<template>
    <div>
        <div id="main" v-if="this.vista == 0">
            <div class="row">
                <h4 class="mb-1">Lista de Sedes</h4>
                <!-- Role cards -->
                <div class="row g-3">
                    <!-- agregar roles -->
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="card h-100">
                            <div class="row h-100">
                                <div class="col-5">
                                    <div class="d-flex align-items-end h-100 justify-content-center">
                                    <img
                                        src="style/assets/img/illustrations/add-new-role-illustration.png"
                                        class="img-fluid"
                                        alt="Image"
                                        width="68" />
                                    </div>
                                </div>
                            <div class="col-7">
                                <div class="card-body text-sm-end text-center ps-sm-0">
                                    <button
                                        data-bs-target="#addSedeModal"
                                        data-bs-toggle="modal"
                                        class="btn btn-sm btn-primary mb-4 text-nowrap add-new-role">
                                        Añadir Sede
                                    </button>
                                    <p class="mb-0">
                                        Añadir nueva Sede
                                    </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Vista de roles -->
                    <div class="col-xl-4 col-lg-6 col-md-6" v-for="(r, index) in Sedes" :key="index">
                        <div class="card">
                            <div class="card-body">
                                <a type="button" class="d-flex justify-content-between align-items-center mb-4">
                                    <p class="mb-0">Total {{ r.total_usuarios }} Usuarios</p>
                                </a>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="role-heading">
                                    <h5 class="mb-1">{{r.nombre}}</h5>
                                    <a type="button" data-bs-toggle="modal" data-bs-target="#updateSedeModal" class="role-edit-modal" style="color: #4caf50;" @click="infoSede(r)">
                                        <p class="mb-0">Editar Sede</p>
                                    </a>
                                    </div>
                                    <a type="button" class="text-danger" @click="deleteSede(r)"><i class="ri-delete-bin-6-fill ri-22px"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- modal para crear las sedes -->
        <div class="modal fade" id="addSedeModal" tabindex="-1" aria-hidden="true">
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
                                <button type="button" class="btn btn-primary" @click="agregaSede()">Guardar</button>
                                <button type="reset" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal para editar las sedes -->
        <div class="modal fade" id="updateSedeModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body p-0">
                        <div class="text-center mb-6">
                            <h4 class="mb-2">Editar Sede</h4>
                        </div>
                        <form id="editUserForm" class="row g-5">
                            <div class="col-12 col-md-6">
                                <div class="form-floating form-floating-outline">
                                <input
                                    type="text"
                                    id="sede"
                                    class="form-control"
                                    v-model="detalleSede.nombre"
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
                                    v-model="detalleSede.ubicacion"
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
                                    v-model="detalleSede.lugar_entrenamiento"
                                    placeholder="Lugar Entrenamiento" />
                                <label for="lugar">Lugar Entrenamiento</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating form-floating-outline">
                                <input
                                style="color: black;"
                                    type="date"
                                    id="fecha"
                                    class="form-control"
                                    disabled
                                    v-model="detalleSede.fecha_registro"/>
                                <label for="fecha">Fecha Registro</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-12">
                                <div class="form-floating form-floating-outline">
                                    <div style="max-width: 800px; overflow: hidden;">
                                        <quill-editor
                                            v-model="detalleSede.contactos"
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
                                <button type="button" class="btn btn-primary" @click="editarSede()">Editar</button>
                                <button type="reset" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
            Sedes:[],
            newSede:{
                nombre:'',
                ubicacion:'',
                lugar_entrenamiento:'',
                contactos:'',
                fecha_registro:''
            },
            detalleSede:[],
            editorOption: {},
        }
    },
    computed: {
        
    },
    watch: {
        
    },
    mounted() {
        this.getSede();
    },
    methods: {
        muestra(valor){
            this.vista = valor;
        },
        getSede(){
            axios.get('sede/busqueda').then(res=>{
                this.Sedes = res.data.sedes
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

            axios.post('sede/createSede',formData).then(response =>{
                this.getSede();
                Swal.fire({
                    title: 'Perfecto',
                    text: "La Sede ha sido registrada!",
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2500,
                })
                $('#addSedeModal').modal('hide');
                this.newSede = {
                    nombre:'',
                    ubicacion:'',
                    lugar_entrenamiento:'',
                    contactos:'',
                    fecha_registro:''

                }
            })
        },
        infoSede(r){
            this.detalleSede = r;

            axios.get(`sede/infoSede/${this.detalleSede.id_sede}`).then(response =>{

            })
        },
        editarSede(){
            if (this.detalleSede.nombre == '') {
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
            if (this.detalleSede.ubicacion == '') {
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
            if (this.detalleSede.lugar_entrenamiento == '') {
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
            if (this.detalleSede.fecha_registro == '') {
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
                formData.append('id_sede',this.detalleSede.id_sede);
                formData.append('nombre',this.detalleSede.nombre);
                formData.append('ubicacion',this.detalleSede.ubicacion);
                formData.append('lugar_entrenamiento',this.detalleSede.lugar_entrenamiento);
                formData.append('contactos',this.detalleSede.contactos);
                formData.append('fecha_registro',this.detalleSede.fecha_registro);

            axios.post('sede/updateSede',formData).then(response =>{
                this.getSede();
                Swal.fire({
                    title: 'Perfecto',
                    text: "La Sede se modifico correctamente!",
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2500,
                });
                $('#updateSedeModal').modal('hide');
                this.detalleSede = [];
            })
        },
        deleteSede(r){

            if (r.total_usuarios != 0) {
                Swal.fire({
                    title: 'Error',
                    text: `La Sede ${r.nombre} no se puede eliminar por que esta en uso`,
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2500,
                });  
            }else{
                this.id = r.id_sede;

                axios.delete(`sede/deleteSede/${this.id}`).then(response=>{
                    this.getSede();
                    Swal.fire({
                        title: 'Perfecto',
                        text: "Se Elimino Correctamente!",
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2500,
                    });
                })
            }
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