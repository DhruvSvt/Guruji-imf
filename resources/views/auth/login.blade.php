<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <title>Guruji IMF</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Guruji IMF" name="description" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ config('app.url') }}/assets/images/logoicon.png">
    <!-- Layout config Js -->
    <script src="{{ config('app.url') }}/assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="{{ config('app.url') }}/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ config('app.url') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ config('app.url') }}/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ config('app.url') }}/assets/css/custom.min.css" rel="stylesheet" type="text/css" />
     <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>
            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0
            1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>
        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">
                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <a href="{{ config('app.url') }}/" class="d-inline-block auth-logo">
                                        <img src="{{ config('app.url') }}/assets/images/logo8.jpg" alt=""
                                            style="max-height: 97px;">
                                    </a>
                                    <h5 class="text-primary mt-3">Welcome Back !</h5>
                                    <p class="text-muted">Sign in to Guruji IMF.</p>
                                </div>
                                <div class="p-2 mt-4">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email Address</label>
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            {{-- <div class="float-end">
                                                <a href="auth-pass-reset-basic.html" class="text-muted">Forgot
                                                    password?</a>
                                            </div> --}}
                                            <label class="form-label" for="password">Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input id="password" type="password"
                                                    class="form-control pe-5 password-input" @error('password')
                                                    is-invalid @enderror" name="password" required
                                                    autocomplete="current-password">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <button
                                                    class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                    type="submit" id="password-addon"><i
                                                        class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <button class="btn btn-primary w-100" type="submit">Sign In</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->
        <!-- footer -->
    </div>
    <!-- JAVASCRIPT -->
    <script src="{{ config('app.url') }}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ config('app.url') }}/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="{{ config('app.url') }}/assets/libs/node-waves/waves.min.js"></script>
    <script src="{{ config('app.url') }}/assets/libs/feather-icons/feather.min.js"></script>
    <script src="{{ config('app.url') }}/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="{{ config('app.url') }}/assets/js/plugins.js"></script>
    <!-- particles js -->
    <script src="{{ config('app.url') }}/assets/libs/particles.js/particles.js"></script>
    <!-- particles app js -->
    <script src="{{ config('app.url') }}/assets/js/pages/particles.app.js"></script>
</body>

</html>
<!-- end auth-page-wrapper -->
