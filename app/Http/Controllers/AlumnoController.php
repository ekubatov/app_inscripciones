<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alumno;


class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $alumnos=Alumno::orderBy('id','DESC')->paginate(3);
        return view('Alumno.index',compact('alumnos')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Alumno.create');

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
        $this->validate($request,[ 'alumno'=>'required' ]);
        Alumno::create($request->all());
        return redirect()->route('Alumno.index')->with('success','Registro creado satisfactoriamente');        
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
        $alumnos=Alumno::find($id);
        return  view('alumno.show',compact('alumnos'));        
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
        $alumno=Alumno::find($id);
        return view('alumno.edit',compact('alumno'));        
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
        $this->validate($request,[ 'alumno'=>'required' ]);

        alumno::find($id)->update($request->all());
        return redirect()->route('Alumno.index')->with('success','Registro actualizado satisfactoriamente');

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
        alumno::find($id)->delete();
        return redirect()->route('Alumno.index')->with('success','Registro eliminado satisfactoriamente');        
    }
}
