@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Inscripciones') }}</div>

                <div class="card-body">

                    <div class="row">
                        <div class="col center">
                            <a href="{{ url('/Curso') }}" class="btn btn-primary" type="button">Cursos</a>
                        </div>
                        <div class="col center">
                            <a href="{{ url('/Profesor') }}" class="btn btn-primary" type="button">Profesores</a>
                        </div>
                        <div class="col center">
                            <a href="{{ url('/Alumno') }}" class="btn btn-primary" type="button">ALumnos</a>
                        </div>
                        <div class="col center">
                            <a href="{{ url('/Inscripcion') }}" class="btn btn-success" type="button">Inscripciones</a>
                        </div>                        
                    </div>
                   
                
                </div>
            </div>
        </div>
    </div>    
</div>
@endsection
