<template>
    <div>
        <div id="main" v-show="this.vista == 0">
            <!-- Connection Cards -->
            <div class="row g-6">
                <div class="card">
                    <div class="row">
                    <div class="col-12 col-md-6">
                        <h5 class="card-header">Cuerpo Técnico</h5>
                    </div>
                    <div class="col-12 col-md-6 mt-3">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <input type="search" id="email"class="form-control"  v-model="search" placeholder="Buscar Cuerpo Técnico" @keyup="buscarJugador()"/>
                            <button type="button" class="btn btn-outline-success waves-effect" data-bs-toggle="modal" data-bs-target="#createTecnico" v-if="include('Crear')">Agregar</button>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12" v-if="this.Informacion.length == 0">
                    <div class="card">
                        <center>
                            <h5 class="card-header text-success">Sin Información</h5>
                            <img src="style/logos/img_no hay datos.png" alt="img_sindato" style="width: 200px;">
                        </center>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6" v-for="(c, index) in Informacion" :key="index" v-else>
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="dropdown btn-pinned">
                                <button
                                type="button"
                                class="btn dropdown-toggle hide-arrow p-4"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="ri-more-2-line ri-22px text-muted"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" type="button" style="color: orange;" v-if="include('Vizualizar')" @click="infoTecnico(c),muestra(1)">
                                        <i class="ri-clipboard-line me-1"></i> Vizualizar</a>  
                                    </li>
                                    <li>
                                        <a class="dropdown-item" type="button" style="color: #33b2ff;" v-if="include('Editar')" 
                                        data-bs-toggle="modal" data-bs-target="#updateTecnico" @click="infoTecnico(c)">
                                        <i class="ri-pencil-line me-1"></i> Editar</a>  
                                    </li>
                                    <li v-if="c.estatus == 1">
                                        <a class="dropdown-item" type="button" style="color: green;" v-if="include('Permisos')" @click="infoTecnico(c),cambioEstatus(c)">
                                        <i class="ri-checkbox-circle-fill me-1"></i> Activar</a>  
                                    </li>
                                    <li v-if="c.estatus == 0">
                                        <a class="dropdown-item" type="button" style="color: red;" v-if="include('Permisos')" @click="infoTecnico(c),cambioEstatus(c)">
                                            <i class="ri-close-circle-fill me-1"></i> Desactivar</a>  
                                        </li>
                                    <li>
                                        <a class="dropdown-item" type="button" style="color: red;" v-if="include('Eliminar')" @click="deleteTecnico(c)">
                                        <i class="ri-delete-bin-7-line me-1"></i> Eliminar</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="mx-auto my-6">
                                <img :src="`ArchivosSistema/CuerpoTecnico/${c.id_cuerpo_tecnico}/${c.foto}`" alt="Foto" class="rounded-circle w-px-100" />
                            </div>
                            <h5 class="mb-0 card-title">{{c.nombre}}</h5>
                            <span>{{c.puesto}}</span>
                            <div class="d-flex align-items-center justify-content-center my-6 gap-2">
                                <span :class="`badge bg-label-${c.color} rounded-pill`">Sede: {{ c.sede }}</span>
                                <span :class="`badge bg-label-${c.class_color} rounded-pill`">{{c.text}}</span>
                            </div>
                        </div>
                    </div>
                </div>
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
            <!--/ Connection Cards -->
        </div>
        <!-- vista de detalle jugador-->
        <div id="main" v-if="this.vista == 1">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row gy-6 gy-md-0">
                    <!-- User Sidebar -->
                    <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                        <!-- User Card -->
                        <div class="card mb-6">
                            <div class="card-body pt-12">
                            <div class="user-avatar-section">
                                <div class="d-flex align-items-center flex-column">
                                <img
                                    class="img-fluid rounded-3 mb-4"
                                :src="`ArchivosSistema/CuerpoTecnico/${DetalleTecnico.id_cuerpo_tecnico}/${DetalleTecnico.foto}`"
                                    height="120"
                                    width="120"
                                    alt="User avatar" style="width: 80px;"/>
                                <div class="user-info text-center">
                                    <h5>{{this.DetalleTecnico.nombre}}</h5>
                                    <span class="badge bg-label-dark rounded-pill">{{this.DetalleTecnico.categoria}}</span>
                                </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-around flex-wrap my-6 gap-0 gap-md-3 gap-lg-4">
                                <div class="d-flex align-items-center me-5 gap-4">
                                <div class="avatar">
                                    <div class="avatar-initial bg-label-primary rounded-3">
                                    <i class="ri-football-line ri-24px"></i>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="mb-0">Puesto</h5>
                                    <span>{{ this.DetalleTecnico.puesto }}</span>
                                </div>
                                </div>
                                
                            </div>
                            
                            </div>
                        </div>
                        <!-- /User Card -->
                    </div>
                    <!--/ User Sidebar -->

                    <!-- User Content -->
                    <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                    <!-- User Tabs -->
                    <div class="nav-align-top">
                        <ul class="nav nav-pills flex-column flex-md-row mb-6 row-gap-2">
                            <li class="nav-item">
                                <a class="nav-link" :class="{ 'active': activeView === null }" type="button" @click="showCard(null)"><i class="ri-user-fill me-2"></i>Información</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" :class="{ 'active': activeView === 'exp' }" type="button"  @click="showCard('exp')"><i class="ri-book-marked-fill me-2"></i>Documentación</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" :class="{ 'active': activeView === 'tutor' }" type="button"  @click="showCard('tutor')"><i class="ri-todo-fill me-2"></i>Info Tutor</a>
                            </li> -->
                        </ul>
                    </div>
                    <!--/ User Tabs -->
                    
                    <!-- informacion -->
                    <div class="card mb-6" v-if="this.activeView == null">
                        <h5 class="card-header">Información del Cuerpo Técnico</h5>
                        <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-12 col-md-6 mt-2" style="color: green;">
                            <i class="ri-hashtag me-2 ri-24px"></i><span class="fw-medium">Folio: {{this.DetalleTecnico.folio}}</span>
                            </div>
                            <div class="col-12 col-md-6 mt-2">
                            <i class="ri-user-fill me-2 ri-24px"></i><span class="fw-medium">Nombre: {{this.DetalleTecnico.nombre}}</span>
                            </div>
                            <div class="col-12 col-md-6 mt-2">
                            <i class="ri-football-line me-2 ri-24px"></i><span class="fw-medium">Puesto: {{this.DetalleTecnico.puesto}}</span>
                            </div>
                            <div class="col-12 col-md-6 mt-2">
                            <i class="ri-user-5-fill me-2 ri-24px"></i><span class="fw-medium">Sexo: {{this.DetalleTecnico.sexo}}</span>
                            </div>
                            <div class="col-12 col-md-6 mt-2">
                            <i class="ri-calendar-fill me-2 ri-24px"></i><span class="fw-medium">Fecha de Nacimiento: {{this.DetalleTecnico.fecha_nacimiento}}</span>
                            </div>
                            <div class="col-12 col-md-6 mt-2">
                            <i class="ri-emotion-fill me-2 ri-24px"></i><span class="fw-medium">Edad: {{this.DetalleTecnico.edad}} años</span>
                            </div>
                            <div class="col-12 col-md-6 mt-2">
                            <i class="ri-road-map-fill me-2 ri-24px"></i><span class="fw-medium">Sede: {{this.DetalleTecnico.sede}}</span>
                            </div>
                            <!-- <div class="col-12 col-md-6 mt-2">
                            <i class="ri-map-pin-2-fill me-2 ri-24px"></i><span class="fw-medium">Dirección: {{this.DetalleTecnico.direccion}}</span>
                            </div>
                            <div class="col-12 col-md-6 mt-2">
                            <i class="ri-mail-check-fill me-2 ri-24px"></i><span class="fw-medium">Correo: {{this.DetalleTecnico.correo}}</span>
                            </div>
                            <div class="col-12 col-md-6 mt-2">
                            <i class="ri-phone-fill me-2 ri-24px"></i><span class="fw-medium">Telefono: {{this.DetalleTecnico.telefono}}</span>
                            </div> -->
                        </div>
                        </div>
                    </div>
                    <!-- Expediente -->
                    <!-- <div class="card mb-6" v-if="this.activeView == 'exp'">
                        <h5 class="card-header">Expendiente</h5>
                        <div class="card-body pt-0">
                        <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Archivo</th>
                                    <th scope="col">Tipo</th>
                                </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                <tr v-for="(arch, index) in DetalleTecnico.documentacion" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td v-if="arch.archivo == ''">
                                    <div class="form-floating form-floating-outline">
                                        <input type="file"  accept="image/png,image/jpeg" class="form-control" :id="`bs-validation-upload-fileupdate${index}`" :ref="`fileArch${index}`" @change="onChangeArchivoUpdate(index,arch)">
                                        <label :for="`bs-validation-upload-fileupdate${index}`">Archivo</label>
                                    </div>
                                    </td>
                                    <td v-else>
                                    <img
                                        :src="`ArchivosSistema/Jugadores/${arch.id_jugador}/${arch.archivo}`"
                                        alt="Archivo"
                                        style="width: 80px;"
                                        />
                                    </td>
                                    <td v-if="arch.id_docu_jugador == ''">
                                    <div class="form-floating form-floating-outline">
                                        <select :id="`tipo${index}`" :name="`tipo${index}`" class="form-select" v-model="arch.tipo">
                                        <option value="Selecciona una Opción">Selecciona una Opción</option>
                                        <option value="Acta de Nacimiento">Acta de Nacimiento</option>
                                        <option value="Curp">Curp</option>
                                        <option value="Identificación">Identificación</option>
                                        </select>
                                        <label :for="`tipo${index}`">Tipo</label>
                                    </div>
                                    </td>
                                    <td v-else>{{ arch.tipo }}</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div> -->
                    <!-- Info Tutor -->
                    <!-- <div class="card mb-6" v-if="this.activeView == 'tutor'">
                        <h5 class="card-header">Expendiente</h5>
                        <div class="card-body">
                        <form>
                            <div class="input-group input-group-merge mb-6">
                            <span id="basic-icon-default-fullname2" class="input-group-text">
                                <i class="ri-user-line"></i>
                            </span>
                            <div class="form-floating form-floating-outline">
                                <input 
                                type="text"
                                id="basic-icon-default-company"
                                class="form-control"
                                placeholder="Nombre"
                                aria-label="Nombre"
                                v-model="DetalleTecnico.tutor"
                                aria-describedby="basic-icon-default-fullname2" />
                                <label for="basic-icon-default-fullname">Nombre Tutor</label>
                            </div>
                            </div>
                            <div class="input-group input-group-merge mb-6">
                            <span id="basic-icon-default-company2" class="input-group-text">
                                <i class="ri-map-pin-line"></i>
                            </span>
                            <div class="form-floating form-floating-outline">
                                <input
                                type="text"
                                id="basic-icon-default-company"
                                class="form-control"
                                placeholder="Dirección"
                                aria-label="Dirección"
                                v-model="DetalleTecnico.direccion"
                                aria-describedby="basic-icon-default-company2" />
                                <label for="basic-icon-default-company">Dirección</label>
                            </div>
                            </div>
                            <div class="mb-6">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="ri-mail-line"></i></span>
                                <div class="form-floating form-floating-outline">
                                <input
                                    type="email"
                                    id="basic-icon-default-email"
                                    class="form-control"
                                    placeholder="john.doe"
                                    aria-label="john.doe"
                                    v-model="DetalleTecnico.correo"
                                    aria-describedby="basic-icon-default-email2" />
                                <label for="basic-icon-default-email">Email</label>
                                </div>
                                <span id="basic-icon-default-email2" class="input-group-text">@example.com</span>
                            </div>
                            
                            </div>
                            <div class="input-group input-group-merge mb-6">
                            <span id="basic-icon-default-phone2" class="input-group-text">
                                <i class="ri-phone-fill"></i>
                            </span>
                            <div class="form-floating form-floating-outline">
                                <input
                                type="number"
                                id="basic-icon-default-phone"
                                class="form-control phone-mask"
                                placeholder="658 799 8941"
                                aria-label="658 799 8941"
                                v-model="DetalleTecnico.telefono"
                                aria-describedby="basic-icon-default-phone2" />
                                <label for="basic-icon-default-phone">Telefono</label>
                            </div>
                            </div>
                            
                            <button type="button" class="btn btn-primary" @click="newTutor()">Guardar</button>
                        </form>
                        </div>
                    </div> -->
                    <!-- /Activity Timeline -->
                    </div>
                    <!--/ User Content -->
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
        <!-- MODAL QUE CREA EL Cuerpo Tecnico -->
        <div class="modal fade" id="createTecnico" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-add-new-address">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body p-0">
                        <div class="text-center mb-6">
                            <h4 class="address-title mb-2">Agregar Cuerpo Técnico</h4>
                        </div>
                        <form id="addNewAddressForm" class="row g-5">

                            <!-- campos de acceso -->
                            <div class="col-12 col-md-6" v-if="this.submenu == false">
                                <div class="form-floating form-floating-outline">
                                <input type="file"  accept="image/png,image/jpeg" class="form-control" id="bs-validation-upload-file" ref="fileFoto" @change="onChangeFoto()">
                                <label for="bs-validation-upload-file">Foto</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6" v-if="this.submenu == false">
                                <div class="form-floating form-floating-outline">
                                <input
                                    type="text"
                                    id="name"
                                    class="form-control"
                                    v-model="newtecnico.nombre"
                                    placeholder="Nombre"/>
                                <label for="name">Nombre</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6" v-if="this.submenu == false">
                                <div class="form-floating form-floating-outline">
                                <input
                                    type="date"
                                    id="fecha"
                                    class="form-control"
                                    v-model="newtecnico.fecha_nacimiento" @change="mostrarEdad(newtecnico.fecha_nacimiento)"/>
                                <label for="fecha">Fecha de Nacimiento</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6" v-if="this.submenu == false">
                                <div class="form-floating form-floating-outline">
                                <input
                                    type="number"
                                    id="edad"
                                    class="form-control"
                                    v-model="newtecnico.edad" disabled/>
                                <label for="edad">Edad</label>
                                </div>
                            </div>
                           
                            <div class="col-12 col-md-6" v-if="this.submenu == false">
                                <div class="form-floating form-floating-outline">
                                <select id="puesto" name="puesto" class="form-select" v-model="newtecnico.puesto">
                                    <option value="Selecciona un Puesto">Selecciona un Puesto</option>
                                    <option value="Preparador Físico">Preparador Físico</option>
                                    <option value="Médico">Médico</option>
                                    <option value="Auxiliar Técnico">Auxiliar Técnico</option>
                                    <option value="Kinesíologo">Kinesíologo</option>
                                    <option value="Masajista">Masajista</option>
                                    <option value="Utilero">Utilero</option>
                                    <option value="Entrenador de Arqueros">Entrenador de Arqueros</option>
                                </select>
                                <label for="puesto">Puesto</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6" v-if="this.submenu == false">
                                <div class="form-floating form-floating-outline">
                                <select id="sexo" name="sexo" class="form-select" v-model="newtecnico.sexo">
                                    <option value="Selecciona el Sexo">Selecciona el Sexo</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                </select>
                                <label for="sexo">Sexo</label>
                                </div>
                            </div>

                            <div class="col-12 col-md-6" v-if="this.submenu == false">
                                <div class="form-floating form-floating-outline">
                                <input
                                    type="text"
                                    id="sede"
                                    class="form-control"
                                    v-model="newtecnico.sede" disabled/>
                                <label for="sede">Sede</label>
                                </div>
                            </div>

                            <!-- campos de informacion -->

                            <div class="col-12 col-md-6" v-if="this.submenu == true">
                                <div class="form-floating form-floating-outline">
                                <input type="file"  accept="image/png,image/jpeg" class="form-control" id="bs-validation-upload-file_acta" ref="fileActa" @change="onChangeActa()">
                                <label for="bs-validation-upload-file_acta">Acta de Nacimiento</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6" v-if="this.submenu == true">
                                <div class="form-floating form-floating-outline">
                                <input type="file"  accept="image/png,image/jpeg" class="form-control" id="bs-validation-upload-file_curp" ref="fileCurp" @change="onChangeCurp()">
                                <label for="bs-validation-upload-file_curp">Curp</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6" v-if="this.submenu == true">
                                <div class="form-floating form-floating-outline">
                                <input type="file"  accept="image/png,image/jpeg" class="form-control" id="bs-validation-upload-file_ident" ref="fileIdent" @change="onChangeIdentificacion()">
                                <label for="bs-validation-upload-file_ident">Identificación</label>
                                </div>
                            </div>
                            <div class="col-12 mt-6 d-flex flex-wrap justify-content-center gap-4 row-gap-4">
                                <button type="button" class="btn btn-primary" @click="agregaTecnico()">Guardar</button>
                                <button type="reset" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL QUE edita EL Cuerpo Tecnico -->
        <div class="modal fade" id="updateTecnico" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-add-new-address">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body p-0">
                        <div class="text-center mb-6">
                            <h4 class="address-title mb-2">Editar Cuerpo Técnico</h4>
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
                                                <span class="h6 mb-0 d-flex align-items-center"><i class="ri-account-box-fill ri-20px me-1"></i>Datos</span>
                                            </span>
                                            </label>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md mb-md-0">
                                        <div class="form-check custom-option custom-option-basic">
                                            <label class="form-check-label custom-option-content" for="customRadioOffice">
                                            <input
                                                name="customRadioTemp"
                                                class="form-check-input"
                                                type="radio"
                                                value=""
                                                id="customRadioOffice" @click="accionSubmenu()"/>
                                            <span class="custom-option-header">
                                                <span class="h6 mb-0 d-flex align-items-center"><i class="ri-id-card-fill ri-20px me-1"></i>Documentación</span>
                                            </span>
                                            </label>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            <!-- campos de acceso -->
                            <div class="col-12 col-md-6" v-if="this.submenuUpdate == false">
                                <div class="form-floating form-floating-outline">
                                    <div class="col-12 col-md-6">
                                        <a type="button" for="file-img"  onclick="document.getElementById('file-img').click()">
                                            <img src="style/logos/imgcarga.png" alt="Upload Image" v-if="this.DetalleTecnico.foto == ''"/>
                                            <img :src="`ArchivosSistema/CuerpoTecnico/${DetalleTecnico.id_cuerpo_tecnico}/${DetalleTecnico.foto}`" alt="Foto" style="width: 80px;" v-else>
                                        </a>
                                        <input type="file" id="file-img" ref="fileFotoupdates" accept="image/*" style="display: none;"  @change="onChangeFotoUpdate()" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6" v-if="this.submenuUpdate == false">
                                <div class="form-floating form-floating-outline">
                                    <input
                                        type="text"
                                        id="name"
                                        class="form-control"
                                        v-model="DetalleTecnico.nombre"
                                        placeholder="Nombre"/>
                                    <label for="name">Nombre</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6" v-if="this.submenuUpdate == false">
                                <div class="form-floating form-floating-outline">
                                    <input
                                        type="date"
                                        id="fecha"
                                        class="form-control"
                                        v-model="DetalleTecnico.fecha_nacimiento" @change="mostrarEdadUpdate(DetalleTecnico.fecha_nacimiento)"/>
                                    <label for="fecha">Fecha de Nacimiento</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6" v-if="this.submenuUpdate == false">
                                <div class="form-floating form-floating-outline">
                                    <input
                                        type="number"
                                        id="edad"
                                        class="form-control"
                                        v-model="DetalleTecnico.edad" disabled/>
                                    <label for="edad">Edad</label>
                                </div>
                            </div>
                           
                            <div class="col-12 col-md-6" v-if="this.submenuUpdate == false">
                                <div class="form-floating form-floating-outline">
                                <select id="puesto" name="puesto" class="form-select" v-model="DetalleTecnico.puesto">
                                    <option value="Selecciona un Puesto">Selecciona un Puesto</option>
                                    <option value="Preparador Físico">Preparador Físico</option>
                                    <option value="Médico">Médico</option>
                                    <option value="Auxiliar Técnico">Auxiliar Técnico</option>
                                    <option value="Kinesíologo">Kinesíologo</option>
                                    <option value="Masajista">Masajista</option>
                                    <option value="Utilero">Utilero</option>
                                    <option value="Entrenador de Arqueros">Entrenador de Arqueros</option>
                                </select>
                                <label for="puesto">Puesto</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6" v-if="this.submenuUpdate == false">
                                <div class="form-floating form-floating-outline">
                                <select id="sexo" name="sexo" class="form-select" v-model="DetalleTecnico.sexo">
                                    <option value="Selecciona el Sexo">Selecciona el Sexo</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                </select>
                                <label for="sexo">Sexo</label>
                                </div>
                            </div>

                            <div class="col-12 col-md-6" v-if="this.submenuUpdate == false">
                                <div class="form-floating form-floating-outline">
                                <input
                                    type="text"
                                    id="sede"
                                    class="form-control"
                                    v-model="DetalleTecnico.sede" disabled/>
                                <label for="sede">Sede</label>
                                </div>
                            </div>

                            <!-- campos de informacion -->

                            <div class="col-12 col-md-6" v-if="this.submenuUpdate == true">
                                <div class="form-floating form-floating-outline">
                                <input type="file"  accept="image/png,image/jpeg" class="form-control" id="bs-validation-upload-file_acta" ref="fileActa" @change="onChangeActa()">
                                <label for="bs-validation-upload-file_acta">Acta de Nacimiento</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6" v-if="this.submenuUpdate == true">
                                <div class="form-floating form-floating-outline">
                                <input type="file"  accept="image/png,image/jpeg" class="form-control" id="bs-validation-upload-file_curp" ref="fileCurp" @change="onChangeCurp()">
                                <label for="bs-validation-upload-file_curp">Curp</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6" v-if="this.submenuUpdate == true">
                                <div class="form-floating form-floating-outline">
                                <input type="file"  accept="image/png,image/jpeg" class="form-control" id="bs-validation-upload-file_ident" ref="fileIdent" @change="onChangeIdentificacion()">
                                <label for="bs-validation-upload-file_ident">Identificación</label>
                                </div>
                            </div>
                            <div class="col-12 mt-6 d-flex flex-wrap justify-content-center gap-4 row-gap-4">
                                <button type="button" class="btn btn-primary" @click="updateTecnico()">Editar</button>
                                <button type="reset" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
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
import moment from 'moment';
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
            search:'',
            submenu:false,
            submenuUpdate:false,
            activeView:null,
            newtecnico:{
                foto:'',
                nombre:'',
                fecha_nacimiento:'',
                edad:'',
                puesto:'Selecciona un Puesto',
                sexo:'Selecciona el Sexo',
                sede:this.sede
            },
            Informacion:[],
            DetalleTecnico:[],
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
        this.getCuerpoTecnico();
    },
    methods: {
        include(permiso){
            return this.permisos.includes(permiso);
        },
        muestra(value){
            this.vista = value;
        },
        getCuerpoTecnico(page){
            axios.get(`cuerpo_tecnico/getCuerpoTecnico?buscador=${this.search}&rol=${this.rol_usuario}&sede=${this.sede}&page=`+page).then(response =>{
                this.Informacion = response.data.tecnico.data;
                this.pagination = response.data.pagination
            });
        },
        mostrarEdad(fechaNacimiento){
            let nacimiento = moment(fechaNacimiento);
            let hoy = moment();
            let edad = 0;
            if(nacimiento < hoy){
                edad = hoy.diff(nacimiento, 'years');
                this.newtecnico.edad = edad;
            }else{
                this.$toast.error("La fecha de nacimiento no puede ser superior a la fecha actual del sistema.!", {
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
                this.newtecnico.fecha_nacimiento = ''
            }
            return edad;
        },
        mostrarEdadUpdate(fechaNacimiento){
            let nacimiento = moment(fechaNacimiento);
            let hoy = moment();
            let edad = 0;
            if(nacimiento < hoy){
                edad = hoy.diff(nacimiento, 'years');
                this.DetalleTecnico.edad = edad;
            }else{
                this.$toast.error("La fecha de nacimiento no puede ser superior a la fecha actual del sistema.!", {
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
                this.DetalleTecnico.fecha_nacimiento = ''
            }
            return edad;
        },
        agregaTecnico(){
            if (this.newtecnico.foto == '') {
                this.$toast.error("Añade una Fotografia", {
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
            if (this.newtecnico.nombre == '') {
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
            if (this.newtecnico.fecha_nacimiento == '') {
                this.$toast.error("Ingresa una Fceha de Nacimiento", {
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
            if (this.newtecnico.puesto == 'Selecciona un Puesto') {
                this.$toast.error("Selecciona un Puesto", {
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
            if (this.newtecnico.sexo == 'Selecciona el Sexo') {
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
            let formData = new FormData();
                formData.append('creacion',this.id_usuario_logeado);
                formData.append('foto',this.newtecnico.foto);
                formData.append('nombre',this.newtecnico.nombre);
                formData.append('fecha_nacimiento',this.newtecnico.fecha_nacimiento);
                formData.append('edad',this.newtecnico.edad);
                formData.append('puesto',this.newtecnico.puesto);
                formData.append('sexo',this.newtecnico.sexo);
                formData.append('sede',this.newtecnico.sede);

            axios.post('cuerpo_tecnico/createRegistro',formData).then(response=>{
                this.getCuerpoTecnico();
                $('#createTecnico').modal('hide');
                this.newtecnico = {
                    foto:'',
                    nombre:'',
                    fecha_nacimiento:'',
                    edad:'',
                    puesto:'Selecciona un Puesto',
                    sexo:'Selecciona el Sexo',
                    sede:this.sede
                }
                Swal.fire({
                    title: 'Exitoso',
                    text: "Se Registro correctamente!",
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2500,
                });
            })
        },
        onChangeFoto(){
            var fileedit = this.$refs.fileFoto.files[0];
            this.newtecnico.foto = fileedit
        },
        onChangeFotoUpdate(){
            var fileedit = this.$refs.fileFotoupdates.files[0];
            this.DetalleTecnico.foto = fileedit
        },
        infoTecnico(c){
            this.DetalleTecnico = c;
            this.DetalleTecnico.foto_elimina = c.foto;
        },
        cambioEstatus(c){
            this.id_cuerpo_tecnico = c.id_cuerpo_tecnico;
            this.estatus = c.estatus;
            Swal.fire({
                title: 'Estas seguro?',
                text: "Se cambiara de estatus!",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText:'Cancelar',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.isConfirmed) {
                    let formData = new FormData();
                        if (this.estatus == 0) {
                            this.estatus = 1;
                        } else {
                            this.estatus = 0;
                        }
                        formData.append('id_cuerpo_tecnico', this.id_cuerpo_tecnico);
                        formData.append('estatus',this.estatus);
                    axios.post('cuerpo_tecnico/cambioEstatus',formData).then(response=>{
                        this.getCuerpoTecnico();
                        Swal.fire({
                            title: 'Exitoso',
                            text: "Se cambio correctamente!",
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2500,
                        });
                    })
                }
            })
        },
        deleteTecnico(c){
            this.id = c.id_cuerpo_tecnico;
            Swal.fire({
                title: 'Estas seguro?',
                text: "Se Eliminara definitivamente!",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText:'Cancelar',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`cuerpo_tecnico/deleteTecnico/${this.id}`).then(response =>{
                        this.getCuerpoTecnico();
                        Swal.fire({
                            title: 'Exitoso',
                            text: "Se Elimino correctamente!",
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2500,
                        });
                    })
                }
            })
        },
        updateTecnico(){
            let formData = new FormData();
                formData.append('id_cuerpo_tecnico',this.DetalleTecnico.id_cuerpo_tecnico);
                formData.append('foto',this.DetalleTecnico.foto);
                formData.append('nombre',this.DetalleTecnico.nombre);
                formData.append('fecha_nacimiento',this.DetalleTecnico.fecha_nacimiento);
                formData.append('edad',this.DetalleTecnico.edad);
                formData.append('puesto',this.DetalleTecnico.puesto);
                formData.append('sexo',this.DetalleTecnico.sexo);
                formData.append('sede',this.DetalleTecnico.sede);
            axios.post('cuerpo_tecnico/updaterRegistro',formData).then(response =>{
                $('#updateTecnico').modal('hide');
                this.getCuerpoTecnico();
                Swal.fire({
                    title: 'Exitoso',
                    text: "Se Edito correctamente!",
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2500,
                });
            })
        }
    }
};
</script>
<style lang='' scoped>
</style>