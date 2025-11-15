<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConsultaEstudiantilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //crear la votacion
        $consultaId = DB::table('consultas')->insertGetId([
            'titulo' => 'Consulta Estudiantil',
            'descripcion' => 'Tu opinión cuenta. Participa en esta votación organizada por la comunidad estudiantil.',
            'fecha_inicio' => Carbon::now(),
            'fecha_fin' => Carbon::now()->addDays(7),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | PREGUNTA 1 - Opinión general
        |--------------------------------------------------------------------------
        */
        $pregunta1Id = DB::table('preguntas')->insertGetId([
            'consulta_id' => $consultaId,
            'texto' => '¿Estás de acuerdo con realizar un paro estudiantil como forma de protesta ante las condiciones actuales?',
            'tipo' => 'opcion_unica',
            'orden' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('opciones')->insert([
            ['pregunta_id' => $pregunta1Id, 'texto' => 'Sí, estoy a favor del paro.', 'valor' => 'a_favor', 'orden' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['pregunta_id' => $pregunta1Id, 'texto' => 'No, estoy en contra del paro.', 'valor' => 'en_contra', 'orden' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['pregunta_id' => $pregunta1Id, 'texto' => 'Me abstengo / No tengo postura.', 'valor' => 'abstencion', 'orden' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);

        /*
        |--------------------------------------------------------------------------
        | PREGUNTA 2 - Actividades durante el paro
        |--------------------------------------------------------------------------
        */
        $pregunta2Id = DB::table('preguntas')->insertGetId([
            'consulta_id' => $consultaId,
            'texto' => 'En caso de realizarse el paro, ¿qué alternativa consideras mejor?',
            'tipo' => 'opcion_unica',
            'orden' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('opciones')->insert([
            ['pregunta_id' => $pregunta2Id, 'texto' => 'Continuar con clases en línea.', 'valor' => 'en_linea', 'orden' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['pregunta_id' => $pregunta2Id, 'texto' => 'Suspender completamente las clases.', 'valor' => 'suspender', 'orden' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['pregunta_id' => $pregunta2Id, 'texto' => 'Asistir solo a actividades informativas o de organización estudiantil.', 'valor' => 'informativas', 'orden' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['pregunta_id' => $pregunta2Id, 'texto' => 'Otra (especificar):', 'valor' => null, 'orden' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);

        /*
        |--------------------------------------------------------------------------
        | PREGUNTA 3 - Duración del paro
        |--------------------------------------------------------------------------
        */
        $pregunta3Id = DB::table('preguntas')->insertGetId([
            'consulta_id' => $consultaId,
            'texto' => '¿Cuánto tiempo consideras adecuado para un paro?',
            'tipo' => 'opcion_unica',
            'orden' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('opciones')->insert([
            ['pregunta_id' => $pregunta3Id, 'texto' => '1 día', 'valor' => '1_dia', 'orden' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['pregunta_id' => $pregunta3Id, 'texto' => '3 días', 'valor' => '3_dias', 'orden' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['pregunta_id' => $pregunta3Id, 'texto' => '1 semana', 'valor' => '1_semana', 'orden' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['pregunta_id' => $pregunta3Id, 'texto' => 'Hasta que se cumplan las demandas', 'valor' => 'hasta_demanda', 'orden' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['pregunta_id' => $pregunta3Id, 'texto' => 'Otro (especificar):', 'valor' => null, 'orden' => 5, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
