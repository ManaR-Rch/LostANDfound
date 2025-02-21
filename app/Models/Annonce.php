<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    use HasFactory;
    protected $fillable = ['titre', 'description', 'lieu', 'categorie', 'contact_email', 'contact_telephone','date_perdu_trouve', 'photo', 'contact', 'user_id'];
    
    public function commentaires() {
        return $this->hasMany(Commentaire::class);
    }
    

}
