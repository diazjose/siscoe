<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo.jpeg') }}" />

        <title>SISCOE</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="text-center">
            <img src="{{asset('/images/logo_gobierno_horizontal.png')}}" id="logo">
        </div>
        <div id="login">
                <div class="container">
                    <h3 class="text-center text-white title">Sistema de Administración del COE</h3>
                
                    <div id="login-row" class="row justify-content-center align-items-center">
                        <div id="login-column" class="col-md-6">
                            <div id="login-box" class="col-md-12">
                                <form id="login-form" class="form my-3" action="{{ route('login') }}" method="post">
                                    @csrf
                                    <h3 class="text-center title">Iniciar Sesión</h3>
                                    <div class="form-group">
                                        <label for="username" class="title">Correo Electrónico:</label><br>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="password" class="title">Contraseña:</label><br>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <!--
                                    <div class="form-group">
                                        <label for="remember-me" class="text-white"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                                        <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
                                    </div>-->
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-red btn-block title">
                                            {{ __('Iniciar Sesión') }}
                                        </button>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
    </body>
</html>
