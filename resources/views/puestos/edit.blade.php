@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card border-red">
                <div class="card-header text-white title fondo-grey rounded"><h3>{{ __('Actualizar Puesto') }}</h3></div>
                <input type="hidden" id="status" value="{{$puesto->estado}}">
                <div class="card-body">
                    <form method="POST" action="{{ route('puesto.update') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{$puesto->id}}">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="denominacion" class="title">{{ __('Denominación') }}</label>
                                <input id="denominacion" type="text" class="form-control @error('denominacion') is-invalid @enderror" name="denominacion" value="{{$puesto->denominacion}}" required autocomplete="denominacion" autofocus>
                                @error('denominacion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="direccion" class="title">{{ __('Dirección') }}</label>
                                <input id="direccion" type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{$puesto->direccion}}" required autocomplete="direccion" autofocus>
                                @error('direccion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>                            
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="latitud" class="title">{{ __('latitud') }}</label>
                                <input id="latitud" type="text" class="form-control @error('latitud') is-invalid @enderror" name="latitud" value="{{$puesto->latitud}}" autocomplete="latitud">
                                @error('latitud')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="longitud" class="title">{{ __('Longitud') }}</label>
                                <input id="longitud" type="text" class="form-control @error('longitud') is-invalid @enderror" name="longitud" value="{{$puesto->longitud}}" autocomplete="longitud">
                                @error('longitud')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                              <label for="estado" class="title">Estado</label>
                              <select class="custom-select" id="estado" name="estado" required>
                                <option selected disabled value="">-- Elegir Opcion --</option>
                                <option value="1">Activo</option>
                                <option value="0">DesActivo</option>
                              </select>
                            </div>
                        </div>
                        <hr class="border-red">        
                        <div class="form-group">
                            <div class="row justify-content-end">
                                <button type="submit" class="btn btn-red btn-lg title mx-5">
                                    {{ __('Actualizar Puesto') }}
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
@section('script')
    <script type="text/javascript" src="{{asset('js/puestos.js')}}"></script>
@endsection