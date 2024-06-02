<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>FitTracker - Registrarse</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    
    <!-- ================== BEGIN core-css ================== -->
    <link href="{{ asset('assets/css/vendor.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/default/app.min.css') }}" rel="stylesheet" />
    <!-- ================== END core-css ================== -->
</head>
<body class='pace-top'>
    <!-- BEGIN #loader -->
    <div id="loader" class="app-loader">
        <span class="spinner"></span>
    </div>
    <!-- END #loader -->

    <!-- BEGIN #app -->
    <div id="app" class="app">
        <!-- BEGIN register -->
        <div class="register register-with-news-feed">
            <!-- BEGIN news-feed -->
            <div class="news-feed">
                <div class="news-image" style="background-image: url('{{ asset('images/fittracker.png') }}')"></div>
                <div class="news-caption">
                   
                </div>
            </div>
            <!-- END news-feed -->
            
            <!-- BEGIN register-container -->
            <div class="register-container">
                <!-- BEGIN register-header -->
                <div class="register-header mb-25px h1">
                    <div class="mb-1">Regístrate</div>
                    <small class="d-block fs-15px lh-16">Crea tu cuenta en FitTracker. Es gratis y siempre lo será.</small>
                </div>
                <!-- END register-header -->
                
                <!-- BEGIN register-content -->
                <div class="register-content">
                    <form method="POST" action="{{ route('register') }}" class="fs-13px">
                        @csrf
                        <div class="mb-3">
                            <label class="mb-2">Nombre <span class="text-danger">*</span></label>
                            <div class="row gx-3">
                                <div class="col-md-6 mb-2 mb-md-0">
                                    <input type="text" class="form-control fs-13px @error('name') is-invalid @enderror" placeholder="Nombre" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus />
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control fs-13px @error('surname') is-invalid @enderror" placeholder="Apellido" name="surname" value="{{ old('surname') }}" required autocomplete="surname" />
                                    @error('surname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="mb-2">Correo electrónico <span class="text-danger">*</span></label>
                            <input type="email" class="form-control fs-13px @error('email') is-invalid @enderror" placeholder="Correo electrónico" name="email" value="{{ old('email') }}" required autocomplete="email" />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="mb-2">Contraseña <span class="text-danger">*</span></label>
                            <input type="password" class="form-control fs-13px @error('password') is-invalid @enderror" placeholder="Contraseña" name="password" required autocomplete="new-password" />
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="mb-2">Confirmar Contraseña <span class="text-danger">*</span></label>
                            <input type="password" class="form-control fs-13px @error('password_confirmation') is-invalid @enderror" placeholder="Confirmar Contraseña" name="password_confirmation" required autocomplete="new-password" />
                        </div>
                        
                        <div class="mb-4">
                            <button type="submit" class="btn btn-danger d-block w-100 btn-lg h-45px fs-13px">Registrarse</button>
                        </div>
                        <div class="mb-4 pb-5">
                            ¿Ya eres miembro? Haz clic <a href="{{ route('login') }}">aquí</a> para iniciar sesión.
                        </div>
                        <hr class="bg-gray-600 opacity-2" />
                        <p class="text-center text-gray-600">
                            &copy; FitTracker Todos los derechos reservados 2024
                        </p>
                    </form>
                </div>
                <!-- END register-content -->
            </div>
            <!-- END register-container -->
        </div>
        <!-- END register -->
    </div>
    <!-- END #app -->

    <!-- ================== BEGIN core-js ================== -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <!-- ================== END core-js ================== -->
</body>
</html>