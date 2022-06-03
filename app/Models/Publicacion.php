<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'descripcion','imagen','nro_likes','nro_comentarios','isLiked','isFavorite','estado','user_id', 'etiquetas'
    ];

    public function user()
    {
        return  $this->belongsTo(User::class);
    }

    public function etiquetaPublicacion(){
        return $this-> hasMany(EtiquetaPublicacion::class);
    }
}
