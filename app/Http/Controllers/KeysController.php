<?php

namespace App\Http\Controllers;

use App\Models\Consultas;
use App\Models\Opciones;
use App\Models\Preguntas;
use App\Models\Respuestas;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use phpseclib3\Crypt\PublicKeyLoader;
use phpseclib3\Crypt\RSA;
use phpseclib3\Exception\NoKeyLoadedException;

class KeysController extends Controller
{
    /* Da la vista para generar las llaves*/
    public function index(){
        return view('keys');
    }

    /* Genera las llaves
    La llave pública se guarda en la base de datos
    La llave privada se le da al usuario*/
    public function generate(Request $request){

        $user = Auth::user();
        // Generar llaves RSA de 2048 bits en formato PKCS8
        $keyPair = RSA::createKey(2048);
        $publicKey = $keyPair->getPublicKey()->toString('PKCS8');
        $privateKey = $keyPair->toString('PKCS8');

        // Guardar la pública en la BD
        $user->public_key = $publicKey;
        $user->save();

        // Entregar la privada al usuario
        return response()->streamDownload(function () use ($privateKey) {
            echo $privateKey;
        }, 'private.pem');
    }

    /* Da la vista con la encuesta*/
    public function votar (){
        return view('votar');
    }

    /*Valida el contenido de la llave que carga el usuario
    En caso de que sea una llave válida hace la firma digital
    y verifica si coincide con la llave publica almecenada en la BD*/
    public function validar (Request $request){   

        $user = Auth::user();

         // Leer contenido del archivo subido
        try {
            $privatePem = file_get_contents($request->file('private_key')->getRealPath());
        } catch (\Throwable $t) {
            // Error leyendo el archivo
            return back()->withErrors(['private_key' => 'No se pudo leer el archivo subido.']);
        }

        // Intentar cargar la llave privada con phpseclib y capturar excepción si es inválida
        try {
            $privateKey = PublicKeyLoader::loadPrivateKey($privatePem);
        } catch (NoKeyLoadedException $e) {
            // Llave inválida / malformada
            Log::warning('Private key inválida subida por usuario ID ' . $user->id . '. Error: ' . $e->getMessage());
            return back()->withErrors([
                'private_key' => 'El archivo .pem proporcionado no contiene una llave privada válida.'
            ]);
        } catch (\Throwable $e) {
            // Otro error inesperado
            Log::error('Error al cargar private key para usuario ID ' . $user->id . '. ' . $e->getMessage());
            return back()->withErrors([
                'private_key' => 'Ocurrió un error al procesar la llave privada. Inténtalo de nuevo.'
            ]);
        }

        // Firmar el voto
        try {
            //sign es para aplicar el agoritmo RSA , produce una firma binaria
            //se pasa a base 64 para que sea un texto legible
            $firma = base64_encode($privateKey->sign($request->voto));
        } catch (\Throwable $e) {
            Log::error('Error firmando con private key para usuario ID ' . $user->id . '. ' . $e->getMessage());
            return back()->withErrors([
                'private_key' => 'No se pudo generar la firma con la llave privada proporcionada.'
            ]);
        }

        // Verifica si la firma coincide con la llave publica almacenada en la BD
        try {
            $publicKeyPem = $user->public_key;
            //valida si el usuario tiene llave publica en la base de datos
            if (empty($publicKeyPem)) {
                return back()->withErrors(['public_key' => 'No se encontró llave pública asociada al usuario.']);
            }
            //convierte el texto plano del PEM en un objeto para verificar firmas
            $publicKey = PublicKeyLoader::load($publicKeyPem);

            //verficia si la firma fue generada con la llave privada corredpondiente a la llave publica
            $isValid = $publicKey->verify($request->voto, base64_decode($firma));
            if (! $isValid) {
                return back()->withErrors(['firma' => 'La firma no coincide con la llave pública registrada.']);
            }
        } catch (\Throwable $e) {
            Log::error('Error verificando firma para usuario ID ' . $user->id . '. ' . $e->getMessage());
            return back()->withErrors(['firma' => 'Error al verificar la firma.']);
        }

        
        // si la clave es valida procedemos a registrar las respuestas
        $idConsultas = Consultas::where('titulo', 'ilike','consulta estudiantil')->first()?->id;
        
        //respuestas de la pregunta 1
        $idPregunta = Preguntas::where('orden','1')->first()?->id;
        $idOpcion = Opciones::where ('valor',$request->paro)->first()?->id;
        Respuestas::Create([
            'user_id' => $user->id,
            'consulta_id' => $idConsultas,
            'pregunta_id' => $idPregunta,
            'opcion_id' => $idOpcion,
            'fecha_respuesta' => Carbon::now()
        ]);


        //respuestas de la pregunta 2
        $idPregunta = Preguntas::where('orden','2')->first()?->id;
        $idOpcion = Opciones::where ('valor',$request->actividad)->first()?->id;
        Respuestas::Create([
            'user_id' => $user->id,
            'consulta_id' => $idConsultas,
            'pregunta_id' => $idPregunta,
            'opcion_id' => $idOpcion,
            'fecha_respuesta' => Carbon::now()
        ]);


        // respuestas de la pregunta 3
        $idPregunta = Preguntas::where('orden','3')->first()?->id;
        $idOpcion = Opciones::where ('valor',$request->duracion)->first()?->id;
        Respuestas::Create([
            'user_id' => $user->id,
            'consulta_id' => $idConsultas,
            'pregunta_id' => $idPregunta,
            'opcion_id' => $idOpcion,
            'fecha_respuesta' => Carbon::now()
        ]);


        return redirect()->route('dashboard')->with('success', 'Tu voto ha sido registrado correctamente.');
    }
}
