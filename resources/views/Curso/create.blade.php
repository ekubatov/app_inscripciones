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
 			   <div class="float-left"><h3>Nuevo Curso</h3></div>

 			<form method="POST" action="{{ route('Curso.store') }}"  role="form">
			{{ csrf_field() }}

				<div class="form-group">
 					<input type="text" class="form-control" name="curso" id="curso" placeholder="Nombre del Curso">
				</div>

				<input type="submit"  value="Guardar" class="btn btn-success btn-block">
				<a href="{{ route('Curso.index') }}" class="btn btn-primary btn-block" >Atrás</a>
	

			</form>
		</div>
      </div>

    </div>
  </div>

@endsection