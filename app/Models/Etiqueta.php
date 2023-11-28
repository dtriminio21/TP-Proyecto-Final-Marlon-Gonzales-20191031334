<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Nota;

class Etiqueta extends Model
{
    use HasFactory;
    protected $fillable = ['nombre'];
    public function notas(){
        return $this->belongsToMany(Nota::class);
    }
}
