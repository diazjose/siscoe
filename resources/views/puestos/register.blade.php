@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card border-red">
                <div class="card-header text-white title fondo-grey rounded"><h3>{{ __('Registrar Puesto') }}</h3></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('puesto.create') }}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="denominacion" class="title">{{ __('Denominación') }}</label>
                                <input id="denominacion" type="text" class="form-control @error('denominacion') is-invalid @enderror" name="denominacion" value="{{ old('denominacion') }}" required autocomplete="denominacion" autofocus>
                                @error('denominacion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="direccion" class="title">{{ __('Dirección') }}</label>
                                <input id="direccion" type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{ old('direccion') }}" required autocomplete="direccion" autofocus>
                                @error('direccion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-2">
                                <label for="latitud" class="title">{{ __('latitud') }}</label>
                                <input id="latitud" type="text" class="form-control @error('latitud') is-invalid @enderror" name="latitud" value="{{ old('name') }}" autocomplete="latitud">
                                @error('latitud')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-2">
                                <label for="longitud" class="title">{{ __('Longitud') }}</label>
                                <input id="longitud" type="text" class="form-control @error('longitud') is-invalid @enderror" name="longitud" value="{{ old('longitud') }}" autocomplete="longitud">
                                @error('longitud')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <hr class="border-red">        
                        <div class="form-group">
                            <div class="row justify-content-end">
                                <button type="submit" class="btn btn-red btn-lg title mx-5">
                                    {{ __('Regitrar Puesto') }}
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
    <script type="text/javascript" src="{{asset('js/consultas.js')}}"></script>
@endsection