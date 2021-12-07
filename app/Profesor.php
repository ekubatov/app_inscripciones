<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    protected $fillable = ['profesor'];

    public function cursos()
    {
        return $this->belongsToMany(Curso::class);
    }    
}

