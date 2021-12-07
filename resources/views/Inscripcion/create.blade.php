@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">

			@if (count($errors) > 0)
			<div class="alert alert-danger">
				<strong>Error!</strong> Revise los campos obligatorios.<br><br>
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
			@if(Session::has('success'))
			<div class="alert alert-info">
				{{Session::get('success')}}
			</div>
			@endif

      <div class="card cardgrid">
        <div class="card-body">
 			   <div class="float-left"><h3>Nueva Inscripción</h3></div>

 			<form method="POST" action="{{ route('Inscripcion.store') }}"  role="form">
			{{ csrf_field() }}


				<div class="form-group">
					<select class="form-control" id="curso_id" name="curso_id">
					<option value="">Elegir Curso</option>
					@foreach ($cursos as $curso)
							<option value="{{ $curso->id }}">{{ $curso->curso }}</option> 
					@endforeach
					</select>
				</div>

				<div class="form-group">
					<select class="form-control" id="alumno_id" name="alumno_id">
					<option value="">Elegir Alumno</option>
					@foreach ($alumnos as $alumno)
							<option value="{{ $alumno->id }}">{{ $alumno->alumno }}</option> 
					@endforeach
					</select>
				</div>

				<input type="submit"  value="Guardar" class="btn btn-success btn-block">
				<a href="{{ route('Inscripcion.index') }}" class="btn btn-primary btn-block" >Atrás</a>
	

			</form>
		</div>
      </div>

    </div>
  </div>

@endsection