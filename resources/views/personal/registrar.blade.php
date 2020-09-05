@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card border-red">
                <div class="card-header text-white title fondo-grey rounded"><h3>{{ __('Registrar Personal') }}</h3></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('personal.create') }}">
                        @include('personal.formPersonal')
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
@section('script')
    <script type="text/javascript" src="{{asset('js/consultas.js')}}"></script>
@endsection