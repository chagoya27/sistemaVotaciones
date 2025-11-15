<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistema votaciones</title>
</head>
<body>
    <main>
        <form action="{{route('store')}}" method="POST" class="formulario" name="formulario">
            @csrf
            <h1>Registrase</h1>

            <div class="labels">
                <div class="formulario-grupo">
                    <input type="text" placeholder="Nombre" class="formulario-input" name="name">
                </div>

                <div class="formulario-grupo">
                    <input type="text" placeholder="Apellido Paterno" class="formulario-input" name="last_name1">
                </div>


                <div class="formulario-grupo">
                    <input type="text" placeholder="Apellido Materno" class="formulario-input" name="last_name2">
                </div>

                <div class="formulario-grupo">
                    <input type="text" placeholder="Nombre de usuario" class="formulario-input" name="user_name">
                </div>

                
                <div class="formulario-grupo">
                    <input type="password" placeholder="Contraseña" class="formulario-input" name="password">
                </div>


                <button type="submit" class="btn"><span>Registrarse</span></button>
            </div>

        </form>

    </main>
</body>
</html>