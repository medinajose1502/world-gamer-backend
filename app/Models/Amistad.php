<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amistad extends Model
{
    use HasFactory;
    protected $fillable=['estado', 'user_id', 'amigo_id'];

    public function usuario(){
        return $this->belongsTo(User::class);
    }

    public function amistad(){
        return $this->belongsTo(User::class,'amigo_id');
    }
}
