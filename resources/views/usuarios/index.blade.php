@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="text-center my-3">
            <h2 class="title display-3">Administrar Usuarios</h2>
        </div><br>
        <div class="col">
            <hr class="border-red">
            @if(session('message'))
            <div class="alert alert-{{ session('status') }}">
                <strong>{{ session('message') }}</strong>   
            </div>  
            @endif 
             @if(count($usuarios)>0)
            <div class="table-responsive my-5 justify-content-center" id="resultado">
                <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Correo Electrónico</th>
                            <th>Rol del Usuario</th>
                            <th>Ver</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i=1)
                        @foreach($usuarios as $user)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$user->persona->nombre}} {{$user->persona->apellidos}}</td>    
                            <td>{{$user->email}}</td>
                            <td>
                                @if($user->role == 'ADMIN')
                                ADMINISTRADOR
                                @else
                                REFERENTE
                                @endif
                            </td>
                            <td>
                                <a href="#" class="btn btn-outline-success" title="Editar Usuario" data-toggle="modal" data-target="#userModal" ><i class="fas fa-user-edit" onclick="edit({{$user->id}}, '{{$user->role}}')"></i></a>
                                <a href="{{route('usuario.destroy', [$user->id])}}" class="btn btn-outline-danger" title="Ver Personal" ><i class="fas fa-user-minus"></i></a>
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
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title title" id="exampleModalCenterTitle">Editar Uusario</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form method="POST" action="{{route('usuario.update')}}">
                @csrf
                <input type="hidden" name="id" id="user_id" value="">
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
                    <button type="submit" class="btn btn-success title">Editar Usuario</button>
                </div>
            </form>        
      </div>      
    </div>
  </div>
</div>

@endsection
@section('script')
    <script type="text/javascript" src="{{asset('js/user.js')}}"></script>
@endsection

