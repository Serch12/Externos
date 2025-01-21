    <template>
        <div>
            <div id="main" v-if="this.vista == 0">
                <div class="row">
                    <!-- Users List Table -->
                    <div class="card">
                    
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <h5 class="card-header">Usuario</h5>
                            </div>
                            <div class="col-12 col-md-6 mt-3">
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <input type="search" id="email"class="form-control"  v-model="search" placeholder="Buscar Registro" @keyup="buscarUsuario()"/>
                                    <button type="button" class="btn btn-outline-success waves-effect" data-bs-toggle="modal" data-bs-target="#createUser">Agregar</button>
                                </div>
                            </div>
                            <div class="table-responsive text-nowrap mt-2">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Foto</th>
                                            <th>Nombre</th>
                                            <th>Email</th>
                                            <th>Rol</th>
                                            <th>Estatus</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <tr v-for="(user, index) in Usuario" :key="index">
                                            <td>{{ index+1 }}</td>
                                            <td>
                                                <div class="d-flex justify-content-start align-items-center" v-if="user.perfil != null">
                                                    <div class="avatar-wrapper">
                                                        <div class="avatar me-2" >
                                                            <img :src="`ArchivosSistema/Documentacion/${user.perfil.foto}`" alt="Avatar" class="rounded-circle">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-start align-items-center" v-else>
                                                    <div class="avatar-wrapper">
                                                        <div class="avatar me-2" >
                                                            <img src="style/logos/sinfoto.png" alt="Avatar" class="rounded-circle">
                                                        </div>
                                                    </div>
                                                </div>
                            
                                            </td>
                                            <td>{{ user.name }}</td>
                                            <td>{{ user.email }}</td>
                                            <td>{{ user.rol_name }}</td>
                                            <td><span :class="`badge rounded-pill ${user.color} me-1`">{{user.text}}</span></td>
                                            <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="ri-more-2-line"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" type="button" style="color: orange;" v-if="include('Vizualizar')" @click="muestra(1),infoUsuario(user)">
                                                        <i class="ri-clipboard-line me-1"></i> Vizualizar</a>
                                                    <a class="dropdown-item" type="button" style="color: #33b2ff;" v-if="include('Editar')" 
                                                        data-bs-toggle="modal" data-bs-target="#editUser" @click="infoUsuario(user)">
                                                        <i class="ri-pencil-line me-1"></i> Editar</a>
                                                    <a class="dropdown-item" type="button" style="color: red;" v-if="include('Eliminar')" @click="eliminarPerfil(user.id)">
                                                        <i class="ri-delete-bin-7-line me-1"></i> Eliminar</a>
                                                </div>
                                            </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <nav aria-label="Page navigation example mt-3">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item disabled" v-if="pagination.current_page > 1">
                                            <a @click.prevent="changePage(pagination.current_page -1)" class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                        </li>
                                        <li class="page-item" v-for="(page, index) in pageNumber"
                                            :key="index" @click.prevent="changePage(page)"
                                            v-bind:class="[ page == isActived ? 'active' : 'waves-effect']">
                                            <a class="page-link" href="#">{{ page }}</a>
                                        </li>
                                        <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                            <a @click.prevent="changePage(pagination.current_page + 1)" class="page-link" href="#">Next</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="main" v-if="this.vista == 1">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-6">
                            <div class="user-profile-header-banner">
                                <img src="style/logos/fondo5.jpg" alt="Banner image" class="rounded-top" />
                            </div>
                            <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-5">
                                <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                                    <img
                                    :src="`ArchivosSistema/Documentacion/${this.detalleUsuario.perfil.foto}`"
                                    alt="user image"
                                    class="d-block h-auto ms-0 ms-sm-5 rounded-4 user-profile-img" />
                                </div>
                                <div class="flex-grow-1 mt-4 mt-sm-12">
                                    <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-5 flex-md-row flex-column gap-6">
                                        <div class="user-profile-info">
                                            <h4 class="mb-2">{{this.detalleUsuario.name}}</h4>
                                            <ul
                                            class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4">
                                            <li class="list-inline-item">
                                                <i class="ri-football-line me-2 ri-24px"></i><span class="fw-medium">{{this.detalleUsuario.rol_name}}</span>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="ri-map-pin-line me-2 ri-24px"></i><span class="fw-medium">{{this.detalleUsuario.sede[0].nombre}}</span>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="ri-calendar-line me-2 ri-24px"></i
                                                ><span class="fw-medium"> Joined April 2021</span>
                                            </li>
                                            </ul>
                                        </div>
                                        <div class="alert alert-solid-success d-flex align-items-center" role="alert" v-if="this.detalleUsuario.estatus == 1">
                                            <span class="alert-icon rounded">
                                            <i class="ri-checkbox-circle-line ri-22px"></i>
                                            </span>
                                            ACTIVO
                                        </div>

                                        <div class="alert alert-solid-danger d-flex align-items-center" role="alert" v-if="this.detalleUsuario.estatus == 2">
                                            <span class="alert-icon rounded">
                                            <i class="ri-error-warning-line ri-22px"></i>
                                            </span>
                                            INACTIVO
                                        </div>

                                        <div class="alert alert-solid-warning d-flex align-items-center" role="alert" v-if="this.detalleUsuario.estatus == 0">
                                            <span class="alert-icon rounded">
                                            <i class="ri-alert-line ri-22px"></i>
                                            </span>
                                            INACTIVO
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Navbar pills -->
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="perfil-tab" data-bs-toggle="pill" data-bs-target="#perfil" type="button" role="tab" aria-controls="perfil" aria-selected="true">
                                    <i class="ri-user-3-line me-2"></i>
                                    Perfil
                                </button>
                            </li>
                            <li class="nav-item" role="presentation" v-if="this.detalleUsuario.rol_name == 'Cuerpo Tecnico'">
                                <button class="nav-link" id="documentacion-tab" data-bs-toggle="pill" data-bs-target="#documentacion" type="button" role="tab" aria-controls="documentacion" aria-selected="false">
                                    <i class="ri-article-line me-2"></i>Documentación
                                </button>
                            </li>
                            
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="perfil" role="tabpanel" aria-labelledby="perfil-tab">
                                <!-- User Profile Content -->
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-5 col-md-5">
                                            <!-- About User -->
                                            <div class="card mb-6">
                                                <div class="card-body">
                                                    <small class="card-text text-uppercase text-muted small">ACERCA DE</small>
                                                    <ul class="list-unstyled my-3 py-1" >
                                                        <li class="d-flex align-items-center mb-4">
                                                            <i class="ri-user-3-line ri-24px"></i><span class="fw-medium mx-2">NOMBRE COMPLETO:</span>
                                                            <span>{{this.detalleUsuario.perfil.nombre}} {{ this.detalleUsuario.perfil.apellido_paterno }} {{ this.detalleUsuario.perfil.apellido_materno }}</span>
                                                        </li>
                                                        <li class="d-flex align-items-center mb-4">
                                                            <i class="ri-check-line ri-24px"></i><span class="fw-medium mx-2">Estatus:</span>
                                                            <span class="badge bg-label-success rounded-pill" v-if="this.detalleUsuario.estatus == 1">Activo</span>
                                                            <span class="badge bg-label-warning rounded-pill" v-if="this.detalleUsuario.estatus == 0">Pendiente</span>
                                                            <span class="badge bg-label-danger rounded-pill" v-if="this.detalleUsuario.estatus == 2">Inactivo</span>
                                                        </li>
                                                        <li class="d-flex align-items-center mb-4">
                                                            <i class="ri-football-fill ri-24px"></i><span class="fw-medium mx-2">Role:</span>
                                                            <span>{{this.detalleUsuario.rol_name}}</span>
                                                        </li>
                                                        <!-- <li class="d-flex align-items-center mb-4">
                                                            <i class="ri-flag-2-line ri-24px"></i><span class="fw-medium mx-2">Country:</span>
                                                            <span>USA</span>
                                                        </li>
                                                        <li class="d-flex align-items-center mb-2">
                                                            <i class="ri-translate-2 ri-24px"></i><span class="fw-medium mx-2">Languages:</span>
                                                            <span>English</span>
                                                        </li> -->
                                                    </ul>
                                                </div>
                                            </div>
                                            <!--/ About User -->
                                        </div>
                                        <div class="col-xl-6 col-lg-5 col-md-5">
                                            <!-- About User -->
                                            <div class="card mb-6">
                                                <div class="card-body">
                                                    <small class="card-text text-uppercase text-muted small">CONTACTOS</small>
                                                    <ul class="list-unstyled my-3 py-1">
                                                        <li class="d-flex align-items-center mb-4">
                                                        <i class="ri-phone-line ri-24px"></i><span class="fw-medium mx-2">Tel:</span>
                                                        <span>{{ this.detalleUsuario.perfil.telefono }}</span>
                                                        </li>
                                                        <li class="d-flex align-items-center mb-4">
                                                        <i class="ri-map-pin-line ri-24px"></i><span class="fw-medium mx-2">Dirección:</span>
                                                        <span>{{this.detalleUsuario.perfil.direccion}}</span>
                                                        </li>
                                                        <li class="d-flex align-items-center mb-2">
                                                        <i class="ri-mail-open-line ri-24px"></i><span class="fw-medium mx-2">Email:</span>
                                                        <span>{{this.detalleUsuario.email}}</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!--/ About User -->
                                        </div>
                                    </div>
                                <!--/ User Profile Content -->
                            </div>
                            <div class="tab-pane fade" id="documentacion" role="tabpanel" aria-labelledby="documentacion-tab">
                                <div class="row">
                                    <div class="col-xl-4 col-lg-5 col-md-5">
                                        <!-- About User -->
                                        <div class="card mb-6">
                                            <div class="card-body">
                                                <div class="row" v-for="d in documentacion" :key="d.value">
                                                    <div class="col-12 col-md-12">
                                                        <div class="form-check form-switch">
                                                            <input type="checkbox" class="form-check-input" id="ine" :value="d.value"
                                                             @click="modalArch(d)"/>
                                                            <label for="ine" class="text-heading">{{d.label}}</label>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                        <!--/ About User -->
                                    </div>
                                    <div class="col-xl-8 col-lg-5 col-md-5">
                                        <!-- About User -->
                                        <div class="card mb-6">
                                            <div class="card-body" style="border-color: #33b2ff;">
                                                <h5 class="card-header">Documentacion Cargada</h5>
                                                <div class="table-responsive text-nowrap">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Tipo</th>
                                                                <th>Archivo</th>
                                                                <th>Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="(d, index) in this.DetalleDocumentacion" :key="index">
                                                                <td>
                                                                    {{index+1}}
                                                                </td>
                                                                <td>{{d.tipo}}</td>
                                                                <td>{{d.archivo}}</td>
                                                                <td>
                                                                    <a class="dropdown-item waves-effect" type="button" style="color: red;" @click="deleteDoc(d)">
                                                                        <i class="ri-delete-bin-7-line me-1"></i> Delete</a>

                                                                </td>
                                                            </tr>
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!--/ About User -->
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-5 col-md-5">
                        <div class="card mb-6">
                            <div class="card-body">
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a href="javascript:void(0)" class="btn btn-danger" @click="muestra(0)">
                                        <i class="ri-arrow-left-long-fill ri-16px me-2"></i>Regresar
                                    </a>
                                </div>
                            </div>
                        </div>   
                    </div>
                </div>
                

                <!--/ Navbar pills -->
            </div>
            <!-- Moda de alta usuario -->
            <div class="modal fade" id="createUser" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                    <div class="modal-content">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="modal-body p-0">
                            <div class="text-center mb-6">
                                <h4 class="mb-2">Agregar Usuario</h4>
                            </div>
                            <form id="editUserForm" class="row g-5">
                                <div class="col-12 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                    <input
                                        type="text"
                                        id="name"
                                        class="form-control"
                                        v-model="registro.name"
                                        placeholder="Nombre" />
                                    <label for="name">Nombre</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                    <select id="roles" name="roles" class="form-select" v-model="registro.rol">
                                        <option value="Selecciona un Rol">Selecciona un Role</option>
                                        <option v-for="(rol, index) in Roles" :key="index" v-bind:value="rol.name">{{rol.name}}</option>
                                    </select>
                                    <label for="roles">Roles</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                    <input
                                        type="text"
                                        id="email"
                                        class="form-control"
                                        v-model="registro.email"
                                        placeholder="ejemplo@gmail.com" />
                                    <label for="email">Email</label>
                                    </div>
                                </div>
                            
                                <div class="col-12 col-md-6">
                                    <div class="form-password-toggle">
                                        <div class="input-group input-group-merge">
                                        
                                        <div class="form-floating form-floating-outline">
                                            <input
                                            type="password"
                                            id="password"
                                            class="form-control @error('password') @enderror"
                                            v-model="registro.password"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="password" />
                                            <label for="password">Password</label>
                                        </div>
                                        <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-5">
                                    <div class="form-floating form-floating-outline">
                                    <select id="Sedes" name="Sedes" class="form-select" v-model="registro.rol">
                                        <option value="Selecciona un Rol">Selecciona una Sede</option>
                                        <option v-for="(rol, index) in Sedes" :key="index" v-bind:value="rol.name">{{rol.name}}</option>
                                    </select>
                                    <label for="Sedes">Sedes</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-1">
                                    <button type="button" class="btn btn-icon btn-outline-whatsapp waves-effect" data-bs-toggle="modal" data-bs-target="#createSede">
                                        <i class="tf-icons ri-checkbox-circle-fill ri-22px"></i>
                                    </button>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="editBillingAddress" v-model="registro.activacion"/>
                                    <label for="editBillingAddress" class="text-heading">Activar Usuario?</label>
                                    </div>
                                </div>
                                <div class="col-12 text-center d-flex flex-wrap justify-content-center gap-4 row-gap-4">
                                    <button type="button" class="btn btn-primary" @click="agregaUser()">Guardar</button>
                                    <button type="reset" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal de editar del usuario -->
            <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-simple modal-add-new-address">
                    <div class="modal-content">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="modal-body p-0">
                            <div class="text-center mb-6">
                                <h4 class="address-title mb-2">Editar Usuario</h4>
                            </div>
                            <form id="addNewAddressForm" class="row g-5">
                                <div class="col-12">
                                    <div class="row g-5">
                                        <div class="col-md mb-md-0">
                                            <div class="form-check custom-option custom-option-basic">
                                                <label class="form-check-label custom-option-content" for="customRadioHome">
                                                <input
                                                    name="customRadioTemp"
                                                    class="form-check-input"
                                                    type="radio"
                                                    value=""
                                                    id="customRadioHome"
                                                    checked @click="accionSubmenu()"/>
                                                <span class="custom-option-header">
                                                    <span class="h6 mb-0 d-flex align-items-center"><i class="ri-account-box-fill ri-20px me-1"></i>Acceso</span>
                                                </span>
                                                <!-- <span class="custom-option-body">
                                                    <small>Delivery time (9am – 9pm)</small>
                                                </span> -->
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md mb-md-0">
                                            <div class="form-check custom-option custom-option-basic">
                                                <label class="form-check-label custom-option-content" for="customRadioOffice">
                                                <input
                                                    name="customRadioTemp"
                                                    class="form-check-input"
                                                    type="radio"
                                                    value=""
                                                    id="customRadioOffice" @click="accionSubmenu()"/>
                                                <span class="custom-option-header">
                                                    <span class="h6 mb-0 d-flex align-items-center"><i class="ri-id-card-fill ri-20px me-1"></i>Información</span>
                                                </span>
                                                <!-- <span class="custom-option-body">
                                                    <small>Delivery time (9am – 5pm) </small>
                                                </span> -->
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- campos de acceso -->
                                <div class="col-12 col-md-6" v-if="this.submenu == false">
                                    <div class="form-floating form-floating-outline">
                                    <input
                                        type="text"
                                        id="nameupdate"
                                        class="form-control"
                                        v-model="detalleUsuario.name"
                                        placeholder="Nombre" disabled/>
                                    <label for="nameupdate">Nombre</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6" v-if="this.submenu == false">
                                    <div class="form-floating form-floating-outline">
                                    <select id="rolesupdate" name="roles" class="form-select" v-model="detalleUsuario.rol_name">
                                        <option value="Selecciona un Rol">Selecciona un Rol</option>
                                        <option v-for="(rol, index) in Roles" :key="index" v-bind:value="rol.name">{{rol.name}}</option>
                                    </select>
                                    <label for="rolesupdate">Roles</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6" v-if="this.submenu == false">
                                    <div class="form-floating form-floating-outline">
                                    <input
                                        type="email"
                                        id="emailupdate"
                                        class="form-control"
                                        v-model="detalleUsuario.email"
                                        placeholder="ejemplo@gmail.com" disabled/>
                                    <label for="emailupdate">Email</label>
                                    </div>
                                </div>
                            
                                <div class="col-12 col-md-6" v-if="this.submenu == false">
                                    <div class="form-password-toggle">
                                        <div class="input-group input-group-merge">
                                        
                                        <div class="form-floating form-floating-outline">
                                            <input
                                            type="password"
                                            id="passwordupdate"
                                            class="form-control @error('password') @enderror"
                                            v-model="detalleUsuario.password"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="password" />
                                            <label for="passwordupdate">Password</label>
                                        </div>
                                        <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-5" v-if="this.submenu == false">
                                    <div class="form-floating form-floating-outline">
                                    <select id="Sedes" name="Sedes" class="form-select" v-model="detalleUsuario.sede">
                                        <option value="Selecciona una Sede">Selecciona una Sede</option>
                                        <option v-for="(sed, index) in Sedes" :key="index" v-bind:value="sed.id_sede">{{sed.nombre}}</option>
                                    </select>
                                    <label for="Sedes">Sedes</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-1" v-if="this.submenu == false">
                                    <button type="button" class="btn btn-icon btn-outline-whatsapp waves-effect" data-bs-toggle="modal" data-bs-target="#createSede">
                                        <i class="tf-icons ri-checkbox-circle-fill ri-22px"></i>
                                    </button>
                                </div>
                                <div class="col-12" v-if="this.submenu == false">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" id="editBillingAddressupdate" v-model="detalleUsuario.estatus"/>
                                        <label for="editBillingAddressupdate" class="text-heading">Activar Usuario?</label>
                                    </div>
                                </div>
                                <!-- campos de informacion -->
                                <div class="col-12 col-md-6" v-if="this.submenu == true">
                                    <div class="form-floating form-floating-outline">
                                    <input
                                        type="text"
                                        id="nombreperfil"
                                        class="form-control"
                                        v-model="detalleUsuario.perfil.nombre"
                                        placeholder="Nombre" />
                                    <label for="nombreperfil">Nombre</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6" v-if="this.submenu == true">
                                    <div class="form-floating form-floating-outline">
                                    <input
                                        type="text"
                                        id="apellidoPperfil"
                                        class="form-control"
                                        v-model="detalleUsuario.perfil.apellido_paterno"
                                        placeholder="Apellido Paterno" />
                                    <label for="apellidoPperfil">Apellido Paterno</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6" v-if="this.submenu == true">
                                    <div class="form-floating form-floating-outline">
                                    <input
                                        type="text"
                                        id="apellido_materno"
                                        class="form-control"
                                        v-model="detalleUsuario.perfil.apellido_materno"
                                        placeholder="Apellido Materno" />
                                    <label for="apellido_materno">Apellido Materno</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6" v-if="this.submenu == true">
                                    <div class="form-floating form-floating-outline">
                                    <input
                                        type="text"
                                        id="direccion"
                                        class="form-control"
                                        v-model="detalleUsuario.perfil.direccion"
                                        placeholder="Dirección" />
                                    <label for="direccion">Dirección</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6" v-if="this.submenu == true">
                                    <div class="form-floating form-floating-outline">
                                    <input
                                        type="text"
                                        id="telefono"
                                        class="form-control"
                                        v-model="detalleUsuario.perfil.telefono"
                                        placeholder="5455545" />
                                    <label for="telefono">Telefono</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6" v-if="this.submenu == true">
                                    <div class="form-floating form-floating-outline mb-6">
                                        <input type="file"  accept="image/png,image/jpeg" class="form-control" id="bs-validation-upload-file" ref="fileFoto" @change="onChangeFoto()">
                                        <label for="bs-validation-upload-file">Foto</label>
                                    </div>
                                </div>
                                <div class="col-12 mt-6 d-flex flex-wrap justify-content-center gap-4 row-gap-4">
                                    <button type="button" class="btn btn-primary" @click="updateUsuarios()">Editar</button>
                                    <button type="reset" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal para cargar los archivos -->
            <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel1">{{this.doc.name}}</h4>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-6 mt-2">
                                    <div class="col-12 col-md-12" >
                                    <div class="form-floating form-floating-outline mb-6">
                                        <input type="file"  accept="image/png,image/jpeg" class="form-control" id="bs-validation-upload-file" ref="fileDoc" @change="onChangeDoc()" multiple>
                                        <label for="bs-validation-upload-file">{{this.doc.name}}</label>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div> -->
                    </div>
                </div>
            </div>
            <!-- modal para crear las sedes -->
            <div class="modal fade" id="createSede" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                    <div class="modal-content">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="modal-body p-0">
                            <div class="text-center mb-6">
                                <h4 class="mb-2">Agregar Sede</h4>
                            </div>
                            <form id="editUserForm" class="row g-5">
                                <div class="col-12 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                    <input
                                        type="text"
                                        id="sede"
                                        class="form-control"
                                        v-model="newSede.nombre"
                                        placeholder="Sede" />
                                    <label for="sede">Sede</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                    <input
                                        type="text"
                                        id="ubicacion"
                                        class="form-control"
                                        v-model="newSede.ubicacion"
                                        placeholder="Ubicación" />
                                    <label for="ubicacion">Ubicación</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                    <input
                                        type="text"
                                        id="lugar"
                                        class="form-control"
                                        v-model="newSede.lugar_entrenamiento"
                                        placeholder="Lugar Entrenamiento" />
                                    <label for="lugar">Lugar Entrenamiento</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                    <input
                                        type="date"
                                        id="fecha"
                                        class="form-control"
                                        v-model="newSede.fecha_registro"
                                         />
                                    <label for="fecha">Fecha Registro</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="form-floating form-floating-outline">
                                        <div style="max-width: 800px; overflow: hidden;">
                                            <quill-editor
                                                v-model="newSede.contactos"
                                                style="height: 150px ;text-align: left;"
                                                ref="myQuillEditor"
                                                :options="editorOption"
                                                @blur="onEditorBlur($event)"
                                                @focus="onEditorFocus($event)"
                                                @change="onEditorChange($event)">
                                            </quill-editor>
                                        </div>
                                    </div>
                                    
                                </div>
                               
                                
                                <div class="col-12 text-center d-flex flex-wrap justify-content-center gap-4 row-gap-4">
                                    <button type="button" class="btn btn-primary" @click="agregaSede()">Guardar</button>
                                    <button type="reset" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            
            
        <br><br><br>
        </div>
    </template>
    <script>
    import axios from 'axios';
    import 'quill/dist/quill.core.css'
    import 'quill/dist/quill.snow.css'
    import 'quill/dist/quill.bubble.css'
    import { quillEditor } from 'vue-quill-editor';
    export default {
        name: '',
        components: {
            quillEditor
        },
        mixins: [],
        props: [
            'id_usuario_logeado',
            'name_usuario_logeado',
            'rol_usuario',
            'sede',
            'permisos',
            'componente'
        ],
        data() {
            return {
                vista:0,
                search:'',
                registro:{
                    name:'',
                    rol:'Selecciona un Rol',
                    email:'',
                    password:'',
                    sede:'Selecciona una Sede',
                    activacion:false
                },
                Usuario:[],
                Roles:[],
                Sedes:[],
                submenu:false,
                detalleUsuario:[],
                newperfil:{
                    foto:'',
                    nombre:'',
                    apellido_paterno:'',
                    apellido_materno:'',
                    direccion:'',
                    telefono:'',
                    sede:0
                },
                newSede:{
                    nombre:'',
                    ubicacion:'',
                    lugar_entrenamiento:'',
                    contactos:'',
                    fecha_registro:''

                },
                documentacion:[
                    { label: 'INE', value: 'INE' },
                    { label: 'COMPROBANTE DE ESTUDIOS', value: 'COMPROBANTE DE ESTUDIOS' },
                    { label: 'COMPROBANTE DE DOMICILIO', value: 'COMPROBANTE DE DOMICILIO' },
                    { label: 'CONSTANCIA DE SITUACIÓN FISCAL', value: 'CONSTANCIA DE SITUACIÓN FISCAL' },
                ],
                documentacionDate:[],
                DetalleDocumentacion:[],
                doc:{
                    name:'',
                    active:''
                },
                editorOption: {},
                pagination: {
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0
                },
                offset: 2,
            }
        },
        computed: {
            isActived: function () {
                return this.pagination.current_page;
            },
            pageNumber: function () {
                if (!this.pagination.to) {
                    return [];
                }
                var from = this.pagination.current_page - this.offset; // bandera offset
                if (from < 1) {
                    from = 1
                }
                var to = from + (this.offset * 2);
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }
                var pageArray = [];
                while (from <= to) {
                    pageArray.push(from);
                    from++;
                }

                return pageArray;
            }
        },
        watch: {
            
        },
        mounted() {
            this.getAdministrador();
        },
        methods: {
            muestra(valor){
                this.vista = valor;
            },
            getAdministrador(page){
                if (this.search == '') {
                
                    var url = `administrador/Busqueda?page=`+page;
                    axios.get(url).then(response => {

                        this.Usuario = response.data.muestra.data,
                        this.Roles = response.data.roles
                        this.Sedes = response.data.sedes
                        this.pagination = response.data.pagination
                    });
                } else {
                    this.search
                    var url = `administrador/Busqueda?buscador=${this.search}&page=`+page;
                    axios.get(url).then(response => {
                        this.Usuario = response.data.muestra.data
                        this.Roles = response.data.roles
                        this.Sedes = response.data.sedes
                        this.pagination = response.data.pagination
                    });
                }
            },
            include(permiso){
                return this.permisos.includes(permiso);
            },
            changePage: function (page) {
                this.pagination.current_page = page;
                this.getAdministrador(page);
            },
            buscarUsuario() {               
                clearTimeout(this.tiempoBusqueda)
                this.tiempoBusqueda = setTimeout(this.getAdministrador, 200)
            },
            agregaUser(){
                if (this.registro.name == '') {
                    this.$toast.error("Ingresa un Nombre", {
                        position: "top-center",
                        timeout: 1270,
                        closeOnClick: true,
                        pauseOnFocusLoss: true,
                        pauseOnHover: true,
                        draggable: true,
                        draggablePercent: 0.6,
                        showCloseButtonOnHover: false,
                        hideProgressBar: true,
                        closeButton: "button",
                        icon: true,
                        rtl: false
                    });
                }

                let formData = new FormData();
                    formData.append('name',this.registro.name);
                    formData.append('rol',this.registro.rol);
                    formData.append('email',this.registro.email);
                    formData.append('password',this.registro.password);
                    formData.append('estatus',this.registro.activacion);
                axios.post('administrador/createUser',formData).then(res =>{
                    this.registro ={
                        name:'',
                        rol:'Selecciona un Rol',
                        email:'',
                        password:'',
                        activacion:false
                    }
                    this.getAdministrador();
                    $('#createUser').modal('hide');
                    Swal.fire({
                        title: 'Exitoso',
                        text: "Se Agrego correctamente!",
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2500,
                    });
                })

            },
            infoUsuario(u){
                this.submenu = false;
                this.detalleUsuario = u;
                if (this.detalleUsuario.perfil == null) {
                    this.detalleUsuario.bandera = 'activo';
                    this.detalleUsuario.perfil = {
                        nombre:'',
                        apellido_paterno:'',
                        apellido_materno:'',
                        direccion:'',
                        telefono:'',
                        sede:0,
                        foto:''
                    }
                }
                axios.get(`administrador/detalleDocumentacion/${this.detalleUsuario.id}`).then(res =>{
                    this.DetalleDocumentacion = res.data
                })
            },
            accionSubmenu(){
                if (this.submenu == false) {
                    this.submenu = true;
                } else {
                    this.submenu = false;
                }
            },
            updateUsuarios(){
                if (this.detalleUsuario.name == '') {
                    this.$toast.error("Ingresa un Nombre", {
                        position: "top-center",
                        timeout: 1270,
                        closeOnClick: true,
                        pauseOnFocusLoss: true,
                        pauseOnHover: true,
                        draggable: true,
                        draggablePercent: 0.6,
                        showCloseButtonOnHover: false,
                        hideProgressBar: true,
                        closeButton: "button",
                        icon: true,
                        rtl: false
                    });
                    return;
                }
                if (this.detalleUsuario.email == '') {
                    this.$toast.error("Ingresa un Email", {
                        position: "top-center",
                        timeout: 1270,
                        closeOnClick: true,
                        pauseOnFocusLoss: true,
                        pauseOnHover: true,
                        draggable: true,
                        draggablePercent: 0.6,
                        showCloseButtonOnHover: false,
                        hideProgressBar: true,
                        closeButton: "button",
                        icon: true,
                        rtl: false
                    });
                    return;
                }
                if (this.detalleUsuario.rol_name == '') {
                    this.$toast.error("Selecciona un Role", {
                        position: "top-center",
                        timeout: 1270,
                        closeOnClick: true,
                        pauseOnFocusLoss: true,
                        pauseOnHover: true,
                        draggable: true,
                        draggablePercent: 0.6,
                        showCloseButtonOnHover: false,
                        hideProgressBar: true,
                        closeButton: "button",
                        icon: true,
                        rtl: false
                    });
                    return;
                }
                if (this.detalleUsuario.password == '') {
                    this.$toast.error("Ingresa una contraseña", {
                        position: "top-center",
                        timeout: 1270,
                        closeOnClick: true,
                        pauseOnFocusLoss: true,
                        pauseOnHover: true,
                        draggable: true,
                        draggablePercent: 0.6,
                        showCloseButtonOnHover: false,
                        hideProgressBar: true,
                        closeButton: "button",
                        icon: true,
                        rtl: false
                    });
                    return;
                }

                let formData = new FormData();
                    formData.append('id',this.detalleUsuario.id);
                    formData.append('rol_name',this.detalleUsuario.rol_name);
                    formData.append('password',this.detalleUsuario.password);
                    formData.append('estatus',this.detalleUsuario.estatus);
                    formData.append('bandera',this.detalleUsuario.bandera);
                    formData.append('id_perfil',this.detalleUsuario.perfil.id_perfil);
                    formData.append('nombre',this.detalleUsuario.perfil.nombre);
                    formData.append('apellido_paterno',this.detalleUsuario.perfil.apellido_paterno);
                    formData.append('apellido_materno',this.detalleUsuario.perfil.apellido_materno);
                    formData.append('direccion',this.detalleUsuario.perfil.direccion);
                    formData.append('telefono',this.detalleUsuario.perfil.telefono);
                    formData.append('sede',this.detalleUsuario.sede);
                    formData.append('foto',this.detalleUsuario.perfil.foto);
                axios.post('administrador/updateUsuarios',formData).then(response =>{
                    this.getAdministrador();
                    $('#editUser').modal('hide');
                    this.submenu = false;
                    Swal.fire({
                        title: 'Exitoso',
                        text: "Se Edito correctamente!",
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2500,
                    });
                })
            },
            eliminarPerfil(id){
            this.id = id
                Swal.fire({
                    title: 'Estas seguro?',
                    text: "Se eliminara permanentemente!",
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText:'Cancelar',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (this.id_usuario_logeado == this.id) {
                            Swal.fire({
                                title: 'Error',
                                text: "No se puede eliminar por que es el usuario en curso!",
                                icon: 'error',
                                showConfirmButton: false,
                                timer: 2500,
                            }) 
                        }else{
                            axios.post(`administrador/deleteUsuarios/${this.id}`).then(response => {
                                this.getAdministrador();
                                
                                Swal.fire({
                                    title: 'Eliminado',
                                    text: "El Usuario ha sido eliminado!",
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 2500,
                                })
                            });
                        }
                    }
                })
            },
            onChangeFoto(){
                var fileedit = this.$refs.fileFoto.files[0];
                this.detalleUsuario.perfil.foto = fileedit
            },
    
            modalArch(d){
                this.doc.name = d.value;
                
                $('#basicModal').modal('show');
            },
            onChangeDoc(){
                
                var file = this.$refs.fileDoc.files;

                for (let index = 0; index < file.length; index++) {
                    this.documentacionDate.push({
                        archivo:file[index],
                        tipo:this.doc.name
                    });
                }
                let formData = new FormData();
                    formData.append('id',this.detalleUsuario.id);
                for (let i = 0; i < this.documentacionDate.length; i++) {
                    formData.append(`documentacionDate[${i}][archivo]`, this.documentacionDate[i].archivo);
                    formData.append(`documentacionDate[${i}][tipo]`, this.documentacionDate[i].tipo);
                }
                axios.post('administrador/Documentacion',formData).then(res=>{
                    $('#fileDoc').modal('');
                    $('#basicModal').modal('hide');
                    axios.get(`administrador/detalleDocumentacion/${this.detalleUsuario.id}`).then(res =>{
                        this.DetalleDocumentacion = res.data
                    })
                    Swal.fire({
                        title: 'Exitoso',
                        text: "Se Añadieron correctamente!",
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2500,
                    });
                })
            },
            deleteDoc(d){
                this.id = d.id_documentacion;
                Swal.fire({
                    title: 'Estas seguro?',
                    text: "Se eliminara permanentemente!",
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText:'Cancelar',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.post(`administrador/deleteDoc/${this.id}`).then(response => {
                            axios.get(`administrador/detalleDocumentacion/${this.detalleUsuario.id}`).then(res =>{
                                this.DetalleDocumentacion = res.data
                            })
                            Swal.fire({
                                title: 'Eliminado',
                                text: "El Documento ha sido eliminado!",
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 2500,
                            })
                        });
                    }
                })
            },
            agregaSede(){
                if (this.newSede.nombre == '') {
                    this.$toast.error("Ingresa el nombre de la Sede", {
                        position: "top-center",
                        timeout: 1270,
                        closeOnClick: true,
                        pauseOnFocusLoss: true,
                        pauseOnHover: true,
                        draggable: true,
                        draggablePercent: 0.6,
                        showCloseButtonOnHover: false,
                        hideProgressBar: true,
                        closeButton: "button",
                        icon: true,
                        rtl: false
                    });
                    return;
                }
                if (this.newSede.ubicacion == '') {
                    this.$toast.error("Ingresa la Ubicación", {
                        position: "top-center",
                        timeout: 1270,
                        closeOnClick: true,
                        pauseOnFocusLoss: true,
                        pauseOnHover: true,
                        draggable: true,
                        draggablePercent: 0.6,
                        showCloseButtonOnHover: false,
                        hideProgressBar: true,
                        closeButton: "button",
                        icon: true,
                        rtl: false
                    });
                    return;
                }
                if (this.newSede.lugar_entrenamiento == '') {
                    this.$toast.error("Ingresa el lugar de entrenamiento", {
                        position: "top-center",
                        timeout: 1270,
                        closeOnClick: true,
                        pauseOnFocusLoss: true,
                        pauseOnHover: true,
                        draggable: true,
                        draggablePercent: 0.6,
                        showCloseButtonOnHover: false,
                        hideProgressBar: true,
                        closeButton: "button",
                        icon: true,
                        rtl: false
                    });
                    return;
                }
                if (this.newSede.fecha_registro == '') {
                    this.$toast.error("Ingresa la Fecha", {
                        position: "top-center",
                        timeout: 1270,
                        closeOnClick: true,
                        pauseOnFocusLoss: true,
                        pauseOnHover: true,
                        draggable: true,
                        draggablePercent: 0.6,
                        showCloseButtonOnHover: false,
                        hideProgressBar: true,
                        closeButton: "button",
                        icon: true,
                        rtl: false
                    });
                    return;
                }

                let formData = new FormData();
                    formData.append('nombre',this.newSede.nombre);
                    formData.append('ubicacion',this.newSede.ubicacion);
                    formData.append('lugar_entrenamiento',this.newSede.lugar_entrenamiento);
                    formData.append('contactos',this.newSede.contactos);
                    formData.append('fecha_registro',this.newSede.fecha_registro);

                axios.post('administrador/newSede',formData).then(response =>{
                    this.getAdministrador();
                    Swal.fire({
                        title: 'Perfecto',
                        text: "La Sede ha sido registrada!",
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2500,
                    })
                    $('#createSede').modal('hide');
                    this.newSede = {
                        nombre:'',
                        ubicacion:'',
                        lugar_entrenamiento:'',
                        contactos:'',
                        fecha_registro:''

                    }
                })
            },
            onEditorReady (editor) {}, // prepara el editor
            onEditorBlur () {}, // Evento de pérdida de foco
            onEditorFocus () {}, // Obtiene el evento de enfoque
            onEditorChange () {}, // evento de cambio de contenido

        }
    };
    </script>
    <style lang='' scoped>
    </style>