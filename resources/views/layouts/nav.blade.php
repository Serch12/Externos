<nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="container-xxl">
      <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-6">
        <a href="{{ route('home') }}" class="app-brand-link gap-2">
          <span class="app-brand-logo demo">
            <span>
              <img src="{{asset('style/logos/logo-_amfpro_pro_color.png')}}" class="mt-2" alt="logo" style="max-width: 15%">
            </span>
          </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
          <i class="ri-close-fill align-middle"></i>
        </a>
      </div>

      <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
          <i class="ri-menu-fill ri-22px"></i>
        </a>
      </div>

      <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <ul class="navbar-nav flex-row align-items-center ms-auto">
          <!-- Search -->
          <!-- /Search -->


          <!-- Quick links  -->

          <!-- Quick links -->

          <!-- Notification -->
          <notificaciones-component id_usuario_logeado = "{{ auth()->user()->id }}" name_usuario_logeado = "{{ auth()->user()->name }}" rol_usuario = "{{ $rol_usuario }}" sede = "{{ $sede }}" permisos="{{json_encode($permisos)}}" componente="Jugadores"></notificaciones-component>
         
          <!--/ Notification -->

          <!-- User -->
          <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
              <div class="avatar avatar-online">
                @if ($imagen->foto != 'sinfoto')
                  <img src="{{ asset('ArchivosSistema/Documentacion/'.$imagen->foto)}}" alt class="rounded-circle" />
                @else
                <img src="{{asset('style/logos/sinfoto.png')}}" alt class="rounded-circle" />
                @endif
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item" href="#!">
                  <div class="d-flex">
                    <div class="flex-shrink-0 me-2">
                      <div class="avatar avatar-online">
                        @if ($imagen->foto != 'sinfoto')
                          <img src="{{ asset('ArchivosSistema/Documentacion/'.$imagen->foto)}}" alt class="rounded-circle" />
                        @else
                          <img src="{{asset('style/logos/sinfoto.png')}}" alt class="rounded-circle" />
                        @endif
                      </div>
                    </div>
                    <div class="flex-grow-1">
                      <span class="fw-medium d-block small">{{ auth()->user()->name }}</span>
                      <small class="text-muted">{{ $rol_usuario }}</small>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <a class="dropdown-item" href="{{route('perfil')}}">
                  <i class="ri-user-3-line ri-22px me-3"></i><span class="align-middle">Mi Perfil</span>
                </a>
              </li>
              {{-- <li>
                <a class="dropdown-item" href="pages-account-settings-account.html">
                  <i class="ri-settings-4-line ri-22px me-3"></i><span class="align-middle">Settings</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="pages-account-settings-billing.html">
                  <span class="d-flex align-items-center align-middle">
                    <i class="flex-shrink-0 ri-file-text-line ri-22px me-3"></i>
                    <span class="flex-grow-1 align-middle">Billing</span>
                    <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger">4</span>
                  </span>
                </a>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <a class="dropdown-item" href="pages-pricing.html">
                  <i class="ri-money-dollar-circle-line ri-22px me-3"></i
                  ><span class="align-middle">Pricing</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="pages-faq.html">
                  <i class="ri-question-line ri-22px me-3"></i><span class="align-middle">FAQ</span>
                </a>
              </li> --}}
              <li>
                <div class="d-grid px-4 pt-2 pb-1">
                  <a class="btn btn-sm btn-danger d-flex" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                    <small class="align-middle">Logout</small>
                    <i class="ri-logout-box-r-line ms-2 ri-16px"></i>
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                </div>
              </li>
            </ul>
          </li>
          <!--/ User -->
        </ul>
      </div>

      <!-- Search Small Screens -->
      <div class="navbar-search-wrapper search-input-wrapper container-xxl d-none">
        <input
          type="text"
          class="form-control search-input border-0"
          placeholder="Search..."
          aria-label="Search..." />
        <i class="ri-close-fill search-toggler cursor-pointer"></i>
      </div>
    </div>
  </nav>