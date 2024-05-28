<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>FitTracker - Register</title>
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
                <div class="news-image" style="background-image: url('{{ asset('assets/img/login-bg/login-bg-15.jpg') }}')"></div>
                <div class="news-caption">
                    <h4 class="caption-title"><b>FitTracker</b> App</h4>
                    <p>Tu compañero de entrenamiento</p>
                </div>
            </div>
            <!-- END news-feed -->
            
            <!-- BEGIN register-container -->
            <div class="register-container">
                <!-- BEGIN register-header -->
                <div class="register-header mb-25px h1">
                    <div class="mb-1">Sign Up</div>
                    <small class="d-block fs-15px lh-16">Create your FitTracker Account. It’s free and always will be.</small>
                </div>
                <!-- END register-header -->
                
                <!-- BEGIN register-content -->
                <div class="register-content">
                    <form method="POST" action="{{ route('register') }}" class="fs-13px">
                        @csrf
                        <div class="mb-3">
                            <label class="mb-2">Name <span class="text-danger">*</span></label>
                            <div class="row gx-3">
                                <div class="col-md-6 mb-2 mb-md-0">
                                    <input type="text" class="form-control fs-13px @error('name') is-invalid @enderror" placeholder="First name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus />
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control fs-13px @error('surname') is-invalid @enderror" placeholder="Last name" name="surname" value="{{ old('surname') }}" required autocomplete="surname" />
                                    @error('surname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="mb-2">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control fs-13px @error('email') is-invalid @enderror" placeholder="Email address" name="email" value="{{ old('email') }}" required autocomplete="email" />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="mb-2">Re-enter Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control fs-13px" placeholder="Re-enter email address" name="email_confirmation" required autocomplete="email_confirmation" />
                        </div>
                        <div class="mb-4">
                            <label class="mb-2">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control fs-13px @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="new-password" />
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" value="" id="agreementCheckbox" />
                            <label class="form-check-label" for="agreementCheckbox">
                                By clicking Sign Up, you agree to our <a href="javascript:;">Terms</a> and that you have read our <a href="javascript:;">Data Policy</a>, including our <a href="javascript:;">Cookie Use</a>.
                            </label>
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-theme d-block w-100 btn-lg h-45px fs-13px">Sign Up</button>
                        </div>
                        <div class="mb-4 pb-5">
                            Already a member? Click <a href="{{ route('login') }}">here</a> to login.
                        </div>
                        <hr class="bg-gray-600 opacity-2" />
                        <p class="text-center text-gray-600">
                            &copy; FitTracker All Right Reserved 2024
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