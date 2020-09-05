@extends('layouts.app')

@section('content')
<div class="container">
    <div class="justify-content-center">
        <div class="text-center my-3">
            <h2 class="title display-3">Ficha Personal</h2> 
        </div>
        <hr class="border-red">
        @if(session('message'))
        <div class="alert alert-{{ session('status') }}">
            <strong>{{ session('message') }}</strong>   
        </div>  
        @endif 
        <div class="mx-2">
            <div class="fondo-grey-c">
                <h3 class="title my-3 mx-3 p-2">Datos Personales</h3> 
                <hr class="border-white p-2 mx-3">
                <h5 class="mx-3"> 
                    <div class="row">   
                        <div class="form-group col-md-3">
                            <label for="nombre" class="title">{{ __('Nombre') }}</label><br>
                            {{$auth->apellidos}} {{$auth->nombre}}      
                        </div>
                        <div class="form-group col-md-3">
                            <label class="title">{{ __('N° Documento') }}</label><br>
                            {{$auth->dni}}
                        </div>
                        <div class="form-group col-md-3">
                            <label for="nombre" class="title">{{ __('Fecha de Nacimiento') }}</label><br>
                            {{date('d/m/Y', strtotime($auth->fechaNac))}}     
                        </div>
                        <div class="form-group col-md-3">
                            <label class="title">{{ __('N° Teléfono') }}</label><br>
                            {{$auth->telefono}}
                        </div>
                    </div>    
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="nombre" class="title">{{ __('Correo Electrónico') }}</label><br>
                            {{$auth->email}}     
                        </div>
                        <div class="form-group col-md-3">
                            <label for="nombre" class="title">{{ __('Domicilio') }}</label><br>
                            {{$auth->direccion}}     
                        </div>
                        <div class="form-group col-md-3">
                            <label class="title">{{ __('Zona del Domicilio') }}</label><br>
                            {{$auth->zona}}
                        </div>
                        <div class="form-group col-md-3">
                            <label class="title">{{ __('Situación Laboral') }}</label><br>
                            {{$auth->situacionLaboral}}
                        </div>
                    </div>
                    @if(!empty($auth->user))              
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="title">{{ __('Tipo de Usuario') }}</label><br>
                            @if($auth->user->role == 'ADMIN')
                            ADMINISTRADOR
                            @else
                            REFERENTE
                            @endif
                        </div>
                    </div>    
                    @endif                    
                </h5>
                @if(Auth::user()->role == 'ADMIN')
                <a href="{{route('personal.edit', [$auth->id])}}" class="btn btn-success btn-lg title">Editar Persona</a>
                    @if(empty($auth->user))              
                    <a href="#" class="btn btn-primary btn-lg title" data-toggle="modal" data-target="#userModal">Crear Usuario</a>  
                    @endif
                @endif
            </div>    
            @if($auth->cargo != 'PERSONAL VOLUNTARIO')
            <div class="col">
                <hr class="border-red">
                <h3 class="title my-3">Datos del Personal a cargo</h3> <hr class="border-red">
                @if(count($dependiente)>0)
                <div class="table-responsive my-5 justify-content-center" id="resultado">
                    <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>DNI</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach($dependiente as $dep)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$dep->persona->apellidos}} {{$dep->persona->nombre}}</td>
                                <td>{{$dep->persona->dni}}</td>
                                <td>{{$dep->persona->email}}</td>
                                <td>{{$dep->persona->telefono}}</td>
                                <td>
                                    <a href="#" class="btn btn-outline-primary" title="Ver Personal" ><i class="far fa-eye"></i></a>
                                </td>
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
            @endif
        </div>
    </div>    
</div>

<!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title title" id="exampleModalCenterTitle">Crear Usuario</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form method="POST" action="{{route('usuario.create')}}">
                @csrf
                <input type="hidden" name="id" value="{{$auth->id}}">
                <div class="form-group">
                    <label for="user" class="title"><h5>{{ __('Tipo de Usuario') }}</h5></label>
                    <select name="user" id="user" class="form-control" required>
                        <option selected disabled>--Elegir Opción--</option>
                        <option value="ADMIN">ADMINISTRADOR</option>
                        <option value="USER">REFERENTE</option>
                    </select>
                </div>
                
                <hr>
                <div class="form-group mx-2">
                    <button type="submit" class="btn btn-primary title">Crear Usuario</button>
                </div>
            </form>        
      </div>      
    </div>
  </div>
</div>


@endsection
@section('script')
    <script src="{{ asset('js/consultas.js') }}"></script>
@endsection