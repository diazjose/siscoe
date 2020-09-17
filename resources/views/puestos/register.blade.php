@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card border-red">
                <div class="card-header text-white title fondo-grey rounded"><h3>{{ __('Registrar Puesto') }}</h3></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('puesto.create') }}">
                    <div class="row">
                        <div class="col-md-4">
                            
                                @csrf
                                <div class="form-group">
                                    <label for="denominacion" class="title">{{ __('Denominación') }}</label>
                                    <input id="denominacion" type="text" class="form-control @error('denominacion') is-invalid @enderror" name="denominacion" value="{{ old('denominacion') }}" required autocomplete="denominacion" autofocus>
                                    @error('denominacion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="direccion" class="title">{{ __('Dirección') }}</label>
                                    <input id="direccion" type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{ old('direccion') }}" required autocomplete="direccion" autofocus>
                                    @error('direccion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="zona" class="title">Zona</label>
                                    <select class="custom-select" id="zona" name="zona" required>
                                        <option selected disabled value="">-- Elegir Opcion --</option>
                                        <option value="SUR">NORTE</option>
                                        <option value="SUR">SUR</option>
                                        <option value="ESTE">ESTE</option>
                                        <option value="OESTE">OESTE</option>
                                    </select>
                                </div>
                                   
                                <div class="form-group">
                                    <label for="latitud" class="title">{{ __('latitud') }}</label>
                                    <input id="latitud" type="text" class="form-control @error('latitud') is-invalid @enderror" name="latitud" value="{{ old('name') }}" autocomplete="latitud">
                                    @error('latitud')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="longitud" class="title">{{ __('Longitud') }}</label>
                                    <input id="longitud" type="text" class="form-control @error('longitud') is-invalid @enderror" name="longitud" value="{{ old('longitud') }}" autocomplete="longitud">
                                    @error('longitud')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                
                                
                        </div>
                            
                        <!-- MAPS -->
                        <div class="col-md-8">
                            <div id="map" class="google_canvas"></div>
                        </div>
                    </div>
                    <hr class="border-red">        
                    <div class="form-group">
                        <button type="submit" class="btn btn-red btn-lg title btn-block">
                            <i class="fas fa-map-marker-alt"></i> {{ __('Regitrar Puesto') }}
                        </button>
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
    <script>
        var marker;          //variable del marcador
        var coords = {};    //coordenadas obtenidas con la geolocalización
         
        //Funcion principal
        initMap = function () 
        {
         
            //usamos la API para geolocalizar el usuario
                /*
                navigator.geolocation.getCurrentPosition(
                  function (position){
                    coords =  {
                      lng: position.coords.longitude,
                      lat: position.coords.latitude
                    };
                    setMapa(coords);  //pasamos las coordenadas al metodo para crear el mapa
                    
                   
                  },function(error){console.log(error);});
                */
                coords = {
                    lng:-66.865371,
                    lat: -29.423337
                }    
                setMapa(coords);
        }
         
         
         
        function setMapa (coords)
        {   
              //Se crea una nueva instancia del objeto mapa
              var map = new google.maps.Map(document.getElementById('map'),
              {
                zoom: 13,
                center:new google.maps.LatLng(coords.lat,coords.lng),
         
              });
         
              //Creamos el marcador en el mapa con sus propiedades
              //para nuestro obetivo tenemos que poner el atributo draggable en true
              //position pondremos las mismas coordenas que obtuvimos en la geolocalización
              marker = new google.maps.Marker({
                map: map,
                draggable: true,
                animation: google.maps.Animation.DROP,
                position: new google.maps.LatLng(coords.lat,coords.lng),
         
              });
              //agregamos un evento al marcador junto con la funcion callback al igual que el evento dragend que indica 
              //cuando el usuario a soltado el marcador
              marker.addListener('click', toggleBounce);
              
              marker.addListener( 'dragend', function (event)
              {
                //escribimos las coordenadas de la posicion actual del marcador dentro del input #coords
                document.getElementById("latitud").value = this.getPosition().lat();
                document.getElementById("longitud").value = this.getPosition().lng();
              });
        }
         
        //callback al hacer clic en el marcador lo que hace es quitar y poner la animacion BOUNCE
        function toggleBounce() {
          if (marker.getAnimation() !== null) {
            marker.setAnimation(null);
          } else {
            marker.setAnimation(google.maps.Animation.BOUNCE);
          }
        }
         
        // Carga de la libreria de google maps 
 
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCsPND1hxm0AB7SsyOmPA1a_yJsDxnmJ3k&callback=initMap"></script>

@endsection