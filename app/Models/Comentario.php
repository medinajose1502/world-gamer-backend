<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;
    protected $fillable=['descripcion','estado', 'user_id','publicacion_id'];

    protected $with = ['user'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
