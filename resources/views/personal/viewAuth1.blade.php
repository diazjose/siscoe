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
                    <div class="row my-2">   
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
                    <div class="row my-2">
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
                                  
                    <div class="row">
                        <div class="form-group col-md-3" >
                            <label class="title">Depende de</label><br>
                            @if(count($auth->depende)>0)
                                @foreach($auth->depende as $dep)
                                    @if($dep->persona_id == $auth->id)
                                    {{$dep->coordinador->apellidos}} {{$dep->coordinador->nombre}}
                                    @endif
                                @endforeach    
                            @else
                            NADIE
                            @endif
                        </div>  
                        @if(!empty($auth->user))
                        <div class="form-group col-md-3">
                            <label class="title">{{ __('Tipo de Usuario') }}</label><br>
                            @if($auth->user->role == 'ADMIN')
                            ADMINISTRADOR
                            @else
                            REFERENTE
                            @endif
                        </div>
                        @endif
                        <div class="form-group col-md-6" >
                            <label class="title">Vehiculos de Translado</label><br>
                            @if(count($auth->vehiculos)>0)
                                <table class="table table-responsive">
                                    <thead>
                                        <th>Tipo</th>
                                        <th>Denominación</th>
                                        <th>Dominio</th>
                                    </thead>
                                    <tbody>    
                                    @foreach($auth->vehiculos as $ve)
                                        <tr>
                                            <td>{{$ve->tipo}}</td>
                                            <td>{{$ve->descripcion}}</td>
                                            <td>{{$ve->dominio}}</td>
                                        </tr>    
                                    @endforeach
                                    </tbody>    
                                </table>    
                            @else
                            NINGUNO
                            @endif
                        </div>
                    </div>    
                                        
                </h5>
                @if(Auth::user()->role == 'ADMIN')
                <a href="{{route('personal.edit', [$auth->id])}}" class="btn btn-success btn-lg title"><i class="fas fa-id-card"></i> Editar Persona</a>
                    @if(empty($auth->user) AND $auth->cargo != 'PERSONAL VOLUNTARIO')              
                    <a href="#" class="btn btn-primary btn-lg title" data-toggle="modal" data-target="#userModal"><i class="fas fa-user"></i> Crear Usuario</a>  
                    @endif
                    <a href="#" class="btn btn-primary btn-lg title" data-toggle="modal" data-target="#vehiModal"><i class="fas fa-car"></i> Agregar Vehiculo</a>
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
                                <th>Teléfono</th>
                                <th>Domicilio</th>
                                <th>Zona de Domicilio</th>
                                <th>Puesto</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach($dependiente as $dep)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$dep->persona->apellidos}} {{$dep->persona->nombre}}</td>
                                <td>{{$dep->persona->telefono}}</td>
                                <td>{{$dep->persona->direccion}}</td>
                                <td>{{$dep->persona->zona}}</td>
                                <td>
                                    @if($dep->persona->tarea) 
                                    {{$dep->persona->tarea->lugar->denominacion}}<br>
                                    Tarea: {{$dep->persona->tarea->tarea}}<br>
                                    Horario: {{date('H:i', strtotime($dep->persona->tarea->horaEntrada))}} a {{date('H:i', strtotime($dep->persona->tarea->horaSalida))}}
                                    @else
                                    NINGUNO...
                                    @endif
                                </td>
                                <td>
                                    @if($dep->persona->tarea)
                                    <a href="#" class="btn btn-outline-primary disabled"  title="Agregar Tarea" ><i class="fas fa-clipboard-list"></i></a>
                                    <a href="#" class="btn btn-outline-success" onclick="editTarea({{$dep->persona->id}},'{{$dep->persona->apellidos}}','{{$dep->persona->nombre}}','{{$dep->persona->tarea->lugar->id}}','{{$dep->persona->tarea->horaEntrada}}','{{$dep->persona->tarea->horaSalida}}','{{$dep->persona->tarea->tarea}}')" data-toggle="modal" data-target="#tareaModal" title="Editar Tarea" ><i class="far fa-edit"></i></a>
                                    @else
                                    <a href="#" class="btn btn-outline-primary" onclick="tarea({{$dep->persona->id}},'{{$dep->persona->apellidos}}','{{$dep->persona->nombre}}')" data-toggle="modal" data-target="#tareaModal" title="Agregar Tarea" ><i class="fas fa-clipboard-list"></i></a>
                                    <a href="#" class="btn btn-outline-success disabled" title="Editar Tarea" ><i class="far fa-edit"></i></a>
                                    @endif

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
      <div class="modal-header fondo-grey-c">
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

<div class="modal fade" id="vehiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header fondo-grey-c">
        <h4 class="modal-title title" id="exampleModalCenterTitle">Agregar Vehiculo</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form method="POST" action="{{route('personal.vehiculo')}}">
                @csrf
                <input type="hidden" name="id" value="{{$auth->id}}">
                <div class="form-group">
                    <label for="vehiculo" class="title">{{ __('Tipo de Vehículo') }}</label>
                    <select name="vehiculo" class="form-control" id="vehiculo"> 
                        <option selected disabled>--Elegir Opción--</option>
                        <option value="BICICLETA">BICICLETA</option>
                        <option value="MOTOCICLETA">MOTOCICLETA</option>
                        <option value="AUTOMOVIL">AUTOMOVIL</option>
                        <option value="CAMIONETA">CAMIONETA</option>
                        <option value="CAMION">CAMION</option>
                        <option value="TRAFIC">TRAFIC</option>      
                    </select>
                </div>
                <div class="form-group">
                    <label for="descripcion" class="title">{{ __('Descripción') }}</label>
                    <input id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" autocomplete="descripcion" autofocus>
                </div>
                <div class="form-group">
                    <label for="dominio" class="title">{{ __('Dominio') }}</label>
                    <input id="dominio" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="dominio" autocomplete="descripcion" autofocus>
                </div>
                
                <hr>
                <div class="form-group mx-2">
                    <button type="submit" class="btn btn-primary title">Agregar Vehiculo</button>
                </div>
            </form>        
      </div>      
    </div>
  </div>
</div>

<div class="modal fade" id="tareaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header fondo-grey-c">
        <h4 class="modal-title title" id="Title"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form method="POST" action="{{route('personal.asignarTarea')}}">
                @csrf
                <input type="hidden" name="id" value="{{$auth->id}}">
                <input type="hidden" name="persona_id" id="persona_id" value="">
                <div class="form-group">
                    <label for="nombre" class="title">Asignar Tarea a:</label>
                    <p id="nombre"></p>
                </div>
                <div class="form-group">
                    <label for="estado" class="title">Puesto</label>
                    <select class="custom-select" id="lugar" name="lugar" required>
                        <option selected disabled value="">-- Elegir Puesto --</option>
                        @foreach($lugares as $lu)
                        <option value="{{$lu->id}}">{{$lu->denominacion}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="horaEntrada" class="title">{{ __('Hora de Entrada') }}</label>
                    <input id="horaEntrada" type="time"  class="form-control @error('horaEntrada') is-invalid @enderror" name="horaEntrada" placeholder="00:00" autocomplete="horaEntrada" autofocus>
                </div>
                <div class="form-group">
                    <label for="horaSalida" class="title">{{ __('Hora de Salida') }}</label>
                    <input id="horaSalida" type="time" class="form-control @error('horaSalida') is-invalid @enderror" name="horaSalida" autocomplete="horaSalida" placeholder="00:00" autofocus>
                </div>
                <div class="form-group">
                    <label for="tarea" class="title">Tarea Asignada</label>
                    <select class="custom-select" id="tarea" name="tarea" required>
                        <option selected disabled value="">-- Elegir Puesto --</option>
                        <option value="Control">Control</option>
                        <option value="Asistente">Asistente</option>
                    </select>
                </div>
                
                <hr>
                <div class="form-group mx-2">
                    <button type="submit" class="btn btn-primary title" id="boton"></button>
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