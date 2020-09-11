@extends('layouts.app')

@section('content')
<div class="container">
    <div class="justify-content-center">
        <div class="text-center my-3">
            <h2 class="title display-3">Administrar Puestos</h2>
        </div><br>
        <a href="{{route('puesto.register')}}" class="btn btn-primary title"><i class="fas fa-map-marker-alt"></i> Agregar Puesto</a>
        <br>
        <hr class="border-red">
            @if(session('message'))
            <div class="alert alert-{{ session('status') }}">
                <strong>{{ session('message') }}</strong>   
            </div>  
            @endif 
             @if(count($puestos)>0)
            <div class="table-responsive my-5 justify-content-center" id="resultado">
                <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Denominación</th>
                            <th>Dirección</th>
                            <th>Estado</th>
                            <th>Latitud</th>
                            <th>Longitud</th>
                            <th>Ver</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($puestos as $pue)
                        <tr>
                            <td>{{$pue->denominacion}}</td>
                            <td>{{$pue->direccion}}</td>
                            <td>
                                @if($pue->estado == 1)
                                <h5><span class="badge badge-success">Activo</span></h5>
                                @else
                                <h5><span class="badge badge-danger">DesAct.</span></h5>
                                @endif
                            </td>
                            <td>{{$pue->latitud}}</td>
                            <td>{{$pue->longitud}}</td>
                            <td>
                                <a href="{{route('puesto.edit', [$pue->id])}}" class="btn btn-outline-primary" title="Ver Puesto" ><i class="far fa-edit"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Denominación</th>
                            <th>Dirección</th>
                            <th>Estado</th>
                            <th>Latitud</th>
                            <th>Longitud</th>
                            <th>Ver</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            @else
            <div class="text-center my-5">
                <h4 class="text-danger my-5"><strong>NO SE REGISTRO NINGUN PUESTO...</strong></h4>
            </div>    
            @endif
        
    </div>
</div>
@endsection
@section('script')
    <script src="{{ asset('js/consultas.js') }}"></script>
@endsection