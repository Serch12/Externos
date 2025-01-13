<!doctype html>

<html
  lang="en"
  class="light-style layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="style/assets/"
  data-template="horizontal-menu-template-no-customizer"
  {{-- data-style="light"> --}}
  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <link rel="stylesheet" href="{{asset('style/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}" />
    <link rel="stylesheet" href="{{asset('style/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}" />
    <link rel="stylesheet" href="{{asset('style/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css')}}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{asset('style/assets/vendor/css/pages/page-profile.css')}}" />

    <!-- Helpers -->
    <script src="{{asset('style/assets/vendor/js/helpers.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset('style/assets/js/config.js')}}"></script>
  </head>

  <body>
    
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
      <div class="layout-container">
        <!-- Navbar -->
        @include('layouts.nav')
        <!-- / Navbar -->

        <div id="app">
          <!-- Layout container -->
          <div class="layout-page">
            <!-- Content wrapper -->
            
            <div class="content-wrapper">
              <!-- Menu -->
              @include('layouts.menu')
              <!-- / Menu -->

              <!-- Content -->
              <div class="container-xxl flex-grow-1 container-p-y">
                <!-- Layout Demo -->
                @yield('content') 
                <!--/ Layout Demo -->
                    </div>
              
              <!--/ Content -->

              <!-- Footer -->
              @include('layouts.footer')
              <!-- / Footer -->

              <div class="content-backdrop fade"></div>
            </div>
            <!--/ Content wrapper -->
          </div>
        </div>
        <!--/ Layout container -->
      </div>
    </div>
    
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>

    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>

    <!--/ Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('js/app.js') }}"></script>
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

    <!-- Main JS -->
    <script src="{{asset('style/assets/js/main.js')}}"></script>

    <!-- Page JS -->
    <script src="{{asset('style/assets/js/pages-profile-user.js')}}"></script>
  </body>
</html>
