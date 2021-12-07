<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profesor;
use App\Curso;


class ProfesorController extends Controller
{


    public function index()
    {
        //
        $profesors=Profesor::orderBy('id','DESC')->paginate(3);
        return view('Profesor.index',compact('profesors')); 
    }

    public function create()
    {
        //
        return view('Profesor.create');
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
        $this->validate($request,[ 'profesor'=>'required']);
        Profesor::create($request->all());
        return redirect()->route('Profesor.index')->with('success','Registro creado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profesors=Profesor::find($id);
        return  view('profesor.show',compact('profesors'));
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
        $profesor=Profesor::find($id);
        return view('profesor.edit',compact('profesor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)    {
        //
        $this->validate($request,[ 'profesor'=>'required']);

        Profesor::find($id)->update($request->all());
        return redirect()->route('Profesor.index')->with('success','Registro actualizado satisfactoriamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Borrar los curso_profesor asignados a ese profesor
        $profesor = Profesor::find($id);
        $profesor->cursos()->detach();

        Profesor::find($id)->delete();
        return redirect()->route('Profesor.index')->with('success','Registro eliminado satisfactoriamente');
    }

    public function edit_cursos($id)
    {
        $profesor=Profesor::find($id);

        $list_cursos = Curso::pluck('id', 'curso')->all();
        
        return view('profesor.edit_cursos',compact('profesor','list_cursos'));
    }
 
    public function update_cursos(Request $request, $id)    {
        
        $this->validate($request,[ 'cursos'=>'required']);

        $profesor = Profesor::find($id);

        $profesor->cursos()->detach();
        $cursos = $request->input('cursos');     
        $curso = Curso::find($cursos);
        $profesor->cursos()->attach($curso);

        return redirect()->route('Profesor.index')->with('success','Registro actualizado satisfactoriamente');

    }


}
