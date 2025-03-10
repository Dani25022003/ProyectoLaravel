<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Establecer la imagen de fondo */
        @font-face {
            font-family: 'MiFuente';
            src: url('/Fonts/bloodcrow.ttf') format('truetype'); /* Ajusta la ruta según sea necesario */
            font-weight: normal;
            font-style: normal;
        }

        /* Aplicar la fuente a un elemento */
        h1{
            font-family: 'MiFuente', sans-serif;
        }
        body {
            background-image: url("{{ asset('images/fondo.jpg') }}");
            background-size: cover;  /* Hace que la imagen cubra toda el área */
            background-position: center;  /* Centra la imagen */
            background-attachment: fixed;  /* Fija la imagen mientras se hace scroll */
            color: white;  /* Cambiar color del texto para que sea visible sobre el fondo */
        }

        .content {
            padding: 50px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <h1 class="mt-5">Bienvenido a mi lista de anime</h1>
        <p class="mt-3">Para continuar, por favor inicie sesión o regístrese si aún no tiene una cuenta.</p>
        
        <!-- Botones de inicio de sesión y registro -->
        <div class="mt-5 mb-5">
            <a href="{{ route('login') }}" class="btn btn-primary">Iniciar Sesión</a>
            <a href="{{ route('register.form') }}" class="btn btn-secondary">Registrarse</a>
        </div>
        <img src="/images/Gojo.gif">
    </div>
</body>
</html>
