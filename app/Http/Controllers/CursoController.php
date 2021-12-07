<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Curso;
use App\Profesor;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cursos=Curso::orderBy('id','DESC')->paginate(3);
        return view('Curso.index',compact('cursos')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Curso.create');
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
        $this->validate($request,[ 'curso'=>'required']);
        Curso::create($request->all());
        return redirect()->route('Curso.index')->with('success','Registro creado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cursos=Curso::find($id);
        return  view('curso.show',compact('cursos'));
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
        $curso=Curso::find($id);
        return view('curso.edit',compact('curso'));
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
        $this->validate($request,[ 'curso'=>'required']);

        Curso::find($id)->update($request->all());
        return redirect()->route('Curso.index')->with('success','Registro actualizado satisfactoriamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Borrar los curso_profesor asignados a ese curso
        $curso = Curso::find($id);
        $curso->profesors()->detach();

        Curso::find($id)->delete();
        return redirect()->route('Curso.index')->with('success','Registro eliminado satisfactoriamente');
    }
    
    public function edit_profesors($id)
    {
        $curso=Curso::find($id);

        $list_profesors = Profesor::pluck('id', 'profesor')->all();
        
        return view('curso.edit_profesors',compact('curso','list_profesors'));
    }
 
    public function update_profesors(Request $request, $id)    {
        
        $this->validate($request,[ 'profesors'=>'required']);

        $curso = Curso::find($id);

        $curso->profesors()->detach();
        $profesors = $request->input('profesors');     
        $profesor = Profesor::find($profesors);
        $curso->profesors()->attach($profesor);

        return redirect()->route('Curso.index')->with('success','Registro actualizado satisfactoriamente');

    }



}