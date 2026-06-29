<template>
    <div>
      <!-- vista de jugadores -->
      <div id="main" v-if="this.vista == 0">
        <div class="row g-6">
          <div class="col-12">
            <div class="card shadow-sm border-0" style="border-radius: 12px; overflow: hidden;">

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
              <div class="table-responsive text-nowrap px-0 pb-2">
                <table class="table table-hover align-middle mb-0" style="font-size: 14px;">
                  <thead class="table-light">
                    <tr style="color: #64748b; font-weight: 600; font-size: 12.5px; text-transform: uppercase; letter-spacing: 0.5px;">
                      <th class="ps-4">Dorsal</th>
                      <th>Foto</th>
                      <th>Nombre</th>
                      <th>Categoría</th>
                      <th>Posición</th>
                      <th>Sexo</th>
                      <th>Sede</th>
                      <th>Información</th>
                      <th>Estatus</th>
                      <th class="text-center pe-4">Acciones</th>
                    </tr>
                  </thead>
                    <tbody class="border-top-0">
                        <tr v-for="(jur, index) in Jugadores" :key="index">
                            <td class="ps-4 fw-medium text-secondary">{{ jur.num_dorsal }}</td>
                            
                            <td>
                              <div style="width: 38px; height: 38px; border-radius: 50%; overflow: hidden; border: 2px solid #e2e8f0; background-color: #f8fafc;">
                                <img :src="`ArchivosSistema/Jugadores/${jur.id_jugador}/${jur.foto}`" alt="Avatar" @error="(event)=>onImageError(event)" style="width: 100%; height: 100%; object-fit: cover; display: block;" />
                              </div>
                            </td>
                            
                            <td class="fw-bold" style="color: #334155;">{{ jur.nombre }}</td>
                            <td>{{ jur.categoria }}</td>
                            <td>{{ jur.posicion }}</td>
                            <td>{{ jur.sexo }}</td>
                            <td>{{ jur.sede }}</td>
                            <td><span :class="`badge rounded-pill ${jur.color_info}`" style="padding: 0.5em 0.85em; font-weight: 500; letter-spacing: 0.3px;">{{ jur.text_info }}</span></td>
                            <td><span :class="`badge rounded-pill ${jur.color}`" style="padding: 0.5em 0.85em; font-weight: 500; letter-spacing: 0.3px;">{{ jur.text }}</span></td>
                            
                            <td class="text-center pe-4">
                                <div class="d-flex justify-content-center gap-2">
                                    
                                    <button type="button" class="btn btn-sm btn-light text-info border-0" title="Visualizar" v-if="include('Vizualizar')" @click="infoJugador(jur); muestra(1)" style="background: #e0f2fe; width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: 6px;">
                                        <i class="ri-clipboard-line" style="font-size: 16px;"></i>
                                    </button>
                                    
                                    <button type="button" class="btn btn-sm btn-light text-primary border-0" title="Editar" v-if="include('Editar')" data-bs-toggle="modal" data-bs-target="#editJugador" @click="infoJugador(jur)" style="background: #e0e7ff; width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: 6px;">
                                        <i class="ri-pencil-line" style="font-size: 16px;"></i>
                                    </button>
                                    
                                    <button type="button" class="btn btn-sm btn-light text-success border-0" title="Activar" v-if="include('Permisos') && jur.estatus == 1" @click="cambioEstatus(jur)" style="background: #dcfce7; width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: 6px;">
                                        <i class="ri-checkbox-circle-fill" style="font-size: 16px;"></i>
                                    </button>
                                    
                                    <button type="button" class="btn btn-sm btn-light text-warning border-0" title="Desactivar" v-if="include('Permisos') && jur.estatus == 0" @click="cambioEstatus(jur)" style="background: #fef3c7; width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: 6px;">
                                        <i class="ri-close-circle-fill" style="font-size: 16px;"></i>
                                    </button>
                                    
                                    <button type="button" class="btn btn-sm btn-light text-danger border-0" title="Eliminar" v-if="include('Eliminar')" @click="deleteJugador(jur)" style="background: #fee2e2; width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: 6px;">
                                        <i class="ri-delete-bin-7-line" style="font-size: 16px;"></i>
                                    </button>

                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
              </div>

              <div class="card-footer bg-white border-top-0 pt-2 pb-4">
                <nav aria-label="Navegación de páginas">
                  <ul class="pagination justify-content-center mb-0" style="gap: 5px;">
                    <li class="page-item disabled" v-if="pagination.current_page > 1">
                      <a @click.prevent="changePage(pagination.current_page - 1)" class="page-link border-0 shadow-sm rounded" href="#" tabindex="-1" aria-disabled="true" style="color: #64748b;">Anterior</a>
                    </li>
                    <li class="page-item" v-for="(page, index) in pageNumber" :key="index" @click.prevent="changePage(page)" v-bind:class="[ page == isActived ? 'active' : 'waves-effect']">
                      <a class="page-link border-0 shadow-sm rounded" href="#" :style="page == isActived ? 'background-color: #198754; color: white;' : 'color: #334155;'">{{ page }}</a>
                    </li>
                    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                      <a @click.prevent="changePage(pagination.current_page + 1)" class="page-link border-0 shadow-sm rounded" href="#" style="color: #64748b;">Siguiente</a>
                    </li>
                  </ul>
                </nav>
              </div>
                
            </div>
          </div>
        </div>
      </div>

      <!-- vista de detalle jugador-->
      <div id="main" v-if="vista === 1">
        <div class="container-xxl flex-grow-1 container-p-y">
          
          <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6">
            <div class="d-flex flex-column justify-content-center">
              <h4 class="mb-1 mt-3">Perfil del Jugador</h4>
              <p class="text-muted">Gestiona la información, documentos y tutor del jugador.</p>
            </div>
            <div class="d-flex align-content-center flex-wrap gap-2">
              <button class="btn btn-outline-danger waves-effect" @click="muestra(0)">
                <i class="ri-arrow-left-line me-2"></i>Regresar
              </button>
            </div>
          </div>

          <div class="row gy-6 gy-md-0">
            
            <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
              <div class="card mb-6 shadow-sm border-0">
                <div class="card-body pt-12">
                  <div class="user-avatar-section">
                    <div class="d-flex align-items-center flex-column text-center">
                      <img
                        class="img-fluid rounded-circle mb-4 border border-4 border-white shadow-sm"
                        :src="`ArchivosSistema/Jugadores/${detalleJugador.id_jugador}/${detalleJugador.foto}`"
                        height="120"
                        width="120"
                        alt="Avatar del Jugador" 
                        style="width: 120px; height: 120px; object-fit: cover;"
                      />
                      <div class="user-info">
                        <h4 class="mb-2 fw-bold">{{ detalleJugador.nombre }}</h4>
                        <span class="badge bg-label-dark rounded-pill px-3 py-2">{{ detalleJugador.categoria }}</span>
                      </div>
                    </div>
                  </div>
                  
                  <hr class="my-5" />
                  
                  <div class="d-flex justify-content-around flex-wrap text-center gap-2">
                    <div class="px-2">
                      <div class="avatar avatar-md mx-auto mb-2">
                        <div class="avatar-initial bg-label-primary rounded-circle">
                          <i class="ri-football-line ri-24px"></i>
                        </div>
                      </div>
                      <h6 class="mb-0 fw-semibold">{{ detalleJugador.posicion }}</h6>
                      <small class="text-muted">Posición</small>
                    </div>
                    <div class="px-2">
                      <div class="avatar avatar-md mx-auto mb-2">
                        <div class="avatar-initial bg-label-info rounded-circle">
                          <i class="ri-user-smile-line ri-24px"></i>
                        </div>
                      </div>
                      <h6 class="mb-0 fw-semibold">{{ detalleJugador.sexo }}</h6>
                      <small class="text-muted">Sexo</small>
                    </div>
                    <div class="px-2">
                      <div class="avatar avatar-md mx-auto mb-2">
                        <div class="avatar-initial bg-label-success rounded-circle">
                          <i class="ri-calendar-event-line ri-24px"></i>
                        </div>
                      </div>
                      <h6 class="mb-0 fw-semibold">{{ detalleJugador.edad }} años</h6>
                      <small class="text-muted">Edad</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
              <div class="nav-align-top mb-6">
                <ul class="nav nav-pills flex-column flex-md-row gap-2 shadow-sm p-2 bg-white rounded-3">
                  <li class="nav-item">
                    <button class="nav-link w-100 text-start" :class="{ 'active': activeView === null }" @click="showCard(null)">
                      <i class="ri-user-3-line me-2"></i>Información
                    </button>
                  </li>
                  <li class="nav-item">
                    <button class="nav-link w-100 text-start" :class="{ 'active': activeView === 'exp' }" @click="showCard('exp')">
                      <i class="ri-folder-open-line me-2"></i>Documentación
                    </button>
                  </li>
                  <li class="nav-item">
                    <button class="nav-link w-100 text-start" :class="{ 'active': activeView === 'tutor' }" @click="showCard('tutor')">
                      <i class="ri-parent-line me-2"></i>Info Tutor
                    </button>
                  </li>
                </ul>
              </div>

              <div class="card mb-6 shadow-sm border-0" v-if="activeView === null">
                <div class="card-header bg-transparent border-bottom">
                  <h5 class="mb-0 fw-bold"><i class="ri-file-info-line me-2 text-primary"></i>Detalles Generales</h5>
                </div>
                <div class="card-body pt-4">
                  <div class="row g-4">
                    <div class="col-12 col-md-6 d-flex align-items-center">
                      <div class="avatar me-3">
                        <div class="avatar-initial bg-label-success rounded"><i class="ri-hashtag"></i></div>
                      </div>
                      <div>
                        <small class="text-muted d-block">Folio</small>
                        <span class="fw-semibold">{{ detalleJugador.folio }}</span>
                      </div>
                    </div>
                    <div class="col-12 col-md-6 d-flex align-items-center">
                      <div class="avatar me-3">
                        <div class="avatar-initial bg-label-primary rounded"><i class="ri-calendar-fill"></i></div>
                      </div>
                      <div>
                        <small class="text-muted d-block">Fecha de Nacimiento</small>
                        <span class="fw-semibold">{{ detalleJugador.fecha_nacimiento }}</span>
                      </div>
                    </div>
                    <div class="col-12 col-md-6 d-flex align-items-center">
                      <div class="avatar me-3">
                        <div class="avatar-initial bg-label-primary rounded"><i class="ri-phone-fill"></i></div>
                      </div>
                      <div>
                        <small class="text-muted d-block">Teléfono</small>
                        <span class="fw-semibold">{{ detalleJugador.telefono }}</span>
                      </div>
                    </div>
                    <div class="col-12 col-md-6 d-flex align-items-center">
                      <div class="avatar me-3">
                        <div class="avatar-initial bg-label-primary rounded"><i class="ri-mail-line"></i></div>
                      </div>
                      <div>
                        <small class="text-muted d-block">Correo</small>
                        <span class="fw-semibold">{{ detalleJugador.correo }}</span>
                      </div>
                    </div>
                    <div class="col-12 d-flex align-items-center">
                      <div class="avatar me-3">
                        <div class="avatar-initial bg-label-primary rounded"><i class="ri-map-pin-2-line"></i></div>
                      </div>
                      <div>
                        <small class="text-muted d-block">Dirección</small>
                        <span class="fw-semibold">{{ detalleJugador.direccion }}</span>
                      </div>
                    </div>
                    <div class="col-12 col-md-6 d-flex align-items-center">
                      <div class="avatar me-3">
                        <div class="avatar-initial bg-label-warning rounded"><i class="ri-exchange-funds-line"></i></div>
                      </div>
                      <div>
                        <small class="text-muted d-block">Estatus de Préstamo</small>
                        <span class="badge bg-label-success" v-if="detalleJugador.prestamo == 1">En Préstamo</span>
                        <span class="badge bg-label-secondary" v-else>Sin Préstamo</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card mb-6 shadow-sm border-0" v-if="activeView === 'exp'">
                <div class="card-header bg-transparent border-bottom">
                  <h5 class="mb-0 fw-bold"><i class="ri-folder-shield-2-line me-2 text-primary"></i>Archivos del Jugador</h5>
                </div>
                <div class="table-responsive">
                  <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                      <tr>
                        <th scope="col" class="text-center" width="10%">#</th>
                        <th scope="col" width="60%">Tipo de Documento</th>
                        <th scope="col" class="text-center" width="30%">Acción</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <tr v-for="(arch, index) in detalleJugador.documentacion" :key="index">
                        <td class="text-center fw-medium">{{ index + 1 }}</td>
                        <td>
                          <span class="fw-semibold text-dark">{{ arch.tipo }}</span>
                        </td>
                        <td class="text-center">
                          <a class="btn btn-sm btn-outline-primary rounded-pill waves-effect d-inline-flex align-items-center"
                            target="_blank" 
                            :href="`ArchivosSistema/Jugadores/${arch.id_jugador}/${arch.archivo}`" 
                            onclick="window.open(this.href, this.target, 'width=800,height=800');return false;">
                            <i class="ri-eye-line me-1"></i> Ver PDF
                          </a>
                        </td>
                      </tr>
                      <tr v-if="!detalleJugador.documentacion || detalleJugador.documentacion.length === 0">
                        <td colspan="3" class="text-center py-5 text-muted">
                          <i class="ri-file-unknow-line ri-3x mb-2 d-block text-light"></i>
                          No hay documentos adjuntos.
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="card mb-6 shadow-sm border-0" v-if="activeView === 'tutor'">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center bg-transparent border-bottom py-3">
                  <h5 class="mb-0 fw-bold"><i class="ri-shield-user-line me-2 text-primary"></i>Información del Tutor</h5>
                  
                  <button v-if="stepTutor === 0" type="button" class="btn btn-primary btn-sm waves-effect shadow-sm" @click="cambiarModo(1)">
                      <i class="ri-edit-2-line me-1"></i> Editar
                  </button>
                  <button v-if="stepTutor === 1" type="button" class="btn btn-outline-secondary btn-sm waves-effect" @click="cambiarModo(0)">
                    Cancelar
                  </button>
                </div>

                <div class="card-body pt-4">
                  <form>
                    <div class="row g-4">
                      <div class="col-12 col-md-6">
                        <div class="form-floating form-floating-outline">
                          <input type="text" id="tutor-name" class="form-control" placeholder="Nombre completo" 
                                v-model="detalleJugador.tutor" 
                                :disabled="stepTutor === 0" />
                          <label for="tutor-name">Nombre del Tutor</label>
                        </div>
                      </div>

                      <div class="col-12 col-md-6">
                        <div class="form-floating form-floating-outline">
                          <input type="tel" id="tutor-phone" class="form-control phone-mask" placeholder="658 799 8941" 
                                v-model="detalleJugador.telefono" 
                                :disabled="stepTutor === 0" />
                          <label for="tutor-phone">Teléfono</label>
                        </div>
                      </div>

                      <div class="col-12 col-md-6">
                        <div class="form-floating form-floating-outline">
                          <input type="email" id="tutor-email" class="form-control" placeholder="correo@ejemplo.com" 
                                v-model="detalleJugador.correo" 
                                :disabled="stepTutor === 0" />
                          <label for="tutor-email">Email</label>
                        </div>
                      </div>

                      <div class="col-12 col-md-6">
                        <div class="form-floating form-floating-outline">
                          <input type="text" id="tutor-address" class="form-control" placeholder="Dirección completa" 
                                v-model="detalleJugador.direccion" 
                                :disabled="stepTutor === 0" />
                          <label for="tutor-address">Dirección</label>
                        </div>
                      </div>

                      <div class="col-12 mt-4">
                        <div v-if="stepTutor === 0">
                          <label class="d-block fw-semibold mb-2 text-dark">Formato de Consentimiento</label>
                          <a v-if="detalleJugador.formato" 
                            class="btn btn-outline-primary waves-effect d-inline-flex align-items-center" 
                            target="_blank" 
                            :href="`ArchivosSistema/Jugadores/${detalleJugador.id_jugador}/${detalleJugador.formato}`" 
                            onclick="window.open(this.href, this.target, 'width=800,height=800'); return false;">
                              <i class="ri-file-pdf-line me-2 fs-5"></i> Ver Documento
                          </a>
                          <div v-else class="alert alert-warning d-inline-flex align-items-center py-2 px-3 mb-0 shadow-none">
                              <i class="ri-error-warning-line me-2 fs-5"></i> 
                              <span style="font-size: 0.9rem;">Archivo no adjuntado</span>
                          </div>
                        </div>

                        <div v-else class="p-4 bg-label-secondary rounded-3 border-dashed">
                            <label class="form-label fw-bold text-dark mb-2">Actualizar Formato de Consentimiento</label>
                            <input type="file" accept=".pdf" class="form-control mb-1" id="upload-acta" ref="carta" @change="onChangeFormato()">
                            <div class="form-text mt-2">
                                <i class="ri-information-line me-1"></i> Solo se permiten archivos PDF.
                            </div>
                        </div>
                      </div>
                    </div>

                    <div class="mt-5 text-end border-top pt-4" v-if="stepTutor === 1">
                        <button type="button" class="btn btn-success px-4 waves-effect shadow-sm" @click="newTutor()">
                            <i class="ri-save-3-line me-2"></i> Guardar Cambios
                        </button>
                    </div>
                  </form>
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
              <form id="addNewAddressForm" class="row g-5" onsubmit="return false" v-show="this.step == 0">
                <div class="col-12">
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
                <div class="col-12 col-lg-6">
                  <div class="input-group input-group-merge">
                    <div class="form-floating form-floating-outline">
                      <input
                        type="date"
                        id="fecha"
                        class="form-control"
                        v-model="newjugador.fecha_nacimiento" @change="mostrarEdad(newjugador.fecha_nacimiento)"/>
                      <label for="fecha">Fecha de Nacimiento</label>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-lg-6">
                  <div class="form-floating form-floating-outline">
                    <input
                      type="number"
                      id="edad"
                      class="form-control"
                      v-model="newjugador.edad" disabled/>
                    <label for="edad">Edad</label>
                  </div>
                </div>
                <div class="col-12 col-lg-6">
                  <div class="form-floating form-floating-outline">
                    <select id="posicion" name="posicion" class="form-select" v-model="newjugador.posicion">
                      <option value="Selecciona una Posición">Selecciona una Posición</option>
                      <option value="Delantero">Delantero</option>
                      <option value="Medio">Medio</option>
                      <option value="Defensa">Defensa</option>
                      <option value="Portero">Portero</option>
                    </select>
                    <label for="posicion">Posición</label>
                  </div>
                </div>
                <div class="col-12 col-lg-6">
                  <div class="form-floating form-floating-outline">
                    <select id="sexo" name="sexo" class="form-select" v-model="newjugador.sexo">
                      <option value="Selecciona el Sexo">Selecciona el Sexo</option>
                      <option value="Masculino">Masculino</option>
                      <option value="Femenino">Femenino</option>
                    </select>
                    <label for="sexo">Sexo</label>
                  </div>
                </div>
                <div class="col-12 col-lg-6">
                  <div class="form-floating form-floating-outline">
                    <select id="categoria" name="categoria" class="form-select" v-model="newjugador.categoria">
                      <option value="Selecciona una Categoria">Selecciona una Categoria</option>
                      <option value="Categoria 2009">Categoria 2009</option>
                      <option value="Categoria 2010">Categoria 2010</option>
                      <option value="Categoria 2011">Categoria 2011</option>
                      <option value="Categoria 2012">Categoria 2012</option>
                      <option value="Categoria 2013">Categoria 2013</option>
                      <option value="Categoria 2014">Categoria 2014</option>
                      <option value="Categoria 2015">Categoria 2015</option>
                      <option value="Categoria 2016">Categoria 2016</option>
                      <option value="Categoria 2017">Categoria 2017</option>
                    </select>
                    <label for="categoria">Categoria</label>
                  </div>
                </div>
                <div class="col-12 col-lg-6">
                  <div class="form-floating form-floating-outline">
                    <input
                      type="text"
                      id="sede"
                      class="form-control"
                      v-model="newjugador.sede" disabled/>
                    <label for="sede">Sede</label>
                  </div>
                </div>
                <!-- <div class="col-12 col-lg-6">
                  <div class="form-check form-switch mt-2">
                    <input type="checkbox" class="form-check-input" id="prestamo4545" v-model="newjugador.prestamo"/>
                    <label for="prestamo4545" class="text-heading">Opción a Prestamo?</label>
                  </div>
                </div> -->
                <div class="col-12 col-lg-6">
                  <div class="form-floating form-floating-outline">
                    <input type="number" id="num_dorsal" class="form-control" v-model="newjugador.num_dorsal" />
                    <label for="num_dorsal">Número Dorsal</label>
                  </div>
                  <p style="color: red;" v-if="this.NombreJugador != false">El Dorsal <b>{{ this.newjugador.num_dorsal }}</b> ya fue asignado al Jugador: <b>{{this.NombreJugador}}</b></p>
                </div>
                <div class="col-12 d-flex justify-content-between mt-6">
                  <button class="btn btn-outline-secondary" disabled>
                    <i class="ri-arrow-left-line ri-16px"></i>
                    <span class="align-middle d-sm-block d-none ms-2">Anterior</span>
                  </button>
                  <button class="btn btn-success" @click="validacionAltaJugador(0)">
                    <span class="align-middle d-sm-block d-none me-2">Siguiente</span>
                    <i class="ri-arrow-right-line ri-16px"></i>
                  </button>
                </div>
              </form>
              <form id="addNewAddressForm" class="row g-5" onsubmit="return false" v-show="this.step == 1">
                <div class="card-body">
                  <div class="d-flex align-items-start align-items-sm-center gap-6">
                    <img src="style/assets/img/avatars/1.png" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded-4" id="uploadedAvatar" v-if="this.imagenMiniatura == ''"/>
                    <img :src="this.imagenMiniatura" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded-4" id="uploadedAvatar" v-else/>
                    <div class="button-wrapper">
                      <label for="upload" class="btn btn-primary me-3 mb-4" tabindex="0">
                        <span class="d-none d-sm-block">Sube una Foto</span>
                        <i class="ri-upload-2-line d-block d-sm-none"></i>
                        <input type="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg, image/jpg" ref="fileFoto" @change="onChangeFoto()"/>
                      </label>
                      <div>JPG, JPEG o PNG.</div>
                    </div>
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-floating form-floating-outline">
                    <input type="file"  accept=".pdf,.jpeg" class="form-control" id="bs-validation-upload-file_acta" ref="fileActa" @change="onChangeActa()">
                    <label for="bs-validation-upload-file_acta">Acta de Nacimiento</label>
                  </div>
                  <p style="color: red;">*** Solo se permiten archivos PDF y.JPEG ***</p>
                </div>
                <div class="col-12">
                  <div class="form-floating form-floating-outline">
                    <input type="file" accept=".pdf,.jpeg" class="form-control" id="bs-validation-upload-file_curp" ref="fileCurp" @change="onChangeCurp()">
                    <label for="bs-validation-upload-file_curp">Curp</label>
                  </div>
                  <p style="color: red;">*** Solo se permiten archivos PDF y.JPEG ***</p>
                </div>
                <div class="col-12">
                  <div class="form-floating form-floating-outline">
                    <input type="file" accept=".pdf,.jpeg" class="form-control" id="bs-validation-upload-file_ident" ref="fileIdent" @change="onChangeIdentificacion()">
                    <label for="bs-validation-upload-file_ident">Identificación</label>
                  </div>
                  <p style="color: red;">*** Solo se permiten archivos PDF y.JPEG ***</p>
                </div>
                <div class="col-12 d-flex justify-content-between mt-6">
                  <button class="btn btn-outline-secondary" @click="goPrevStep()">
                    <i class="ri-arrow-left-line ri-16px"></i>
                    <span class="align-middle d-sm-block d-none ms-2">Anterior</span>
                  </button>
                  <button class="btn btn-success" @click="validacionAltaJugador(1)">
                    <span class="align-middle d-sm-block d-none me-2">Siguiente</span>
                    <i class="ri-arrow-right-line ri-16px"></i>
                  </button>
                </div>
              </form>
              <form id="addNewAddressForm" class="row g-5" onsubmit="return false" v-show="this.step == 2">
                <div class="col-12">
                  <div class="form-floating form-floating-outline">
                    <input
                      type="text"
                      id="tutor"
                      class="form-control"
                      v-model="newjugador.tutor"
                      placeholder="Nombre Tutor"/>
                    <label for="tutor">Nombre Tutor</label>
                  </div>
                </div>
                <div class="col-12 col-lg-12">
                  <div class="input-group input-group-merge">
                    <div class="form-floating form-floating-outline">
                      <input
                        type="text"
                        id="direccion"
                        class="form-control"
                        placeholder="Ingresa una Dirección"
                        v-model="newjugador.direccion"/>
                      <label for="direccion">Dirección</label>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-lg-6">
                  <div class="form-floating form-floating-outline">
                    <input
                      type="email"
                      id="correo"
                      class="form-control"
                      placeholder="ejemplo@gmail.com"
                      v-model="newjugador.correo"/>
                    <label for="correo">Email</label>
                  </div>
                </div>
                <div class="col-12 col-lg-6">
                  <div class="form-floating form-floating-outline">
                    <input
                      type="number"
                      id="telefono"
                      class="form-control"
                      v-model="newjugador.telefono"/>
                    <label for="telefono">Telefono</label>
                  </div>
                </div>
                <div class="col-12 d-flex justify-content-between mt-6">
                  <button class="btn btn-outline-secondary" @click="goPrevStep()">
                    <i class="ri-arrow-left-line ri-16px"></i>
                    <span class="align-middle d-sm-block d-none ms-2">Anterior</span>
                  </button>
                  <button class="btn btn-success" @click="agregaJugador()">
                    <span class="align-middle d-sm-block d-none me-2">Guardar</span>
                    <i class="ri-save-3-fill ri-16px"></i>
                  </button>
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
              <form id="addNewAddressForm" class="row g-5" onsubmit="return false" v-show="this.stepUpdate == 0">
                <div class="card-body">
                  <div class="d-flex align-items-start align-items-sm-center gap-6">
                    <img :src="`ArchivosSistema/Jugadores/${detalleJugador.id_jugador}/${detalleJugador.foto}`" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded-4" id="uploadedAvatar" @error="(event)=>onImageError(event)" v-if="this.imagenMiniaturaUpdate == ''"/>
                    <img :src="this.imagenMiniaturaUpdate" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded-4" id="uploadedAvatar" v-else/>
                    <div class="button-wrapper">
                      <label for="upload_new" class="btn btn-primary me-3 mb-4" tabindex="0">
                        <span class="d-none d-sm-block">Sube una Foto</span>
                        <i class="ri-upload-2-line d-block d-sm-none"></i>
                        <input type="file" id="upload_new" class="account-file-input" hidden accept="image/png, image/jpeg" ref="fileFotoupdates" @change="onChangeFotoUpdate()"/>
                      </label>
                      <div>JPG permitido,o PNG.</div>
                    </div>
                  </div>
                </div>
                <div class="col-12">
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
                <div class="col-12 col-lg-6">
                  <div class="input-group input-group-merge">
                    <div class="form-floating form-floating-outline">
                      <input
                        type="date"
                        id="fecha"
                        class="form-control"
                        v-model="detalleJugador.fecha_nacimiento" @change="mostrarEdad(detalleJugador.fecha_nacimiento)"/>
                      <label for="fecha">Fecha de Nacimiento</label>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-lg-6">
                  <div class="form-floating form-floating-outline">
                    <input
                      type="number"
                      id="edad"
                      class="form-control"
                      v-model="detalleJugador.edad" disabled/>
                    <label for="edad">Edad</label>
                  </div>
                </div>
                <div class="col-12 col-lg-6">
                  <div class="form-floating form-floating-outline">
                    <select id="posicion" name="posicion" class="form-select" v-model="detalleJugador.posicion">
                      <option value="Selecciona una Posición">Selecciona una Posición</option>
                      <option value="Delantero">Delantero</option>
                      <option value="Medio">Medio</option>
                      <option value="Defensa">Defensa</option>
                      <option value="Portero">Portero</option>
                    </select>
                    <label for="posicion">Posición</label>
                  </div>
                </div>
                <div class="col-12 col-lg-6">
                  <div class="form-floating form-floating-outline">
                    <select id="sexo" name="sexo" class="form-select" v-model="detalleJugador.sexo">
                      <option value="Selecciona el Sexo">Selecciona el Sexo</option>
                      <option value="Masculino">Masculino</option>
                      <option value="Femenino">Femenino</option>
                    </select>
                    <label for="sexo">Sexo</label>
                  </div>
                </div>
                <div class="col-12 col-lg-6">
                  <div class="form-floating form-floating-outline">
                    <select id="categoria" name="categoria" class="form-select" v-model="detalleJugador.categoria">
                      <option value="Selecciona una Categoria">Selecciona una Categoria</option>
                      <option value="Categoria 2009">Categoria 2009</option>
                      <option value="Categoria 2010">Categoria 2010</option>
                      <option value="Categoria 2011">Categoria 2011</option>
                      <option value="Categoria 2012">Categoria 2012</option>
                      <option value="Categoria 2013">Categoria 2013</option>
                      <option value="Categoria 2014">Categoria 2014</option>
                      <option value="Categoria 2015">Categoria 2015</option>
                      <option value="Categoria 2016">Categoria 2016</option>
                      <option value="Categoria 2017">Categoria 2017</option>
                    </select>
                    <label for="categoria">Categoria</label>
                  </div>
                </div>
                <div class="col-12 col-lg-6">
                  <div class="form-floating form-floating-outline">
                    <input
                      type="text"
                      id="sede"
                      class="form-control"
                      v-model="detalleJugador.sede" disabled/>
                    <label for="sede">Sede</label>
                  </div>
                </div>
                <!-- <div class="col-12 col-lg-6">
                  <div class="form-check form-switch mt-2">
                    <input type="checkbox" class="form-check-input" id="prestamo4578" v-model="detalleJugador.prestamo"/>
                    <label for="prestamo4578" class="text-heading">Opción a Prestamo?</label>
                  </div>
                </div> -->
                <div class="col-12 col-lg-6">
                  <div class="form-floating form-floating-outline">
                    <input type="number" id="num_dorsal" class="form-control" v-model="detalleJugador.num_dorsal" />
                    <label for="num_dorsal">Número Dorsal</label>
                  </div>
                  <p style="color: red;" v-if="this.NombreJugador != false">El Dorsal <b>{{ this.detalleJugador.num_dorsal }}</b> ya fue asignado al Jugador: <b>{{this.NombreJugador}}</b></p>
                </div>
                <div class="col-12 d-flex justify-content-between mt-6">
                  <button class="btn btn-outline-secondary" disabled>
                    <i class="ri-arrow-left-line ri-16px"></i>
                    <span class="align-middle d-sm-block d-none ms-2">Anterior</span>
                  </button>
                  <button class="btn btn-success" @click="goNextStepUp()">
                    <span class="align-middle d-sm-block d-none me-2">Siguiente</span>
                    <i class="ri-arrow-right-line ri-16px"></i>
                  </button>
                </div>
              </form>
              <form id="addNewAddressForm" class="row g-5" onsubmit="return false" v-show="this.stepUpdate == 1">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
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
                            <input type="file" accept=".pdf,.jpeg" class="form-control" :id="`bs-validation-upload-fileupdate${index}`" :ref="`fileArch${index}`" @change="onChangeArchivoUpdate(index,arch)">
                            <label :for="`bs-validation-upload-fileupdate${index}`">Archivo</label>
                          </div>
                        </td>
                        <td v-else>
                          <a class="btn btn-icon rounded-pill btn-outline-youtube waves-effect"
                            target="_blank" :href="`ArchivosSistema/Jugadores/${arch.id_jugador}/${arch.archivo}`" onclick="window.open(this.href, this.target, 'width=650,height=650');return false;">
                            <i class="tf-icons ri-contract-line ri-22px"></i>
                          </a>
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
                <div class="col-12 d-flex justify-content-between mt-6">
                  <button class="btn btn-outline-secondary" @click="goPrevStepUp()">
                    <i class="ri-arrow-left-line ri-16px"></i>
                    <span class="align-middle d-sm-block d-none ms-2">Anterior</span>
                  </button>
                  <button class="btn btn-success" @click="EditarJugador()">
                    <span class="align-middle d-sm-block d-none me-2">Editar</span>
                    <i class="ri-save-3-fill ri-16px"></i>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      
      <br><br><br><br><br><br><br><br>
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
        edad:0,
        posicion:'Selecciona una Posición',
        sexo:'Selecciona el Sexo',
        prestamo:false,
        apodo:'',
        categoria:'Selecciona una Categoria',
        sede:this.sede,
        acta_nacimiento:'',
        curp:'',
        identificacion:'',
        tutor:'',
        correo:'',
        direccion:'',
        telefono:''
      },
      imagenMiniatura:'',
      imagenMiniaturaUpdate:'',
      Jugadores:[],
      step:0,
      stepUpdate:0,
      stepTutor:0,
      detalleJugador:[],
      activeView:null,
      DorsalExistente:false,
      NombreJugador:'',
      pagination: {
        'total': 0,
        'current_page': 0,
        'per_page': 0,
        'last_page': 0,
        'from': 0,
        'to': 0
      },
      backupImageSrc: 'style/logos/sinfoto.png',
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
    onImageError(event) {
      event.target.src = this.backupImageSrc;
    },
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
    goPrevStep() {
      this.step--;
    },
    goNextStep() {
      this.step++;
    },
    goPrevStepUp() {
      this.stepUpdate--;
    },
    goNextStepUp() {
      this.stepUpdate++;
    },
    validacionAltaJugador(value){
      if (value == 0) {
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
        if (this.newjugador.posicion == 'Selecciona una Posición') {
          this.$toast.error("Selecciona una Posición", {
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
        if (this.newjugador.sexo == 'Selecciona el Sexo') {
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
        if (this.newjugador.num_dorsal == '') {
          this.$toast.error("Ingresa un Dorsal", {
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
        this.goNextStep();
      }
      if (value == 1) {
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
        this.goNextStep();
      }

      
    },
    agregaJugador(){  
      if (this.newjugador.tutor == '') {
        this.$toast.error("Ingresa el Nombre del Padre o Tutor", {
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
      if (this.newjugador.direccion == '') {
        this.$toast.error("Ingresa una direccion", {
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
      if (this.newjugador.correo == '') {
        this.$toast.error("Ingresaun correo", {
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
      if (this.newjugador.telefono == '') {
        this.$toast.error("Ingresa un telefono", {
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
        formData.append('num_dorsal',this.newjugador.num_dorsal);
        // formData.append('prestamo',this.newjugador.prestamo);
        formData.append('acta_nacimiento',this.newjugador.acta_nacimiento);
        formData.append('curp',this.newjugador.curp);
        formData.append('identificacion',this.newjugador.identificacion);
        formData.append('tutor',this.newjugador.tutor);
        formData.append('direccion',this.newjugador.direccion);
        formData.append('correo',this.newjugador.correo);
        formData.append('telefono',this.newjugador.telefono);
      axios.post('jugadores/createJugador',formData).then(response=>{
        this.getJugador();
        this.imagenMiniatura = '';
        $('#createJugador').modal('hide');
        $('#bs-validation-upload-file_acta').val('');
        $('#bs-validation-upload-file_curp').val('');
        $('#bs-validation-upload-file_ident').val('');
        this.step = 0;
        this.newjugador = {
          foto:'',
          nombre:'',
          fecha_nacimiento:'',
          edad:0,
          posicion:'Selecciona una Posición',
          sexo:'Selecciona el Sexo',
          prestamo:false,
          apodo:'',
          categoria:'Selecciona una Categoria',
          sede:this.sede,
          acta_nacimiento:'',
          curp:'',
          identificacion:'',
          tutor:'',
          correo:'',
          direccion:'',
          telefono:''
        }
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
      this.newjugador.foto = fileedit
      this.newcargarImagen(fileedit)
    },
    newcargarImagen(file){
        let reader = new FileReader();

        reader.onload = (e) => {
            this.imagenMiniatura = e.target.result
        }
        reader.readAsDataURL(file)
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
      this.detalleJugador.dorsal_antiguo = jur.num_dorsal;
      if (this.detalleJugador.tutor == null) {
        Swal.fire({
          title: "Atencion!",
          html: `Completa la Información del Jugador <b>${this.detalleJugador.nombre}</b> en Info Tutor`,
          icon: "error"
        }).then((result) => {
          if (result.isConfirmed) {
            this.showCard('tutor');
          }
        });
      }
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
        formData.append('num_dorsal',this.detalleJugador.num_dorsal);
        for (let i = 0; i < this.detalleJugador.documentacion.length; i++) {
          formData.append(`documentacion[${i}][archivo]`, this.detalleJugador.documentacion[i].archivo);
          formData.append(`documentacion[${i}][tipo]`, this.detalleJugador.documentacion[i].tipo);
        }
        // formData.append('prestamo',this.detalleJugador.prestamo);
      axios.post('jugadores/updateJugador',formData).then(response=>{
        this.getJugador();
        this.imagenMiniaturaUpdate = '';
        this.submenuUpdate = false;
        $('#editJugador').modal('hide');
        this.stepUpdate = 0;  
        Swal.fire({
          title: 'Éxito',
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
      this.cargarImagen(fileeditupdate)
    },
    cargarImagen(file){
        let reader = new FileReader();

        reader.onload = (e) => {
            this.imagenMiniaturaUpdate = e.target.result
        }
        reader.readAsDataURL(file)
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
        formData.append('formato',this.detalleJugador.formato);
        formData.append('creacion',this.id_usuario_logeado);
      axios.post('jugadores/createTutor',formData).then(response =>{
        this.showCard(null);
        this.getJugador();
        this.stepTutor = 0;
        this.vista = 0;
        Swal.fire({
          title: 'Éxito',
          text: "Se Guardo correctamente!",
          icon: 'success',
          showConfirmButton: false,
          timer: 2500,
        });
      })
    },
    cambioEstatus(jur){
      
      this.id_jugador = jur.id_jugador;
      this.estatus = jur.estatus;
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
            formData.append('id_jugador', this.id_jugador);
            formData.append('estatus',this.estatus);
          axios.post('jugadores/cambioEstatus',formData).then(response=>{
            this.getJugador();
            Swal.fire({
              title: 'Éxito',
              text: "Se cambio el estatus correctamente!",
              icon: 'success',
              showConfirmButton: false,
              timer: 2500,
            });
          })
        }
      })
    },
    deleteJugador(j){
      Swal.fire({
        title: 'Estas seguro?',
        html: `Se eliminara el Jugador <b> ${j.nombre}</b>`,
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText:'Cancelar',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar'
      }).then((result) => {
        if (result.isConfirmed) {
          let formData = new FormData();
              formData.append('id_jugador', j.id_jugador);
          axios.post('jugadores/deleteJugador',formData).then(response=>{
            this.getJugador();
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
    verificaDorsal(){
      this.NombreJugador = false;
      const datos = {
        num_dorsal: this.newjugador.num_dorsal,
        sede: this.sede
      }
      axios.post('jugadores/verificaDorsal',datos).then(response=>{
        this.NombreJugador = response.data.jugador;  
        
        if (this.NombreJugador != false) {
          this.$toast.error("Ya existe un registro con ese dorsal", {
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
          this.newjugador.num_dorsal = '';
          return;
          
        }
      })

      
    },
    verificaDorsalUpdate(){
      if (this.detalleJugador.num_dorsal != this.detalleJugador.dorsal_antiguo) {
        this.NombreJugador = false;
        axios.post('jugadores/verificaDorsal',{ num_dorsal: this.detalleJugador.num_dorsal }).then(response=>{
          this.NombreJugador = response.data.jugador;  
        
        })
        
      }
    },
    onChangeFormato(){
      var fileedit = this.$refs.carta.files[0];
      this.detalleJugador.formato = fileedit
    },
    cambiarModo(valor){
      this.stepTutor = valor;
    }

  }
};
</script>
<style lang='' scoped>
</style>