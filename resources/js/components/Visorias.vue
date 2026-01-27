<template>
    <div>
        <div id="main">
            <div class="row g-6">
                <div class="card">  
                    <div class="row">
                        <div class="card-header py-3">
                            <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
                                
                                <div class="card-title mb-0">
                                    <h5 class="m-0 me-2 text-primary d-flex align-items-center flex-wrap">
                                        <i class="ri-team-line me-2"></i> 
                                        <span class="me-2">Jugadores Registrados</span>
                                        
                                        <div class="d-flex gap-2 my-1">
                                            <span class="badge rounded-pill bg-label-primary" title="Total de registros">
                                                {{ jugadoresFiltrados.length }}
                                            </span>

                                            <span v-if="totalDuplicados > 0" 
                                                @click="mostrarSoloDuplicados = !mostrarSoloDuplicados"
                                                :class="['badge rounded-pill cursor-pointer', mostrarSoloDuplicados ? 'bg-danger shadow-sm' : 'bg-label-danger']"
                                                style="cursor: pointer; transition: all 0.3s ease;">
                                                <i class="ri-alert-line me-1"></i> 
                                                {{ totalDuplicados }} Duplicados 
                                                <i :class="mostrarSoloDuplicados ? 'ri-close-circle-fill ms-1' : 'ri-filter-3-line ms-1'"></i>
                                            </span>
                                            <span class="badge rounded-pill bg-label-success" title="Asistencias confirmadas">
                                                <i class="ri-user-follow-line me-1"></i>
                                                {{ totalAsistencias }} Presentes
                                            </span>
                                        </div>
                                    </h5>
                                </div>

                                <div class="w-100" style="max-width: 400px;">
                                    <div class="d-flex gap-2">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="ri-search-line"></i></span>
                                            <input type="text" class="form-control" v-model="search" placeholder="Buscar por nombre..." />
                                        </div>
                                        <button class="btn btn-primary d-flex align-items-center" @click="abrirEscanner">
                                            <i class="ri-qr-scan-2-line me-1"></i> <span class="d-none d-sm-inline">Escanear</span>
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
                                        <th>Teléfono</th>
                                        <th>Documento</th>
                                        <th>Estatus</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr v-for="(jur, index) in jugadoresPaginados" :key="index" :class="{'table-warning': registrosDuplicados.includes(jur.nombre.toLowerCase().trim()),'table-success': jur.estatus == 1}">
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
    </div>
</template>
<script>
import axios from 'axios';
import { Html5Qrcode } from "html5-qrcode";

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
            scannerActivo: false
        }
    },
    computed: {
        // 1. Primero filtramos por búsqueda
        jugadoresFiltrados() {
            let lista = this.Jugadores;

            // Primero filtramos por modo duplicados si está activo
            if (this.mostrarSoloDuplicados) {
                lista = lista.filter(j => 
                    this.registrosDuplicados.includes(j.nombre.toLowerCase().trim())
                );
            }

            // Luego aplicamos la búsqueda por texto si existe
            if (this.search) {
                const query = this.search.toLowerCase();
                lista = lista.filter(j => 
                    j.nombre.toLowerCase().includes(query) || 
                    j.correo.toLowerCase().includes(query)
                );
            }

            return lista;
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
            return this.Jugadores.filter(j => j.estatus == 1).length;
        }
    },
    watch: {
        search() {
            this.paginaActual = 1;
        },
        mostrarSoloDuplicados() {
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
                // Buscamos al jugador en la lista que acabamos de cargar
                // Nota: Asegúrate de que el nombre de la propiedad coincida (id o id_registro_jugador)
                const jugadorEncontrado = this.Jugadores.find(j => j.id_registro_jugador == jugadorId);

                if (jugadorEncontrado) {
                    // 1. Abrimos el modal con la info del jugador
                    this.infoJugador(jugadorEncontrado);

                    // 2. Mostramos una alerta de éxito limpia
                    Swal.fire({
                        icon: 'success',
                        title: '¡Asistencia Confirmada!',
                        text: `El estatus de ${jugadorEncontrado.nombre} ha sido actualizado.`,
                        timer: 3000,
                        showConfirmButton: false
                    });

                    // 3. Limpiamos la URL para que no se reabra el modal si refrescan la página
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

            // Esperar a que el modal se muestre para iniciar la cámara
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
                    // EL ÉXITO: decodedText será la URL que generamos (http://.../validar-visor/ID)
                    this.procesarLectura(decodedText);
                },
                (errorMessage) => {
                    // Error de escaneo (silencioso para evitar spam de logs)
                }
            ).catch((err) => {
                console.error("Error al iniciar cámara: ", err);
                Swal.fire('Error', 'No se pudo acceder a la cámara', 'error');
            });
        },

        procesarLectura(url) {
            // Detenemos la cámara de inmediato para procesar
            this.cerrarEscanner();

            // Como la URL del QR ya apunta a tu backend (validar-visor/id)
            // Simplemente redirigimos al navegador a esa URL
            // Laravel hará el login check y el update automáticamente
            window.location.href = url;
        },

        cerrarEscanner() {
            if (this.html5QrCode) {
                this.html5QrCode.stop().then(() => {
                    this.html5QrCode.clear();
                    bootstrap.Modal.getInstance(document.getElementById('modalQR')).hide();
                }).catch(err => {
                    bootstrap.Modal.getInstance(document.getElementById('modalQR')).hide();
                });
            } else {
                bootstrap.Modal.getInstance(document.getElementById('modalQR')).hide();
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
                    // Enviamos la petición al servidor
                    // Usamos el ID del registro que ya tienes en el objeto
                    const response = await axios.post(`visorias/confirmar-asistencia/${jugador.id_registro_jugador}`);

                    if (response.data.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Hecho!',
                            text: 'Asistencia registrada correctamente.',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        
                        // Refrescamos la lista para actualizar el estatus visualmente
                        this.getJugadores(); 
                        
                        // Opcional: Abrir el detalle automáticamente como pediste con el QR
                        this.infoJugador(jugador);
                    }
                } catch (error) {
                    console.error(error);
                    Swal.fire('Error', 'No se pudo actualizar el estatus.', 'error');
                }
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
</style>