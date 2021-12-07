<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inscripcion;
use App\Alumno;
use App\Curso;


use Illuminate\Support\Facades\DB;


class InscripcionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       $inscripcions=Inscripcion::orderBy('id','DESC')->paginate(3);   

        return view('Inscripcion.index',compact('inscripcions'));         
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $alumnos=Alumno::orderBy('alumno','ASC')->get();   
        $cursos=Curso::orderBy('curso','ASC')->get();   

        return view('Inscripcion.create',compact('alumnos','cursos'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,['alumno_id'=>'required','curso_id'=>'required']);
        Inscripcion::create($request->all());
        return redirect()->route('Inscripcion.index')->with('success','Registro creado satisfactoriamente');        
          
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $inscripcions=Inscripcion::find($id);
        return  view('inscripcion.show',compact('inscripcions'));        
          
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $inscripcion=Inscripcion::find($id);

        $alumnos=Alumno::orderBy('alumno','ASC')->get();   
        $cursos=Curso::orderBy('curso','ASC')->get();   

        return view('inscripcion.edit',compact('inscripcion','alumnos','cursos'));        
          
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request,['alumno_id'=>'required','curso_id'=>'required']);

        inscripcion::find($id)->update($request->all());
        return redirect()->route('Inscripcion.index')->with('success','Registro actualizado satisfactoriamente');

          
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        inscripcion::find($id)->delete();
        return redirect()->route('Inscripcion.index')->with('success','Registro eliminado satisfactoriamente');        
         
    }


    //APIs
    
    //o Alumnos inscriptos a un curso determinado.
    //http://app-inscripciones.test/api/api_inscripcion/7        
    public function api_inscripcion($curso_id)
    { 
        $inscripcions = Inscripcion::select('alumnos.alumno')
        ->leftjoin('alumnos', 'inscripcions.alumno_id', '=', 'alumnos.id')
        ->where('inscripcions.curso_id', $curso_id)->get();

        return response($inscripcions,200);

    }
    /*
    Alumnos y las inscripciones en caso de tener de cada uno. (Este
    endopoint debe obtener la información desde una query cruda y no
    mediante ORM).
    http://app-inscripciones.test/api/api_alumnos
    */       
    public function api_alumnos()
    { 

        $alumnos = DB::table('alumnos')
        ->select('alumnos.alumno', 'cursos.curso')
        ->leftjoin('inscripcions', 'alumnos.id', '=', 'inscripcions.alumno_id')
        ->leftjoin('cursos', 'cursos.id', '=', 'inscripcions.curso_id')
        ->orderBy('alumnos.alumno', 'ASC')
        ->get();

        return response($alumnos,200);
    }




}
