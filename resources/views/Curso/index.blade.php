@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
          @if(Session::has('success'))
          <div class="alert alert-success">
            {{Session::get('success')}}
          </div>
          @endif
      <div class="card cardgrid">
        <div class="card-body">
          <div class="float-left"><h3>Lista Cursos</h3></div>
          <div class="float-right">
            <div class="btn-group-toggle">
              <a href="{{ route('Curso.create') }}" class="btn btn-primary" >Añadir Curso</a>
            </div>
          </div>
          <div class="table-container">
            <table id="mytable" class="table table-bordred table-striped">
             <thead>
               <th>Curso</th>
               <th></th>
               <th></th>
               <th></th>
             </thead>
             <tbody>
              @if($cursos->count())  
              @foreach($cursos as $curso)  
              <tr>
                <td>{{$curso->curso}}</td>
                <td><a class="btn btn-primary btn-xs" href="{{action('CursoController@edit', $curso->id)}}" >Editar</a></td>
                <td>
                  <form action="{{action('CursoController@destroy', $curso->id)}}" method="post">
                   {{csrf_field()}}
                   <input name="_method" type="hidden" value="DELETE">
                   <button class="btn btn-danger btn-xs" type="submit" onclick="return confirm('¿Confirmar acción de borrado?')">Borrar</button>
                 </td>
                 <td><a class="btn btn-success btn-xs" href="{{action('CursoController@edit_profesors', $curso->id)}}" >Profesores</a></td>
               </tr>
               @endforeach 
               @else
               <tr>
                <td colspan="8">No hay registros</td>
              </tr>
              @endif
            </tbody>

          </table>
        </div>
      </div>
   <div class="cardpage">{{ $cursos->links() }}</div>
    </div>
  </div>

@endsection