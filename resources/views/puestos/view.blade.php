@extends('layouts.app')

@section('content')
<div class="container">
    <div class="justify-content-center">
        <div class="text-center my-3">
            <h2 class="title display-3">Ficha de Puesto</h2> 
        </div>
        <hr class="border-red">
        @if(session('message'))
        <div class="alert alert-{{ session('status') }}">
            <strong>{{ session('message') }}</strong>   
        </div>  
        @endif 
        <input type="hidden" name="" id="puestId" value="{{$puesto->id}}">
        <div class="mx-2">
            <div class="fondo-grey-c">
                <h3 class="title my-3 mx-3 p-2">Datos Puesto</h3> 
                <hr class="border-white p-2 mx-3">
                <h5 class="mx-3"> 
                    <div class="row my-2">   
                        <div class="form-group col-md-5">
                            <label for="nombre" class="title">{{ __('Denominacion') }}</label><br>
                            {{$puesto->denominacion}}      
                        </div>
                        <div class="form-group col-md-5">
                            <label class="title">{{ __('Direccion') }}</label><br>
                            {{$puesto->direccion}}
                        </div>
                        <div class="form-group col-md-2">
                            <label class="title">{{ __('Zona') }}</label><br>
                            {{$puesto->zona}}
                        </div>
                    </div>    
                    <div class="row my-2">
                        <div class="form-group col-md-5">
                            <label for="nombre" class="title">{{ __('Latitud') }}</label><br>
                            {{$puesto->latitud}}     
                        </div>
                        <div class="form-group col-md-5">
                            <label class="title">{{ __('Longitud') }}</label><br>
                            {{$puesto->longitud}}
                        </div>
                        <div class="form-group col-md-2">
                            <label for="nombre" class="title">{{ __('Estado') }}</label><br>
                            @if($puesto->estado == 1)
                            Activo
                            @else
                            DesActivo
                            @endif     
                        </div>
                    </div>       
                </h5>
                @if(Auth::user()->role == 'ADMIN')
                <a href="{{route('puesto.edit', [$puesto->id])}}" class="btn btn-success btn-lg title"><i class="fas fa-id-card"></i> Editar Puesto</a>
                @endif
            </div>
            <hr class="border-red">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="title my-3">Asistencia del Personal - {{date('d/m/Y', strtotime($fecha))}} <!--{{date_default_timezone_get()}}--> </h3>
                </div>
                <div class="col-md-4 my-3"> 
                    <form class="form-inline" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="date" class="form-control" id="fecha" name="fecha">
                        </div>
                        <div class="form-group">
                            <a href="#" id="fechaTarea" class="mx-md-2 btn btn-primary btn-md-block"><strong><i class="fas fa-search"></i> Buscar por Fecha</strong></a>
                        </div>
                    </form>
                </div>
            </div>    
            <hr class="border-red">
            @if(count($personas)>0)
                <div class="table-responsive my-5 justify-content-center" id="resultado">
                    <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Teléfono</th>
                                <th>Hora Entrada</th>
                                <th>Hora Salida</th>
                                <th>Asistencia</th>
                                <th>Depende</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach($personas as $per)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$per->persona->apellidos}} {{$per->persona->nombre}}</td>
                                <td>{{$per->persona->telefono}}</td>
                                <td>{{date('H:i', strtotime($per->horaEntrada))}}</td>
                                <td>{{date('H:i', strtotime($per->horaSalida))}}</td>
                                <td>
                                    @if($per->estado == '')
                                    ...    
                                    @else
                                    {{$per->estado}}
                                    @endif
                                </td>
                                @if(count($per->persona->depende) > 0)
                                    @foreach($per->persona->depende as $dep)                                    
                                        @if($dep->persona_id == $per->persona_id)
                                        <td>{{$dep->coordinador->apellidos}} {{$dep->coordinador->nombre}}</td>
                                        @endif
                                    @endforeach                            
                                @else
                                <td>NADIE</td>
                                @endif
                                <td></td>
                            </tr>
                            @php($i++)
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
            <div class="text-center my-5">
                <h4 class="text-danger my-5"><strong>NO SE REGISTRO NINGUN PERSONAL...</strong></h4>
            </div>    
            @endif
        </div>
    </div>    
</div>


@endsection
@section('script')
    <script src="{{ asset('js/consultas.js') }}"></script>
@endsection