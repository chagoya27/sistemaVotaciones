<x-app-layout>
    <div class="body">
        <div class="container">
            <h1>Consulta Estudiantil</h1>
            <p class="subtitle">Tu opinión cuenta. Participa en esta votación organizada por la comunidad estudiantil.</p>

            <form action="{{route('keys.validar')}}" id="votacionForm"  name="votacionForm" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Sección 1 -->
            <h2>Opinión general</h2>
            <p class="pregunta">¿Estás de acuerdo con realizar un paro estudiantil como forma de protesta ante las condiciones actuales?</p>
            <label class="opcion">
                <input type="radio" name="paro" value="a_favor" required> Sí, estoy a favor del paro.
            </label>
            <label class="opcion">
                <input type="radio" name="paro" value="en_contra"> No, estoy en contra del paro.
            </label>
            <label class="opcion">
                <input type="radio" name="paro" value="abstencion"> Me abstengo / No tengo postura.
            </label>

            <!-- Sección 2 -->
            <h2>Actividades durante el paro</h2>
            <p class="pregunta">En caso de realizarse el paro, ¿qué alternativa consideras mejor?</p>
            <label class="opcion">
                <input type="radio" name="actividad" value="en_linea" required> Continuar con clases en línea.
            </label>
            <label class="opcion">
                <input type="radio" name="actividad" value="suspender"> Suspender completamente las clases.
            </label>
            <label class="opcion">
                <input type="radio" name="actividad" value="informativas"> Asistir solo a actividades informativas o de organización estudiantil.
            </label>
            <label class="opcion">
                <input type="radio" name="actividad" value="otra"> Otra (especificar):
            </label>
            <input type="text" id="otraActividad" name="otraActividad" placeholder="Escribe tu opción" class="input-opcional">

            <!-- Sección 3 -->
            <h2>Duración del paro</h2>
            <p class="pregunta">¿Cuánto tiempo consideras adecuado para un paro?</p>
            <label class="opcion">
                <input type="radio" name="duracion" value="1_dia" required> 1 día
            </label>
            <label class="opcion">
                <input type="radio" name="duracion" value="3_dias"> 3 días
            </label>
            <label class="opcion">
                <input type="radio" name="duracion" value="1_semana"> 1 semana
            </label>
            <label class="opcion">
                <input type="radio" name="duracion" value="hasta_demanda"> Hasta que se cumplan las demandas
            </label>
            <label class="opcion">
                <input type="radio" name="duracion" value="otra"> Otro (especificar):
            </label>
            <input type="text" id="otraDuracion" name="otraDuracion" placeholder="Escribe tu opción" class="input-opcional">

            <!-- Sección 4 -->
            <h2>Comentarios</h2>
            <textarea name="comentarios" id="comentarios" rows="4" placeholder="¿Quieres agregar alguna propuesta o comentario sobre el paro? (opcional)"></textarea>

            <!-- Sección 5 -->
            <label class="confirmacion">
                <input type="checkbox" required> Confirmo que mi voto es personal y único.
            </label>

            <label>Sube tu llave privada:</label>
            <input type="file" name="private_key" accept=".pem" required>

            <button class="btn-encuesta" type="submit">Enviar respuestas</button>
            </form>

            <p id="mensajeFinal" class="oculto">Gracias por participar en la consulta estudiantil. Tus respuestas ayudarán a tomar decisiones colectivas.</p>
        </div>
    </div>
</x-app-layout>