<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Http\Request;
use App\Models\Rating; // Asegúrate de tener un modelo de Rating

class AnimeController extends Controller
{
    public function rate(Request $request, $animeId)
{
    $userId = session('user_id'); // Obtén la ID del usuario desde la sesión

    if (!$userId) {
        return redirect('/login')->withErrors(['usuario' => 'Debes iniciar sesión para puntuar.']);
    }

    // Validar la entrada
    $request->validate([
        'rating' => 'required|integer|between:1,5', // Asegúrate de que la calificación esté entre 1 y 5
    ]);

    // Verifica si ya existe una calificación para este anime por parte del usuario
    $existingRating = Rating::where('user_id', $userId)->where('anime_id', $animeId)->first();

    if ($existingRating) {
        // Si ya existe, actualizamos la calificación
        $existingRating->update([
            'rating' => $request->rating,
        ]);
    } else {
        // Si no existe, creamos una nueva calificación
        Rating::create([
            'user_id' => $userId,
            'anime_id' => $animeId,
            'rating' => $request->rating,
        ]);
    }

    return back()->with('success', 'Calificación guardada correctamente.');
}

    public function index(Request $request)
{
    // Creamos una consulta base para los animes
    $query = Anime::query();

    // Verifica si el usuario está autenticado y tiene el rol de admin
    $isAdmin = session('user') && session('user')->rol === 'admin';

    $user = session('user');

    // Filtrar por género si se ha enviado el parámetro 'genre'
    if ($request->has('genre') && $request->genre != '') {
        // Asumimos que los géneros están almacenados como una lista separada por comas
        $query->where('genre', 'like', '%' . $request->genre . '%');
    }

    // Filtrar por demografía si se ha enviado el parámetro 'demografia'
    if ($request->has('demografia') && $request->demografia != '') {
        $query->where('demografia', $request->demografia);
    }

    // Ejecutar la consulta y obtener los resultados
    $animes = $query->get();

    // Pasa los géneros y demografías al filtro
    $genres = [
        'Acción', 'Aventura', 'Comedia', 'Drama', 'Fantasía', 'Magia', 'Misterio',
        'Psicológico', 'Romance', 'Ciencia Ficción', 'Slice of Life', 'Terror', 'Deportes'
    ];

    $demografias = [
        'Shōnen', 'Shōjo', 'Seinen', 'Josei', 'Kodomo'
    ];

    // Retornamos la vista con los datos necesarios
    return view('animes.index', compact('animes', 'genres', 'demografias', 'isAdmin', 'user'));
}

    public function show($id)
    {
        $anime = Anime::findOrFail($id);

        // Verifica si el usuario está autenticado y es administrador
        $isAdmin = session('user') && session('user')->rol === 'admin';

        // Pasa la información del anime y el rol del usuario a la vista
        $user = session('user');

        return view('animes.show', compact('anime', 'isAdmin', 'user'));
    }
}
