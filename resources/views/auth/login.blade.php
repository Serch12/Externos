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
    <link rel="stylesheet" href="style/assets/vendor/libs/@form-validation/form-validation.css" />
    <link rel="stylesheet" type="text/css" href="{{asset('style/assets/login.css')}}">

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{asset('style/assets/vendor/css/pages/page-auth.css')}}" />

    <!-- Helpers -->
    <script src="{{asset('style/assets/vendor/js/helpers.js')}}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset('style/assets/js/config.js')}}"></script>
  </head>

  <body style="background-image: url('style/assets/img/banners/loginbanner.svg');
    background-repeat: no-repeat;
    background-size: cover;">
    <!-- Content -->

    <div class="position-relative">
      <div class="authentication-wrapper authentication-basic container-p-y p-4 p-sm-0">
        <div class="authentication-inner py-6">
          <!-- Login -->
          <div class="card p-md-7 p-1" style="background: rgba(0, 0, 0, 0.62)">
            <!-- Logo -->
            <div class="app-brand justify-content-center mt-5">
              <div class="app-brand-link gap-2">
                <center><img src="{{asset('style/logos/logo-_amfpro_pro_color.png')}}" alt="" style="max-width: 45%"></center>
              </div>
            </div>
            <!-- /Logo -->

            <div class="card-body mt-1">
              {{-- <h4 class="mb-1">Welcome to Materialize! 👋</h4>
              <p class="mb-5">Please sign-in to your account and start the adventure</p> --}}

              <form id="formAuthentication" class="mb-5" method="POST" class="login-form" action="{{ route('login') }}">
                @csrf
                @error('email')
                  <div class="alert alert-solid-danger d-flex align-items-center" role="alert">
                    <span class="alert-icon rounded">
                      <i class="ri-error-warning-line ri-22px"></i>
                    </span>
                    {{($message)}}
                  </div>
                @enderror
                @error('password')
                  <div class="alert alert-solid-danger d-flex align-items-center" role="alert">
                    <span class="alert-icon rounded">
                      <i class="ri-error-warning-line ri-22px"></i>
                    </span>
                    {{($message)}}
                  </div>
                @enderror
                <div class="form-floating form-floating-outline mb-5">
                  <input
                    type="text"
                    class="form-control @error('email') @enderror text-white"
                    id="username"
                    name="email"
                    value="{{old('email')}}"
                    placeholder="Ingrese su Correo"/>
                  <label for="email">Email</label>
                </div>
                <div class="mb-5">
                  <div class="form-password-toggle">
                    <div class="input-group input-group-merge">
                      
                      <div class="form-floating form-floating-outline">
                        <input
                          type="password"
                          id="password"
                          class="form-control @error('password') @enderror text-white"
                          name="password"
                          placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                          aria-describedby="password" />
                        <label for="password">Password</label>
                      </div>
                      <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line text5-white"></i></span>
                    </div>
                  </div>
                </div>
                <div class="mb-5 d-flex justify-content-between mt-5">
                  <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" id="remember" {{ old('remember') ? 'checked' : '' }}/>
                    <label class="form-check-label text-white" for="remember-me">{{ __('Recordar Credenciales') }}</label>
                  </div>
                  <a href="{{ route('reset') }}" class="float-end mb-1 mt-2">
                    <span>Olvidó la contraseña?</span>
                  </a>
                </div>
                <div class="mb-5">
                  <button class="btn btn-success d-grid w-100" type="submit">Ingresar</button>
                </div>
              </form>

              {{-- <p class="text-center">
                <span>New on our platform?</span>
                <a href="auth-register-basic.html">
                  <span>Create an account</span>
                </a>
              </p> --}}

             
            </div>
          </div>
          <!-- /Login -->
          {{-- <img
            alt="mask"
            src="style/assets/img/illustrations/auth-basic-login-mask-light.png"
            class="authentication-image d-none d-lg-block"
            data-app-light-img="illustrations/auth-basic-login-mask-light.png"
            data-app-dark-img="illustrations/auth-basic-login-mask-dark.png" /> --}}
        </div>
      </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="style/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="style/assets/vendor/libs/popper/popper.js"></script>
    <script src="style/assets/vendor/js/bootstrap.js"></script>
    <script src="style/assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="style/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="style/assets/vendor/libs/hammer/hammer.js"></script>
    <script src="style/assets/vendor/libs/i18n/i18n.js"></script>
    <script src="style/assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="style/assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="style/assets/vendor/libs/@form-validation/popular.js"></script>
    <script src="style/assets/vendor/libs/@form-validation/bootstrap5.js"></script>
    <script src="style/assets/vendor/libs/@form-validation/auto-focus.js"></script>

    <!-- Main JS -->
    <script src="style/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="style/assets/js/pages-auth.js"></script>
  </body>
</html>
