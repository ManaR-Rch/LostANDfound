<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Annonce;
use Illuminate\Http\Request;

class CommentaireController extends Controller {
    public function store(Request $request, $annonce_id) {
        $request->validate([
            'contenu' => 'required|string|max:500',
        ]);
    
        Commentaire::create([
            'annonce_id' => $annonce_id,
            'user_id' => auth()->id(),
            'contenu' => $request->contenu,
        ]);
    
        return back()->with('success', 'Commentaire ajouté avec succès.');
    }
    
}

