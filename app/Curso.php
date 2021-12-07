<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
 
class Curso extends Model
{
    protected $fillable = ['curso'];
    
    public function profesors()
    {
        return $this->belongsToMany(Profesor::class);
    }

    public function inscripcions()
    {
         return $this->hasMany(Inscripcion::class);
    }    

}