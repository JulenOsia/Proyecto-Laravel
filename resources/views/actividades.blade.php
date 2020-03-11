<div class="panel panel-default">
	<div class="panel-heading">
		Nueva Actividad
	</div>

	<div class="panel-body">
		<!-- Mostrar errores de validación -->
		@include('common.errors')

		<!-- Formulario para añadir una actividad -->
		<form action="{{url('/actividad')}}" method="POST" class="form-horizontal">
			<!-- Evitar XSS Cross Site Scripting -->
			{{ csrf_field() }}
			<!-- Nombre de la actividad  -->
			<div class="form-group">
				<label for="actividad-nombre" class="col-sm-3 control-label">Actividad</label>

				<div class="col-sm-6">
					<input type="text" name="nombre" id="actividad-nombre" class="form-control" value="{{old('nombre')}}">
				</div>
			</div>
			<!-- Fecha de la actividad  -->
			<div class="form-group">
				<label for="actividad-fecha" class="col-sm-3 control-label">Fecha</label>

				<div class="col-sm-6">
					<input type="date" name="fecha" id="actividad-fecha" class="form-control" value="{{old('fecha')}}">
				</div>
			</div>

			<!-- Add Actividad Button -->
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-6">
					<button type="submit" class="btn btn-default">
						<i class="fa fa-plus"></i>Nueva Actividad
					</button>
				</div>
			</div>
		</form>
	</div>

	<div class="form-group" style="background-color: lightgray;
	padding:1em 0;
	 width:50%;
	  margin: 0 25%;
	   border:1px solid black;
	    border-radius: 5px;
	     padding-bottom: 0;
		  margin-bottom:1em">

		<form action="{{url('/actividad/buscar')}}" method="POST" class="form-horizontal">
		{{ csrf_field() }}
			<label class="col-sm-3 control-label">Búsqueda de actividad</label>
			<div class="col-sm-6">
				<input type="text" name='busqueda' class="form-control">
			</div>
			<button type="submit" class="btn btn-info">
				<i class="fa fa-search"></i>buscar
			</button>
		</form>
	</div>

</div>
<!--COMPLETA: extiende el layout -->
@extends ('layouts.app')
<!--COMPLETA: empieza la sección -->
@section('content')
<div class="container">
	<div class="col-sm-offset-2 col-sm-8">

		<!-- En este punto IRA el formulario para añadir una nueva actividad -->

		<!-- Actividades Actuales -->
		@if (count($actividades) > 0)
		<div class="panel panel-default">
			<div class="panel-heading">
				Actividades Actuales
			</div>

			<div class="panel-body">
				<table class="table table-striped task-table">
					<thead>
						<th>Actividad</th>
						<th>Fecha</th>
					</thead>
					<tbody>
						@foreach ($actividades as $actividad)
						<tr>
							<td class="table-text">
								<div>{{$actividad["nombre"]}}</div>
							</td>
							<td class="table-text">
								<div>{{$actividad["fecha"]}}</div>
							</td>
							<td>
								<form action="{{url('/actividad/deleteActividad')}}" method="POST">
									{{ csrf_field() }}
									<!--{{ method_field('DELETE') }}-->
									<input type="hidden" name="id_actividad" value="{{$actividad->id}}" />
									@if (!$actividad->id == null)
									<button type="submit" class="btn btn-danger">
										<i class="fa fa-trash"></i>Eliminar
									</button>
									@endif
								</form>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		@endif

	</div>
</div>
<!--COMPLETA: termina la sección -->
@endsection