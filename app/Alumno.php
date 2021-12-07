<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    //
    protected $fillable = ['alumno'];


    public function inscripcions()
    {
         return $this->hasMany(Inscripcion::class);
    }

}
