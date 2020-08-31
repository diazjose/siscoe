@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card border-red">
                <div class="card-header text-white title fondo-grey rounded"><h3>{{ __('Registrar Personal') }}</h3></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('personal.create') }}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="nombre" class="title">{{ __('Nombre') }}</label>
                                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="apellidos" class="title">{{ __('Apellidos') }}</label>
                                <input id="paellidos" type="text" class="form-control @error('apellidos') is-invalid @enderror" name="apellidos" value="{{ old('apellidos') }}" required autocomplete="apellidos" autofocus>
                                @error('apellidos')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-2">
                                <label for="dni" class="title">{{ __('N° Documento') }}</label>
                                <input id="dni" type="text" class="form-control @error('dni') is-invalid @enderror" name="dni" value="{{ old('dni') }}" required autocomplete="dni">
                                @error('dni')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-2">
                                <label for="fechaNac" class="title">{{ __('Fecha de Nac.') }}</label>
                                <input id="fechaNac" type="date" class="form-control @error('fechaNac') is-invalid @enderror" name="fechaNac" value="{{ old('fechaN') }}" required autocomplete="fechaNac">
                                @error('fechaNac')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="email" class="title">{{ __('Correo Electrónico') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>                   
                            <div class="form-group col-md-3">
                                <label for="telefono" class="title">{{ __('Teléfono') }}</label>
                                <input id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('fechaN') }}" required autocomplete="telefono">
                                @error('telefono')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                 </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="direccion" class="title">{{ __('Dirección') }}</label>
                                <input id="direccion" type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{ old('direccion') }}" required autocomplete="direccion">
                                @error('direccion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">    
                            <div class="form-group col-md-3">
                                <label for="fechaIngreso" class="title">{{ __('Fecha de Ingreso al COE') }}</label>
                                <input id="fechaIngreso" type="date" class="form-control @error('fechaIngreso') is-invalid @enderror" name="fechaIngreso" value="{{ old('fechaIngreso') }}" required autocomplete="fechaIngreso">
                                @error('fechaIngreso')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="situacionLaboral" class="title">{{ __('Situación Laboral Actual') }}</label>
                                <input id="situacionLaboral" type="text" class="form-control @error('situacionLaboral') is-invalid @enderror" name="situacionLaboral" value="{{ old('situacionLaboral') }}" required autocomplete="situacionLaboral">
                                @error('situacionLaboral')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="cargo" class="title">{{ __('Cargo') }}</label>
                                <select name="cargo" class="form-control">
                                    <option>--Elegir Opción--</option>
                                    <option value="COORDINADOR">COORDINADOR</option>
                                    <option value="PERSONAL">PERSONAL</option>
                                </select>
                            </div>
                        </div>
                        <hr class="border-red">        
                        <div class="form-group">
                            <div class="row justify-content-end">
                                <button type="submit" class="btn btn-red btn-lg title mx-5">
                                    {{ __('Regitrar Personal') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
