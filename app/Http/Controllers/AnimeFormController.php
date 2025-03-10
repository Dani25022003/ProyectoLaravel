<?php

namespace App\Http\Controllers;

use App\Models\Anime;

class AnimeFormController extends Controller
{
    public function create()
    {
        $genres = [
            'Acción',
            'Aventura',
            'Comedia',
            'Drama',
            'Fantasía',
            'Magia',
            'Misterio',
            'Psicológico',
            'Romance',
            'Ciencia Ficción',
            'Slice of Life',
            'Terror',
            'Deportes'
        ];

        $demografias = [
            'Shōnen',
            'Shōjo',
            'Seinen',
            'Josei',
            'Kodomo'
        ];

        return view('animes.create', compact('genres', 'demografias'));
    }

    public function edit($id)
    {
        $anime = Anime::findOrFail($id);

        $genres = [
            'Acción',
            'Aventura',
            'Comedia',
            'Drama',
            'Fantasía',
            'Magia',
            'Misterio',
            'Psicológico',
            'Romance',
            'Ciencia Ficción',
            'Slice of Life',
            'Terror',
            'Deportes'
        ];

        $demografias = [
            'Shōnen',
            'Shōjo',
            'Seinen',
            'Josei',
            'Kodomo'
        ];

        return view('animes.edit', compact('anime', 'genres', 'demografias'));
    }
}
