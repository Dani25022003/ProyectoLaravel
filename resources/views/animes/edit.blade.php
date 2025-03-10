<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Anime</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url("{{ asset('images/fondo.jpg') }}");
            background-size: cover;  /* Hace que la imagen cubra toda el área */
            background-position: center;  /* Centra la imagen */
            background-attachment: fixed;  /* Fija la imagen mientras se hace scroll */
            font-family: 'Arial', sans-serif;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.9);  /* Fondo blanco con opacidad */
            border-radius: 10px;
            padding: 30px;
            margin-top: 50px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .form-group label {
            font-weight: bold;
            color: #333;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #ccc;
            box-shadow: none;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            font-size: 1.1rem;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .btn-link {
            font-size: 1rem;
            color: #007bff;
            text-decoration: none;
        }

        .btn-link:hover {
            text-decoration: underline;
        }

        .form-group img {
            border-radius: 5px;
            margin-top: 10px;
        }

        .form-group select {
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 10px;
        }

        .form-group select:focus {
            border-color: #007bff;
        }

        /* Estilo para los botones de acción */
        .btn-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .form-control {
            margin-bottom: 15px;
        }

        .form-control[type="file"] {
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Anime</h1>
        <form action="/animes/{{ $anime->id }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Título:</label>
                <input type="text" id="title" name="title" value="{{ $anime->title }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Descripción:</label>
                <textarea id="description" name="description" class="form-control" required>{{ $anime->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="year">Año de estreno:</label>
                <input type="text" id="year" name="year" value="{{ $anime->year }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="genre">Géneros:</label>
                <select id="genre" name="genre[]" class="form-control" multiple required>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre }}" 
                            @if(isset($anime) && in_array($genre, explode(',', $anime->genre))) selected @endif>
                            {{ $genre }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="demografia">Demografía:</label>
                <select id="demografia" name="demografia" class="form-control" required>
                    <option value="" disabled>Selecciona una demografía</option>
                    @foreach ($demografias as $demografia)
                        <option value="{{ $demografia }}" @if($anime->demografia == $demografia) selected @endif>
                            {{ $demografia }}
                        </option>
                    @endforeach
                </select>
            </div>            
            <div class="form-group">
                <label for="image">Imagen:</label>
                <input type="file" id="image" name="image" class="form-control">
                @if($anime->image)
                    <div class="mt-2">
                        <img src="{{ asset($anime->image) }}" alt="Imagen de Anime" width="150">
                    </div>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </form>
        <a href="/animes/{{ $anime->id }}" class="btn btn-link">Cancelar</a>
    </div>
</body>
</html>
