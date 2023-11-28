<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $fillable = ['titulo', 'contenido', 'user_id', 'fecha_creacion', 'color'];
    use HasFactory;
    public function categorias(){
        return $this->belongsToMany(Categoria::class);
    }

    public function etiquetas(){
        return $this->belongsToMany(Etiqueta::class);
    }

    public function user(){
        $this->belongsTo(User::class);
    }
}
