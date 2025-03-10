<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
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
        <h1 class="mt-5">Registro de Usuario</h1>
        <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
            </div>

            <!-- Campo para elegir el rol -->
            <div class="form-group">
                <label for="rol">Seleccionar Rol:</label>
                <select name="rol" id="rol" class="form-control" required>
                    <option value="usuario">Usuario</option>
                    <option value="admin">Administrador</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
</body>
</html>
