@extends('layouts.app')

@section('content')
<div class="container">
    <div class="justify-content-center">
        <div class="text-center my-3">
            <h2 class="title display-3">Administrar Autoridades</h2>
        </div><br>
        <a href="{{route('personal.register')}}" class="btn btn-success title"><i class="fas fa-user-plus"></i> Agregar Personal</a>
        <br>
        <hr class="border-red">
        <div class="container">
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
                            <th>Nombre Completo</th>
                            <th>N° DNI</th>
                            <th>Fecha Nac.</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Ingreso</th>
                            <th>Situación Laboral</th>
                            <th>Organigrama</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($personas as $per)
                        <tr>
                            <td>{{$per->apellidos}} {{$per->nombre}}</td>
                            <td>{{$per->dni}}</td>
                            <td>{{date('d/m/Y', strtotime($per->fechaNac))}}</td>
                            <td>{{$per->email}}</td>
                            <td>{{$per->telefono}}</td>
                            <td>{{date('d/m/Y', strtotime($per->fechaIngreso))}}</td>
                            <td>{{$per->situacionLaboral}}</td>
                            <td>{{$per->cargo}}</td>
                            <td>
                                <a href="#" class="btn btn-outline-primary" title="Ver Personal" ><i class="far fa-eye"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nombre Completo</th>
                            <th>N° DNI</th>
                            <th>Fecha Nac.</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Ingreso COE</th>
                            <th>Situación Laboral</th>
                            <th>Cargo</th>
                            <th>Acciones</th>
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
</div>
@endsection
@section('script')
    <script src="{{ asset('js/consultas.js') }}"></script>
@endsection