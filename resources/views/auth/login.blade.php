<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url("{{ asset('images/fondo.jpg') }}");
            background-size: cover;  /* Hace que la imagen cubra toda el área */
            background-position: center;  /* Centra la imagen */
            background-attachment: fixed;  /* Fija la imagen mientras se hace scroll */
            color: white;  /* Cambiar color del texto para que sea visible sobre el fondo */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Iniciar Sesión</h1>
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>
