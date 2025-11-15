<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Inicia Sesion</title>
</head>
<body>
    <main>
        <form action="{{route('login')}}"  method="POST"  class="formulario" name="formulario">
            @csrf
            <h1>Iniciar Sesion</h1>
            <section class="labels">
                <div class="formulario-grupo">
                    <input type="text" name= "user_name" class="formulario-input" placeholder="user_name">
                </div>
    
                <div class="formulario-grupo">
                    <input type="password" name="password" class="formulario-input" placeholder="Contraseña">
                </div>

                <button class="btn" type="submit"><span>Entrar</span></button>

            </section>


            <section class="link">
                <a href="{{route('register')}}">¿No tienes cuenta? Crea una</a>
            </section>
        </form>


    </main>


    <script src="https://kit.fontawesome.com/8ceb30feb6.js" crossorigin="anonymous"></script>
</body>
</html>