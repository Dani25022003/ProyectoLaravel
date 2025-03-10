<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $anime->title }}</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @font-face {
            font-family: 'MiFuente';
            src: url('/Fonts/bloodcrow.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        body {
            background-color: #f4f6f9;
            font-family: Arial, sans-serif;
            background-image: url("{{ asset('images/fondoIndex.jpg') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .anime-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 50px;
            margin-top: 30px;
        }

        .anime-card img {
            border-radius: 8px;
            margin-bottom: 15px;
            max-width: 100%;
            height: auto;
            max-height: 300px;
        }

        .anime-card h1 {
            font-size: 3rem;
            color: #333;
            font-family: 'MiFuente', sans-serif;
        }

        input[type="radio"] {
            display: none;
        }

        label img {
            cursor: pointer;
        }

        label img:hover, label img:hover ~ img {
            filter: brightness(1.3);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="anime-card mx-auto" style="max-width: 900px;">
            <div class="row">
                <div class="col-md-7">
                    <h1 class="text-primary">{{ $anime->title }}</h1>
                    <p><strong>Descripción:</strong> {{ $anime->description }}</p>
                    <p><strong>Año de estreno:</strong> {{ $anime->year }}</p>
                    <p><strong>Demografía:</strong> {{ $anime->demografia }}</p>
                    <p><strong>Géneros:</strong> {{ implode(', ', explode(',', $anime->genre)) }}</p>
                </div>
                <div class="col-md-5">
                    @if($anime->image)
                        <img src="{{ asset($anime->image) }}" alt="Imagen de Anime" class="img-fluid rounded">
                    @endif
                </div>
            </div>

            <!-- Mostrar promedio de calificación -->
            <div class="d-flex align-items-center mt-3">
                <strong>Calificación:</strong>
                <div class="ml-2">
                    @php 
                        $average = round($anime->ratings()->avg('rating'), 1) ?? 0; 
                    @endphp
                    @for ($i = 1; $i <= 5; $i++)
                        <img src="{{ asset($i <= $average ? 'images/star-filled.png' : 'images/star-empty.png') }}" width="20">
                    @endfor
                    ({{ $average }}/5)
                </div>
            </div>

            <!-- Calificación del usuario -->
            @if(!$isAdmin)  <!-- Verifica si el usuario no es admin -->
                @php
                    $userRating = $anime->ratings()->where('user_id', auth()->id())->value('rating') ?? 0;
                @endphp

                <form action="{{ url('/animes/'.$anime->id.'/rate') }}" method="POST" class="mt-3">
                    @csrf
                    <label><strong>Tu puntuación:</strong></label>
                    <div>
                        @for ($i = 1; $i <= 5; $i++)
                            <input type="radio" name="rating" value="{{ $i }}" id="star{{ $i }}" 
                                {{ $userRating == $i ? 'checked' : '' }}>
                            <label for="star{{ $i }}">
                                <img src="{{ asset($i <= $userRating ? 'images/star-filled.png' : 'images/star-empty.png') }}" width="20">
                            </label>
                        @endfor
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm mt-2">Puntuar</button>
                </form>

                @if(session('success'))
                    <div class="alert alert-success mt-2">
                        {{ session('success') }}
                    </div>
                @endif
            @endif

            <!-- Botones de navegación -->
            <div class="mt-3">
                <a href="/animes" class="btn btn-outline-secondary">Volver a la lista de animes</a>
                @if($isAdmin)
                    <a href="/animes/{{ $anime->id }}/edit" class="btn btn-primary">Editar</a>
                    <form action="/animes/{{ $anime->id }}" method="post" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
