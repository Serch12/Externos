<template>
    <div>

        <div id="main" v-if="this.vista == 0"> 
             <div class="row">
                    <!-- User Sidebar -->
                <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                    <!-- User Card -->
                    <div class="card mb-6">
                        <div class="card-body pt-12">
                            <div class="user-avatar-section">
                                <div class="d-flex align-items-center flex-column">
                                    <img class="img-fluid rounded-3 mb-4"
                                        :src="`ArchivosSistema/Documentacion/${this.Perfil.foto}`"
                                        height="120"
                                        width="120"
                                        alt="User avatar" @error="(event)=>onImageError(event)"/>
                                    <div class="user-info text-center">
                                        <h5>{{this.Perfil.name}}</h5>
                                        <span class="badge bg-label-success rounded-pill">{{ this.Perfil.rol_name }}</span>
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
                                        <h5 class="mb-0">{{this.Perfil.cumpleaños}}</h5>
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
                                        <h5 class="mb-0">{{this.Perfil.fecha_ingreso}}</h5>
                                        <span>Fecha Ingreso</span>
                                    </div>
                                </div>
                            </div>
                            <h5 class="pb-4 border-bottom mb-4">Detalles</h5>
                            <div class="info-container">
                                <ul class="list-unstyled mb-6">
                                    <li class="mb-2">
                                        <span class="fw-medium text-heading me-2">Nombre Usuario:</span>
                                        <span>{{this.Perfil.nombre}} </span>
                                    </li>
                                    <li class="mb-2">
                                        <span class="fw-medium text-heading me-2">Email:</span>
                                        <span>{{this.Perfil.email}}</span>
                                    </li>
                                    <li class="mb-2">
                                        <span class="fw-medium text-heading me-2">Estatus:</span>
                                        <span :class="`badge ${this.Perfil.color} rounded-pill`">{{this.Perfil.text}}</span>
                                    </li>
                                    <li class="mb-2">
                                        <span class="fw-medium text-heading me-2">Role:</span>
                                        <span>{{ this.Perfil.rol_name }}</span>
                                    </li>

                                    <li class="mb-2">
                                        <span class="fw-medium text-heading me-2">Contacto:</span>
                                        <span>+(52) {{this.Perfil.telefono}}</span>
                                    </li>
                                    <li class="mb-2">
                                        <span class="fw-medium text-heading me-2">Dirección:</span>
                                        <span>{{this.Perfil.calle}} #{{ this.Perfil.num_ext }}, CP: {{ this.Perfil.cp }}, {{ this.Perfil.colonia }},</span>
                                    </li>
                                    <li class="mb-2">
                                        <span class="fw-medium text-heading me-2">Cedula:</span>
                                        <span>{{this.Perfil.cedula}}</span>
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
                                <button class="nav-link active" id="info-tab" data-bs-toggle="pill" data-bs-target="#info" type="button" role="tab" aria-controls="info" aria-selected="false">
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
                                <button class="nav-link" id="datosbancarios-tab" data-bs-toggle="pill" data-bs-target="#datosbancarios" type="button" role="tab" aria-controls="datosbancarios" aria-selected="false">
                                    <i class="ri-lock-line me-2"></i>Datos Bancarios
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contrato-tab" data-bs-toggle="pill" data-bs-target="#contrato" type="button" role="tab" aria-controls="contrato" aria-selected="false">
                                    <i class="ri-file-edit-fill me-2"></i>Contrato
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">

                            <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                                <!-- User Profile Content -->
                                <div class="card mb-6">
                                    <div class="card-body">
                                    <div class="d-flex align-items-start align-items-sm-center gap-6">
                                        <img :src="`ArchivosSistema/Documentacion/${this.Perfil.id_user}/${this.Perfil.foto}`" alt="user-avatar1" class="d-block w-px-100 h-px-100 rounded-4" id="uploadedAvatar" @error="(event)=>onImageError(event)" v-if="this.backupImageSrc == ''"/>
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
                                                        <input class="form-control" type="text" id="nombre456" name="nombre456" v-model="Perfil.nombre"  style="text-transform: uppercase;"/>
                                                        <label for="nombre456">Nombre</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating form-floating-outline">
                                                        <input class="form-control" type="text" id="apPaterno456" name="apPaterno456" v-model="Perfil.apellido_paterno" style="text-transform: uppercase;"/>
                                                        <label for="apPaterno456">Apellido Paterno</label>

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-floating form-floating-outline">
                                                        <input class="form-control" type="text" id="apMaterno456" name="apMaterno456" v-model="Perfil.apellido_materno" style="text-transform: uppercase;"/>
                                                        <label for="apMaterno456">Apellido Materno</label>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating form-floating-outline">
                                                        <input class="form-control" type="text" id="Profecion456" name="Profecion456"  v-model="Perfil.profesion" style="text-transform: uppercase;"/>
                                                        <label for="Profecion456">Profesión</label>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating form-floating-outline">
                                                        <select class="form-select" id="select_update_civil" name="select_update_civil" v-model="Perfil.estado_civil">
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
                                                        <select class="form-select" id="select_update_sexo" name="select_update_sexo" v-model="Perfil.sexo">
                                                            <option value="">Selecciona el Sexo</option>
                                                            <option value="MASCULINO">MASCULINO</option>
                                                            <option value="FEMENNINO">FEMENNINO</option>
                                                        </select>
                                                        <label for="select_update_sexo">Sexo</label>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="date" class="form-control flatpickr-validation" placeholder="YYYY-MM-DD" id="fechanacimienot785" v-model="Perfil.cumpleaños"/>
                                                        <label for="fechanacimienot785">Fecha Nacimiento</label>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-group input-group-merge">
                                                        <div class="form-floating form-floating-outline">
                                                            <input type="number" id="phoneNumber" name="phoneNumber" class="form-control" v-model="Perfil.telefono"/>
                                                            <label for="phoneNumber">Telefono </label>
                                                        </div>
                                                        <span class="input-group-text">MEX (+52)</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" class="form-control" id="address" name="address" v-model="Perfil.calle" style="text-transform: uppercase;"/>
                                                        <label for="address">Calle</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="number" class="form-control" id="num_ext" name="num_ext" v-model="Perfil.num_ext"/>
                                                        <label for="num_ext">Num Ext</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="number" class="form-control" id="num_int" name="num_int" v-model="Perfil.num_int"/>
                                                        <label for="num_int">Num Int</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="number" class="form-control" id="CP12" name="CP12" v-model="Perfil.codigo_postal"/>
                                                        <label for="CP12">CP</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" class="form-control" id="colonia" name="colonia" v-model="Perfil.colonia" style="text-transform: uppercase;"/>
                                                        <label for="colonia">Colonia</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" class="form-control" id="municipio" name="municipio" v-model="Perfil.municipio" style="text-transform: uppercase;"/>
                                                        <label for="municipio">Municipio</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating form-floating-outline">
                                                        <input class="form-control" type="text" id="state" name="state" value="New York" v-model="Perfil.entidad" style="text-transform: uppercase;"/>
                                                        <label for="state">Estado</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating form-floating-outline">
                                                        <input class="form-control" type="text" id="nacionalidad" name="nacionalidad" value="New York" v-model="Perfil.nacionalidad" style="text-transform: uppercase;"/>
                                                        <label for="nacionalidad">Nacionalidad</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating form-floating-outline">
                                                        <input class="form-control" type="text" id="cedula" name="cedula" value="New York" v-model="Perfil.cedula" style="text-transform: uppercase;"/>
                                                        <label for="cedula">Cédula</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating form-floating-outline">
                                                        <input class="form-control" type="text" id="curp" name="curp" value="New York" v-model="Perfil.curp" style="text-transform: uppercase;"/>
                                                        <label for="curp">Curp</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating form-floating-outline">
                                                        <input class="form-control" type="text" id="rfc" name="rfc" value="New York" v-model="Perfil.rfc" style="text-transform: uppercase;"/>
                                                        <label for="rfc">RFC</label>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-6">
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="date" class="form-control flatpickr-validation" placeholder="YYYY-MM-DD" id="bs-validation-dob" v-model="Perfil.fecha_ingreso"/>
                                                        <label for="bs-validation-dob">Fecha Ingreso</label>
                                                    </div>
                                                </div> -->

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
                            <div class="tab-pane fade" id="datosbancarios" role="tabpanel" aria-labelledby="datosbancarios-tab">
                                <div class="col-12 col-md-12">
                                    <div class="card card-action mb-6">
                                        <div class="card-header align-items-center">
                                            <h5 class="card-action-title mb-0">Datos Bancarios</h5>
                                            <div class="card-action-element">
                                                <button
                                                class="btn btn-sm btn-primary"
                                                type="button"
                                                data-bs-toggle="modal"
                                                data-bs-target="#addNewCCModal">
                                                <i class="ri-add-line ri-14px me-1"></i>Añadir
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="added-cards">
                                                <div class="cardMaster border p-5 rounded-4 mb-4" v-for="(db, index) in DatoBancario" :key="index" >
                                                    <div class="d-flex justify-content-between flex-sm-row flex-column">
                                                        <div class="card-information" data-bs-toggle="modal" data-bs-target="#vizualizaCard" @click="detaBancario(db)">
                                                            <img class="mb-2 img-fluid" :src="`style/imgBancos/${db.imagen_banco}`" alt="Master Card" width="70px" height="70px"/>
                                                            <div class="d-flex align-items-center mb-2">
                                                                <h6 class="mb-0 me-2">{{db.nombre}}</h6>
                                                                <!-- <span class="badge bg-label-primary me-1 rounded-pill">Popular</span> -->
                                                            </div>
                                                            <span class="card-number">Tarjeta: {{ db.numero_tarjeta }}</span>
                                                        </div>
                                                        <div class="d-flex flex-column text-start text-lg-end">
                                                            <div class="d-flex order-sm-0 order-1 mt-sm-2">
                                                                <button class="btn btn-sm btn-outline-primary me-4" data-bs-toggle="modal" data-bs-target="#editCard" @click="detaBancario(db)">
                                                                    Editar
                                                                </button>
                                                                <button class="btn btn-sm btn-outline-danger" @click="deleteBancario(db.id_datos_bancarios)">Eliminar</button>
                                                            </div>
                                                            <small class="mt-sm-4 mt-2 order-sm-1 order-0 text-sm-end mb-2">{{ db.tipo_tarjeta }}</small>
                                                        </div>
                                                    </div>
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

                                            <!-- Contratos Vigentes -->
                                            <div style="
                                                flex: 1;
                                                background: #fff;
                                                padding: 15px 20px;
                                                border-radius: 10px;
                                                box-shadow: 0 2px 6px rgba(0,0,0,0.1);
                                                text-align: center; ">
                                                <div style="font-size: 14px; color: #666;">Contratos Vigentes</div>
                                                <div style="font-size: 26px; font-weight: bold; color: #0055ff;">0</div>
                                            </div>

                                            <!-- Pendientes de firma -->
                                            <div style="
                                                flex: 1;
                                                background: #fff;
                                                padding: 15px 20px;
                                                border-radius: 10px;
                                                box-shadow: 0 2px 6px rgba(0,0,0,0.1);
                                                text-align: center; ">
                                                <div style="font-size: 14px; color: #666;">Pendientes de Firma</div>
                                                <div style="font-size: 26px; font-weight: bold; color: #d98b00;">0</div>
                                            </div>

                                            <!-- Contratos Históricos -->
                                            <div style="
                                                flex: 1;
                                                background: #fff;
                                                padding: 15px 20px;
                                                border-radius: 10px;
                                                box-shadow: 0 2px 6px rgba(0,0,0,0.1);
                                                text-align: center;">
                                                <div style="font-size: 14px; color: #666;">Contratos Históricos</div>
                                                <div style="font-size: 26px; font-weight: bold; color: #333;">0</div>
                                            </div>

                                            <!-- Próxima Fecha -->
                                            <div style="
                                                flex: 1;
                                                background: #fff;
                                                padding: 15px 20px;
                                                border-radius: 10px;
                                                box-shadow: 0 2px 6px rgba(0,0,0,0.1);
                                                text-align: center;">
                                                <div style="font-size: 14px; color: #666;">Próxima Fecha de Vencimiento</div>
                                                <div style="font-size: 26px; font-weight: bold; color: #cc0000;">00/00/0000</div>
                                            </div>
                                        </div>

                                        <!-- Tabla -->
                                        <div class="card">
                                            <h5 class="card-header">Contratos Pendientes de Firma</h5>
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
                                                        <tr v-for="(c, index) in ContratoFirma" :key="index">
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
                                                                <span class="badge rounded-pill bg-label-warning me-1">Por Firmar</span>
                                                            </td>
                                                            <td>
                                                                <a type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ver Contrato" @click="verContrato(c.id_contrato_digital)">
                                                                    <i class="ri-file-list-fill bg-label-warning ri-25px me-1"></i>
                                                                </a>
                                                                <a type="button" data-bs-toggle="modal" data-bs-placement="bottom" title="Firmar Contrato" data-bs-target="#modalConfirmacion" @click="detalleContrato(c)">
                                                                    <i class="ri-edit-box-fill bg-label-info ri-25px me-1"></i>
                                                                </a>
                                                                
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

        <!-- Agregar Dato Bancario -->
        <div class="modal fade" id="addNewCCModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body p-0">
                    <div class="text-center mb-6">
                        <h4 class="mb-2">Añadir Nuevo Dato Bancario</h4>
                    </div>
                    <form id="addNewCCForm" class="row g-5" onsubmit="return false">
                        <div class="col-6">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <input id="modalAddCard" name="modalAddCard" class="form-control credit-card-mask" type="text" placeholder="1356 3215 6548 7898"
                                    aria-describedby="modalAddCard2" v-model="newBancario.numero_tarjeta"/>
                                    <label for="modalAddCard">Número de Tarjeta</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <input id="cuenta" name="cuenta" class="form-control credit-card-mask" type="text" placeholder="1356 3215 6548 7898"
                                    aria-describedby="cuenta2" v-model="newBancario.cuenta_bancaria"/>
                                    <label for="cuenta">Cuenta Bancaria</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <input id="clabe" name="clabe" class="form-control credit-card-mask" type="text" placeholder="1356 3215 6548 7898"
                                    aria-describedby="clabe2" v-model="newBancario.clabe_bancaria"/>
                                    <label for="clabe">Clabe Bancaria</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-floating form-floating-outline">
                                <select id="tipo_tarjeta" name="tipo_tarjeta" class="form-select" v-model="newBancario.tipo_tarjeta">
                                    <option value="Selecciona">Selecciona</option>
                                    <option value="credito">Crédito</option>
                                    <option value="debito nomina">Débito Nomina</option>
                                    <option value="debito empresarial">Débito Empresarial</option>
                                    <option value="debito personal">Débito Personal</option>
                                    <option value="servicios">Servicios</option>
                                </select>
                                <label for="tipo_tarjeta">Tipo de Tarjeta</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-12">
                            <div class="form-floating form-floating-outline">
                                <select id="banco" name="banco" class="form-select" v-model="newBancario.banco">
                                    <option value="Seleccionar Banco">Seleccionar Banco</option>
                                    <option value="BBVA BANCOMER">BBVA BANCOMER</option>
                                    <option value="BANORTE">BANORTE</option>
                                    <option value="CITI BANAMEX">CITI BANAMEX</option>
                                    <option value="SANTANDER">SANTANDER</option>
                                    <option value="HSBC">HSBC</option>
                                    <option value="INBURSA">INBURSA</option>
                                    <option value="MIFEL">MIFEL</option>
                                    <option value="SCOTIABANK">SCOTIABANK</option>
                                    <option value="AMERICAN EXPRESS">AMERICAN EXPRESS</option>
                                    <option value="BANCO AZTECA">BANCO AZTECA</option>
                                    <option value="BANCOPPEL">BANCOPPEL</option>
                                    <option value="AFIRME">AFIRME</option>
                                    <option value="BANBAJIO">BANBAJÍO</option>
                                </select>
                                <label for="banco">Banco</label>
                            </div>
                        </div>

                        <div class="col-12 d-flex flex-wrap justify-content-center gap-4 row-gap-4">
                            <button type="button" class="btn btn-success" @click="createBancario()">Guardar</button>
                            <button type="reset" class="btn btn-outline-danger btn-reset" data-bs-dismiss="modal" aria-label="Close">
                                Cancelar
                            </button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- editar Dato Bancario -->
        <div class="modal fade" id="editCard" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body p-0">
                    <div class="text-center mb-6">
                        <h4 class="mb-2">Editar Dato Bancario</h4>
                    </div>
                    <form id="addNewCCForm" class="row g-5" onsubmit="return false">
                        <div class="col-6">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <input id="modalAddCard" name="modalAddCard" class="form-control credit-card-mask" type="text" placeholder="1356 3215 6548 7898"
                                    aria-describedby="modalAddCard2" v-model="detalleBancario.numero_tarjeta"/>
                                    <label for="modalAddCard">Número de Tarjeta</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <input id="cuenta" name="cuenta" class="form-control credit-card-mask" type="text" placeholder="1356 3215 6548 7898"
                                    aria-describedby="cuenta2" v-model="detalleBancario.cuenta_bancaria"/>
                                    <label for="cuenta">Cuenta Bancaria</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <input id="clabe" name="clabe" class="form-control credit-card-mask" type="text" placeholder="1356 3215 6548 7898"
                                    aria-describedby="clabe2" v-model="detalleBancario.clabe_bancaria"/>
                                    <label for="clabe">Clabe Bancaria</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-floating form-floating-outline">
                                <select id="tipo_tarjeta" name="tipo_tarjeta" class="form-select" v-model="detalleBancario.tipo_tarjeta">
                                    <option value="Selecciona">Selecciona</option>
                                    <option value="credito">Crédito</option>
                                    <option value="debito nomina">Débito Nomina</option>
                                    <option value="debito empresarial">Débito Empresarial</option>
                                    <option value="debito personal">Débito Personal</option>
                                    <option value="servicios">Servicios</option>
                                </select>
                                <label for="tipo_tarjeta">Tipo de Tarjeta</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-12">
                            <div class="form-floating form-floating-outline">
                                <select id="banco" name="banco" class="form-select" v-model="detalleBancario.banco">
                                    <option value="Seleccionar Banco">Seleccionar Banco</option>
                                    <option value="BBVA BANCOMER">BBVA BANCOMER</option>
                                    <option value="BANORTE">BANORTE</option>
                                    <option value="CITI BANAMEX">CITI BANAMEX</option>
                                    <option value="SANTANDER">SANTANDER</option>
                                    <option value="HSBC">HSBC</option>
                                    <option value="INBURSA">INBURSA</option>
                                    <option value="MIFEL">MIFEL</option>
                                    <option value="SCOTIABANK">SCOTIABANK</option>
                                    <option value="AMERICAN EXPRESS">AMERICAN EXPRESS</option>
                                    <option value="BANCO AZTECA">BANCO AZTECA</option>
                                    <option value="BANCOPPEL">BANCOPPEL</option>
                                    <option value="AFIRME">AFIRME</option>
                                    <option value="BANBAJIO">BANBAJÍO</option>
                                </select>
                                <label for="banco">Banco</label>
                            </div>
                        </div>

                        <div class="col-12 d-flex flex-wrap justify-content-center gap-4 row-gap-4">
                            <button type="button" class="btn btn-success" @click="updateBancario()">Editar</button>
                            <button type="reset" class="btn btn-outline-danger btn-reset" data-bs-dismiss="modal" aria-label="Close">
                                Cancelar
                            </button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- vizualizar Dato Bancario -->
        <div class="modal fade" id="vizualizaCard" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body p-0">
                    <div class="text-center mb-6">
                        <h4 class="mb-2">Dato Bancario</h4>
                    </div>
                    <form id="addNewCCForm" class="row g-5" onsubmit="return false">
                        <div class="col-6">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <input id="modalAddCard" name="modalAddCard" class="form-control credit-card-mask" type="text" style="color:black" disabled placeholder="1356 3215 6548 7898"
                                    aria-describedby="modalAddCard2" v-model="this.detalleBancario.numero_tarjeta"/>
                                    <label for="modalAddCard">Número de Tarjeta</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <input id="cuenta" name="cuenta" class="form-control credit-card-mask" type="text" style="color:black" disabled placeholder="1356 3215 6548 7898"
                                    aria-describedby="cuenta2" v-model="this.detalleBancario.cuenta_bancaria"/>
                                    <label for="cuenta">Cuenta Bancaria</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <input id="clabe" name="clabe" class="form-control credit-card-mask" type="text" style="color:black" disabled placeholder="1356 3215 6548 7898"
                                    aria-describedby="clabe2" v-model="this.detalleBancario.clabe_bancaria"/>
                                    <label for="clabe">Clabe Bancaria</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-floating form-floating-outline">
                                <select id="tipo_tarjeta" name="tipo_tarjeta" class="form-select" v-model="this.detalleBancario.tipo_tarjeta" style="color:black" disabled>
                                    <option value="Selecciona">Selecciona</option>
                                    <option value="credito">Crédito</option>
                                    <option value="debito nomina">Débito Nomina</option>
                                    <option value="debito empresarial">Débito Empresarial</option>
                                    <option value="debito personal">Débito Personal</option>
                                    <option value="servicios">Servicios</option>
                                </select>
                                <label for="tipo_tarjeta">Tipo de Tarjeta</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-12">
                            <div class="form-floating form-floating-outline">
                                <select id="banco" name="banco" class="form-select" v-model="this.detalleBancario.banco" style="color:black" disabled>
                                    <option value="Seleccionar Banco">Seleccionar Banco</option>
                                    <option value="BBVA BANCOMER">BBVA BANCOMER</option>
                                    <option value="BANORTE">BANORTE</option>
                                    <option value="CITI BANAMEX">CITI BANAMEX</option>
                                    <option value="SANTANDER">SANTANDER</option>
                                    <option value="HSBC">HSBC</option>
                                    <option value="INBURSA">INBURSA</option>
                                    <option value="MIFEL">MIFEL</option>
                                    <option value="SCOTIABANK">SCOTIABANK</option>
                                    <option value="AMERICAN EXPRESS">AMERICAN EXPRESS</option>
                                    <option value="BANCO AZTECA">BANCO AZTECA</option>
                                    <option value="BANCOPPEL">BANCOPPEL</option>
                                    <option value="AFIRME">AFIRME</option>
                                </select>
                                <label for="banco">Banco</label>
                            </div>
                        </div>

                        <div class="col-12 d-flex flex-wrap justify-content-center gap-4 row-gap-4">
                            <button type="reset" class="btn btn-outline-danger btn-reset" data-bs-dismiss="modal" aria-label="Close">
                                Cancelar
                            </button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Confirmacion-->
        <div class="modal fade" id="modalConfirmacion" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalCenterTitle">Firma Electrónica de Contrato</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td><b>ID Contrato:</b></td>
                                        <td>CI-{{ this.InfoContrato.id_contrato_digital }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Tipo:</b></td>
                                        <td>{{ this.InfoContrato.tipo_contrato }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Vigencia:</b></td>
                                        <td>{{ this.InfoContrato.fecha_inicio }} - {{ this.InfoContrato.fecha_fin }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Monto Mensual:</b></td>
                                        <td>${{ formatPrice(this.InfoContrato.salario_numero_1) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-12 ">
                            <div class="card shadow-none bg-label-secondary">
                                <div class="card-body">
                                    <p class="card-text">
                                        Declaro haber leido y estar de acuerdo con las condiciones establecidas e el presente contrato. Al hacer clic en "Firmar electronicamente", acepto los terminos y condiciones y otorgo mi consentimiento para la formalización de este acuerdo.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="defaultCheck3" v-model="buttonFirma">
                                <label class="form-check-label" for="defaultCheck3"> He leído y acepto las condiciones del contrato </label>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer mt-2">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="button" class="btn btn-primary" :disabled="!buttonFirma" data-bs-toggle="modal" data-bs-target="#modalFirma">Firmar electronicamente</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal firma -->
        <div class="modal fade" id="modalFirma" data-bs-backdrop="static" tabindex="-1">
            <div class="modal-dialog">
                <form class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="backDropModalTitle">Agrega Firma</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <canvas ref="firmaUsuario" class="signature-pad" width="500px" height="400px" style="background-color: #33b2ff;"></canvas>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="clearFirmaUsuario()">
                            Limpiar Firma
                        </button>
                        <!-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                            Cancelar
                        </button> -->
                        <button type="button" class="btn btn-success" @click="agregaFirma()">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
        <br><br>
    </div>
</template>
<script>
import axios from 'axios';
import SignaturePad from 'signature_pad';

export default {
    name: '',
    components: {

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
            Perfil:[],
            DatoBancario:[],
            detalleBancario:[],
            newperfil:{

            },
            newBancario:{
                id_user:this.id_usuario_logeado,
                nombre:this.name_usuario_logeado,
                clabe_bancaria:'',
                cuenta_bancaria:'',
                numero_tarjeta:'',
                tipo_tarjeta:'Selecciona',
                banco:'Seleccionar Banco',
            },
            backupImageSrc: 'style/logos/sinfoto.png',
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
            ContratoFirma:[],
            InfoContrato:[],
            buttonFirma:false
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
        this.getPerfil();
    },
    methods: {
        onImageError(event) {
            event.target.src = this.backupImageSrc;
        },
        include(permiso){
            return this.permisos.includes(permiso);
        },
        formatPrice(value) {
            let val = (value / 1).toFixed(2).replace(',', '.')
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        },
        getPerfil(){
            var url = `perfil/getPerfil?id=${this.id_usuario_logeado}`;
                axios.get(url).then(response => {

                this.Perfil = response.data.perfil;
                    if (this.Perfil == null) {
                        this.Perfil = {
                            bandera:'activo'
                        }
                    }

                    let partes = this.Perfil.direccion.split(',');
                    partes = partes.map(p => p.trim());
                    

                    this.Perfil.calle  = partes[0] || '';
                    this.Perfil.num_ext = partes[1] || '';
                    this.Perfil.num_int = partes[2] || '';
                    this.Perfil.colonia = partes[3] || '';
                    this.Perfil.municipio = partes[4] || '';
                    this.Perfil.entidad = partes[5] || '';

                    
                this.DatoBancario = response.data.datoBancario
                this.Archivos = response.data.documento;
                this.ContratoFirma = response.data.contrato_firma;
            });

            this.firmaUsuario = new SignaturePad(this.$refs.firmaUsuario, {
                backgroundColor: 'rgb(255, 255, 255)',
                penColor: 'rgb(1, 1, 1)',
            });
        },

        onChangeFoto(){
            var fileedit = this.$refs.fileFoto.files[0];
            this.newperfil.foto = fileedit
        },
        createBancario(){
            if (this.newBancario.numero_tarjeta == '') {
                this.$toast.error("Ingresa un Número de Tarjeta", {
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
            if (this.newBancario.cuenta_bancaria == '') {
                this.$toast.error("Ingresa una Cuenta Bancaria", {
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
            if (this.newBancario.clabe_bancaria == '') {
                this.$toast.error("Ingresa una Clabe Bancaria", {
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
            if (this.newBancario.tipo_tarjeta == 'Selecciona') {
                this.$toast.error("Selecciona un Tipo de Tarjeta", {
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
            if (this.newBancario.banco == 'Seleccionar Banco') {
                this.$toast.error("Selecciona un Banco", {
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
            formData.append('id_user',this.id_usuario_logeado);
            formData.append('nombre',this.name_usuario_logeado);
            formData.append('clabe_bancaria',this.newBancario.clabe_bancaria);
            formData.append('cuenta_bancaria',this.newBancario.cuenta_bancaria);
            formData.append('numero_tarjeta',this.newBancario.numero_tarjeta);
            formData.append('tipo_tarjeta',this.newBancario.tipo_tarjeta);
            formData.append('banco',this.newBancario.banco);


            axios.post('perfil/createDatoBancario',formData).then(response=>{
                this.getPerfil();
                this.vista = 0;
                $('#addNewCCModal').modal('hide');
                Swal.fire({
                    title: 'Éxito',
                    text: "Se Registro correctamente!",
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2500,
                });
            })

        },
        detaBancario(db){
            this.detalleBancario = db;
        },
        updateBancario(){
            if (this.detalleBancario.numero_tarjeta == '') {
                this.$toast.error("Ingresa un Número de Tarjeta", {
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
            if (this.detalleBancario.cuenta_bancaria == '') {
                this.$toast.error("Ingresa una Cuenta Bancaria", {
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
            if (this.detalleBancario.clabe_bancaria == '') {
                this.$toast.error("Ingresa una Clabe Bancaria", {
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
            if (this.detalleBancario.tipo_tarjeta == 'Selecciona') {
                this.$toast.error("Selecciona un Tipo de Tarjeta", {
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
            if (this.detalleBancario.banco == 'Seleccionar Banco') {
                this.$toast.error("Selecciona un Banco", {
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
            formData.append('id_datos_bancarios',this.detalleBancario.id_datos_bancarios);
            formData.append('clabe_bancaria',this.detalleBancario.clabe_bancaria);
            formData.append('cuenta_bancaria',this.detalleBancario.cuenta_bancaria);
            formData.append('numero_tarjeta',this.detalleBancario.numero_tarjeta);
            formData.append('tipo_tarjeta',this.detalleBancario.tipo_tarjeta);
            formData.append('banco',this.detalleBancario.banco);


            axios.post('perfil/updateDatoBancario',formData).then(response=>{
                this.getPerfil();
                this.vista = 0;
                $('#editCard').modal('hide');
                Swal.fire({
                    title: 'Éxito',
                    text: "Se Registro correctamente!",
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2500,
                });
            })
        },
        deleteBancario(id){
            this.id_datos_bancarios = id;
            Swal.fire({
                title: 'Estas seguro?',
                html: `Se eliminara definitivamente`,
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText:'Cancelar',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.isConfirmed) {
                    let formData = new FormData();
                    formData.append('id_datos_bancarios',this.id_datos_bancarios);
                    axios.post('perfil/deleteDatoBancario',formData).then(response=>{
                        this.getPerfil();
                        this.vista = 0;
                        Swal.fire({
                            title: 'Éxito',
                            text: "Se Elimino correctamente!",
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2500,
                        });
                    })
                }
            })
        },
        updateUsuarios(){
            if (this.Perfil.nombre == '') {
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
            if (this.Perfil.apellido_paterno == '') {
                this.$toast.error("Ingresa el Apellido Paterno", {
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
            if (this.Perfil.apellido_materno == '') {
                this.$toast.error("Ingresa el Apellido Materno", {
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
            if (this.Perfil.profesion == '') {
                this.$toast.error("Ingresa una Profesión", {
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
            if (this.Perfil.estado_civil == '') {
                this.$toast.error("Selecciona el Estado Civil", {
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
            if (this.Perfil.sexo == '') {
                this.$toast.error("Selecciona el Sexo", {
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
             if (this.Perfil.cumpleaños == '') {
                this.$toast.error("Ingresa la Fecha de Nacimiento", {
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
            if (this.Perfil.telefono == '') {
                this.$toast.error("Ingresa un Número Telefonico", {
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

            if (this.Perfil.calle == '') {
                this.$toast.error("Ingresa la Calle", {
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
            if (this.Perfil.num_ext == '') {
                this.$toast.error("Ingresa el Número Exterior", {
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

            if (this.Perfil.num_int == '') {
                this.Perfil.num_int = 0;
            }

            if (this.Perfil.codigo_postal == '') {
                this.$toast.error("Ingresa el Codigo Postal", {
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
            if (this.Perfil.colonia == '') {
                this.$toast.error("Ingresa la Colonia", {
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

            if (this.Perfil.municipio == '') {
                this.$toast.error("Ingresa el Municipio", {
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

            if (this.Perfil.entidad == '') {
                this.$toast.error("Ingresa el Estado", {
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

            if (this.Perfil.nacionalidad == '') {
                this.$toast.error("Ingresa una Nacionalidad", {
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

            if (this.Perfil.cedula == '') {
                this.$toast.error("Ingresa la Cédula", {
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
            if (this.Perfil.curp == '') {
                this.$toast.error("Ingresa tu Curp", {
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

            if (this.Perfil.rfc == '') {
                this.$toast.error("Ingresa tu RFC", {
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

                formData.append('id_perfil',this.Perfil.id_perfil);
                formData.append('bandera',this.Perfil.bandera);
                formData.append('id',this.id_usuario_logeado);
                formData.append('nombre',this.Perfil.nombre.toUpperCase());
                formData.append('apellido_paterno',this.Perfil.apellido_paterno.toUpperCase());
                formData.append('apellido_materno',this.Perfil.apellido_materno.toUpperCase());
                formData.append('profesion',this.Perfil.profesion.toUpperCase());
                formData.append('estado_civil',this.Perfil.estado_civil.toUpperCase());
                formData.append('sexo',this.Perfil.sexo.toUpperCase());
                formData.append('cumpleaños',this.Perfil.cumpleaños);
                formData.append('telefono',this.Perfil.telefono);
                formData.append('codigo_postal',this.Perfil.codigo_postal);
                formData.append('direccion',this.Perfil.calle.toUpperCase()+" ,"+this.Perfil.num_ext+" ,"+this.Perfil.num_int+" ,"+this.Perfil.colonia.toUpperCase()+" ,"+this.Perfil.municipio.toUpperCase()+" ,"+this.Perfil.entidad.toUpperCase());
                formData.append('nacionalidad',this.Perfil.nacionalidad.toUpperCase());
                formData.append('cedula',this.Perfil.cedula.toUpperCase());
                formData.append('curp',this.Perfil.curp.toUpperCase());
                formData.append('rfc',this.Perfil.rfc.toUpperCase());
                formData.append('foto',this.Perfil.foto);
            axios.post('administrador/updateUsuarios',formData).then(response =>{
                this.getPerfil();
                Swal.fire({
                    title: 'Éxito',
                    text: "Se Edito correctamente!",
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2500,
                });
            })
        },

        archivosPDF(event,tipo){

            let file = event.target.files[0];

            let formData = new FormData();
                formData.append('id_perfil',this.id_usuario_logeado);
                formData.append('documento',file);
                formData.append('tipo',tipo.tipo);
                $('#modalloading').modal('show');
            axios.post('perfil/newDocumento',formData).then(response=>{
                this.getPerfil();
                this.vista = 0;
               $('#modalloading').modal('hide');
                Swal.fire({
                    title: 'Éxito',
                    text: "Se Agrego correctamente!",
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2500,
                });
            });
        },
        archivosPDFUpdate(event,value){
            
            let file = event.target.files[0];

            let formData = new FormData();
                formData.append('id_documentacion',value.id_documentacion);
                formData.append('id_perfil',this.id_usuario_logeado);
                formData.append('documento_delete',value.archivo)
                formData.append('documento',file);
                formData.append('tipo',value.tipo);
                $('#modalloading').modal('show');
            axios.post('perfil/updateDocumento',formData).then(response=>{
                this.getPerfil();
                this.vista = 0;
                $('#modalloading').modal('hide');
                Swal.fire({
                    title: 'Éxito',
                    text: "Se Edito correctamente!",
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2500,
                });
            })
        },
        verContrato(id_contrato_digital){
            axios.post('perfil/verContrato', { id_contrato_digital}, { responseType: 'blob' })
            .then((response) => {
                const blob = new Blob([response.data], { type: 'application/pdf' });
                const url = window.URL.createObjectURL(blob);
                window.open(url, '_blank');
                
            })
            .catch((error) => {
                console.error(error);
                
            });
        },
        detalleContrato(c){
            this.InfoContrato = c;
            this.InfoContrato.confirmacion = false;
        },
        clearFirmaUsuario() {
            this.firmaUsuario.clear();
        },
    }
};
</script>
<style scoped>
</style>