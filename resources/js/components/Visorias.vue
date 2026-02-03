<template>
    <div>
        <div id="main">
            <div class="row g-4 pt-4 pb-4">
                <div class="col-sm-6 col-xl-3">
                    <div class="card border-1 border-start-personal border-primary h-100">
                        <div class="card-body">
                            <p class="mb-1 fw-bold text-muted small text-uppercase">Total Registrados</p>
                            <h3 class="mb-0 fw-bold">{{ jugadoresFiltrados.length }}</h3>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card border-1 border-start-personal border-success h-100">
                        <div class="card-body">
                            <p class="mb-1 fw-bold text-muted small text-uppercase">Asistencias</p>
                            <h3 class="mb-0 fw-bold">{{ totalAsistencias }}</h3>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card border-1 border-start-personal border-warning h-100">
                        <div class="card-body">
                            <p class="mb-1 fw-bold text-muted small text-uppercase">% Asistencia</p>
                            <h3 class="mb-0 fw-bold">{{ porcentajeAsistencia }}%</h3>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card border-1 border-start-personal border-info h-100">
                        <div class="card-body">
                            <p class="mb-1 fw-bold text-muted small text-uppercase">Pendientes</p>
                            <h3 class="mb-0 fw-bold">{{ totalPendientes }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="m-0">
            <div class="row g-6">
                <div class="card">  
                    <div class="row">
                        <div class="card-header py-3">
                            <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
                                
                                <div class="card-title mb-0">
                                    <h5 class="m-0 me-2 text-primary d-flex align-items-center flex-wrap">
                                        <!-- <i class="ri-team-line me-2"></i>  -->
                                        <!-- <span class="me-2">Jugadores Registrados</span> -->
                                        
                                        <div class="d-flex gap-2 my-1">
                                            <!-- <span class="badge rounded-pill bg-label-primary" title="Total de registros">
                                                {{ jugadoresFiltrados.length }}
                                            </span> -->
                                            <div class="flex-shrink-0" v-show="this.rol_usuario == 'Root'">
                                                <select class="form-select border-primary text-primary fw-bold rounded-pill" v-model="sedeSeleccionada">
                                                    <option v-for="s in sedesDisponibles" :key="s" :value="s">{{ s }}</option>
                                                </select>
                                            </div>
                                            <span v-if="totalDuplicados > 0" 
                                                @click="mostrarSoloDuplicados = !mostrarSoloDuplicados"
                                                :class="['badge rounded-pill cursor-pointer', mostrarSoloDuplicados ? 'bg-danger shadow-sm' : 'bg-label-danger']"
                                                style="cursor: pointer; transition: all 0.3s ease;padding-top: 14px;">
                                                <i class="ri-alert-line me-1"></i> 
                                                {{ totalDuplicados }} Duplicados 
                                                <i :class="mostrarSoloDuplicados ? 'ri-close-circle-fill ms-1' : 'ri-filter-3-line ms-1'"></i>
                                            </span>
                                            <span @click="mostrarSoloSeleccionados = !mostrarSoloSeleccionados"
                                                :class="['badge rounded-pill cursor-pointer', mostrarSoloSeleccionados ? 'bg-success shadow-sm' : 'bg-label-success']"
                                                style="cursor: pointer; transition: all 0.3s ease; padding-top: 14px;">
                                                <i class="ri-star-fill me-1"></i> 
                                                Ver Seleccionados
                                                <i :class="mostrarSoloSeleccionados ? 'ri-close-circle-fill ms-1' : 'ri-filter-3-line ms-1'"></i>
                                            </span>
                                            <!-- <span class="badge rounded-pill bg-label-success" title="Asistencias confirmadas">
                                                <i class="ri-user-follow-line me-1"></i>
                                                {{ totalAsistencias }} Presentes
                                            </span> -->
                                        </div>
                                    </h5>
                                </div>

                                <div class="w-100" style="max-width: 400px;">
                                    <div class="d-flex gap-2">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="ri-search-line"></i></span>
                                            <input type="text" class="form-control" v-model="search" placeholder="Buscar por nombre..." />
                                        </div>
                                        <button class="btn btn-outline-danger d-flex align-items-center" @click="exportarPDF" title="Exportar Lista">
                                            <i class="ri-download-cloud-2-line"></i> <span class="d-none d-sm-inline"></span>
                                        </button>
                                        <button v-if="rol_usuario == 'Root'" class="btn btn-outline-primary d-flex align-items-center" @click="abrirEscanner" title="Escaner QR Asistencia">
                                            <i class="ri-qr-scan-2-line"></i> <span class="d-none d-sm-inline"></span>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        
                        <div class="table-responsive text-nowrap mt-2" style="font-size: 13px;">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Fecha Reg.</th>
                                        <th>Nombre</th>
                                        <th>Sede Visoría</th>
                                        <th>Posición</th>
                                        <th>Edad (F. Nac)</th>
                                        <th>Documento</th>
                                        <th class="text-center">Seleccionado</th>
                                        <th>Asistencia</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr v-for="(jur, index) in jugadoresPaginados" :key="index" :class="{'table-warning': registrosDuplicados.includes(jur.nombre.toLowerCase().trim()),'table-info': jur.estatus == 1 && jur.seleccionado == 0,'table-success': jur.estatus_seleccionado == 1}">
                                        <td>{{ jur.fecha_registro_texto }}</td>
                                        <td>
                                            <div class="d-flex justify-content-start align-items-center">
                                                <div class="d-flex flex-column">
                                                    <span class="fw-bold">{{ jur.nombre }}</span>
                                                    <small class="text-muted">{{ jur.correo }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-label-primary">{{ jur.lugar_visoria }}</span></td>
                                        <td>{{ jur.posicion }} ({{ jur.perfil }})</td>
                                        <td>{{ jur.edad }} años <br><small>{{ jur.fecha_nacimiento }}</small></td>
                                        <td>
                                            <a v-if="jur.formato_firmado" :href="`ArchivosSistema/Documentacion/${jur.formato_firmado}`" target="_blank" class="btn btn-sm btn-icon btn-outline-danger shadow-sm">
                                                <i class="ri-file-pdf-fill"></i>
                                            </a>
                                            <span v-else class="text-danger small">Sin archivo</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch d-flex justify-content-center">
                                                <input class="form-check-input" type="checkbox" 
                                                    :id="'switch' + jur.id_registro_jugador"
                                                    :checked="jur.estatus_seleccionado == 1" 
                                                    @change="toggleSeleccionado(jur)">
                                            </div>
                                        </td>
                                        <td>
                                            <span :class="['badge rounded-pill', jur.estatus == 1 ? 'bg-label-success' : 'bg-label-warning']">
                                                <i :class="jur.estatus == 1 ? 'ri-checkbox-circle-line' : 'ri-time-line'"></i>
                                                {{ jur.estatus == 1 ? 'Asistió' : 'Pendiente' }}
                                            </span>
                                        </td>
                                        <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="ri-more-2-line"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" type="button" style="color: #2b7a3a;" 
                                                    v-if="jur.estatus == 0 && include('Editar')" 
                                                    @click="confirmarAsistenciaManual(jur)">
                                                    <i class="ri-checkbox-circle-line me-1"></i> Confirmar Asistencia
                                                </a>
                                                <a class="dropdown-item" type="button" style="color: orange;" v-if="include('Vizualizar')" @click="infoJugador(jur)">
                                                    <i class="ri-eye-line me-1"></i> Ver Detalle
                                                </a> 
                                                <a class="dropdown-item" type="button" style="color: #33b2ff;" v-if="include('Editar')" 
                                                    data-bs-toggle="modal" data-bs-target="#editJugador" @click="infoJugadorEdit(jur)">
                                                    <i class="ri-pencil-line me-1"></i> Editar
                                                </a> 
                                            <!-- <a class="dropdown-item" type="button" :style="jur.estatus == 0 ? 'color: green;' : 'color: red;'" v-if="include('Permisos')" @click="cambioEstatus(jur)">
                                                <i :class="jur.estatus == 0 ? 'ri-checkbox-circle-fill me-1' : 'ri-close-circle-fill me-1'"></i> 
                                                {{ jur.estatus == 0 ? 'Activar' : 'Desactivar' }}
                                            </a>  
                                            <a class="dropdown-item" type="button" style="color: red;" v-if="include('Eliminar')" @click="deleteJugador(jur)">
                                                <i class="ri-delete-bin-7-line me-1"></i> Eliminar
                                            </a> -->
                                            </div>
                                        </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation" class="mt-4" v-if="totalPaginas > 1">
                                <ul class="pagination justify-content-center pagination-sm">
                                    <li :class="['page-item', paginaActual === 1 ? 'disabled' : '']">
                                        <a class="page-link shadow-none" href="#" @click.prevent="paginaActual--">
                                            <i class="ri-arrow-left-s-line"></i>
                                        </a>
                                    </li>
                                    <li v-for="p in totalPaginas" :key="p" :class="['page-item', paginaActual === p ? 'active' : '']">
                                        <a class="page-link shadow-none" href="#" @click.prevent="paginaActual = p">{{ p }}</a>
                                    </li>
                                    <li :class="['page-item', paginaActual === totalPaginas ? 'disabled' : '']">
                                        <a class="page-link shadow-none" href="#" @click.prevent="paginaActual++">
                                            <i class="ri-arrow-right-s-line"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br><br><br><br><br>
<div class="modal fade" id="modalDetalle" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered"> 
        <div class="modal-content">
            <div class="modal-header bg-primary py-3">
                <h5 class="modal-title text-white d-flex align-items-center">
                    <i class="ri-user-star-line ri-24px me-2"></i>
                    Ficha Técnica: {{ selectedJugador?.nombre }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body p-4" v-if="selectedJugador">
                <div class="row">
                    <div class="col-md-4 border-end">
                        <div class="text-center mb-4">
                            <div class="avatar avatar-xl mb-3 mx-auto">
                                <span class="avatar-initial rounded-circle bg-label-primary fs-2">
                                    {{ selectedJugador.nombre ? selectedJugador.nombre.charAt(0) : 'J' }}
                                </span>
                            </div>
                            <h4 class="mb-0">{{ selectedJugador.nombre }}</h4>
                            <!-- <span class="badge bg-label-secondary mb-2">ID Registro: #{{ selectedJugador.id }}</span> -->
                            <div v-if="selectedJugador.profesional_amateur == 'Profesional'" class="text-success small fw-bold">
                                <i class="ri-medal-fill"></i> Jugador Profesional
                            </div>
                            <div v-else class="text-muted small fw-bold">
                                <i class="ri-user-3-fill"></i> Jugador Amateur
                            </div>
                        </div>

                        <h6 class="text-primary text-uppercase small fw-bold mb-3 border-bottom pb-1">Contacto y Domicilio</h6>
                        <div class="mb-3">
                            <label class="text-muted d-block small">Correo Electrónico:</label>
                            <span class="fw-medium text-break">{{ selectedJugador.correo }}</span>
                        </div>
                        <div class="mb-3">
                            <label class="text-muted d-block small">Teléfono:</label>
                            <span class="fw-medium">{{ selectedJugador.telefono }}</span>
                        </div>
                        <div class="mb-3">
                            <label class="text-muted d-block small">Domicilio Particular:</label>
                            <span class="fw-medium small">{{ selectedJugador.domicilio }}</span>
                        </div>
                        <div class="mb-3">
                            <label class="text-muted d-block small">Escuela / Estudios:</label>
                            <span class="fw-medium">{{ selectedJugador.escuela }}</span>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <h6 class="text-primary text-uppercase small fw-bold mb-3 border-bottom pb-1">Perfil Deportivo</h6>
                                <p class="mb-2"><i class="ri-map-pin-2-line me-2 text-primary"></i> <span class="fw-bold">Sede:</span> {{ selectedJugador.lugar_visoria }}</p>
                                <p class="mb-2"><i class="ri-football-line me-2 text-primary"></i> <span class="fw-bold">Posición:</span> {{ selectedJugador.posicion }}</p>
                                <p class="mb-2"><i class="ri-ruler-2-line me-2 text-primary"></i> <span class="fw-bold">Perfil:</span> {{ selectedJugador.perfil }}</p>
                                <p class="mb-2"><i class="ri-history-line me-2 text-primary"></i> <span class="fw-bold">Tiempo Jugando:</span> {{ selectedJugador.tiempo_jugando }}</p>
                                <p class="mb-2"><i class="ri-team-line me-2 text-primary"></i> <span class="fw-bold">Equipos previos:</span> <span class="small">{{ selectedJugador.equipos_jugando }}</span></p>
                            </div>

                            <div class="col-md-6 mb-4">
                                <h6 class="text-primary text-uppercase small fw-bold mb-3 border-bottom pb-1">Físico y Salud</h6>
                                <div class="row mb-2">
                                    <div class="col-6"><strong>Estatura:</strong> {{ selectedJugador.estatura }} cm</div>
                                    <div class="col-6"><strong>Peso:</strong> {{ selectedJugador.peso }} kg</div>
                                </div>
                                <p class="mb-2"><strong>Edad:</strong> {{ selectedJugador.edad }} años</p>
                                <p class="mb-2"><strong>Fecha de Nacimiento:</strong> {{ selectedJugador.fecha_nacimiento_texto }}</p>
                                <p class="mb-2">
                                    <strong>Salud:</strong> 
                                    <span :class="selectedJugador.enfermedad != 'Ninguna' && selectedJugador.enfermedad != 'No' ? 'text-danger fw-bold' : 'text-success'">
                                        {{ selectedJugador.enfermedad }}
                                    </span>
                                </p>
                                <p class="mb-2"><strong>Recomendado por:</strong> {{ selectedJugador.persona_recomienda }}</p>
                            </div>

                            <div class="col-12 mb-4" v-if="selectedJugador.solicitud_dinero == 'SI'">
                                <div class="alert alert-danger d-flex align-items-center py-2" role="alert">
                                    <i class="ri-error-warning-fill me-2"></i>
                                    <div>
                                        <strong>DENUNCIA DE COBRO:</strong> Solicitado por: {{ selectedJugador.nombre_quien_pago }}
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="col-12">
                                <h6 class="text-primary text-uppercase small fw-bold mb-3 border-bottom pb-1">Expediente Digital</h6>
                                <div class="d-flex gap-3 align-items-center">
                                    <a v-if="selectedJugador.formato_firmado" 
                                       :href="`ArchivosSistema/Documentacion/${selectedJugador.formato_firmado}`" 
                                       target="_blank" class="btn btn-danger">
                                        <i class="ri-file-pdf-2-fill me-1"></i> Ver Formato Firmado
                                    </a>
                                    <div class="form-check" v-if="selectedJugador.terminos">
                                        <input class="form-check-input" type="checkbox" checked disabled>
                                        <label class="form-check-label text-success fw-bold">Términos Aceptados</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-3"> 
                                <h6 class="text-primary text-uppercase small fw-bold mb-3 border-bottom pb-1">Visualización de Documento</h6>
                                <div class="d-flex justify-content-center border rounded bg-light overflow-hidden" style="height: 800px; width: 100%;"> 
                                    
                                    <span v-if="!selectedJugador.formato_firmado" class="text-muted d-flex align-items-center justify-content-center w-100">
                                        <i class="ri-file-warning-line me-2"></i> No se adjuntó archivo.
                                    </span>

                                    <img v-else-if="esImagen(selectedJugador.formato_firmado)" 
                                        :src="`ArchivosSistema/Documentacion/${selectedJugador.formato_firmado}`" 
                                        class="img-fluid" 
                                        style="object-fit: contain; width: 100%; height: 100%;"
                                        alt="Documento del jugador">

                                    <iframe v-else 
                                        :src="`ArchivosSistema/Documentacion/${selectedJugador.formato_firmado}#toolbar=0`" 
                                        width="100%" 
                                        height="100%" 
                                        frameborder="0"
                                        style="display: block;">
                                    </iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <div class="me-auto">
                    <small class="text-muted">Fecha de registro: {{ selectedJugador?.fecha_registro_texto }}</small>
                </div>
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editJugador" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-info py-3">
        <h5 class="modal-title text-white">Actualizar Documento</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-4 text-center">
        <h6 class="mb-3">Jugador: <span class="text-primary">{{ formEdit.nombre }}</span></h6>
        
        <div v-if="formEdit.formato_firmado_actual" class="alert bg-label-secondary mb-4">
            <i class="ri-file-pdf-fill ri-32px text-danger"></i>
            <p class="small mb-0 mt-2 text-truncate">Archivo actual: {{ formEdit.formato_firmado_actual }}</p>
        </div>

        <div class="divider divider-info mt-4">
            <div class="divider-text text-uppercase">Subir Nuevo Archivo</div>
        </div>

        <div class="row g-3">
            <div class="col-12">
                <input type="file" id="fileInput" ref="fileInput" class="form-control" @change="handleFileEdit($event)" accept="image/*,application/pdf">
                <small class="text-muted d-block mt-2">Solo JPG, PNG o PDF (Máx. 2MB)</small>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-info" @click="updateArchivoOnly" :disabled="loadingEdit || !formEdit.nuevo_archivo">
            <span v-if="loadingEdit" class="spinner-border spinner-border-sm me-1"></span>
            Actualizar Archivo
        </button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalQR" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white"><i class="ri-camera-line me-2"></i>Escaneo de Asistencia</h5>
                <button type="button" class="btn-close btn-close-white" @click="cerrarEscanner"></button>
            </div>
            <div class="modal-body text-center">
                <div id="reader" style="width: 100%; border-radius: 10px; overflow: hidden;"></div>
                <p class="text-muted mt-3 small">Coloque el código QR frente a la cámara</p>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalArchivoQR" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h6 class="modal-title">{{ selectedJugador?.nombre }} - Documento</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div v-if="selectedJugador?.formato_firmado" style="height: 70vh;">
                    <iframe :src="`ArchivosSistema/Documentacion/${selectedJugador.formato_firmado}`" 
                            width="100%" height="100%" frameborder="0"></iframe>
                </div>
                <div v-else class="text-center p-5">
                    <i class="ri-file-warning-line ri-4x text-warning"></i>
                    <p class="mt-2">Este jugador no cuenta con un archivo adjunto.</p>
                </div>
            </div>
            <div class="modal-footer py-1">
                <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Listo para siguiente escaneo</button>
            </div>
        </div>
    </div>
</div>
    </div>
</template>
<script>
import axios from 'axios';
import { Html5Qrcode } from "html5-qrcode";
import jsPDF from 'jspdf';
import autoTable from 'jspdf-autotable';

export default {
    name: '',
    
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
            mostrarSoloSeleccionados: false,
            Jugadores: [],
            selectedJugador: null,
            search: '',
            paginaActual: 1,
            elementosPorPagina: 10,
            loadingEdit: false,
            formEdit: {
                id: '',
                nombre: '',
                formato_firmado_actual: '', // Guarda la ruta del archivo que ya existe
                nuevo_archivo: null         // Almacena el archivo binario seleccionado en el input
            },
            contador: 0,
            mostrarSoloDuplicados: false, 
            html5QrCode: null,
            scannerActivo: false,
            isProcessing: false,
            sedeSeleccionada: 'Todas las Sedes',
        }
    },
    computed: {
        // 1. Primero filtramos por búsqueda
        jugadoresFiltrados() {
            let lista = this.Jugadores;

            if (this.sedeSeleccionada !== 'Todas las Sedes') {
                lista = lista.filter(j => j.lugar_visoria === this.sedeSeleccionada);
            }
            
            if (this.mostrarSoloDuplicados) {
                lista = lista.filter(j => 
                    this.registrosDuplicados.includes(j.nombre.toLowerCase().trim())
                );
            }

            if (this.mostrarSoloSeleccionados) {
                lista = lista.filter(j => j.estatus_seleccionado == 1);
            }
    
            if (this.search) {
                const query = this.search.toLowerCase();
                lista = lista.filter(j => 
                    j.nombre.toLowerCase().includes(query) || 
                    j.correo.toLowerCase().includes(query)
                );
            }

            return lista;
        },
        sedesDisponibles() {
            const sedes = this.Jugadores.map(j => j.lugar_visoria);
            return ['Todas las Sedes', ...new Set(sedes)];
        },
        jugadoresPaginados() {
            const inicio = (this.paginaActual - 1) * this.elementosPorPagina;
            const fin = inicio + this.elementosPorPagina;
            return this.jugadoresFiltrados.slice(inicio, fin);
        },
        totalPaginas() {
            return Math.ceil(this.jugadoresFiltrados.length / this.elementosPorPagina);
        },
        registrosDuplicados() {
            const conteo = {};
            // Recorremos todos los jugadores para contar cuántas veces aparece cada nombre
            this.Jugadores.forEach(j => {
                const nombre = j.nombre.toLowerCase().trim();
                conteo[nombre] = (conteo[nombre] || 0) + 1;
            });

            // Filtramos para quedarnos solo con los nombres que se repiten
            return Object.keys(conteo).filter(nombre => conteo[nombre] > 1);
        },
        totalDuplicados() {
            return this.registrosDuplicados.length;
        },
        totalAsistencias() {
            // Filtramos sobre la lista que ya tiene aplicada la sede y la búsqueda
            return this.jugadoresFiltrados.filter(j => j.estatus == 1).length;
        },
        porcentajeAsistencia() {
            // Usamos la longitud de jugadoresFiltrados para que el % sea relativo a la sede
            if (this.jugadoresFiltrados.length === 0) return 0;
            let porcentaje = (this.totalAsistencias / this.jugadoresFiltrados.length) * 100;
            return Math.round(porcentaje);
        },

        totalPendientes() {
            // Cálculo de pendientes basado solo en la sede/filtro actual
            return this.jugadoresFiltrados.length - this.totalAsistencias;
        },
    },
    watch: {
        search() {
            this.paginaActual = 1;
        },
        mostrarSoloDuplicados() {
            this.paginaActual = 1;
        },
        sedeSeleccionada() {
            this.paginaActual = 1;
        }
    },
    async mounted() {
        await this.getJugadores();
        this.verificarRetornoEscaneo();
    },
    methods: {
        formatFecha(fecha) {
            return fecha ? fecha.split('T')[0] : 'N/A';
        },
        include(permiso) {
            return this.permisos.includes(permiso);
        },
        infoJugador(jugador) {
            this.selectedJugador = jugador;
            var myModal = new bootstrap.Modal(document.getElementById('modalDetalle'));
            myModal.show();
        },
        getJugadores() {
            let sede = this.sede === 'León' ? 'Leon' : this.sede;
            // Retornamos la promesa para poder usar await en mounted
            return axios.get(`visorias/jugadores/${sede}/${this.rol_usuario}`)
                .then(response => {
                    this.Jugadores = response.data.jugadores;
                    this.contador = response.data.total;
                    this.paginaActual = 1;
                })
                .catch(error => {
                    console.error('Error fetching jugadores:', error);
                });
        },
        verificarRetornoEscaneo() {
            const urlParams = new URLSearchParams(window.location.search);
            const jugadorId = urlParams.get('jugador_id');

            if (jugadorId) {
                const jugadorEncontrado = this.Jugadores.find(j => j.id_registro_jugador == jugadorId);

                if (jugadorEncontrado) {
                    this.infoJugador(jugadorEncontrado);

                    Swal.fire({
                        icon: 'success',
                        title: '¡Asistencia Confirmada!',
                        text: `El estatus de ${jugadorEncontrado.nombre} ha sido actualizado.`,
                        timer: 3000,
                        showConfirmButton: false
                    });

                    // limpio la URL para que no se reabra el modal si refrescan la página
                    window.history.replaceState({}, document.title, window.location.pathname);
                }
            }
        },
        infoJugadorEdit(jur) {
            this.formEdit.id = jur.id_registro_jugador;
            this.formEdit.nombre = jur.nombre;
            this.formEdit.formato_firmado_actual = jur.formato_firmado;
            this.formEdit.nuevo_archivo = null;
        },

        handleFileEdit(event) {
            this.formEdit.nuevo_archivo = event.target.files[0];
        },

        async updateArchivoOnly() {
            if (!this.formEdit.nuevo_archivo) return;

            this.loadingEdit = true;
            let data = new FormData();
            data.append('nuevo_archivo', this.formEdit.nuevo_archivo);

            try {
                const response = await axios.post(`visorias/update-archivo/${this.formEdit.id}`, data, {
                    headers: { 'Content-Type': 'multipart/form-data' }
                });

                if (response.data.status === 'success') {
                    Swal.fire('¡Éxito!', 'Documento actualizado correctamente', 'success');
                    bootstrap.Modal.getInstance(document.getElementById('editJugador')).hide();
                    this.formEdit.nuevo_archivo = null; 
                    if (this.$refs.fileInput) {
                        this.$refs.fileInput.value = '';
                    }
                    this.getJugadores(); // Refrescar la tabla para ver el nuevo link
                }
            } catch (error) {
                Swal.fire('Error', 'No se pudo subir el archivo', 'error');
            } finally {
                this.loadingEdit = false;
            }
        },
        abrirEscanner() {
            var myModal = new bootstrap.Modal(document.getElementById('modalQR'));
            myModal.show();

            setTimeout(() => {
                this.iniciarCamara();
            }, 500);
        },

        iniciarCamara() {
            this.html5QrCode = new Html5Qrcode("reader");
            const config = { fps: 10, qrbox: { width: 250, height: 250 } };

            this.html5QrCode.start(
                { facingMode: "environment" }, // Prioriza la cámara trasera en celulares
                config,
                (decodedText) => {
                    this.procesarLectura(decodedText);
                },
                (errorMessage) => {
                }
            ).catch((err) => {
                console.error("Error al iniciar cámara: ", err);
                Swal.fire('Error', 'No se pudo acceder a la cámara', 'error');
            });
        },
        async procesarLectura(url) {
            if (this.isProcessing) return; 
            this.isProcessing = true;

            try {
                const response = await axios.get(url, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });

                if (response.data.status === 'success') {
                    const jugador = response.data.jugador;
                    const yaEstabaRegistrado = this.Jugadores.find(j => 
                        j.id_registro_jugador === jugador.id_registro_jugador && j.estatus === 1
                    );
                    await this.getJugadores();
                    this.selectedJugador = response.data.jugador;
                    setTimeout(() => {
                        var modalEl = document.getElementById('modalDetalle');
                        var myModal = new bootstrap.Modal(modalEl);
                        myModal.show();
                        
                        // Disparamos la alerta Toast
                        Swal.fire({
                            icon: yaEstabaRegistrado ? 'info' : 'success',
                            title: yaEstabaRegistrado ? 'Asistencia ya registrada' : 'Asistencia Confirmada',
                            text: jugador.nombre,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            didOpen: (toast) => { toast.style.zIndex = '2010'; }
                        });
                    }, 100);
                }
            } catch (error) {
                console.error("Error al validar QR", error);
                Swal.fire({ 
                    icon: 'error', 
                    title: 'QR Inválido o Error de conexión', 
                    timer: 1500, 
                    toast: true,
                    position: 'top-end',
                    didOpen: (toast) => { toast.style.zIndex = '2010'; }
                });
            }
            setTimeout(() => { this.isProcessing = false; }, 3000);
        },
        cerrarEscanner() {
            if (this.html5QrCode) {
                this.html5QrCode.stop().then(() => {
                    this.html5QrCode.clear();
                    var modalEl = document.getElementById('modalQR');
                    var modal = bootstrap.Modal.getInstance(modalEl);
                    modal.hide();
                });
            }
        },
        async confirmarAsistenciaManual(jugador) {
            const result = await Swal.fire({
                title: '¿Confirmar asistencia?',
                text: `Se marcará a ${jugador.nombre} como presente en la visoria.`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#2b7a3a',
                cancelButtonColor: '#8592a3',
                confirmButtonText: 'Sí, confirmar',
                cancelButtonText: 'Cancelar'
            });

            if (result.isConfirmed) {
                try {
                    const response = await axios.post(`visorias/confirmar-asistencia/${jugador.id_registro_jugador}`);

                    if (response.data.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Hecho!',
                            text: 'Asistencia registrada correctamente.',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        this.getJugadores(); 
                        this.infoJugador(jugador);
                    }
                } catch (error) {
                    console.error(error);
                    Swal.fire('Error', 'No se pudo actualizar el estatus.', 'error');
                }
            }
        },
        exportarPDF() {
            const doc = new jsPDF('p', 'pt', 'a4');
            const esRoot = this.rol_usuario === 'Root';

            doc.setFontSize(18);
            const titulo = esRoot 
                ? 'Reporte Global de Jugadores Registrados' 
                : `Reporte de Jugadores Registrados - Sede ${this.sede}`;
            doc.text(titulo, 40, 40);

            doc.setFontSize(10);
            doc.text(`Total: ${this.jugadoresFiltrados.length} | Asistencias: ${this.totalAsistencias} | Porcentaje: ${this.porcentajeAsistencia}%`, 40, 60);

            // 2. Definición dinámica de columnas
            let columnas = [
                { header: 'Fecha', dataKey: 'fecha' },
                { header: 'Nombre', dataKey: 'nombre' },
                { header: 'Correo', dataKey: 'correo' }
            ];

            // Agregamos la columna Sede solo si es Root
            if (esRoot) {
                columnas.push({ header: 'Sede', dataKey: 'sede' });
            }

            columnas.push(
                { header: 'Posición', dataKey: 'posicion' },
                { header: 'Teléfono', dataKey: 'tel' },
                { header: 'Estatus', dataKey: 'estatus' }
            );

            const filas = this.jugadoresFiltrados.map(j => {
                let fila = {
                    fecha: j.fecha_registro_texto,
                    nombre: j.nombre,
                    correo: j.correo,
                    posicion: j.posicion,
                    tel: j.telefono,
                    estatus: j.estatus == 1 ? 'ASISTIÓ' : 'PENDIENTE'
                };
                
                if (esRoot) {
                    fila.sede = j.lugar_visoria;
                }
                
                return fila;
            });

            autoTable(doc, {
                startY: 80,
                columns: columnas,
                body: filas,
                theme: 'striped',
                headStyles: { fillColor: [105, 108, 255] }, 
                styles: { fontSize: esRoot ? 7 : 8, cellPadding: 3 }, // Fuente un poco más pequeña si hay más columnas
                margin: { left: 40, right: 40 }
            });
            const nombreArchivo = esRoot ? 'Reporte_Global_Visorias.pdf' : `Reporte_Visorias_${this.sede}.pdf`;
            doc.save(nombreArchivo);
        },
        esImagen(nombreArchivo) {
            if (!nombreArchivo) return false;
            const extensionesImg = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            const ext = nombreArchivo.split('.').pop().toLowerCase();
            return extensionesImg.includes(ext);
        },
        async toggleSeleccionado(jugador) {
            const nuevoEstado = jugador.estatus_seleccionado == 1 ? 0 : 1;
            
            try {
                const response = await axios.post(`visorias/marcar-seleccionado/${jugador.id_registro_jugador}`, {
                    seleccionado: nuevoEstado
                });

                if (response.data.status === 'success') {
                    jugador.seleccionado = nuevoEstado; 
                    const Toast = Swal.mixin({
                            timer: 2000,
                            showConfirmButton: false
                        });

                    Toast.fire({
                        icon: nuevoEstado == 1 ? 'success' : 'info',
                        title: nuevoEstado == 1 ? 'Jugador Seleccionado' : 'Selección removida'
                    });
                }
            } catch (error) {
                console.error("Error al marcar seleccionado", error);
                Swal.fire('Error', 'No se pudo actualizar el estatus de selección', 'error');
            }
        },
    }
};
</script>
<style scoped>
    .bg-label-primary {
        background-color: rgba(105, 108, 255, 0.16) !important;
        color: #696cff !important;
    }
    .badge-center {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 2rem;
        height: 2rem;
    }
    .border-start-personal {
        border-left-style: solid !important;
        border-left-width: 5px !important;
    }
  
    #modalDetalle {
        z-index: 2000 !important;
    }

</style>