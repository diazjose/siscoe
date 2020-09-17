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
                    <div class="row">
                        <div class="col-md-4">
                            
                                @csrf
                                <input type="hidden" name="id" value="{{$puesto->id}}">
                                <div class="form-group">
                                    <label for="denominacion" class="title">{{ __('Denominación') }}</label>
                                    <input id="denominacion" type="text" class="form-control @error('denominacion') is-invalid @enderror" name="denominacion" value="{{$puesto->denominacion}}" required autocomplete="denominacion" autofocus>
                                    @error('denominacion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="direccion" class="title">{{ __('Dirección') }}</label>
                                    <input id="direccion" type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{$puesto->direccion}}" required autocomplete="direccion" autofocus>
                                    @error('direccion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>                            
                                <div class="form-group">
                                    <label for="latitud" class="title">{{ __('latitud') }}</label>
                                    <input id="latitud" type="text" class="form-control @error('latitud') is-invalid @enderror" name="latitud" value="{{$puesto->latitud}}" autocomplete="latitud">
                                    @error('latitud')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="longitud" class="title">{{ __('Longitud') }}</label>
                                    <input id="longitud" type="text" class="form-control @error('longitud') is-invalid @enderror" name="longitud" value="{{$puesto->longitud}}" autocomplete="longitud">
                                    @error('longitud')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                  <label for="estado" class="title">Estado</label>
                                  <select class="custom-select" id="estado" name="estado" required>
                                    <option selected disabled value="">-- Elegir Opcion --</option>
                                    <option value="1">Activo</option>
                                    <option value="0">DesActivo</option>
                                  </select>
                                </div>
                                
                        </div>

                        <!-- MAPS -->
                        <div class="col-md-8">
                            <div id="map" class="google_canvas"></div>
                        </div>
                    </div>
                    <hr class="border-red">        
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-lg btn-block title">
                                        <i class="fas fa-map-marker-alt"></i> {{ __('Actualizar Puesto') }}
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
    <script type="text/javascript" src="{{asset('js/puestos.js')}}"></script>
    <script>
        var marker;          //variable del marcador
        var coords = {};    //coordenadas obtenidas con la geolocalización
        var lati = document.getElementById('latitud').value;
        var long = document.getElementById('longitud').value; 
        //Funcion principal
        initMap = function () 
        {   
            if (lati != '') {
                coords =  {
                    lng: long,
                    lat: lati
                };
            }else{
                coords =  {
                    lng: -66.865371,
                    lat: -29.423337
                };
            }
            setMapa(coords);
        }     
         
         
        function setMapa (coords)
        {   
              //Se crea una nueva instancia del objeto mapa
              var map = new google.maps.Map(document.getElementById('map'),
              {
                zoom: 14,
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