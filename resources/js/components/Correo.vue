<template>
    <div>
        <!-- vista de correo -->
        <div id="main" v-if="this.vista == 0">
            <div class="row g-6">
                <div class="card">  
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <h5 class="card-header">Correos AMFpro</h5>
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <input type="search" id="email"class="form-control"  v-model="search" placeholder="Buscar Correo" @keyup="buscarJugador()"/>
                                <button type="button" class="btn btn-outline-success waves-effect" data-bs-toggle="modal" data-bs-target="#backDropModal" v-if="include('Crear')">Agregar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <form class="modal-content" >
                    <div class="modal-header">
                        <h4 class="modal-title" id="backDropModalTitle">Agregar Correo</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-4" onsubmit="return false" v-show="this.step == 0">
                            
                            <div class="col-12 col-lg-6">
                                <div class="input-group input-group-merge">
                                    <div class="form-floating form-floating-outline">
                                    <input type="date" id="fecha" class="form-control" />
                                    <label for="fecha">Fecha</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-floating form-floating-outline">
                                    <select id="destinatario" name="destinatario" class="form-select" v-model="correo.destinatario">
                                        <option value="Seleccionar Destinatario">Seleccionar Destinatario</option>
                                        <option value="Afiliados">Afiliados</option>
                                        <option value="User">User</option>
                                    </select>
                                    <label for="destinatario">Destinatario</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="asunto" class="form-control" placeholder="Asunto"/>
                                    <label for="asunto">Asunto</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="edit_container" style="overflow: hidden;">
                                    <quill-editor
                                        v-model="correo.informacion"
                                        style="height: 300px ;text-align: left;"
                                        ref="myQuillEditor"
                                        :options="editorOption"
                                        @blur="onEditorBlur($event)"
                                        @focus="onEditorFocus($event)"
                                        @change="onEditorChange($event)">
                                    </quill-editor>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-between mt-6">
                                <button class="btn btn-outline-secondary" @click="goPrevStepUp()">
                                    <i class="ri-arrow-left-line ri-16px"></i>
                                    <span class="align-middle d-sm-block d-none ms-2">Anterior</span>
                                </button>
                                <button class="btn btn-success" @click="goNextStep()">
                                    <span class="align-middle d-sm-block d-none me-2">Siguiente</span>
                                    <i class="ri-arrow-right-line ri-16px"></i>
                                </button>
                            </div>
                        </form>
                        <form class="row g-4" onsubmit="return false" v-show="this.step == 1">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="button" class="btn btn-outline-success waves-effect" v-if="include('Crear')" for="file-upload"  onclick="document.getElementById('file-upload').click()">Agregar</button>
                                <input type="file" id="file-upload" ref="arimg" accept=".png" style="display: none;" @change="archivosImg()" multiple/>
                            </div>
                            <div class="table-responsive text-nowrap mt-2">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">IMG</th>
                                        <th scope="col">Opciones</th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                    <tr v-for="(arch, index) in this.correo.img" :key="index">
                                        <td>{{ index + 1 }}</td>
                                        <td>
                                            <div class="d-flex justify-content-start align-items-center" >
                                                <div class="avatar-wrapper">
                                                    <div class="avatar me-2" >
                                                        <img :src='arch.previewUrl' class="w-px-100" />
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        
                                        <td>
                                            <a class="dropdown-item" type="button" style="color: red;" @click="deleteArchivos(index,arch)">
                                                <i class="ri-delete-bin-7-line me-1"></i> Eliminar
                                            </a>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 d-flex justify-content-between mt-6">
                                <button class="btn btn-outline-secondary" @click="goPrevStep()">
                                    <i class="ri-arrow-left-line ri-16px"></i>
                                    <span class="align-middle d-sm-block d-none ms-2">Anterior</span>
                                </button>
                                <button class="btn btn-success" @click="agregaCorreo()">
                                    <span class="align-middle d-sm-block d-none me-2">Guardar</span>
                                    <i class="ri-save-3-fill ri-16px"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    
                </form>
            </div>
        </div>
        <br><br><br>
    </div>
</template>
<script>
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
            step:0,
            search:'',
            tiempoBusqueda:'',
            editorOption: {
            },
            correo:{
                fecha:'',
                destinatario:'Seleccionar Destinatario',
                asunto:'',
                informacion:'',
                img:[]
            },
            IMGCorreonew:[],
        }
    },
    computed: {
        
    },
    watch: {
        
    },
    mounted() {
        
    },
    methods: {
        include(permiso){
            return this.permisos.includes(permiso);
        }, 
        goPrevStep() {
            this.step--;
        },
        goNextStep() {
            this.step++;
        },
        archivosImg(){
            var file = this.$refs.arimg.files;

            for (let index = 0; index < file.length; index++) {
                const files = file[index];

                const previewUrl = URL.createObjectURL(files);

                this.correo.img.push({
                    files, 
                    previewUrl 
                });
                this.IMGCorreonew.push(file[index]);
            }
        },
        agregaCorreo(){
            if (this.correo.fecha === '') {
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
            if (this.correo.destinatario === 'Seleccionar Destinatario') {
                this.$toast.error("Seleccionar Destinatario", {
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
            if (this.correo.asunto === '') {
                this.$toast.error("Ingresa Asunto", {
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
            if (this.correo.informacion === '') {
                this.$toast.error("Ingresa la Información", {
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
            for (let i = 0; i < this.IMGCorreonew.length; i++) {
                formData.append('imgCorreo[' + i + ']', this.IMGCorreonew[i]);
            }
            formData.append('fecha',this.correo.fecha);
            formData.append('destinatario',this.correo.destinatario);
            formData.append('asunto',this.correo.asunto);
            formData.append('informacion',this.correo.informacion);

            axios.post('correo/createCorreo',formData).then(res =>{
                this.correo = {
                    fecha:'',
                    destinatario:'Seleccionar Destinatario',
                    asunto:'',
                    informacion:'',
                    img:[]
                }
                this.IMGCorreonew = [];
                this.mostrar = 0;
                this.getCorreos();
                Swal.fire({
                    title: "Perfecto!",
                    text: "Agregado Correctamente.",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2500
                });
            })
        },
    }
};
</script>
<style lang='' scoped>
</style>