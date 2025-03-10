<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anime;
use Illuminate\Support\Facades\Storage;

class AnimeStoreController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'year' => 'required|numeric|digits:4|between:1900,' . date('Y'),
            'genre' => 'required|array',
            'demografia' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $genres = implode(',', $request->input('genre')); // Convierte array a string

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = 'images/' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imagePath);
        }

        Anime::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'year' => $request->input('year'),
            'genre' => $genres,
            'demografia' => $request->input('demografia'),
            'image' => $imagePath,
        ]);

        return redirect('/animes')->with('success', 'Anime creado exitosamente.');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'year' => 'required|numeric|digits:4|between:1900,' . date('Y'),
            'genre' => 'required|array',
            'demografia' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $anime = Anime::findOrFail($id);

        $genres = implode(',', $request->input('genre'));

        if ($request->hasFile('image')) {
            if ($anime->image && file_exists(public_path('images/' . $anime->image))) {
                unlink(public_path('images/' . $anime->image));
            }

            $imagePath = 'images/' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $imagePath);
            $anime->image = $imagePath;
        }

        $anime->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'year' => $request->input('year'),
            'genre' => $genres,
            'demografia' => $request->input('demografia'),
        ]);

        return redirect('/animes')->with('success', 'Anime actualizado exitosamente.');
    }
}
