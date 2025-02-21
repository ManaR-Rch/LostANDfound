<?php
namespace App\Http\Controllers;
use App\Models\Annonce;
use Illuminate\Http\Request;

class AnnonceController extends Controller
{
    public function index(){
        $annonces = Annonce::all();
        return view('annonces.index',compact('annonces'));
    }
    public function create(){
        return view('annonces.create');
    }
    public function store(Request $request){
        $request->validate([
            'titre'=> 'required|max:255',
            'description'=> 'required',
            'categorie'=> 'required',
            'lieu' => 'required',
            'date_perdu_trouve' => 'required|date',
            'contact_email' => 'required|email',
            'contact_telephone' => 'required',
            'image' => 'nullable|image|max:2048'
        ]);
        $imagePath = $request->file('image') ? $request->file('image')->store('annonce','public') : null;
        
        Annonce::create( [
            'titre'=>$request->titre,
            'description' => $request->description,
            'categorie' => $request->categorie,
            'lieu' => $request->lieu,
            'date_perdu_trouve' => $request->date_perdu_trouve,
            'contact_email' => $request->contact_email,
            'contact_telephone' => $request->contact_telephone,
            'image' => $imagePath,
            'user_id' => auth()->id()
        ]);

        return redirect()->route('annonces.index')->with('success','Annonce publiee avec succes');
    }

}
