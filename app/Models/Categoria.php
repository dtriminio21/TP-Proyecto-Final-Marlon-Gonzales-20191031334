<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Nota;
class Categoria extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'user_id'];
    public function notas(){
        return $this->belongsToMany(Nota::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
