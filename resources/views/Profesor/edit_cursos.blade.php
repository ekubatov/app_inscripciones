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
 			   <div class="float-left"><h3>{{ $profesor->profesor }}</h3></div>
                <form method="POST" action="{{ route('profesor.update_cursos',$profesor->id) }}"  role="form">
							{{ csrf_field() }}
					
                            <div class="form-group">
                           <select multiple="multiple" name="cursos[]" id="cursos">
                                    @foreach ($list_cursos as $desc=>$id) 
                                        <option value="{{$id}}" @foreach($profesor->cursos as $p) @if($id == $p->id)selected="selected"@endif @endforeach>{{$desc}}</option>
                                    @endforeach
                                </select>                                
							</div>  

							<input type="submit"  value="Guardar" class="btn btn-success btn-block">
							<a href="{{ route('Profesor.index') }}" class="btn btn-primary btn-block" >Atrás</a>

						</form>
					</div>
				</div>
			   </div>
	</div>
</div>
@endsection