<?php

namespace App\Http\Controllers;

use App\Models\Anime;

class AnimeDeleteController extends Controller
{
    public function destroy($id)
    {
        $anime = Anime::findOrFail($id);

        if ($anime->image && file_exists(public_path('images/' . $anime->image))) {
            unlink(public_path('images/' . $anime->image));
        }

        $anime->delete();

        return redirect('/animes')->with('success', 'Anime eliminado exitosamente.');
    }
}
