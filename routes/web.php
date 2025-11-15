<?php

use App\Http\Controllers\KeysController;
use App\Http\Controllers\ProfileController;
use App\Models\Respuestas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

// ruta por defecto: login
Route::get('/', function () {
    return view('auth/login');
});

// dashboard de inicio una vez que el usuario se haya autenticado
Route::get('/dashboard', function () {

    //obtenemos los votos que han sido registrado por cada una de las preguntas

    //votos de la pregunta1
    $votosPregunta1 = Respuestas::select('opciones.texto as opcion', 'respuestas.opcion_id', DB::raw('COUNT(*) as total_votos'))
    ->join('opciones', 'respuestas.opcion_id', '=', 'opciones.id')
    ->where('respuestas.pregunta_id', 1)
    ->groupBy('respuestas.opcion_id', 'opciones.texto')
    ->get();

    $labels1 = $votosPregunta1->pluck('opcion');
    $series1 = $votosPregunta1->pluck('total_votos');



    //votos de la pregunta 2
    $votosPregunta2 = Respuestas::select('opciones.texto as opcion', 'respuestas.opcion_id', DB::raw('COUNT(*) as total_votos'))
    ->join('opciones', 'respuestas.opcion_id', '=', 'opciones.id')
    ->where('respuestas.pregunta_id', 2)
    ->groupBy('respuestas.opcion_id', 'opciones.texto')
    ->get();

    $labels2 = $votosPregunta2->pluck('opcion');
    $series2 = $votosPregunta2->pluck('total_votos');



    //votos de la pregunta 3
    $votosPregunta3 = Respuestas::select('opciones.texto as opcion', 'respuestas.opcion_id', DB::raw('COUNT(*) as total_votos'))
    ->join('opciones', 'respuestas.opcion_id', '=', 'opciones.id')
    ->where('respuestas.pregunta_id', 3)
    ->groupBy('respuestas.opcion_id', 'opciones.texto')
    ->get();

    $labels3 = $votosPregunta3->pluck('opcion');
    $series3 = $votosPregunta3->pluck('total_votos');

    //mandamos al dash toda la informacion de las preguntas 
    return view('dashboard', compact('labels1','series1','labels2','series2','labels3','series3'));
})->middleware(['auth', 'verified'])->name('dashboard');



//rutas para cuando el ausuario este autenticado
Route::middleware('auth')->group(function () {
    //para la generacion de llaves
    Route::get('/keys',[KeysController::class,'index'])->name('keys');
    Route::post('/keys',[KeysController::class,'generate'])->name('keys.generate');
    
    //para hacer la firma digital del formulario
    Route::get('/form',[KeysController::class,'votar'])->name('keys.votar');
    Route::post('/form',[KeysController::class,'validar'])->name('keys.validar');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
