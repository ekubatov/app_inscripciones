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
          <div class="float-left"><h3>Lista Alumnos</h3></div>
          <div class="float-right">
            <div class="btn-group-toggle">
              <a href="{{ route('Alumno.create') }}" class="btn btn-primary" >Añadir Alumno</a>
            </div>
          </div>
          <div class="table-container">
            <table id="mytable" class="table table-bordred table-striped">
             <thead>
               <th>Alumno</th>
               <th></th>
               <th></th>
             </thead>
             <tbody>
              @if($alumnos->count())  
              @foreach($alumnos as $alumno)  
              <tr>
                <td>{{$alumno->alumno}}</td>
                <td><a class="btn btn-primary btn-xs" href="{{action('AlumnoController@edit', $alumno->id)}}" >Editar</a></td>
                <td>
                  <form action="{{action('AlumnoController@destroy', $alumno->id)}}" method="post">
                   {{csrf_field()}}
                   <input name="_method" type="hidden" value="DELETE">
                   <button class="btn btn-danger btn-xs" type="submit" onclick="return confirm('¿Confirmar acción de borrado?')">Borrar</button>
                 </td>
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
      <div class="cardpage"> {{ $alumnos->links() }}</div>
    </div>
  </div>

@endsection