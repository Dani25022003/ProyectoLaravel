<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Animes</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @font-face {
            font-family: 'MiFuente';
            src: url('/Fonts/bloodcrow.ttf') format('truetype'); /* Ajusta la ruta según sea necesario */
            font-weight: normal;
            font-style: normal;
        }

        /* Aplicar la fuente a un elemento */
        h1, h5 {
            font-family: 'MiFuente', sans-serif;
        }

        body {
            background-image: url("{{ asset('images/fondo.jpg') }}");
            background-size: cover;  /* Hace que la imagen cubra toda el área */
            background-position: center;  /* Centra la imagen */
            background-attachment: fixed;  /* Fija la imagen mientras se hace scroll */
        }

        /* Establecer un tamaño fijo para las imágenes */
        .anime-image {
            padding: 20px;
            width: 100%; /* La imagen ocupará todo el ancho del contenedor de la tarjeta */
            height: 450px; /* Puedes ajustar la altura que desees */
            object-fit: cover; /* Asegura que la imagen cubra el área sin distorsionarse */
        }

        /* Efecto hover en las tarjetas */
        .card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out; /* Añadir transición suave */
        }

        .card:hover {
            transform: scale(1.05); /* Aumenta el tamaño de la tarjeta al pasar el ratón */
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2); /* Añadir sombra para el efecto visual */
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Botón de Cerrar Sesión -->
        <div class="d-flex justify-content-end p-3">
            @if(session('user'))
              @if($user)
                <img src="images/Hunter-Association-Logo.png" height="25rem" width="35rem">
                <p style="font-family: 'MiFuente', sans-serif; font-size: 2rem; color:white">{{ ucfirst($user->usuario) }}</p>
                @else
                    <p>No has iniciado sesión.</p>
                @endif
            @endif
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn ml-4 btn-danger">Cerrar Sesión</button>
            </form>
        </div>
        
        <h1 class="mt-5" style="font-size: 4rem; text-align: center; color:white">Lista de Animes</h1>

        <!-- Filtro para Género y Demografía (solo para usuarios) -->
        @if(!$isAdmin)
            <form action="{{ url()->current() }}" method="GET" class="mb-4">
                <div class="form-row">
                    <div class="col-md-5">
                        <select name="genre" class="form-control" id="genre">
                            <option value="">Filtrar por Género</option>
                            @foreach ($genres as $genre)
                                <option value="{{ $genre }}" {{ request('genre') == $genre ? 'selected' : '' }}>{{ $genre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <select name="demografia" class="form-control" id="demografia">
                            <option value="">Filtrar por Demografía</option>
                            @foreach ($demografias as $demografia)
                                <option value="{{ $demografia }}" {{ request('demografia') == $demografia ? 'selected' : '' }}>{{ $demografia }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                    </div>
                </div>
            </form>
        @endif

        <div class="row mt-3">
            @foreach ($animes as $anime)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-lg h-100">
                        @if($anime->image)
                            <img src="{{ asset($anime->image) }}" alt="Imagen de Anime" class="anime-image d-block mx-auto mt-3">
                        @endif
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $anime->title }}</h5>
                            <a href="/animes/{{ $anime->id }}" class="btn btn-primary mt-3">Ver detalles</a>
                            @if($isAdmin)
                                <form action="/animes/{{ $anime->id }}" method="post" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-primary mt-3 btn-danger">Eliminar</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($isAdmin)
            <a href="{{ route('animes.create') }}" class="btn btn-primary mt-3 mb-3">Crear Nuevo Anime</a>
        @endif

    </div>
</body>
</html>
