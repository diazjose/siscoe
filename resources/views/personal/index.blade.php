@extends('layouts.app')

@section('content')
<div class="container">
    <div class="justify-content-center">
        <div class="text-center my-3">
            <h2 class="title display-3">Administrar Personal</h2>
        </div><br>
        <a href="{{route('personal.register')}}" class="btn btn-success title"><i class="fas fa-user-plus"></i> Agregar Personal</a>
        <br>
        <hr class="border-red">
            @if(session('message'))
            <div class="alert alert-{{ session('status') }}">
                <strong>{{ session('message') }}</strong>   
            </div>  
            @endif 
             @if(count($personas)>0)
            <div class="table-responsive my-5 justify-content-center" id="resultado">
                <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>DNI</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Situación Lab.</th>
                            <th>Puesto</th>
                            <th>Depende</th>
                            <th>Ver</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($personas as $per)
                        <tr>
                            <td>{{$per->apellidos}} {{$per->nombre}}</td>
                            <td>{{$per->dni}}</td>
                            <td>{{$per->email}}</td>
                            <td>{{$per->telefono}}</td>
                            <td>{{$per->situacionLaboral}}</td>
                            <td>{{$per->cargo}}</td>
                            @if(count($per->depende) > 0)
                                @foreach($per->depende as $dep)                                    
                                    @if($dep->persona_id == $per->id)
                                    <td>{{$dep->coordinador->apellidos}} {{$dep->coordinador->nombre}}</td>
                                    @endif
                                @endforeach                            
                            @else
                            <td>NADIE</td>
                            @endif
                            <td>
                                <a href="{{route('personal.viewAuth', [$per->id])}}" class="btn btn-outline-primary" title="Ver Personal" ><i class="far fa-eye"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nombre</th>
                            <th>DNI</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Situación Lab.</th>
                            <th>Puesto</th>
                            <th>Depende</th>
                            <th>Ver</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            @else
            <div class="text-center my-5">
                <h4 class="text-danger my-5"><strong>NO SE REGISTRO NINGUN PERSONAL...</strong></h4>
            </div>    
            @endif
        
    </div>
</div>
@endsection
@section('script')
    <script src="{{ asset('js/consultas.js') }}"></script>
@endsection