@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="justify-content-center">
        <div class="text-center my-3">
            <!--<h2 class="title display-3">Administrar Personal</h2> <hr class="border-red">-->
        </div><br>
       
        <div class="row mx-2">
            <div class="col-md-3 fondo-grey">
                <h3 class="title my-3">Datos Personales</h3> <hr class="border-red">
                <h5>    
                    <div class="form-group">
                        <label for="nombre" class="title">{{ __('Nombre') }}</label><br>
                        {{$auth->apellidos}} {{$auth->nombre}}      
                    </div>
                    <div class="form-group">
                        <label class="title">{{ __('N° Documento') }}</label><br>
                        {{$auth->dni}}
                    </div>
                    <div class="form-group">
                        <label for="nombre" class="title">{{ __('Fecha de Nacimiento') }}</label><br>
                        {{date('d/m/Y', strtotime($auth->fechaNac))}}     
                    </div>
                    <div class="form-group">
                        <label for="nombre" class="title">{{ __('Correo Electrónico') }}</label><br>
                        {{$auth->email}}     
                    </div>
                    <div class="form-group">
                        <label class="title">{{ __('N° Teléfono') }}</label><br>
                        {{$auth->telefono}}
                    </div>
                    <div class="form-group">
                        <label for="nombre" class="title">{{ __('Domicilio') }}</label><br>
                        {{$auth->direccion}}     
                    </div>
                    <div class="form-group">
                        <label class="title">{{ __('Zona del Domicilio') }}</label><br>
                        {{$auth->zona}}
                    </div>
                    <div class="form-group">
                        <label class="title">{{ __('Situación Laboral') }}</label><br>
                        {{$auth->situacionLaboral}}
                    </div>
                </h5>    
            </div>    
            
            <div class="col-md-9">
                <h3 class="title my-3">Datos del Personal a cargo</h3> <hr class="border-red">
                @if(count($dependiente)>0)
                <div class="table-responsive my-5 justify-content-center" id="resultado">
                    <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>DNI</th>
                                <th>Fecha N.</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                                <th>Ingreso</th>
                                <th>Situación Lab.</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dependiente as $dep)
                            <tr>
                                <td>{{$dep->persona->apellidos}} {{$dep->persona->nombre}}</td>
                                <td>{{$dep->persona->dni}}</td>
                                <td>{{date('d/m/Y', strtotime($dep->persona->fechaNac))}}</td>
                                <td>{{$dep->persona->email}}</td>
                                <td>{{$dep->persona->telefono}}</td>
                                <td>{{date('d/m/Y', strtotime($dep->persona->fechaIngreso))}}</td>
                                <td>{{$dep->persona->cargo}}</td>
                                <td>
                                    <a href="#" class="btn btn-outline-primary" title="Ver Personal" ><i class="far fa-eye"></i></a>
                                </td>
                            </tr>
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
</div>
@endsection
@section('script')
    <script src="{{ asset('js/consultas.js') }}"></script>
@endsection