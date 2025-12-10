    <template>
        <div>
            <div id="main" v-if="this.vista == 0">
                <div class="row">
                    <!-- Users List Table -->
                    <div class="card">
                        <div class="card-datatable table-responsive">
                            <table class="tabla_user table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Rol</th>
                                        <th>Estatus</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <!-- <div class="card">
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
                                                            <img :src="`ArchivosSistema/Documentacion/${user.perfil.foto}`" alt="Avatar" class="rounded-circle" @error="(event)=>onImageError(event)">
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
                    </div> -->
                </div>
            </div>
            <div id="main" v-if="this.vista == 1">
                <div class="row">
                     <!-- User Sidebar -->
                    <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                        <!-- User Card -->
                        <div class="card mb-6">
                            <div class="card-body pt-12">
                                <div class="user-avatar-section">
                                    <div class="d-flex align-items-center flex-column">
                                        <img class="img-fluid rounded-3 mb-4"
                                            :src="`ArchivosSistema/Documentacion/${this.detalleUsuario.id}/${this.detalleUsuario.foto}`"
                                            height="120"
                                            width="120"
                                            alt="User avatar" @error="(event)=>onImageError(event)"/>
                                        <div class="user-info text-center">
                                            <h5>{{this.detalleUsuario.name}}</h5>
                                            <span class="badge bg-label-success rounded-pill">{{ this.detalleUsuario.rol_name }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-around flex-wrap my-6 gap-0 gap-md-3 gap-lg-4">
                                    <div class="d-flex align-items-center me-5 gap-4">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-label-primary rounded-3">
                                                <i class="ri-candle-fill ri-24px"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="mb-0">{{this.UpdateInformacion.cumpleaños}}</h5>
                                            <span>Fecha Nacimiento</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-4">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-label-primary rounded-3">
                                                <i class="ri-database-line ri-24px"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="mb-0">{{this.UpdateInformacion.fecha_ingreso}}</h5>
                                            <span>Fecha Ingreso</span>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="pb-4 border-bottom mb-4">Detalles</h5>
                                <div class="info-container">
                                    <ul class="list-unstyled mb-6">
                                        <li class="mb-2">
                                            <span class="fw-medium text-heading me-2">Nombre Usuario:</span>
                                            <span>{{this.UpdateInformacion.nombre}} </span>
                                        </li>
                                        <li class="mb-2">
                                            <span class="fw-medium text-heading me-2">Email:</span>
                                            <span>{{this.detalleUsuario.email}}</span>
                                        </li>
                                        <li class="mb-2">
                                            <span class="fw-medium text-heading me-2">Estatus:</span>
                                            <span :class="`badge ${this.detalleUsuario.color} rounded-pill`">{{this.detalleUsuario.text}}</span>
                                        </li>
                                        <li class="mb-2">
                                            <span class="fw-medium text-heading me-2">Role:</span>
                                            <span>{{ this.detalleUsuario.rol_name }}</span>
                                        </li>
                                        
                                        <li class="mb-2">
                                            <span class="fw-medium text-heading me-2">Contacto:</span>
                                            <span>+(52) {{this.UpdateInformacion.telefono}}</span>
                                        </li>
                                        <li class="mb-2">
                                            <span class="fw-medium text-heading me-2">Dirección:</span>
                                            <span>{{this.UpdateInformacion.calle}} #{{ this.UpdateInformacion.num_ext }}, CP: {{ this.UpdateInformacion.cp }}, {{ this.UpdateInformacion.colonia }},</span>
                                        </li>
                                        <li class="mb-2">
                                            <span class="fw-medium text-heading me-2">Cedula:</span>
                                            <span>{{this.UpdateInformacion.cedula_usuario}}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <!-- /User Card -->
                    </div>
                    <!--/ User Sidebar -->

                    <!-- User Content -->
                    <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                        <div class="col-md-12">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="margin-left: 20px;" >
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="cuenta-tab" data-bs-toggle="pill" data-bs-target="#cuenta" type="button" role="tab" aria-controls="cuenta" aria-selected="false">
                                        <i class="icon-base ri ri-settings-4-line icon-22px me-3"></i>
                                        Cuenta
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="info-tab" data-bs-toggle="pill" data-bs-target="#info" type="button" role="tab" aria-controls="info" aria-selected="false">
                                        <i class="icon-base ri ri-account-circle-line icon-22px me-3"></i>
                                        Información Usuario
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="documentacion-tab" data-bs-toggle="pill" data-bs-target="#documentacion" type="button" role="tab" aria-controls="documentacion" aria-selected="false">
                                        <i class="ri-article-line me-2"></i>Documentación
                                    </button>
                                </li>
                                <!-- <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="seguridad-tab" data-bs-toggle="pill" data-bs-target="#seguridad" type="button" role="tab" aria-controls="seguridad" aria-selected="false">
                                        <i class="ri-lock-line me-2"></i>Seguridad
                                    </button>
                                </li> -->
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="cuenta" role="tabpanel" aria-labelledby="cuenta-tab">
                                    <!-- User Profile Content -->
                                    <div class="card mb-6">
                                        <div class="card-body pt-0">
                                            <form novalidate>
                                                <div class="row mt-1 g-5">
                                                    <div class="col-md-6">
                                                        <div class="form-floating form-floating-outline">
                                                            <input class="form-control" type="text" 
                                                            id="nombre456" name="nombre_update" 
                                                            v-model="detalleUsuario.name" />
                                                            
                                                            <label for="usuario456">Nombre Usuario</label>
                                                           
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating form-floating-outline">
                                                            <select id="roles_update" name="roles_update" class="form-select" v-model="detalleUsuario.rol_name" 
                                                                data-vv-as="Roles" >
                                                                <option value="">Selecciona un Role</option>
                                                                <option v-for="(rol, index) in Roles" :key="index" v-bind:value="rol.name">{{rol.name}}</option>
                                                            </select>
                                                            <label for="roles_update">Roles</label>

                                                            
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating form-floating-outline">
                                                            <input class="form-control" type="email" 
                                                            id="email456" name="email_update" 
                                                            v-model="detalleUsuario.email"/>
                                                            <label for="email456">Email</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-floating form-floating-outline">
                                                        <select id="Sedes" name="Sedes" class="form-select" v-model="detalleUsuario.id_sede">
                                                            <option value="Selecciona una Sede">Selecciona una Sede</option>
                                                            <option v-for="(sed, index) in Sedes" :key="index" v-bind:value="sed.id_sede">{{sed.nombre}}</option>
                                                        </select>
                                                        <label for="Sedes">Sedes</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <button type="button" class="btn btn-icon btn-outline-whatsapp waves-effect" data-bs-toggle="modal" data-bs-target="#createSede">
                                                            <i class="tf-icons ri-checkbox-circle-fill ri-22px"></i>
                                                        </button>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating form-floating-outline">
                                                            <input type="text" class="form-control" 
                                                            id="password123" name="password_update" 
                                                            v-model="detalleUsuario.new_password"/>
                                                            <label for="password123">Password</label>

                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-check m-0">
                                                            <input type="checkbox" class="form-check-input" v-model="detalleUsuario.estatus">
                                                            <span class="form-check-label">Activar Usuario?</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="mt-6">
                                                    <button type="button" class="btn btn-primary me-3" v-if="include('Crear')" @click="CuentaUpdate()">Guardar</button>
                                                    <!-- <button type="reset" class="btn btn-outline-secondary">Reset</button> -->
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    <!--/ User Profile Content -->
                                </div>
                                <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="info-tab">
                                    <!-- User Profile Content -->
                                    <div class="card mb-6">
                                        <div class="card-body">
                                        <div class="d-flex align-items-start align-items-sm-center gap-6">
                                            <img :src="`ArchivosSistema/Documentacion/${this.UpdateInformacion.id_user}/${this.UpdateInformacion.foto}`" alt="user-avatar1" class="d-block w-px-100 h-px-100 rounded-4" id="uploadedAvatar" @error="(event)=>onImageError(event)" v-if="this.backupImageSrc == ''"/>
                                            <img :src="this.backupImageSrc" alt="user-avatar2" class="d-block w-px-100 h-px-100 rounded-4" id="uploadedAvatar" v-else/>
                                            <div class="button-wrapper">
                                                <label for="upload" class="btn btn-primary me-3 mb-4" tabindex="0">
                                                    <span class="d-none d-sm-block">Subir Nueva Foto</span>
                                                    <i class="ri-upload-2-line d-block d-sm-none"></i>
                                                    <input type="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" ref="fileFoto" @change="onChangeFoto()"/>
                                                </label>
                                                <!-- <button type="button" class="btn btn-outline-danger account-image-reset mb-4">
                                                    <i class="ri-refresh-line d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Reset</span>
                                                </button> -->

                                                <div>Se permiten archivos JPG, JPGE o PNG.</div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <form id="formAccountSettings" onsubmit="return false">
                                                <div class="row mt-1 g-5">
                                                    <div class="col-md-4">
                                                        <div class="form-floating form-floating-outline">
                                                            <input class="form-control" type="text" id="nombre456" name="nombre456" v-model="UpdateInformacion.nombre" />
                                                            <label for="nombre456">Nombre</label>
                                                           
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-floating form-floating-outline">
                                                            <input class="form-control" type="text" id="apPaterno456" name="apPaterno456" v-model="UpdateInformacion.paterno"/>
                                                            <label for="apPaterno456">Apellido Paterno</label>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-floating form-floating-outline">
                                                            <input class="form-control" type="text" id="apMaterno456" name="apMaterno456" v-model="UpdateInformacion.materno"/>
                                                            <label for="apMaterno456">Apellido Materno</label>
                                                           
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating form-floating-outline">
                                                            <input class="form-control" type="text" id="Carrera456" name="Carrera456"  v-model="UpdateInformacion.carrera"/>
                                                            <label for="Carrera456">Carrera</label>
                                                           
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating form-floating-outline">
                                                            <select class="form-select" id="select_update_civil" name="select_update_civil" v-model="UpdateInformacion.estado_civil">
                                                                <option value="">Selecciona el Estado Civil</option>
                                                                <option value="Soltero">Soltero</option>
                                                                <option value="Casado">Casado</option>
                                                                <option value="Otro">Otro</option>
                                                            </select>
                                                            <label for="select_update_civil">Estado Civil</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating form-floating-outline">
                                                            <select class="form-select" id="select_update_sexo" name="select_update_sexo" v-model="UpdateInformacion.sexo">
                                                                <option value="">Selecciona el Sexo</option>
                                                                <option value="Masculino">Masculino</option>
                                                                <option value="Femenino">Femenino</option>
                                                            </select>
                                                            <label for="select_update_sexo">Sexo</label>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating form-floating-outline">
                                                            <input type="date" class="form-control flatpickr-validation" placeholder="YYYY-MM-DD" id="fechanacimienot785" v-model="UpdateInformacion.fecha_nacimiento"/>
                                                            <label for="fechanacimienot785">Fecha Nacimiento</label>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group input-group-merge">
                                                            <div class="form-floating form-floating-outline">
                                                                <input type="number" id="phoneNumber" name="phoneNumber" class="form-control" v-model="UpdateInformacion.telefono"/>
                                                                <label for="phoneNumber">Telefono Empresarial</label>
                                                            </div>
                                                            <span class="input-group-text">MEX (+52)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating form-floating-outline">
                                                            <input type="text" class="form-control" id="address" name="address" v-model="UpdateInformacion.calle"/>
                                                            <label for="address">Calle</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-floating form-floating-outline">
                                                            <input type="text" class="form-control" id="num_ext" name="num_ext" v-model="UpdateInformacion.num_ext"/>
                                                            <label for="num_ext">Num Ext</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-floating form-floating-outline">
                                                            <input type="text" class="form-control" id="num_int" name="num_int" v-model="UpdateInformacion.num_int"/>
                                                            <label for="num_int">Num Int</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-floating form-floating-outline">
                                                            <input type="text" class="form-control" id="CP12" name="CP12" v-model="UpdateInformacion.cp"/>
                                                            <label for="CP12">CP</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating form-floating-outline">
                                                            <input type="text" class="form-control" id="colonia" name="colonia" v-model="UpdateInformacion.colonia"/>
                                                            <label for="colonia">Colonia</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating form-floating-outline">
                                                            <input type="text" class="form-control" id="municipio" name="municipio" v-model="UpdateInformacion.municipio"/>
                                                            <label for="municipio">Municipio</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating form-floating-outline">
                                                            <input class="form-control" type="text" id="state" name="state" value="New York" v-model="UpdateInformacion.estado"/>
                                                            <label for="state">Estado</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating form-floating-outline">
                                                            <select id="new_pais" name="new_pais" class="select2 form-select" v-model="UpdateInformacion.pais">
                                                                <option value="Australia">Australia</option>
                                                                <option value="Bangladesh">Bangladesh</option>
                                                                <option value="Belarus">Belarus</option>
                                                                <option value="Brazil">Brazil</option>
                                                                <option value="Canada">Canada</option>
                                                                <option value="China">China</option>
                                                                <option value="France">France</option>
                                                                <option value="Germany">Germany</option>
                                                                <option value="India">India</option>
                                                                <option value="Indonesia">Indonesia</option>
                                                                <option value="Israel">Israel</option>
                                                                <option value="Italy">Italy</option>
                                                                <option value="Japan">Japan</option>
                                                                <option value="Korea">Korea, Republic of</option>
                                                                <option value="México">México</option>
                                                                <option value="Philippines">Philippines</option>
                                                                <option value="Russia">Russian Federation</option>
                                                                <option value="South Africa">South Africa</option>
                                                                <option value="Thailand">Thailand</option>
                                                                <option value="Turkey">Turkey</option>
                                                                <option value="Ukraine">Ukraine</option>
                                                                <option value="United Arab Emirates">United Arab Emirates</option>
                                                                <option value="United Kingdom">United Kingdom</option>
                                                                <option value="Estados Unidos">Estados Unidos</option>
                                                            </select>
                                                            <label for="new_pais">Pais</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating form-floating-outline">
                                                            <input class="form-control" type="text" id="cedula" name="cedula" value="New York" v-model="UpdateInformacion.cedula_usuario"/>
                                                            <label for="cedula">Cédula</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating form-floating-outline">
                                                            <input type="date" class="form-control flatpickr-validation" placeholder="YYYY-MM-DD" id="bs-validation-dob" v-model="UpdateInformacion.fecha_ingreso"/>
                                                            <label for="bs-validation-dob">Fecha Ingreso</label>
                                                        </div>
                                                    </div>
                                                
                                                </div>
                                                <div class="mt-6">
                                                    <button type="submit" class="btn btn-primary me-3" @click="updateUsuarios()" v-if="include('Crear')" >Guardar</button>
                                                    <!-- <button type="reset" class="btn btn-outline-secondary">Reset</button> -->
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    <!--/ User Profile Content -->
                                </div>
                                <div class="tab-pane fade" id="documentacion" role="tabpanel" aria-labelledby="documentacion-tab">
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-5 col-md-5">
                                            <!-- About User -->
                                        
                                            <!--/ About User -->
                                        </div>
                                        <div class="col-xl-12 col-lg-5 col-md-5">
                                            <!-- About User -->
                                            <div class="card mb-6">
                                                <div class="card-body" style="border-color: #33b2ff;">
                                                    <div class="row">
                                                        <div class="col-12 col-md-6">
                                                            <h5 class="card-header">Documentacion Cargada</h5>
                                                        </div>
                                                        <div class="col-12 col-md-6 mt-3">
                                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                                <button type="button" class="btn btn-outline-success waves-effect" data-bs-toggle="modal" data-bs-target="#basicModal">Agregar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
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
                                                                    <td style="font-size: 14px;white-space: normal;word-wrap: break-word;word-break: break-word;"><a href="#" @click="verArch(d.archivo)">{{ d.archivo }}</a></td>
                                                                    <td>
                                                                        <a class="dropdown-item waves-effect" type="button" style="color: red;" @click="deleteDoc(d)">
                                                                            <i class="ri-delete-bin-7-line me-1"></i>Eliminar</a>

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
                
            </div>
            <div id="main" v-if="this.vista == 2">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-6">
                            <div class="user-profile-header-banner">
                                <img src="style/logos/fondo5.jpg" alt="Banner image" class="rounded-top" />
                            </div>
                            <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-5">
                                <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                                    <img :src="`ArchivosSistema/Documentacion/${this.detalleUsuario.perfil.foto}`" alt="user image" class="d-block h-auto ms-0 ms-sm-5 rounded-4 user-profile-img" @error="(event)=>onImageError(event)"/>
                                </div>
                                <div class="flex-grow-1 mt-4 mt-sm-12">
                                    <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-5 flex-md-row flex-column gap-6">
                                        <div class="user-profile-info">
                                            <h4 class="mb-2">{{this.detalleUsuario.name}}</h4>
                                            <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4">
                                                <li class="list-inline-item">
                                                    <i class="ri-football-line me-2 ri-24px"></i><span class="fw-medium">{{this.detalleUsuario.rol_name}}</span>
                                                </li>
                                                <li class="list-inline-item">
                                                    <i class="ri-map-pin-line me-2 ri-24px"></i><span class="fw-medium">{{this.detalleUsuario.sede[0].nombre}}</span>
                                                </li>
                                                <!-- <li class="list-inline-item">
                                                    <i class="ri-calendar-line me-2 ri-24px"></i
                                                    ><span class="fw-medium"> Joined April 2021</span>
                                                </li> -->
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
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="perfil-tab" data-bs-toggle="pill" data-bs-target="#perfil" type="button" role="tab" aria-controls="perfil" aria-selected="true">
                                    <i class="ri-user-3-line me-2"></i>
                                    E
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
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
                                    <select id="Sedes" name="Sedes" class="form-select" v-model="registro.sede">
                                        <option value="Selecciona una Sede">Selecciona una Sede</option>
                                        <option v-for="(rol, index) in Sedes" :key="index" v-bind:value="rol.id_sede">{{rol.nombre}}</option>
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
                                    <button type="button" class="btn btn-success" @click="agregaUser()">Guardar</button>
                                    <button type="reset" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
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
                            <button type="button" class="btn btn-success">Save changes</button>
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
                                    <button type="button" class="btn btn-success" @click="agregaSede()">Guardar</button>
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

                table: null,
                // offset: 2,
                backupImageSrc: 'style/logos/sinfoto.png',
                UpdateInformacion:[],
                UpdateCuenta:{},
            }
        },
        computed: {
            
        },
        watch: {
            
        },
        mounted() {
            this.initDataTable();
        },
        methods: {
            onImageError(event) {
                event.target.src = this.backupImageSrc;
            },
            muestra(valor){
                this.vista = valor;
                if (valor == 0) {
                     window.location.reload();

                }
            },
            initDataTable() {
                
                var statusObj = {
                    
                    0: { title: 'Inactivo', class: 'bg-label-danger' },
                    1: { title: 'Activo', class: 'bg-label-success' },
                    2: { title: 'Inactivo', class: 'bg-label-danger' }
                };

                this.table = $(".tabla_user").DataTable({
                    data: this.Usuario,
                    responsive: true,
                    destroy: true, // Para evitar duplicados en reinicio
                    columns: [
                        { data: 'id' },
                        { data: "name" },
                        { data: "email" },
                        { data: "rol_name" },
                        { data: "estatus" },
                        { data: null },
                        
                    ],
                    columnDefs: [
                        {
                            // For Responsive
                            className: 'control',
                            orderable: false,
                            searchable: false,
                            responsivePriority: 2,
                            targets: 0,
                            render: function (data, type, full, meta) {
                                return '';
                            }
                        },
                        {
                            /* Usuario */
                            targets: 1,
                            orderable: false,
                            searchable: false,
                            responsivePriority: 4,
                            render: function (data, type, full, meta) {
                                var $name = full.name,
                                    $email = full.email,
                                    $image = (full.perfil && full.perfil.foto) ? full.perfil.foto : null;

                                console.log($image);

                                var $output = '';

                                if ($image) {
                                    // Avatar con foto
                                    $output =
                                        '<img src="ArchivosSistema/Documentacion/' + $image + '" ' +
                                        'alt="Avatar" class="rounded-circle" ' +
                                        'onerror="this.onerror=null;this.src=\'style/logos/sinfotoclinica.png\';">';
                                } else {
                                    // Avatar con iniciales
                                    var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
                                    var stateNum = Math.floor(Math.random() * states.length);
                                    var $state = states[stateNum];

                                    var initials = ($name.match(/\b\w/g) || []);
                                    initials = ((initials.shift() || '') + (initials.pop() || '')).toUpperCase();

                                    $output = '<span class="avatar-initial rounded-circle bg-label-' + $state + '">' + initials + '</span>';
                                }

                                var $row_output =
                                    '<div class="d-flex justify-content-left align-items-center">' +
                                    '<div class="avatar-wrapper">' +
                                    '<div class="avatar avatar-sm me-3">' +
                                    $output +
                                    '</div>' +
                                    '</div>' +
                                    '<div class="d-flex flex-column">' +
                                    '<span class="fw-medium text-truncate">' +
                                    $name +
                                    '</span>' +
                                    '<small>' +
                                    $email +
                                    '</small>' +
                                    '</div>' +
                                    '</div>';

                                return $row_output;
                            }

                        },
                        {
                            /* Email */
                            targets: 2,
                            render: function (data, type, full, meta) {
                                var $email = full.email;
                                return '<span >' + $email + '</span>';
                            }
                        },
                        {
                            /* roles */
                            targets: 3,
                            render: function (data, type, full, meta) {
                                var $role = full.rol_name;
                                // var roleBadgeObj = {
                                //     CuerpoTecnico: '<i class="ri-nurse-line ri-22px text-primary me-2"></i>',
                                //     Recepcion: '<i class="ri-dossier-line ri-22px text-warning me-2"></i>',
                                //     Psicologia: '<i class="ri-psychotherapy-line ri-22px text-success me-2"></i>',
                                //     Doctor: '<i class="ri-stethoscope-fill ri-22px text-info me-2"></i>',
                                //     Root: '<i class="ri-vip-crown-line ri-22px text-danger me-2"></i>',
                                //     Contabilidad: '<i class="ri-coins-line ri-22px text-warning me-2"></i>',
                                //     Abogado: '<i class="ri-scales-3-fill ri-22px text-success me-2"></i>',
                                //     Asesor: '<i class="ri-football-line ri-22px text-success me-2"></i>',
                                //     Presidencia: '<i class="ri-box-3-line ri-22px text-success me-2"></i>',
                                //     Coordinador: '<i class="ri-funds-line ri-22px text-warning me-2"></i>'
                                // };
                                return (
                                "<span class='text-truncate d-flex align-items-center text-heading'>" +
                                    // roleBadgeObj[$role] +
                                    $role +
                                '</span>'
                                );
                            }
                        },
                        {
                            // User Status
                            targets: 4,
                            render: function (data, type, full, meta) {
                                var $status = full.estatus;

                                return (
                                '<span class="badge rounded-pill ' +
                                statusObj[$status].class +
                                '" text-capitalized>' +
                                statusObj[$status].title +
                                '</span>'
                                );
                            }
                        },
                        {
                            targets: -1,
                            title: 'Acciones',
                            searchable: false,
                            orderable: false,
                            render: () => {
                                return (
                                   
                                    '<button class="btn btn-sm btn-icon btn-text-secondary rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown"><i class="ri-more-2-fill ri-20px"></i></button>' +
                                    '<div class="dropdown-menu dropdown-menu-end m-0">' +
                                        '<a type="button" class="btn-vizualizar dropdown-item" style="color: orange;"> <i class="ri-clipboard-line me-1"></i> Vizualizar</a>' +
                                        '<a type="button" class="btn-eliminar dropdown-item" style="color: red;"> <i class="ri-delete-bin-7-line me-1"></i> Eliminar</a>' +
                                    '</div>'
                                );
                            }
                        }
                    ], 
                    order: [[2, 'desc']],
                   dom:
                        '<"row mx-1"' +
                        '<"col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start gap-4 mt-5 mt-md-0"l>' +
                        '<"col-sm-12 col-md-7"<"dt-action-buttons d-flex align-items-center justify-content-md-end justify-content-center flex-column flex-sm-row flex-nowrap"<"me-sm-4"f><".add-new w-px-200 mb-5 mb-sm-0">>>' +
                        '>t' +
                        '<"row mx-1"' +
                        '<"col-sm-12 col-md-6"i>' +
                        '<"col-sm-12 col-md-6"p>' +
                        '>',
                    language: {
                        sLengthMenu: 'Mostrar _MENU_',
                        search: '',
                        searchPlaceholder: 'Buscar Usuario',
                        paginate: {
                            next: '<i class="ri-skip-forward-mini-line"></i>',
                            previous: '<i class="ri-skip-back-mini-line"></i>'
                        },
                        sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        sZeroRecords: "No se encontraron resultados",
                        sInfoFiltered: "(filtrando de un total de _MAX_ registros)",
                    },
                    // For responsive popup
                    responsive: {
                        details: {
                            display: $.fn.dataTable.Responsive.display.modal({
                                header: function (row) {
                                var data = row.data();
                                return 'Usuario ' + data.name;
                                }
                            }),
                            type: 'column',
                            renderer: function (api, rowIdx, columns) {
                                var data = $.map(columns, function (col, i) {
                                return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                                    ?   '<tr data-dt-row="' + col.rowIndex + '" data-dt-column="' + col.columnIndex + '">' +
                                            '<td>' +  col.title + ':' +  '</td> ' + '<td>' + col.data + '</td>' +
                                        '</tr>'
                                    : '';
                                }).join('');

                                return data ? $('<table class="table"/><tbody />').append(data) : false;
                            }
                        }
                    },
                    
                    
                });
                $('.add-new').html(
                    "<button class='btn btn-primary waves-effect waves-light' data-bs-toggle='modal' data-bs-target='#createUser'><i class='ri-add-line me-0 me-sm-1 d-inline-block d-sm-none'></i><span class= 'd-none d-sm-inline-block'> Nuevo Usuario </span ></button>"
                );
                
                this.getAdministrador();
                let vm = this; // referencia al componente Vue

                // Evento para Vizualizar
                $('.tabla_user').on('click', '.btn-vizualizar', function (e) {
                    let data = vm.table.row($(this).parents('tr')).data();
                    vm.muestra(1);
                    vm.infoUsuario(data); 
                });

                // Evento para Eliminar
                $('.tabla_user').on('click', '.btn-eliminar', function (e) {
                    let data = vm.table.row($(this).parents('tr')).data();
                    vm.eliminarPerfil(data); 
                });
            },
            getAdministrador(){ 
                const reloadTable = (data) => {
                    this.table.clear();
                    this.table.rows.add(data);
                    this.table.draw();
                    if (this.table.responsive) {
                        this.table.responsive.recalc();
                    }
                };
                var url = `administrador/Busqueda`;
                axios.get(url).then(response => {

                    this.Usuario = response.data.muestra,
                    this.Roles = response.data.roles
                    this.Sedes = response.data.sedes
                    reloadTable(this.Usuario);
                });

            },
            include(permiso){
                return this.permisos.includes(permiso);
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
                    formData.append('sede',this.registro.sede);
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
                        title: 'Éxito',
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
                this.detalleUsuario.new_password = '';
                if (u.estatus == 1) {
                    this.detalleUsuario.estatus  = true;
                }else{
                    this.detalleUsuario.estatus  = false;
                }
                this.detalleUsuario.id_sede = this.detalleUsuario.sede[0].id_sede
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
            CuentaUpdate(){
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
                if (this.detalleUsuario.id_sede == 'Selecciona una Sede') {
                    this.$toast.error("Selecciona una Sede", {
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
                    formData.append('sede',this.detalleUsuario.id_sede);
                    formData.append('estatus',this.detalleUsuario.estatus);
                    if (this.detalleUsuario.new_password != '') {
                        formData.append('new_password',this.detalleUsuario.new_password);
                    }else{
                        formData.append('new_password','Sin Cambio');
                    }
                axios.post('administrador/CuentaUpdate',formData).then(response =>{
                    this.getAdministrador();
                    $('#editUser').modal('hide');
                    this.submenu = false;
                    Swal.fire({
                        title: 'Éxito',
                        text: "Se Edito correctamente!",
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2500,
                    });
                })
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
                    formData.append('sede',this.detalleUsuario.id_sede);
                    formData.append('foto',this.detalleUsuario.perfil.foto);
                axios.post('administrador/updateUsuarios',formData).then(response =>{
                    this.getAdministrador();
                    $('#editUser').modal('hide');
                    this.submenu = false;
                    Swal.fire({
                        title: 'Éxito',
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
                        title: 'Éxito',
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