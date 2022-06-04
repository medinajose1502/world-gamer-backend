<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Publicacion extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'descripcion','imagen','nro_likes','nro_comentarios','isLiked','isFavorite','estado','user_id', 'etiquetas'
    ];

    protected $with = ['user'];

    public function getNroComentariosAttribute(){
        return $this->hasMany(Comentario::class)->count();
    }
    
    public function getNroLikesAttribute(){
        return $this->hasMany(MeGusta::class)->count();
    }

    public function user()
    {
        return  $this->belongsTo(User::class);
    }

    public function comentarios(){
        return $this->hasMany(Comentario::class);
    }

    public function megusta(){
        return $this->hasMany(MeGusta::class);
    }

    public function favorito(){
        return $this->hasMany(Favorito::class);
    }
}