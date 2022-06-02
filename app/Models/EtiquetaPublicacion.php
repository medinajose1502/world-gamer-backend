<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtiquetaPublicacion extends Model
{
    use HasFactory;

    protected $fillable = ['publicacion_id','etiqueta_id'];

    public function publicacion(){
        return $this->belongsTo(Publicacion::class);
    }

    public function etiqueta(){
        return $this->belongsTo(Etiqueta::class);
    }
}
