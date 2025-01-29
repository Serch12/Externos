<template>
    <div>
      <!-- vista de jugadores -->
      <div id="main" v-if="this.vista == 0">
        <div class="row g-6">
          <div class="card">  
            <div class="row">
              <div class="col-12 col-md-6">
                  <h5 class="card-header">Jugadores</h5>
              </div>
              <div class="col-12 col-md-6 mt-3">
                  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                      <input type="search" id="email"class="form-control"  v-model="search" placeholder="Buscar Jugadores" @keyup="buscarJugador()"/>
                      <button type="button" class="btn btn-outline-success waves-effect" data-bs-toggle="modal" data-bs-target="#createJugador" v-if="include('Crear')">Agregar</button>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-6 col-md-6" v-for="(jur, index) in Jugadores" :key="index">
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
                      <a class="dropdown-item" type="button" style="color: orange;" v-if="include('Vizualizar')" @click="infoJugador(jur),muestra(1)">
                        <i class="ri-clipboard-line me-1"></i> Vizualizar</a>  
                    </li>
                    <li>
                      <a class="dropdown-item" type="button" style="color: #33b2ff;" v-if="include('Editar')" 
                        data-bs-toggle="modal" data-bs-target="#editJugador" @click="infoJugador(jur)">
                        <i class="ri-pencil-line me-1"></i> Editar</a>  
                    </li>
                    <li v-if="jur.estatus == 1">
                      <a class="dropdown-item" type="button" style="color: green;" v-if="include('Permisos')" @click="infoJugador(jur)">
                        <i class="ri-checkbox-circle-fill me-1"></i> Activar</a>  
                    </li>
                    <li v-if="jur.estatus == 0">
                      <a class="dropdown-item" type="button" style="color: red;" v-if="include('Permisos')" @click="infoJugador(jur)">
                        <i class="ri-close-circle-fill me-1"></i> Desactivar</a>  
                    </li>
                    <li>
                      <a class="dropdown-item" type="button" style="color: red;" v-if="include('Eliminar')">
                      <i class="ri-delete-bin-7-line me-1"></i> Eliminar</a>
                    </li>
                  </ul>
                </div>
                <div class="mx-auto my-6">
                  <img  :src="`ArchivosSistema/Jugadores/${jur.id_jugador}/${jur.foto}`" alt="Avatar Image" style="width: 70px;"/>
                </div>
                <h5 class="mb-0 card-title">{{jur.nombre}}</h5>
                <span>{{jur.categoria}}</span>
                <div class="d-flex align-items-center justify-content-center my-6 gap-2">
                  <span :class="`badge bg-label-${jur.color} rounded-pill`">Sede: {{ jur.sede }}</span>
                </div>
                <div class="d-flex align-items-center justify-content-around mb-6">
                  <div>
                    <h5 class="mb-0">Posición</h5>
                    <span>{{jur.posicion}}</span>
                  </div>
                  <div>
                    <h5 class="mb-0">Sexo</h5>
                    <span>{{jur.sexo}}</span>
                  </div>
                  <!-- <div>
                    <h5 class="mb-0">2.14k</h5>
                    <span>Connections</span>
                  </div> -->
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
                       :src="`ArchivosSistema/Jugadores/${detalleJugador.id_jugador}/${detalleJugador.foto}`"
                        height="120"
                        width="120"
                        alt="User avatar" style="width: 80px;"/>
                      <div class="user-info text-center">
                        <h5>{{this.detalleJugador.nombre}}</h5>
                        <span class="badge bg-label-dark rounded-pill">{{this.detalleJugador.categoria}}</span>
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
                        <h5 class="mb-0">Posición</h5>
                        <span>{{ this.detalleJugador.posicion }}</span>
                      </div>
                    </div>
                    <div class="d-flex align-items-center gap-4">
                      <div class="avatar">
                        <div class="avatar-initial bg-label-primary rounded-3">
                          <i class="ri-user-fill ri-24px"></i>
                        </div>
                      </div>
                      <div>
                        <h5 class="mb-0">Sexo</h5>
                        <span>{{this.detalleJugador.sexo}}</span>
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
                  <li class="nav-item">
                    <a class="nav-link" :class="{ 'active': activeView === 'exp' }" type="button"  @click="showCard('exp')"><i class="ri-book-marked-fill me-2"></i>Documentación</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" :class="{ 'active': activeView === 'tutor' }" type="button"  @click="showCard('tutor')"><i class="ri-todo-fill me-2"></i>Info Tutor</a>
                  </li>
                </ul>
              </div>
              <!--/ User Tabs -->
              
              <!-- informacion -->
              <div class="card mb-6" v-if="this.activeView == null">
                <h5 class="card-header">Información del Jugador</h5>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-12 col-md-6 mt-2" style="color: green;">
                      <i class="ri-hashtag me-2 ri-24px"></i><span class="fw-medium">Folio: {{this.detalleJugador.folio}}</span>
                    </div>
                    <div class="col-12 col-md-6 mt-2">
                      <i class="ri-user-fill me-2 ri-24px"></i><span class="fw-medium">Nombre: {{this.detalleJugador.nombre}}</span>
                    </div>
                    <div class="col-12 col-md-6 mt-2">
                      <i class="ri-football-line me-2 ri-24px"></i><span class="fw-medium">Posición: {{this.detalleJugador.posicion}}</span>
                    </div>
                    <div class="col-12 col-md-6 mt-2">
                      <i class="ri-football-line me-2 ri-24px"></i><span class="fw-medium">{{this.detalleJugador.categoria}}</span>
                    </div>
                    <div class="col-12 col-md-6 mt-2">
                      <i class="ri-user-5-fill me-2 ri-24px"></i><span class="fw-medium">Sexo: {{this.detalleJugador.sexo}}</span>
                    </div>
                    <div class="col-12 col-md-6 mt-2">
                      <i class="ri-calendar-fill me-2 ri-24px"></i><span class="fw-medium">Fecha de Nacimiento: {{this.detalleJugador.fecha_nacimiento}}</span>
                    </div>
                    <div class="col-12 col-md-6 mt-2">
                      <i class="ri-emotion-fill me-2 ri-24px"></i><span class="fw-medium">Edad: {{this.detalleJugador.edad}}</span>
                    </div>
                    <div class="col-12 col-md-6 mt-2">
                      <i class="ri-team-fill me-2 ri-24px"></i><span class="fw-medium">Tutor: {{this.detalleJugador.tutor}}</span>
                    </div>
                    <div class="col-12 col-md-6 mt-2">
                      <i class="ri-map-pin-2-fill me-2 ri-24px"></i><span class="fw-medium">Dirección: {{this.detalleJugador.direccion}}</span>
                    </div>
                    <div class="col-12 col-md-6 mt-2">
                      <i class="ri-mail-check-fill me-2 ri-24px"></i><span class="fw-medium">Correo: {{this.detalleJugador.correo}}</span>
                    </div>
                    <div class="col-12 col-md-6 mt-2">
                      <i class="ri-phone-fill me-2 ri-24px"></i><span class="fw-medium">Telefono: {{this.detalleJugador.telefono}}</span>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Expediente -->
              <div class="card mb-6" v-if="this.activeView == 'exp'">
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
                          <tr v-for="(arch, index) in detalleJugador.documentacion" :key="index">
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
              </div>
              <!-- Info Tutor -->
              <div class="card mb-6" v-if="this.activeView == 'tutor'">
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
                          v-model="detalleJugador.tutor"
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
                          v-model="detalleJugador.direccion"
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
                            v-model="detalleJugador.correo"
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
                          v-model="detalleJugador.telefono"
                          aria-describedby="basic-icon-default-phone2" />
                        <label for="basic-icon-default-phone">Telefono</label>
                      </div>
                    </div>
                    
                    <button type="button" class="btn btn-primary" @click="newTutor()">Guardar</button>
                  </form>
                </div>
              </div>
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
      <!-- MODAL QUE CREA EL JUGADOR -->
      <div class="modal fade" id="createJugador" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-add-new-address">
          <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body p-0">
              <div class="text-center mb-6">
                <h4 class="address-title mb-2">Agregar Jugador</h4>
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
                                      <span class="h6 mb-0 d-flex align-items-center"><i class="ri-id-card-fill ri-20px me-1"></i>Documentación</span>
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
                        v-model="newjugador.nombre"
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
                        v-model="newjugador.fecha_nacimiento" @change="mostrarEdad(newjugador.fecha_nacimiento)"/>
                      <label for="fecha">Fecha de Nacimiento</label>
                    </div>
                  </div>
                  <div class="col-12 col-md-6" v-if="this.submenu == false">
                    <div class="form-floating form-floating-outline">
                      <input
                        type="number"
                        id="edad"
                        class="form-control"
                        v-model="newjugador.edad" disabled/>
                      <label for="edad">Edad</label>
                    </div>
                  </div>
                  <div class="col-12 col-md-6" v-if="this.submenu == false">
                    <div class="form-floating form-floating-outline">
                      <input
                        type="text"
                        id="posicion"
                        class="form-control"
                        v-model="newjugador.posicion"/>
                      <label for="posicion">Posición</label>
                    </div>
                  </div>
                  <div class="col-12 col-md-6" v-if="this.submenu == false">
                    <div class="form-floating form-floating-outline">
                      <select id="sexo" name="sexo" class="form-select" v-model="newjugador.sexo">
                        <option value="Selecciona el Sexo">Selecciona el Sexo</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                      </select>
                      <label for="sexo">Sexo</label>
                    </div>
                  </div>
                 
                  <div class="col-12 col-md-6" v-if="this.submenu == false">
                    <div class="form-floating form-floating-outline">
                      <select id="categoria" name="categoria" class="form-select" v-model="newjugador.categoria">
                        <option value="Selecciona una Categoria">Selecciona una Categoria</option>
                        <option value="Categoria 2009">Categoria 2009</option>
                        <option value="Categoria 2010">Categoria 2010</option>
                        <option value="Categoria 2011">Categoria 2011</option>
                        <option value="Categoria 2012">Categoria 2012</option>
                      </select>
                      <label for="categoria">Categoria</label>
                    </div>
                  </div>
                  <div class="col-12 col-md-6" v-if="this.submenu == false">
                    <div class="form-floating form-floating-outline">
                      <input
                        type="text"
                        id="sede"
                        class="form-control"
                        v-model="newjugador.sede" disabled/>
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
                      <button type="button" class="btn btn-primary" @click="agregaJugador()">Guardar</button>
                      <button type="reset" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- MODAL QUE edita EL JUGADOR -->
      <div class="modal fade" id="editJugador" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-add-new-address">
          <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body p-0">
              <div class="text-center mb-6">
                <h4 class="address-title mb-2">Editar Jugador</h4>
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
                                      checked @click="accionSubmenuUpdate()"/>
                                  <span class="custom-option-header">
                                      <span class="h6 mb-0 d-flex align-items-center"><i class="ri-account-box-fill ri-20px me-1"></i>Datos</span>
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
                                      id="customRadioOffice" @click="accionSubmenuUpdate()"/>
                                  <span class="custom-option-header">
                                      <span class="h6 mb-0 d-flex align-items-center"><i class="ri-id-card-fill ri-20px me-1"></i>Documentación</span>
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
                  <div class="col-12 col-md-6" v-if="this.submenuUpdate == false">
                    <div class="form-floating form-floating-outline">
                      <!-- <input type="file"  accept="image/png,image/jpeg" class="form-control" id="bs-validation-upload-file" ref="fileFoto" @change="onChangeFoto()">
                      <label for="bs-validation-upload-file">Foto</label> -->
                      <a type="button" for="file-img"  onclick="document.getElementById('file-img').click()">
                        <img src="style/logos/imgcarga.png" alt="Upload Image" v-if="this.detalleJugador.foto == ''"/>
                        <img :src="`ArchivosSistema/Jugadores/${detalleJugador.id_jugador}/${detalleJugador.foto}`" alt="Foto" style="width: 80px;" v-else>
                      </a>
                      <input type="file" id="file-img" ref="fileFotoupdates" accept="image/*" style="display: none;"  @change="onChangeFotoUpdate()" />
                    </div>
                  </div>
                  <div class="col-12 col-md-6" v-if="this.submenuUpdate == false">
                    <div class="form-floating form-floating-outline">
                      <input
                        type="text"
                        id="name"
                        class="form-control"
                        v-model="detalleJugador.nombre"
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
                        v-model="detalleJugador.fecha_nacimiento" @change="mostrarEdad(detalleJugador.fecha_nacimiento)"/>
                      <label for="fecha">Fecha de Nacimiento</label>
                    </div>
                  </div>
                  <div class="col-12 col-md-6" v-if="this.submenuUpdate == false">
                    <div class="form-floating form-floating-outline">
                      <input
                        type="number"
                        id="edad"
                        class="form-control"
                        v-model="detalleJugador.edad" disabled/>
                      <label for="edad">Edad</label>
                    </div>
                  </div>
                  <div class="col-12 col-md-6" v-if="this.submenuUpdate == false">
                    <div class="form-floating form-floating-outline">
                      <input
                        type="text"
                        id="posicion"
                        class="form-control"
                        v-model="detalleJugador.posicion"/>
                      <label for="posicion">Posición</label>
                    </div>
                  </div>
                  <div class="col-12 col-md-6" v-if="this.submenuUpdate == false">
                    <div class="form-floating form-floating-outline">
                      <select id="sexo" name="sexo" class="form-select" v-model="detalleJugador.sexo">
                        <option value="Selecciona el Sexo">Selecciona el Sexo</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                      </select>
                      <label for="sexo">Sexo</label>
                    </div>
                  </div>
                 
                  <div class="col-12 col-md-6" v-if="this.submenuUpdate == false">
                    <div class="form-floating form-floating-outline">
                      <select id="categoria" name="categoria" class="form-select" v-model="detalleJugador.categoria">
                        <option value="Selecciona una Categoria">Selecciona una Categoria</option>
                        <option value="Categoria 2009">Categoria 2009</option>
                        <option value="Categoria 2010">Categoria 2010</option>
                        <option value="Categoria 2011">Categoria 2011</option>
                        <option value="Categoria 2012">Categoria 2012</option>
                      </select>
                      <label for="categoria">Categoria</label>
                    </div>
                  </div>
                  <div class="col-12 col-md-6" v-if="this.submenuUpdate == false">
                    <div class="form-floating form-floating-outline">
                      <input
                        type="text"
                        id="sede"
                        class="form-control"
                        v-model="detalleJugador.sede" disabled/>
                      <label for="sede">Sede</label>
                    </div>
                  </div>

                  <!-- campos de informacion -->
                 
                  <div class="col-12 col-md-" v-if="this.submenuUpdate == true">
                    <!-- <div class="form-floating form-floating-outline">
                      <input type="file"  accept="image/png,image/jpeg" class="form-control" id="bs-validation-upload-file_acta" ref="fileActaupdate" @change="onChangeActaUpdate()">
                      <label for="bs-validation-upload-file_acta">Acta de Nacimiento</label>
                    </div> -->
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                      <!-- <input type="search" id="email"class="form-control"  v-model="search" placeholder="Buscar Jugadores" @keyup="buscarJugador()"/> -->
                      <button type="button" class="btn btn-outline-success waves-effect" @click="newArch()">Agregar</button>
                  </div>
                    <div class="table-responsive text-nowrap mt-2">
                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Archivo</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Opciones</th>
                          </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                          <tr v-for="(arch, index) in detalleJugador.documentacion" :key="index">
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
                            
                            <td>
                              <a class="dropdown-item" type="button" style="color: red;" @click="deleteArchivo(index,arch)">
                                <i class="ri-delete-bin-7-line me-1"></i> Eliminar
                              </a>
                            </td>
                          </tr>

                        </tbody>
                      </table>
                    </div>
                    
                  </div>
                  <div class="col-12 mt-6 d-flex flex-wrap justify-content-center gap-4 row-gap-4">
                      <button type="button" class="btn btn-primary" @click="EditarJugador()">Editar</button>
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
      newjugador:{
        foto:'',
        nombre:'',
        fecha_nacimiento:'',
        edad:'',
        posicion:'',
        sexo:'Selecciona el Sexo',
        apodo:'',
        categoria:'Selecciona una Categoria',
        sede:this.sede,
        acta_nacimiento:'',
        curp:'',
        identificacion:''
      },
      Jugadores:[],
      submenu:false,
      submenuUpdate:false,
      detalleJugador:[],
      activeView:null,
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
    this.getJugador();
  },
  methods: {
    getJugador(page){
      if (this.search == '') {
                
        var url = `jugadores/getJugador?rol=${this.rol_usuario}&sede=${this.sede}&page=`+page;
        axios.get(url).then(response => {

          this.Jugadores = response.data.muestra.data,
          this.pagination = response.data.pagination
        });
      } else {
        this.search
        var url = `jugadores/getJugador?rol=${this.rol_usuario}&sede=${this.sede}&buscador=${this.search}&page=`+page;
        axios.get(url).then(response => {
          this.Jugadores = response.data.muestra.data
          this.pagination = response.data.pagination
        });
      }
    },
    include(permiso){
      return this.permisos.includes(permiso);
    },
    changePage: function (page) {
      this.pagination.current_page = page;
      this.getJugador(page);
    },
    showCard(view){
      this.activeView = view;
    },
    muestra(valor){
      this.vista = valor;
    },
    buscarJugador() {               
      clearTimeout(this.tiempoBusqueda)
      this.tiempoBusqueda = setTimeout(this.getJugador, 200)
    },
    mostrarEdad(fechaNacimiento){
      let nacimiento = moment(fechaNacimiento);
      let hoy = moment();
      let edad = 0;
      if(nacimiento < hoy){
          edad = hoy.diff(nacimiento, 'years');
          this.newjugador.edad = edad;
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
        this.newjugador.fecha_nacimiento = ''
      }
      return edad;
    },
    accionSubmenu(){
      if (this.submenu == false) {
        this.submenu = true;
      } else {
        this.submenu = false;
      }
    },
    accionSubmenuUpdate(){
      if (this.submenuUpdate == false) {
        this.submenuUpdate = true;
      } else {
        this.submenuUpdate = false;
      }
    },
    agregaJugador(){
      if (this.newjugador.foto == '') {
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
      if (this.newjugador.nombre == '') {
        this.$toast.error("Ingresa el Nombre", {
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
      if (this.newjugador.fecha_nacimiento == '') {
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
      if (this.newjugador.categoria == '') {
        this.$toast.error("Selecciona una Categoria", {
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
      if (this.newjugador.acta_nacimiento == '') {
        this.$toast.error("Añade la Acta de Nacimiento", {
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
      if (this.newjugador.curp == '') {
        this.$toast.error("Añade la Curp", {
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
      if (this.newjugador.identificacion == '') {
        this.$toast.error("Añade la Identificación", {
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
        formData.append('foto',this.newjugador.foto);
        formData.append('nombre',this.newjugador.nombre);
        formData.append('fecha_nacimiento',this.newjugador.fecha_nacimiento);
        formData.append('edad',this.newjugador.edad);
        formData.append('posicion',this.newjugador.posicion);
        formData.append('sexo',this.newjugador.sexo);
        formData.append('categoria',this.newjugador.categoria);
        formData.append('sede',this.newjugador.sede);
        formData.append('acta_nacimiento',this.newjugador.acta_nacimiento);
        formData.append('curp',this.newjugador.curp);
        formData.append('identificacion',this.newjugador.identificacion);
      axios.post('jugadores/createJugador',formData).then(response=>{
        this.getJugador();
        $('#createJugador').modal('hide');
        this.newjugador = {
          foto:'',
          nombre:'',
          fecha_nacimiento:'',
          edad:'',
          posicion:'',
          sexo:'',
          apodo:'',
          categoria:'Selecciona una Categoria',
          sede:this.sede,
          acta_nacimiento:'',
          curp:'',
          identificacion:''
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
      this.newjugador.foto = fileedit
    },
    onChangeActa(){
      var actafile = this.$refs.fileActa.files[0];
      this.newjugador.acta_nacimiento = actafile
    },
    onChangeCurp(){
      var curpfile = this.$refs.fileCurp.files[0];
      this.newjugador.curp = curpfile
    },
    onChangeIdentificacion(){
      var idenfile = this.$refs.fileIdent.files[0];
      this.newjugador.identificacion = idenfile
    },
    infoJugador(jur){
      this.detalleJugador = jur;
    },
    EditarJugador(){
      if (this.detalleJugador.foto == '') {
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
      if (this.detalleJugador.nombre == '') {
        this.$toast.error("Ingresa el Nombre", {
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
      if (this.detalleJugador.fecha_nacimiento == '') {
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
      if (this.detalleJugador.categoria == '') {
        this.$toast.error("Selecciona una Categoria", {
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
      if (this.detalleJugador.acta_nacimiento == '') {
        this.$toast.error("Añade la Acta de Nacimiento", {
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
      if (this.detalleJugador.curp == '') {
        this.$toast.error("Añade la Curp", {
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
      if (this.detalleJugador.identificacion == '') {
        this.$toast.error("Añade la Identificación", {
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
        formData.append('id_jugador',this.detalleJugador.id_jugador);
        formData.append('foto',this.detalleJugador.foto);
        formData.append('nombre',this.detalleJugador.nombre);
        formData.append('fecha_nacimiento',this.detalleJugador.fecha_nacimiento);
        formData.append('edad',this.detalleJugador.edad);
        formData.append('posicion',this.detalleJugador.posicion);
        formData.append('sexo',this.detalleJugador.sexo);
        formData.append('categoria',this.detalleJugador.categoria);
        for (let i = 0; i < this.detalleJugador.documentacion.length; i++) {
          formData.append(`documentacion[${i}][archivo]`, this.detalleJugador.documentacion[i].archivo);
          formData.append(`documentacion[${i}][tipo]`, this.detalleJugador.documentacion[i].tipo);
        }
      axios.post('jugadores/updateJugador',formData).then(response=>{
        this.getJugador();
        this.submenuUpdate = false;
        $('#editJugador').modal('hide');
    
        Swal.fire({
          title: 'Exitoso',
          text: "Se Edito correctamente!",
          icon: 'success',
          showConfirmButton: false,
          timer: 2500,
        });
      })
    },
    onChangeFotoUpdate(){
      var fileeditupdate = this.$refs.fileFotoupdates.files[0];
      this.detalleJugador.foto = fileeditupdate
    },
    onChangeArchivoUpdate(index,arch){
    
    const fileInput = this.$refs[`fileArch${index}`][0];
    if (fileInput && fileInput.files.length > 0) {
      var file = fileInput.files[0];
      arch.archivo = file;
    }
        
    },
    newArch(){
        const nuevo = {
          id_docu_jugador:'',
          archivo:'',
          tipo:'Selecciona una Opción'
        }
        this.detalleJugador.documentacion.push(nuevo);
    },
    deleteArchivo(index,arch){
      this.id = arch.id_docu_jugador;
      if (arch.id_docu_jugador == '') {
        this.detalleJugador.documentacion.splice(index, 1);
      } else {
        axios.post(`jugadores/deleteArchivo/${this.id}`).then(res =>{
          this.detalleJugador.documentacion.splice(index, 1);
        })
      }
    },
    newTutor(){
      let formData = new FormData();
        formData.append('id_jugador',this.detalleJugador.id_jugador);
        formData.append('tutor',this.detalleJugador.tutor);
        formData.append('correo',this.detalleJugador.correo);
        formData.append('direccion',this.detalleJugador.direccion);
        formData.append('telefono',this.detalleJugador.telefono);
      axios.post('jugadores/createTutor',formData).then(response =>{
        this.showCard(null);
        Swal.fire({
          title: 'Exitoso',
          text: "Se Guardo correctamente!",
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