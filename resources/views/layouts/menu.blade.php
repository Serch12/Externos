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
            <i class="menu-icon tf-icons ri-layout-2-line"></i>
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
          </ul>
        </li>
        @else
        @endhasanyrole

        <!-- Apps -->
        @hasanyrole('Root|Administrador|Cuerpo Tecnico')
        <li class="menu-item {{ request()->routeIs('jugadores','torneo') ? 'active' : '' }}">
          <a href="javascript:void(0)" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ri-football-line"></i>
            <div data-i18n="Módulo Técnico">Módulo Técnico</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('torneo') ? 'active' : '' }}">
              <a href="{{ route('torneo') }}" class="menu-link">
                <i class="menu-icon tf-icons ri-shield-star-line"></i>
                <div data-i18n="Torneos">Torneos</div>
              </a>
            </li>
            <li class="menu-item {{ request()->routeIs('jugadores') ? 'active' : '' }}">
              <a href="{{ route('jugadores') }}" class="menu-link">
                <i class="menu-icon tf-icons ri-team-line"></i>
                <div data-i18n="Jugadores">Jugadores</div>
              </a>
            </li>
          </ul>
        </li>
        @else
        @endhasanyrole
        @hasanyrole('Root|Administrador|CM')
        <!-- Comunicación y Medios -->
        <li class="menu-item  {{ request()->routeIs('post') ? 'active' : '' }}">
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

            {{-- <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ri-account-circle-line"></i>
                <div data-i18n="User Profile">User Profile</div>
              </a>
              
            </li> --}}
            
          </ul>
        </li>
        @else
        @endhasanyrole

        <!-- Components -->
        {{-- <li class="menu-item">
          <a href="javascript:void(0)" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ri-archive-line"></i>
            <div data-i18n="Components">Components</div>
          </a>
          <ul class="menu-sub">
            <!-- Cards -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ri-bank-card-2-line"></i>
                <div data-i18n="Cards">Cards</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="cards-basic.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Basic">Basic</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="cards-advance.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Advance">Advance</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="cards-statistics.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Statistics">Statistics</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="cards-analytics.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Analytics">Analytics</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="cards-gamifications.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Gamifications">Gamifications</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="cards-actions.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Actions">Actions</div>
                  </a>
                </li>
              </ul>
            </li>
            <!-- User interface -->
            <li class="menu-item">
              <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ri-pantone-line"></i>
                <div data-i18n="User interface">User interface</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="ui-accordion.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Accordion">Accordion</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="ui-alerts.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Alerts">Alerts</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="ui-badges.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Badges">Badges</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="ui-buttons.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Buttons">Buttons</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="ui-carousel.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Carousel">Carousel</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="ui-collapse.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Collapse">Collapse</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="ui-dropdowns.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Dropdowns">Dropdowns</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="ui-footer.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Footer">Footer</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="ui-list-groups.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="List Groups">List Groups</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="ui-modals.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Modals">Modals</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="ui-navbar.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Navbar">Navbar</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="ui-offcanvas.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Offcanvas">Offcanvas</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="ui-pagination-breadcrumbs.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Pagination & Breadcrumbs">Pagination &amp; Breadcrumbs</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="ui-progress.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Progress">Progress</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="ui-spinners.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Spinners">Spinners</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="ui-tabs-pills.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Tabs & Pills">Tabs &amp; Pills</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="ui-toasts.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Toasts">Toasts</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="ui-tooltips-popovers.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Tooltips & Popovers">Tooltips &amp; Popovers</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="ui-typography.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Typography">Typography</div>
                  </a>
                </li>
              </ul>
            </li>
            <!-- Extended components -->
            <li class="menu-item">
              <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ri-box-3-line"></i>
                <div data-i18n="Extended UI">Extended UI</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="extended-ui-avatar.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Avatar">Avatar</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="extended-ui-blockui.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="BlockUI">BlockUI</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="extended-ui-drag-and-drop.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Drag & Drop">Drag &amp; Drop</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="extended-ui-media-player.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Media Player">Media Player</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="extended-ui-perfect-scrollbar.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Perfect Scrollbar">Perfect Scrollbar</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="extended-ui-star-ratings.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Star Ratings">Star Ratings</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="extended-ui-sweetalert2.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="SweetAlert2">SweetAlert2</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="extended-ui-text-divider.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Text Divider">Text Divider</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Timeline">Timeline</div>
                  </a>
                  <ul class="menu-sub">
                    <li class="menu-item">
                      <a href="extended-ui-timeline-basic.html" class="menu-link">
                        <i class="menu-icon tf-icons ri-circle-fill"></i>
                        <div data-i18n="Basic">Basic</div>
                      </a>
                    </li>
                    <li class="menu-item">
                      <a href="extended-ui-timeline-fullscreen.html" class="menu-link">
                        <i class="menu-icon tf-icons ri-circle-fill"></i>
                        <div data-i18n="Fullscreen">Fullscreen</div>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="menu-item">
                  <a href="extended-ui-tour.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Tour">Tour</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="extended-ui-treeview.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Treeview">Treeview</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="extended-ui-misc.html" class="menu-link">
                    <i class="menu-icon tf-icons ri-circle-fill"></i>
                    <div data-i18n="Miscellaneous">Miscellaneous</div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="menu-item">
              <a href="icons-ri.html" class="menu-link">
                <i class="menu-icon tf-icons ri-remixicon-line"></i>
                <div data-i18n="Icons">Icons</div>
              </a>
            </li>
          </ul>
        </li> --}}

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