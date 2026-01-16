<template>
    <div>
        <div id="main">
            <div class="row g-6">
                <div class="card">  
                    <div class="row">
                    <div class="col-12 col-md-6">
                        <h5 class="card-header">Jugadores Registrados para Visoría</h5>
                    </div>
                    <!-- <div class="col-12 col-md-6 mt-3">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <input type="search" class="form-control" v-model="search" placeholder="Buscar por nombre o correo" />
                            <button type="button" class="btn btn-outline-success waves-effect" data-bs-toggle="modal" data-bs-target="#createJugador" v-if="include('Crear')">Agregar Nuevo</button>
                        </div>
                    </div> -->
                    <div class="table-responsive text-nowrap mt-2" style="font-size: 13px;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Fecha Reg.</th>
                                    <th>Nombre</th>
                                    <th>Sede Visoría</th>
                                    <th>Posición</th>
                                    <th>Edad (F. Nac)</th>
                                    <th>Teléfono</th>
                                    <th>Documento</th>
                                    <th>Estatus</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <tr v-for="(jur, index) in Jugadores" :key="index">
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
                                    <td>{{ jur.telefono }}</td>
                                    <td>
                                        <a v-if="jur.formato_firmado" :href="`ArchivosSistema/Documentacion/${jur.formato_firmado}`" target="_blank" class="btn btn-sm btn-icon btn-outline-danger shadow-sm">
                                            <i class="ri-file-pdf-fill"></i>
                                        </a>
                                        <span v-else class="text-danger small">Sin archivo</span>
                                    </td>
                                    <td>
                                        <span :class="`badge rounded-pill ${jur.estatus == 1 ? 'bg-label-success' : 'bg-label-secondary'}`">
                                            {{ jur.estatus == 0 ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </td>
                                    <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="ri-more-2-line"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                        <a class="dropdown-item" type="button" style="color: orange;" v-if="include('Vizualizar')" @click="infoJugador(jur)">
                                            <i class="ri-eye-line me-1"></i> Ver Detalle
                                        </a> 
                                        <!-- <a class="dropdown-item" type="button" style="color: #33b2ff;" v-if="include('Editar')" 
                                            data-bs-toggle="modal" data-bs-target="#editJugador" @click="infoJugador(jur)">
                                            <i class="ri-pencil-line me-1"></i> Editar
                                        </a> 
                                        <a class="dropdown-item" type="button" :style="jur.estatus == 0 ? 'color: green;' : 'color: red;'" v-if="include('Permisos')" @click="cambioEstatus(jur)">
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
                        <!-- <nav aria-label="Page navigation example mt-3">
                            <ul class="pagination justify-content-center">
                                <li :class="['page-item', pagination.current_page > 1 ? '' : 'disabled']">
                                    <a @click.prevent="changePage(pagination.current_page -1)" class="page-link" href="#">Anterior</a>
                                </li>
                                <li class="page-item" v-for="(page, index) in pageNumber" :key="index" @click.prevent="changePage(page)" v-bind:class="[ page == isActived ? 'active' : 'waves-effect']">
                                    <a class="page-link" href="#">{{ page }}</a>
                                </li>
                                <li :class="['page-item', pagination.current_page < pagination.last_page ? '' : 'disabled']">
                                    <a @click.prevent="changePage(pagination.current_page + 1)" class="page-link" href="#">Siguiente</a>
                                </li>
                            </ul>
                        </nav> -->
                    </div>
                    </div>
                </div>
            </div>
        </div>
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
                                    <span v-if="!selectedJugador.formato_firmado" class="text-muted italic small">No se adjuntó archivo.</span>
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
    </div>
</template>
<script>
import axios from 'axios';

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
            Jugadores: [],
            selectedJugador: null,
            search: '',
            pagination: {
                current_page: 1,
                last_page: 1
            },
            offset: 3
        }
    },
    computed: {
        // isActived() { return this.pagination.current_page; },
        // pageNumber() {
        //     if (!this.pagination.to) return [];
        //     let from = this.pagination.current_page - this.offset;
        //     if (from < 1) from = 1;
        //     let to = from + (this.offset * 2);
        //     if (to >= this.pagination.last_page) to = this.pagination.last_page;
        //     let pagesArray = [];
        //     while (from <= to) { pagesArray.push(from); from++; }
        //     return pagesArray;
        // }
    },
    watch: {
        
    },
    mounted() {
        this.getJugadores();
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
            // Si usas Bootstrap nativo en tu proyecto:
            var myModal = new bootstrap.Modal(document.getElementById('modalDetalle'));
            myModal.show();
        },
        imprimirFicha(jugador) {
            // Opción rápida para imprimir los detalles
            window.print();
        },
        getJugadores() {
            let sede = this.sede === 'León' ? 'Leon' : this.sede;
            axios.get(`visorias/jugadores/${sede}`)
                .then(response => {
                    console.log(response.data);
                    this.Jugadores = response.data;
                })
                .catch(error => {
                    console.error('Error fetching jugadores:', error);
                });
        }

    }
};
</script>