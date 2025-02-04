{{-- @extends('layouts.app')

@section('content') --}}
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
{{-- @endsection --}}

<!doctype html>

<html
  lang="en"
  class="light-style layout-wide customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="style/assets/"
  data-template="horizontal-menu-template-no-customizer"
  data-style="light">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

      <title>Intranet AMFPro</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('style/logos/icono-blanco1.png')}}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
      rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{asset('style/assets/vendor/fonts/remixicon/remixicon.css')}}" />
    <link rel="stylesheet" href="{{asset('style/assets/vendor/fonts/flag-icons.css')}}" />

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="{{asset('style/assets/vendor/libs/node-waves/node-waves.css')}}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset('style/assets/vendor/css/rtl/core.css')}}" />
    <link rel="stylesheet" href="{{asset('style/assets/vendor/css/rtl/theme-default.css')}}" />
    <link rel="stylesheet" href="{{asset('style/assets/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('style/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{asset('style/assets/vendor/libs/typeahead-js/typeahead.css')}}" />
    <!-- Vendor -->
    <link rel="stylesheet" href="{{asset('style/assets/vendor/libs/@form-validation/form-validation.css')}}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{asset('style/assets/vendor/css/pages/page-auth.css')}}" />

    <!-- Helpers -->
    <script src="{{asset('style/assets/vendor/js/helpers.js')}}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset('style/assets/js/config.js')}}"></script>
  </head>

  <body style="background-image: url('{{asset('style/assets/img/banners/loginbanner.svg')}}');
  background-repeat: no-repeat;
  background-size: cover;">
    <!-- Content -->

    <div class="position-relative">
      <div class="authentication-wrapper authentication-basic container-p-y p-4 p-sm-0">
        <div class="authentication-inner py-6">
          <!-- Logo -->
          <div class="card p-md-7 p-1" style="background: rgba(0, 0, 0, 0.62)">
            <!-- Forgot Password -->
            <div class="app-brand justify-content-center mt-5">
              <div class="app-brand-link gap-2">
                <center><img src="{{asset('style/logos/logo-_amfpro_pro_color.png')}}" alt="" style="max-width: 40%"></center>
              </div>
            </div>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <!-- /Logo -->
            <div class="card-body mt-1">
              <h4 class="mb-1 text-white">Restablecer Contraseña 🔒</h4>
              <form id="formAuthentication" class="mb-5"  method="POST" action="{{ route('password.update') }}">
                @csrf
                <div class="row">
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="col-12 col-md-12">
                        <div class="form-floating form-floating-outline mb-5">
                        <input
                            type="text"
                            class="form-control text-white  @error('email') is-invalid @enderror" name="email" value="{{ $email}}"
                            id="email"
                            placeholder="Introduzca su correo electronico"
                            
                            readonly />
                        <label>Email</label>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-12">
                        <div class="form-password-toggle">
                            <div class="input-group input-group-merge">
                            
                                <div class="form-floating form-floating-outline">
                                    <input
                                    type="password"
                                    id="password"
                                    class="form-control text-white  @error('password') is-invalid @enderror" name="password" 
                                    value="{{ old('password') }}"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" />
                                    <label for="password">Password</label>
                                </div>
                                <span class="input-group-text cursor-pointer text-white"><i class="ri-eye-off-line"></i></span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 mt-3">
                        <div class="form-password-toggle">
                            <div class="input-group input-group-merge">
                            
                                <div class="form-floating form-floating-outline">
                                    <input
                                    type="password"
                                    id="password-confirm"
                                    class="form-control text-white " name="password_confirmation" 
                                    value="{{ old('password') }}"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password"  required autocomplete="new-password"/>
                                    <label for="password-confirm">Confirmar Password</label>
                                </div>
                                <span class="input-group-text cursor-pointer text-white"><i class="ri-eye-off-line"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary d-grid w-100 mt-3" type="submit">Restablecer Contraseña</button>
              </form>
            </div>
          </div>
          <!-- /Forgot Password -->
        
        </div>
      </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{asset('style/assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('style/assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('style/assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('style/assets/vendor/libs/node-waves/node-waves.js')}}"></script>
    <script src="{{asset('style/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('style/assets/vendor/libs/hammer/hammer.js')}}"></script>
    <script src="{{asset('style/assets/vendor/libs/i18n/i18n.js')}}"></script>
    <script src="{{asset('style/assets/vendor/libs/typeahead-js/typeahead.js')}}"></script>
    <script src="{{asset('style/assets/vendor/js/menu.js')}}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{asset('style/assets/vendor/libs/@form-validation/popular.js')}}"></script>
    <script src="{{asset('style/assets/vendor/libs/@form-validation/bootstrap5.js')}}"></script>
    <script src="{{asset('style/assets/vendor/libs/@form-validation/auto-focus.js')}}"></script>

    <!-- Main JS -->
    <script src="{{asset('style/assets/js/main.js')}}"></script>

    <!-- Page JS -->
    <script src="{{asset('style/assets/js/pages-auth.js')}}"></script>
  </body>
</html>


