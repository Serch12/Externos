<aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
    <div class="container-xxl d-flex h-100">
      <ul class="menu-inner">
        <!-- Dashboards -->
        <li class="menu-item {{ request()->routeIs('home') ? 'active' : '' }}">
          <a class="menu-link" href="{{ route('home') }}">
            <i class="menu-icon tf-icons ri-home-4-fill"></i>
            <div data-i18n="Inicio">Inicio</div>
          </a>
        </li>
        

        <!-- Layouts -->
        @hasanyrole('Root|Administrador')
        <li class="menu-item {{ request()->routeIs('administrador','access') ? 'active' : '' }}">
          <a href="{{ route('administrador') }}" class="menu-link menu-toggle ">
            <i class="menu-icon ri-robot-2-line"></i>
            <div data-i18n="Administrador">Administrador</div>
          </a>

          <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('administrador') ? 'active' : '' }}">
              <a href="{{ route('administrador') }}" class="menu-link">
                <i class="menu-icon tf-icons ri-user-line"></i>
                <div data-i18n="Usuarios">Usuarios</div>
              </a>
            </li>
            <li class="menu-item {{ request()->routeIs('access') ? 'active' : '' }}">
              <a href="{{ route('access') }}" class="menu-link">
                <i class="menu-icon tf-icons ri-shield-user-line"></i>
                <div data-i18n="Roles & Permisos">Roles & Permisos</div>
              </a>
            </li>
            <li class="menu-item {{ request()->routeIs('sede') ? 'active' : '' }}">
              <a href="{{ route('sede') }}" class="menu-link">
                <i class="menu-icon tf-icons ri-pin-distance-fill"></i>
                <div data-i18n="Sedes">Sedes</div>
              </a>
            </li>
          </ul>
        </li>
        @else
        @endhasanyrole

        <!-- Apps -->
        @hasanyrole('Root|Administrador|Cuerpo Tecnico|CM|Auxiliar Técnico')
        <li class="menu-item {{ request()->routeIs('jugadores','torneo','cuerpo_tecnico') ? 'active' : '' }}">
          <a href="javascript:void(0)" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ri-football-line"></i>
            <div data-i18n="Módulo Técnico">Módulo Técnico</div>
          </a>
          <ul class="menu-sub">
            @hasanyrole('Root|Administrador|Cuerpo Tecnico|Auxiliar Técnico')
            <li class="menu-item {{ request()->routeIs('cuerpo_tecnico') ? 'active' : '' }}">
              <a href="{{ route('cuerpo_tecnico') }}" class="menu-link">
                <i class="menu-icon tf-icons ri-group-3-line"></i>
                <div data-i18n="Cuerpo Técnico">Cuerpo Técnico</div>
              </a>
            </li>
            <li class="menu-item {{ request()->routeIs('jugadores') ? 'active' : '' }}">
              <a href="{{ route('jugadores') }}" class="menu-link">
                <i class="menu-icon tf-icons ri-team-line"></i>
                <div data-i18n="Jugadores">Jugadores</div>
              </a>
            </li>
            @else
            @endhasanyrole
            @if ($existJugador == true)
              <li class="menu-item {{ request()->routeIs('torneo') ? 'active' : '' }}">
                <a href="{{ route('torneo') }}" class="menu-link">
                  <i class="menu-icon tf-icons ri-shield-star-line"></i>
                  <div data-i18n="Torneos">Torneos</div>
                </a>
              </li>
            @endif
          </ul>
        </li>
        @else
        @endhasanyrole

        @hasanyrole('Root|Administrador|CM')
        <!-- Comunicación y Medios -->
        <li class="menu-item  {{ request()->routeIs('post','talentos','correo') ? 'active' : '' }}">
          <a href="javascript:void(0)" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ri-article-line"></i>
            <div data-i18n="Comunicación y Medios">Comunicación y Medios</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('post') ? 'active' : '' }}">
              <a href="{{ route('post') }}" class="menu-link">
                <i class="menu-icon tf-icons ri-window-2-fill"></i>
                <div data-i18n="Parrilla">Parrilla</div>
              </a>
            </li>

            <li class="menu-item {{ request()->routeIs('talentos') ? 'active' : '' }}">
              <a href="{{ route('talentos') }}" class="menu-link">
                <i class="menu-icon tf-icons ri-account-circle-line"></i>
                <div data-i18n="Talentos AMFpro">Talentos AMFpro</div>
              </a>
            </li>
            <li class="menu-item {{ request()->routeIs('correo') ? 'active' : '' }}">
              <a href="{{ route('correo') }}" class="menu-link">
                <i class="menu-icon tf-icons ri-mail-send-fill"></i>
                <div data-i18n="Correos AMFpro">Correos AMFpro</div>
              </a>
            </li>
            
          </ul>
        </li>
        @else
        @endhasanyrole

        @hasanyrole('Root|Cuerpo Tecnico|CM|Asesor Juridico|Asesor')
        <!-- Components -->
        <li class="menu-item {{ request()->routeIs('honorario') ? 'active' : '' }}">
          <a href="{{ route('honorario') }}" class="menu-link">
            <i class="menu-icon tf-icons ri-cash-fill"></i>
            <div data-i18n="Honorarios">Honorarios</div>
          </a>
          
        </li>
        @else
        @endhasanyrole

        <!-- Forms -->
        {{-- <li class="menu-item">
          <a href="javascript:void(0)" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ri-pages-line"></i>
            <div data-i18n="Forms">Forms</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ri-file-copy-line"></i>
                <div data-i18n="Form Elements">Form Elements</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="forms-basic-inputs.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Basic Inputs">Basic Inputs</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="forms-input-groups.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Input groups">Input groups</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="forms-custom-options.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Custom Options">Custom Options</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="forms-editors.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Editors">Editors</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="forms-file-upload.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="File Upload">File Upload</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="forms-pickers.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Pickers">Pickers</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="forms-selects.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Select & Tags">Select &amp; Tags</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="forms-sliders.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Sliders">Sliders</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="forms-switches.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Switches">Switches</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="forms-extras.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Extras">Extras</div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ri-box-3-line"></i>
                <div data-i18n="Form Layouts">Form Layouts</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="form-layouts-vertical.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Vertical Form">Vertical Form</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="form-layouts-horizontal.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Horizontal Form">Horizontal Form</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="form-layouts-sticky.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Sticky Actions">Sticky Actions</div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ri-git-commit-line"></i>
                <div data-i18n="Form Wizard">Form Wizard</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="form-wizard-numbered.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Numbered">Numbered</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="form-wizard-icons.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Icons">Icons</div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="menu-item">
              <a href="form-validation.html" class="menu-link">
                <i class="menu-icon tf-icons ri-checkbox-circle-line"></i>
                <div data-i18n="Form Validation">Form Validation</div>
              </a>
            </li>
          </ul>
        </li> --}}

        <!-- Tables -->
        {{-- <li class="menu-item">
          <a href="javascript:void(0)" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ri-table-line"></i>
            <div data-i18n="Tables">Tables</div>
          </a>
          <ul class="menu-sub">
            <!-- Tables -->
            <li class="menu-item">
              <a href="tables-basic.html" class="menu-link">
                <i class="menu-icon tf-icons ri-layout-grid-line"></i>
                <div data-i18n="Tables">Tables</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ri-grid-line"></i>
                <div data-i18n="Datatables">Datatables</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="tables-datatables-basic.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Basic">Basic</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="tables-datatables-advanced.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Advanced">Advanced</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="tables-datatables-extensions.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Extensions">Extensions</div>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </li> --}}

        <!-- Charts & Maps -->
        {{-- <li class="menu-item">
          <a href="javascript:void(0)" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ri-donut-chart-line"></i>
            <div data-i18n="Charts & Maps">Charts & Maps</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ri-bar-chart-2-line"></i>
                <div data-i18n="Charts">Charts</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="charts-apex.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Apex Charts">Apex Charts</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="charts-chartjs.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="ChartJS">ChartJS</div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="menu-item">
              <a href="maps-leaflet.html" class="menu-link">
                <i class="menu-icon tf-icons ri-map-2-line"></i>
                <div data-i18n="Leaflet Maps">Leaflet Maps</div>
              </a>
            </li>
          </ul>
        </li> --}}
      </ul>
    </div>
  </aside>