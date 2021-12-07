<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
  

class Inscripcion extends Model
{
    //
    protected $fillable = ['alumno_id', 'curso_id'];
 
    public function alumno()
    {
         return $this->belongsTo(Alumno::class);
    }

    public function curso()
    {
         return $this->belongsTo(Curso::class);
    }
 
}
