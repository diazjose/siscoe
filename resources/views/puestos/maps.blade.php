@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card border-red">
                <div class="card-header text-white title fondo-grey rounded"><h3>{{ __('Registrar Puesto') }}</h3></div>

                <div class="card-body">
                    <div style="width: 100%; height: 500px;">
                        {!! Mapper::render() !!}
                    </div>

                    <input type="text" id="coords" style="width: 50%;">    
                </div>
                
            </div>

            

        </div>
    </div>
</div>
@endsection

@section('script')
    <!--
    <script>
        function initMap(){
            var options = {
                zoom: 13,
                center: {lat:42.3601,lng:-71.0589}
            }
            var map = new google.maps.Map(document.getElementById('map'), options);
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCsPND1hxm0AB7SsyOmPA1a_yJsDxnmJ3k&callback=initMap"></script>
    -->
@endsection