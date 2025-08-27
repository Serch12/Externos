<template>
    <div>
        <div id="main" v-if="this.vista == 0">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-6">
                        <div class="user-profile-header-banner">
                            <img src="style/logos/fondo5.jpg" alt="Banner image" class="rounded-top" />
                        </div>
                        <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-5">
                            <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                                <img :src="`ArchivosSistema/Documentacion/${this.Perfil.foto}`" alt="user image" class="d-block h-auto ms-0 ms-sm-5 rounded-4 user-profile-img" @error="(event)=>onImageError(event)"/>
                            </div>
                            <div class="flex-grow-1 mt-4 mt-sm-12">
                                <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-5 flex-md-row flex-column gap-6">
                                    <div class="user-profile-info">
                                        <h4 class="mb-2">{{this.Perfil.name}}</h4>
                                        <ul
                                        class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4">
                                        <li class="list-inline-item">
                                            <i class="ri-football-line me-2 ri-24px"></i><span class="fw-medium">{{this.Perfil.rol}}</span>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="ri-map-pin-line me-2 ri-24px"></i><span class="fw-medium">{{this.sede}}</span>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="ri-calendar-line me-2 ri-24px"></i
                                            ><span class="fw-medium">{{this.Perfil.cumpleaños}}</span>
                                        </li>
                                        </ul>
                                    </div>
                                    <div class="alert alert-solid-success d-flex align-items-center" role="alert" v-if="this.Perfil.estatus == 1">
                                        <span class="alert-icon rounded">
                                        <i class="ri-checkbox-circle-line ri-22px"></i>
                                        </span>
                                        ACTIVO
                                    </div>

                                    <div class="alert alert-solid-danger d-flex align-items-center" role="alert" v-if="this.Perfil.estatus == 2">
                                        <span class="alert-icon rounded">
                                        <i class="ri-error-warning-line ri-22px"></i>
                                        </span>
                                        INACTIVO
                                    </div>

                                    <div class="alert alert-solid-warning d-flex align-items-center" role="alert" v-if="this.Perfil.estatus == 0">
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
                        <!-- <li class="nav-item" role="presentation" v-if="this.rol_usuario == 'Cuerpo Tecnico'">
                            <button class="nav-link" id="documentacion-tab" data-bs-toggle="pill" data-bs-target="#documentacion" type="button" role="tab" aria-controls="documentacion" aria-selected="false">
                                <i class="ri-article-line me-2"></i>Documentación
                            </button>
                        </li> -->
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="bancario-tab" data-bs-toggle="pill" data-bs-target="#bancario" type="button" role="tab" aria-controls="bancario" aria-selected="false">
                                <i class="ri-money-dollar-circle-line me-2"></i>Datos Bancarios
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
                                                        <span>{{this.Perfil.nombre}} {{ this.Perfil.apellido_paterno }} {{ this.Perfil.apellido_materno }}</span>
                                                    </li>
                                                    <li class="d-flex align-items-center mb-4">
                                                        <i class="ri-check-line ri-24px"></i><span class="fw-medium mx-2">Estatus:</span>
                                                        <span class="badge bg-label-success rounded-pill" v-if="this.Perfil.estatus == 1">Activo</span>
                                                        <span class="badge bg-label-warning rounded-pill" v-if="this.Perfil.estatus == 0">Pendiente</span>
                                                        <span class="badge bg-label-danger rounded-pill" v-if="this.Perfil.estatus == 2">Inactivo</span>
                                                    </li>
                                                    <li class="d-flex align-items-center mb-4">
                                                        <i class="ri-football-fill ri-24px"></i><span class="fw-medium mx-2">Role:</span>
                                                        <span>{{this.Perfil.rol}}</span>
                                                    </li>
                                                    <li class="d-flex align-items-center mb-4">
                                                        <i class="ri-map-pin-line ri-24px"></i><span class="fw-medium mx-2">Sede:</span>
                                                        <span>{{ this.sede }}</span>
                                                    </li>
                                                    <!-- <li class="d-flex align-items-center mb-2">
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
                                                    <span>{{ this.Perfil.telefono }}</span>
                                                    </li>
                                                    <li class="d-flex align-items-center mb-4">
                                                    <i class="ri-map-pin-line ri-24px"></i><span class="fw-medium mx-2">Dirección:</span>
                                                    <span>{{this.Perfil.direccion}}</span>
                                                    </li>
                                                    <li class="d-flex align-items-center mb-2">
                                                    <i class="ri-mail-open-line ri-24px"></i><span class="fw-medium mx-2">Email:</span>
                                                    <span>{{this.Perfil.email}}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!--/ About User -->
                                    </div>
                                </div>
                            <!--/ User Profile Content -->
                        </div>
                        <div class="tab-pane fade show" id="bancario" role="tabpanel" aria-labelledby="bancario-tab">
                            <!-- Payment Methods -->
                            <div class="col-12 col-md-8">
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
                            <!--/ Payment Methods -->
                        </div>
                        <!-- <div class="tab-pane fade" id="documentacion" role="tabpanel" aria-labelledby="documentacion-tab">
                            <div class="row">
                                <div class="col-xl-4 col-lg-5 col-md-5">
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
                                </div>
                                <div class="col-xl-8 col-lg-5 col-md-5">
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
                                    
                                </div>
                            </div>
                            
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <div id="main" v-if="this.vista == 1">
            <div class="card mb-6">
                <h5 class="card-header" style="color: green;">Registro de Perfil</h5>
                <form class="card-body">
                  <h6>Datos del Perfil</h6>
                    <div class="row g-6">
                        <div class="col-md-6">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                <input
                                    type="text"
                                    id="nombre"
                                    class="form-control"
                                    placeholder="nombre" style="color: black;"
                                    aria-label="nombre" v-model="newperfil.nombre"/>
                                <label for="nombre">Nombre</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                <input
                                    type="text"
                                    id="apellido_paterno"
                                    class="form-control"
                                    placeholder="apellido_paterno" style="color: black;"
                                    aria-label="apellido_paterno" v-model="newperfil.apellido_paterno"/>
                                <label for="apellido_paterno">Apellido Paterno</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                <input
                                    type="text"
                                    id="apellido_materno"
                                    class="form-control"
                                    placeholder="apellido_materno" style="color: black;"
                                    aria-label="apellido_materno" v-model="newperfil.apellido_materno"/>
                                <label for="apellido_materno">Apellido Materno</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                <input
                                    type="text"
                                    id="direccion"
                                    class="form-control"
                                    placeholder="direccion" style="color: black;"
                                    aria-label="direccion" v-model="newperfil.direccion"/>
                                <label for="direccion">Dirección</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                <input
                                    type="number"
                                    id="telefono"
                                    class="form-control"
                                    placeholder="telefono" style="color: black;"
                                    aria-label="telefono" v-model="newperfil.telefono"/>
                                <label for="telefono">Telefono</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                <input
                                    type="date"
                                    id="fecha_n"
                                    class="form-control"
                                    placeholder="fecha_n" style="color: black;"
                                    aria-label="fecha_n" v-model="newperfil.cumpleaños"/>
                                <label for="fecha_n">Fecha de Nacimiento</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline mb-6">
                                <input type="file"  accept="image/png,image/jpeg" class="form-control" id="bs-validation-upload-file" ref="fileFoto" @change="onChangeFoto()">
                                <label for="bs-validation-upload-file">Foto</label>
                            </div>
                        </div>
        
                    </div>
                  
                  
                    <div class="pt-6 mt-2">
                        <button type="button" class="btn btn-success me-4" @click="createPerfil()">Guardar</button>
                        <!-- <button type="reset" class="btn btn-danger" @click="muestra(0)">Cancelar</button> -->
                    </div>
                </form>
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
        <br><br>
    </div>
</template>
<script>
import axios from 'axios';

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
            vista:'',
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
        }
    },
    computed: {
        
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
        getPerfil(){
            var url = `perfil/getPerfil?id=${this.id_usuario_logeado}`;
                axios.get(url).then(response => {
        
                this.Perfil = response.data.perfil
                if (this.Perfil == null) {
                    this.vista = 1;
                }else{
                    this.vista = 0;
                }
                this.DatoBancario = response.data.datoBancario
            });
        },
        createPerfil(){
            if (this.newperfil.nombre == '') {
                this.$toast.error("Ingresa una Nombre", {
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
            if (this.newperfil.apellido_materno == '') {
                this.$toast.error("Ingresa una Apellido Materno", {
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
            if (this.newperfil.apellido_paterno == '') {
                this.$toast.error("Ingresa una Apellido Paterno", {
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
            if (this.newperfil.direccion == '') {
                this.$toast.error("Ingresa una Dirección", {
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
            if (this.newperfil.telefono == '') {
                this.$toast.error("Ingresa un Telefono", {
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
            if (this.newperfil.foto == '') {
                this.$toast.error("Ingresa una Foto", {
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
            formData.append('id',this.id_usuario_logeado);
            formData.append('nombre',this.newperfil.nombre);
            formData.append('apellido_paterno',this.newperfil.apellido_paterno);
            formData.append('apellido_materno',this.newperfil.apellido_materno);
            formData.append('direccion',this.newperfil.direccion);
            formData.append('telefono',this.newperfil.telefono);
            formData.append('cumpleaños',this.newperfil.cumpleaños);
            formData.append('foto',this.newperfil.foto);
            axios.post('perfil/createPerfil',formData).then(response=>{
                this.getPerfil();
                this.vista = 0;
                Swal.fire({
                    title: 'Éxito',
                    text: "Se Registro correctamente!",
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2500,
                });
            })
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
        }
    }
};
</script>
<style scoped>
</style>