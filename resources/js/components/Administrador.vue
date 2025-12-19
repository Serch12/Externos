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
                                            <h5 class="mb-0">{{this.detalleUsuario.perfil.cumpleaños}}</h5>
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
                                            <h5 class="mb-0">{{this.detalleUsuario.perfil.fecha_ingreso}}</h5>
                                            <span>Fecha Ingreso</span>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="pb-4 border-bottom mb-4">Detalles</h5>
                                <div class="info-container">
                                    <ul class="list-unstyled mb-6">
                                        <li class="mb-2">
                                            <span class="fw-medium text-heading me-2">Nombre Usuario:</span>
                                            <span>{{this.detalleUsuario.perfil.nombre}} </span>
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
                                            <span>+(52) {{this.detalleUsuario.perfil.telefono}}</span>
                                        </li>
                                        <li class="mb-2">
                                            <span class="fw-medium text-heading me-2">Dirección:</span>
                                            <span>{{this.detalleUsuario.perfil.calle}} #{{ this.detalleUsuario.perfil.num_ext }}, CP: {{ this.detalleUsuario.perfil.cp }}, {{ this.detalleUsuario.perfil.colonia }},</span>
                                        </li>
                                        <li class="mb-2">
                                            <span class="fw-medium text-heading me-2">Cedula:</span>
                                            <span>{{this.detalleUsuario.perfil.cedula}}</span>
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
                                <li class="nav-item" role="presentation">
                                
                                    <button class="nav-link" id="contrato-tab" data-bs-toggle="pill" data-bs-target="#contrato" type="button" role="tab" aria-controls="contrato" aria-selected="false">
                                        <i class="ri-file-edit-fill me-2"></i>Contrato
                                        <span class="badge badge-center text-bg-danger ms-1">{{this.contrato_pendiente}}</span>
                                    </button>
                                </li>
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
                                            <img :src="`ArchivosSistema/Documentacion/${this.detalleUsuario.perfil.id_user}/${this.detalleUsuario.perfil.foto}`" alt="user-avatar1" class="d-block w-px-100 h-px-100 rounded-4" id="uploadedAvatar" @error="(event)=>onImageError(event)" v-if="this.backupImageSrc == ''"/>
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
                                                            <input class="form-control" type="text" id="nombre456" name="nombre456" v-model="detalleUsuario.perfil.nombre"  style="text-transform: uppercase;"/>
                                                            <label for="nombre456">Nombre</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-floating form-floating-outline">
                                                            <input class="form-control" type="text" id="apPaterno456" name="apPaterno456" v-model="detalleUsuario.perfil.apellido_paterno" style="text-transform: uppercase;"/>
                                                            <label for="apPaterno456">Apellido Paterno</label>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-floating form-floating-outline">
                                                            <input class="form-control" type="text" id="apMaterno456" name="apMaterno456" v-model="detalleUsuario.perfil.apellido_materno" style="text-transform: uppercase;"/>
                                                            <label for="apMaterno456">Apellido Materno</label>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating form-floating-outline">
                                                            <input class="form-control" type="text" id="Profecion456" name="Profecion456"  v-model="detalleUsuario.perfil.profesion" style="text-transform: uppercase;"/>
                                                            <label for="Profecion456">Profesión</label>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating form-floating-outline">
                                                            <select class="form-select" id="select_update_civil" name="select_update_civil" v-model="detalleUsuario.perfil.estado_civil">
                                                                <option value="">Selecciona el Estado Civil</option>
                                                                <option value="SOLTERO">SOLTERO</option>
                                                                <option value="CASADO">CASADO</option>
                                                                <option value="OTRO">OTRO</option>
                                                            </select>
                                                            <label for="select_update_civil">Estado Civil</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating form-floating-outline">
                                                            <select class="form-select" id="select_update_sexo" name="select_update_sexo" v-model="detalleUsuario.perfil.sexo">
                                                                <option value="">Selecciona el Sexo</option>
                                                                <option value="MASCULINO">MASCULINO</option>
                                                                <option value="FEMENNINO">FEMENNINO</option>
                                                            </select>
                                                            <label for="select_update_sexo">Sexo</label>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating form-floating-outline">
                                                            <input type="date" class="form-control flatpickr-validation" placeholder="YYYY-MM-DD" id="fechanacimienot785" v-model="detalleUsuario.perfil.cumpleaños"/>
                                                            <label for="fechanacimienot785">Fecha Nacimiento</label>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group input-group-merge">
                                                            <div class="form-floating form-floating-outline">
                                                                <input type="number" id="phoneNumber" name="phoneNumber" class="form-control" v-model="detalleUsuario.perfil.telefono"/>
                                                                <label for="phoneNumber">Telefono </label>
                                                            </div>
                                                            <span class="input-group-text">MEX (+52)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating form-floating-outline">
                                                            <input type="text" class="form-control" id="address" name="address" v-model="detalleUsuario.perfil.calle" style="text-transform: uppercase;"/>
                                                            <label for="address">Calle</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-floating form-floating-outline">
                                                            <input type="number" class="form-control" id="num_ext" name="num_ext" v-model="detalleUsuario.perfil.num_ext"/>
                                                            <label for="num_ext">Num Ext</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-floating form-floating-outline">
                                                            <input type="number" class="form-control" id="num_int" name="num_int" v-model="detalleUsuario.perfil.num_int"/>
                                                            <label for="num_int">Num Int</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-floating form-floating-outline">
                                                            <input type="number" class="form-control" id="CP12" name="CP12" v-model="detalleUsuario.perfil.codigo_postal"/>
                                                            <label for="CP12">CP</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating form-floating-outline">
                                                            <input type="text" class="form-control" id="colonia" name="colonia" v-model="detalleUsuario.perfil.colonia" style="text-transform: uppercase;"/>
                                                            <label for="colonia">Colonia</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating form-floating-outline">
                                                            <input type="text" class="form-control" id="municipio" name="municipio" v-model="detalleUsuario.perfil.municipio" style="text-transform: uppercase;"/>
                                                            <label for="municipio">Municipio</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating form-floating-outline">
                                                            <input class="form-control" type="text" id="state" name="state" value="New York" v-model="detalleUsuario.perfil.entidad" style="text-transform: uppercase;"/>
                                                            <label for="state">Estado</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating form-floating-outline">
                                                            <input class="form-control" type="text" id="nacionalidad" name="nacionalidad" value="New York" v-model="detalleUsuario.perfil.nacionalidad" style="text-transform: uppercase;"/>
                                                            <label for="nacionalidad">Nacionalidad</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating form-floating-outline">
                                                            <input class="form-control" type="text" id="cedula" name="cedula" value="New York" v-model="detalleUsuario.perfil.cedula" style="text-transform: uppercase;"/>
                                                            <label for="cedula">Cédula</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating form-floating-outline">
                                                            <input class="form-control" type="text" id="curp" name="curp" value="New York" v-model="detalleUsuario.perfil.curp" style="text-transform: uppercase;"/>
                                                            <label for="curp">Curp</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating form-floating-outline">
                                                            <input class="form-control" type="text" id="rfc" name="rfc" value="New York" v-model="detalleUsuario.perfil.rfc" style="text-transform: uppercase;"/>
                                                            <label for="rfc">RFC</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating form-floating-outline">
                                                            <input type="date" class="form-control flatpickr-validation" placeholder="YYYY-MM-DD" id="bs-validation-dob" v-model="detalleUsuario.perfil.fecha_ingreso"/>
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
                                        <h6 class="mb-2 text-danger">*Recuerda que la Documentación es en formato PDF*</h6>
                                        <div class="col-xl-3 col-lg-5 col-md-5 mt-2"  v-for="a in archivosFaltantes" :key="a.tipo">
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                                                        <div class="d-flex align-items-center">
                                                            <!-- <p class="mb-0 text-success me-1">+38%</p>
                                                            <i class="ri-arrow-up-s-line text-success"></i>     -->
                                                        </div>
                                                        <div class="avatar">
                                                            <div class="avatar-initial bg-label-success rounded-3 right" :for="`file-pdf${a.tipo}`" :onclick="`document.getElementById('file-pdf${a.tipo}').click()`">
                                                                <i class="ri-add-circle-fill ri-24px"></i>
                                                                <input type="file" :id="`file-pdf${a.tipo}`"  accept=".pdf" style="display: none;" @change="archivosPDF($event,a)"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-info mt-5">
                                                    <img src="style/logos/añade.png" alt="img_carga" style="max-width: 100%;">
                                                    <div class="badge bg-label-secondary rounded-pill">{{a.tipo}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-5 col-md-5 mt-2"  v-for="a in Archivos" :key="a.tipo">
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                                                        <div class="d-flex align-items-center">
                                                            <!-- <p class="mb-0 text-success me-1">+38%</p>
                                                            <i class="ri-arrow-up-s-line text-success"></i>     -->
                                                        </div>
                                                        <div class="avatar">
                                                            <div class="avatar-initial bg-label-info rounded-3 right" :for="`file-pdfupdate${a.tipo}`" :onclick="`document.getElementById('file-pdfupdate${a.tipo}').click()`">
                                                                <i class="ri-file-edit-fill ri-24px"></i>
                                                                <input type="file" :id="`file-pdfupdate${a.tipo}`"  accept=".pdf" style="display: none;" @change="archivosPDFUpdate($event,a)"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-info mt-5">
                                                        <a target="_blank" :href="`ArchivosSistema/Documentacion/${a.id_perfil}/Documentacion/${a.archivo}`" onclick="window.open(this.href, this.target, 'width=650,height=650');return false;" rel="noopener noreferrer">
                                                            <img src="style/logos/file_save.png" alt="img_carga" style="max-width: 100%;">
                                                        </a>
                                                        <div class="badge bg-label-secondary rounded-pill">{{a.tipo}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                 <div class="tab-pane fade" id="contrato" role="tabpanel" aria-labelledby="contrato-tab">
                                <div class="row">
                                    <div style="padding: 20px; font-family: Arial, sans-serif;">

                                        <!-- Tarjetas superiores -->
                                        <div style="display: flex; gap: 20px; margin-bottom: 25px;">

                                            <div class="row">
                                                <div class="col-xl-3 mt-2">
                                                    <!-- Contratos Vigentes -->
                                                    <div style="
                                                        flex: 1;
                                                        background: #fff;
                                                        padding: 15px 20px;
                                                        border-radius: 10px;
                                                        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
                                                        text-align: center; ">
                                                        <div style="font-size: 14px; color: #666;">Contratos Vigentes</div>
                                                        <div style="font-size: 26px; font-weight: bold; color: #0055ff;">{{ this.contrato_vigente }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 mt-2">
                                                    <!-- Pendientes de firma -->
                                                    <div style="
                                                        flex: 1;
                                                        background: #fff;
                                                        padding: 15px 20px;
                                                        border-radius: 10px;
                                                        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
                                                        text-align: center; ">
                                                        <div style="font-size: 14px; color: #666;">Pendientes de Firma</div>
                                                        <div style="font-size: 26px; font-weight: bold; color: #d98b00;">{{ this.contrato_pendiente }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 mt-2">
                                                    <!-- Contratos Históricos -->
                                                    <div style="
                                                        flex: 1;
                                                        background: #fff;
                                                        padding: 15px 20px;
                                                        border-radius: 10px;
                                                        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
                                                        text-align: center;">
                                                        <div style="font-size: 14px; color: #666;">Contratos Históricos</div>
                                                        <div style="font-size: 26px; font-weight: bold; color: #333;">{{ this.contrato_total }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 mt-2">
                                                    <!-- Próxima Fecha -->
                                                    <div style="
                                                        flex: 1;
                                                        background: #fff;
                                                        padding: 5px 30px;
                                                        border-radius: 10px;
                                                        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
                                                        text-align: center;">
                                                        <div style="font-size: 14px; color: #666;">Próxima Fecha de Vencimiento</div>
                                                        <div style="font-size: 26px; font-weight: bold; color: #cc0000;">{{this.prox_fecha}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Tabla Historial -->
                                        <div class="card mt-2">
                                            <h5 class="card-header">Historial Contratos</h5>
                                            <div class="table-responsive text-nowrap ">
                                                <table class="table" style="font-size: 16px;">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>ID CONTRATO</th>
                                                            <th>TIPO</th>
                                                            <th>VIGENCIA</th>
                                                            <th>MONTO MENSUAL</th>
                                                            <th>ESTATUS</th>
                                                            <th>ACCIONES</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-border-bottom-0">
                                                        <tr v-for="(c, index) in HistorialContrato" :key="index">
                                                            <td>
                                                                CI-{{ c.id_contrato_digital }}
                                                            </td>
                                                            <td>
                                                                {{ c.tipo_contrato }}
                                                            </td>
                                                            <td>
                                                                {{c.fecha_inicio}} -- {{ c.fecha_fin }}
                                                            </td>
                                                            <td>
                                                                ${{ formatPrice(c.salario_numero_1) }}
                                                            </td>
                                                            <td>
                                                                <span class="badge rounded-pill bg-label-success me-1">Aprobado</span>
                                                            </td>
                                                            <td>
                                                                <a type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ver Contrato" @click="verContrato(c.id_contrato_digital)">
                                                                    <i class="ri-file-list-fill bg-label-warning ri-25px me-1"></i>
                                                                </a>
                                                                <!-- <a type="button" data-bs-toggle="modal" data-bs-placement="bottom" title="Firmar Contrato" data-bs-target="#modalConfirmacion" @click="detalleContrato(c)">
                                                                    <i class="ri-edit-box-fill bg-label-info ri-25px me-1"></i>
                                                                </a> -->
                                                                
                                                            </td>
                                                        </tr>
                                                   
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

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
            quillEditor,
           
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
                ArchiPendiente:[
                    { label: 'CV', tipo: 'Cv' },
                    { label: 'Comprobante de estudios', tipo: 'Comprobante de Estudios' },
                    { label: 'Opinión de Cumplimiento', tipo: 'Opinión de Cumplimiento' },
                    { label: 'Rfc', tipo: 'Rfc' },
                    { label: 'Curp', tipo: 'Curp' },
                    { label: 'Ine', tipo: 'Ine' },
                    { label: 'Acta de nacimiento', tipo: 'Acta de nacimiento' },
                    { label: 'Comprobante de domicilio', tipo: 'Comprobante de domicilio' }
                ],
                Archivos:[],
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
                detalleUsuario:[],
                UpdateCuenta:{},

                contrato_vigente:0,
                contrato_pendiente:0,
                contrato_total:0,
                prox_fecha:'00/00/0000',
                HistorialContrato:[],
                ContratoFirma:[]
            }
        },
        computed: {
            archivosFaltantes() {
                //Filtra los archivos pendientes que aún no están en la lista de archivos
                return this.ArchiPendiente.filter((a) => !this.Archivos.find((archivo) => archivo.tipo === a.tipo));
            },
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
            formatPrice(value) {
                let val = (value / 1).toFixed(2).replace(',', '.')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
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
                                    '<div class="d-flex align-items-center gap-50">' +
                                    '<button class="btn btn-vizualizar btn-sm btn-icon btn-text-warning rounded-pill delete-record waves-effect waves-light"><i class="ri-article-fill ri-20px"></i></button>' +
                                    '<button class="btn btn-eliminar btn-sm btn-icon btn-text-danger rounded-pill delete-record waves-effect waves-light"><i class="ri-delete-bin-7-line ri-20px"></i></button>' 
                                    
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
                        profesion:'',
                        estado_civil:'',
                        sexo:'',
                        cumpleaños:'',
                        telefono:'',
                        calle:'',
                        num_ext:'',
                        num_int:'0',
                        cp:'',
                        colonia:'',
                        municipio:'',
                        entidad:'',
                        nacionalidad:'',

                        direccion:'',
                        telefono:'',
                        sede:0,
                        foto:''
                    }
                }

                let partes = this.detalleUsuario.perfil.direccion.split(',');
                    partes = partes.map(p => p.trim());
                    

                    this.detalleUsuario.perfil.calle  = partes[0] || '';
                    this.detalleUsuario.perfil.num_ext = partes[1] || '';
                    this.detalleUsuario.perfil.num_int = partes[2] || '';
                    this.detalleUsuario.perfil.colonia = partes[3] || '';
                    this.detalleUsuario.perfil.municipio = partes[4] || '';
                    this.detalleUsuario.perfil.entidad = partes[5] || '';
                
                axios.get(`administrador/detalleDocumentacion/${this.detalleUsuario.id}`).then(res =>{
                    this.Archivos = res.data.documentacion
                    this.HistorialContrato = res.data.contrato.historial_contrato
                    this.contrato_total = res.data.contrato.contrato_total
                    this.contrato_pendiente = res.data.contrato.contrato_pendiente
                    
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
                

                let formData = new FormData();
                     formData.append('id_perfil',this.detalleUsuario.perfil.id_perfil);
                    formData.append('bandera',this.detalleUsuario.perfil.bandera);
                    formData.append('id',this.detalleUsuario.id);
                    formData.append('nombre',this.detalleUsuario.perfil.nombre.toUpperCase());
                    formData.append('apellido_paterno',this.detalleUsuario.perfil.apellido_paterno.toUpperCase());
                    formData.append('apellido_materno',this.detalleUsuario.perfil.apellido_materno.toUpperCase());
                    formData.append('profesion',this.detalleUsuario.perfil.profesion.toUpperCase());
                    formData.append('estado_civil',this.detalleUsuario.perfil.estado_civil.toUpperCase());
                    formData.append('sexo',this.detalleUsuario.perfil.sexo.toUpperCase());
                    formData.append('cumpleaños',this.detalleUsuario.perfil.cumpleaños);
                    formData.append('telefono',this.detalleUsuario.perfil.telefono);
                    formData.append('codigo_postal',this.detalleUsuario.perfil.codigo_postal);
                    formData.append('direccion',this.detalleUsuario.perfil.calle.toUpperCase()+" ,"+this.detalleUsuario.perfil.num_ext+" ,"+this.detalleUsuario.perfil.num_int+" ,"+this.detalleUsuario.perfil.colonia.toUpperCase()+" ,"+this.detalleUsuario.perfil.municipio.toUpperCase()+" ,"+this.detalleUsuario.perfil.entidad.toUpperCase());
                    formData.append('nacionalidad',this.detalleUsuario.perfil.nacionalidad.toUpperCase());
                    formData.append('cedula',this.detalleUsuario.perfil.cedula.toUpperCase());
                    formData.append('curp',this.detalleUsuario.perfil.curp.toUpperCase());
                    formData.append('rfc',this.detalleUsuario.perfil.rfc.toUpperCase());
                    formData.append('foto',this.detalleUsuario.perfil.foto);
                axios.post('administrador/updateUsuarios',formData).then(response =>{
                    this.getAdministrador();
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
            archivosPDF(event,tipo){

                let file = event.target.files[0];

                let formData = new FormData();
                    formData.append('id_perfil',this.detalleUsuario.id);
                    formData.append('documento',file);
                    formData.append('tipo',tipo.tipo);
                    $('#modalloading').modal('show');
                axios.post('perfil/newDocumento',formData).then(response=>{
                    axios.get(`administrador/detalleDocumentacion/${this.detalleUsuario.id}`).then(res =>{
                        this.Archivos = res.data.documentacion
                        $('#modalloading').modal('hide');
                        Swal.fire({
                            title: 'Éxito',
                            text: "Se Agrego correctamente!",
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2500,
                        });
                    });
               
                });
            },
            archivosPDFUpdate(event,value){
                
                let file = event.target.files[0];

                let formData = new FormData();
                    formData.append('id_documentacion',value.id_documentacion);
                    formData.append('id_perfil',this.detalleUsuario.id);
                    formData.append('documento_delete',value.archivo)
                    formData.append('documento',file);
                    formData.append('tipo',value.tipo);
                    $('#modalloading').modal('show');
                axios.post('perfil/updateDocumento',formData).then(response=>{
                    axios.get(`administrador/detalleDocumentacion/${this.detalleUsuario.id}`).then(res =>{
                        this.Archivos = res.data.documentacion
                        $('#modalloading').modal('hide');
                        Swal.fire({
                            title: 'Éxito',
                            text: "Se Edito correctamente!",
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2500,
                        });
                    })
                   
                })
            },
            verContrato(id_contrato_digital){
                $('#modalloading').modal('show');
                axios.post('perfil/verContrato', { id_contrato_digital}, { responseType: 'blob' })
                .then((response) => {
                    const blob = new Blob([response.data], { type: 'application/pdf' });
                    const url = window.URL.createObjectURL(blob);
                    window.open(url, '_blank');
                    $('#modalloading').modal('hide');
                })
                .catch((error) => {
                    console.error(error);
                    
                });
                
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