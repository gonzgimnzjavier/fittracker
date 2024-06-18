<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>FitTracker - Login</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
       
    <link href="{{ asset('assets/css/vendor.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/default/app.min.css') }}" rel="stylesheet" />
  
</head>
<body class='pace-top'>
 
    <div id="loader" class="app-loader">
        <span class="spinner"></span>
    </div>
  
    <div id="app" class="app">
   
        <div class="login login-v2 fw-bold">

            <div class="login-cover">
                <div class="login-cover-img" style="background-image: url('{{ asset("assets/img/login-bg/login-bg-17.jpg") }}');" data-id="login-cover-image"></div>
                <div class="login-cover-bg"></div>
            </div>
 
            <div class="login-container">
             
                <div class="login-header">
                    <div class="brand">
                        <div class="d-flex align-items-center">
                        <span><img src="{{ asset('images/fittracker.png') }}" alt="FitTracker Logo" style="width: 50px; margin-right: 5px;"></span> <b>Fit</b> Tracker
                        </div>
                        <small>Gestor de Gimnasios</small>
                    </div>
                    <div class="icon">
                        <i class="fa fa-lock"></i>
                    </div>
                </div>
               
                <div class="login-content">
                    <form class="user" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-floating mb-20px">
                            <input type="email" class="form-control fs-13px h-45px border-0 @error('email') is-invalid @enderror" placeholder="Email Address" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
                            <label for="email" class="d-flex align-items-center text-gray-600 fs-13px">Dirección de correo</label>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-floating mb-20px">
                            <input type="password" class="form-control fs-13px h-45px border-0 @error('password') is-invalid @enderror" placeholder="Password" id="password" name="password" required autocomplete="current-password" />
                            <label for="password" class="d-flex align-items-center text-gray-600 fs-13px">Contraseña</label>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-20px">
                            <button type="submit" class="btn btn-danger d-block w-100 h-45px btn-lg">Iniciar Sesión</button>
                        </div>
                        <div class="text-gray-500">
                            ¡No tienes una cuenta! <a href="{{ route('register') }}" class="text-white">Crea una cuenta</a>.
                        </div>
                    </form>
                </div>
              
            </div>

        </div>
  
    </div>

    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
  
</body>
</html>