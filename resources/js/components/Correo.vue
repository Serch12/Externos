<template>
    <div>
        <!-- vista de correo -->
        <div id="main" v-if="this.vista == 0" class="mb-10">
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
                    <div class="col-xl-12 col-lg-12 col-md-12" v-if="this.Correos.length == 0">
                        <center>
                            <h5 class="card-header text-success">Sin Información</h5>
                            <img src="style/logos/img_no hay datos.png" alt="img_sindato" style="width: 200px;">
                        </center>
                    </div>
                    <div class="row" v-else>
                        <div class="table-responsive text-nowrap mt-2">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Fecha Creación</th>
                                        <th>Destinatario</th>
                                        <th>Asunto</th>
                                        <th>Estatus</th>
                                        <th>Gráfica</th>
                                        <th>Estatus</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr v-for="(c, index) in Correos" :key="index">
                                        <td>{{ index + 1 }} </td>
                                        <td>{{ c.fecha }}</td>
                                        <td>{{ c.destinatario }}</td>
                                        <td>{{ c.asunto }}</td>
                                        <td><span :class="`badge rounded-pill bg-label-${c.color} me-1`">{{ c.text}}</span></td>
                                        <td>
                                            <button type="button" class="btn btn-icon btn-outline-whatsapp waves-effect"  @click="envioCorreo(c)">
                                                <i class="tf-icons ri-bar-chart-2-fill ri-22px"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <center>
                                                <button class="btn btn-outline-primary btn-icon waves-effect" v-if="c.estatus == 0" @click="activacion(c)">
                                                    <i class="ri-checkbox-circle-fill ri-22px"></i>
                                                </button>
                                                <button class="btn btn-outline-danger btn-icon waves-effect" v-else @click="activacion(c)">
                                                    <i class="ri-close-circle-fill ri-22px"></i>
                                                </button>
                                            </center>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="ri-more-2-line"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" type="button" style="color: orange;" data-bs-toggle="modal" data-bs-target="#vizualizaCorreo"
                                                        v-if="include('Vizualizar')" @click="infoCorreo(c)">
                                                        <i class="ri-clipboard-line me-1"></i> Vizualizar</a>
                                                    <a class="dropdown-item" type="button" style="color: #33b2ff;" data-bs-toggle="modal" data-bs-target="#updateCorreo"
                                                        v-if="include('Editar') && (c.estatus == 0)" @click="infoCorreo(c)">
                                                        <i class="ri-pencil-line me-1"></i> Editar</a>
                                                    <a class="dropdown-item" type="button" style="color: red;"
                                                        v-if="include('Eliminar') && (c.estatus == 0)" @click="deleteCorreo(c.id)">
                                                        <i class="ri-delete-bin-7-line me-1"></i> Eliminar</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation example mt-3">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item disabled" v-if="pagination.current_page > 1">
                                        <a @click.prevent="changePage(pagination.current_page - 1)" class="page-link"
                                            href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                    </li>
                                    <li class="page-item" v-for="(page, index) in pageNumber" :key="index"
                                        @click.prevent="changePage(page)"
                                        v-bind:class="[page == isActived ? 'active' : 'waves-effect']">
                                        <a class="page-link" href="#">{{ page }}</a>
                                    </li>
                                    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                        <a @click.prevent="changePage(pagination.current_page + 1)" class="page-link"
                                            href="#">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal de alta correo -->
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
                                    <input type="date" id="fecha" class="form-control" v-model="correo.fecha"/>
                                    <label for="fecha">Fecha de Creación</label>
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
                                    <input type="text" id="asunto" class="form-control" placeholder="Asunto" v-model="correo.asunto"/>
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
                                <button type="button" class="btn btn-outline-danger waves-effect" data-bs-dismiss="modal">Cerrar</button>
                                <button class="btn btn-success" @click="goNextStep()">
                                    <span class="align-middle d-sm-block d-none me-2">Siguiente</span>
                                    <i class="ri-arrow-right-line ri-16px"></i>
                                </button>
                            </div>
                        </form>
                        <form class="row g-4" onsubmit="return false" v-show="this.step == 1">
                            <h6 style="color: red;">** Imagenes para el correo **</h6>
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
        <!-- modal de vizualizacion -->
        <div class="modal fade" id="vizualizaCorreo" data-bs-backdrop="static" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <form class="modal-content" >
                    <div class="modal-header">
                        <h4 class="modal-title" id="bvizualizaCorreoTitle">Correo</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th scope="row">Fecha de Creación:</th>
                                    <td>{{this.detalleCorreo.fecha}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Destinatario:</th>
                                    <td>{{this.detalleCorreo.destinatario}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Asunto:</th>
                                    <td>{{this.detalleCorreo.asunto}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Información:</th>
                                    <td v-html="this.detalleCorreo.informacion"></td>
                                </tr>
                                <tr>
                                    <th scope="row">IMG</th>
                                    <td>
                                        <div class="row">
                                            <div class="col-12 col-lg-4" v-for="(img, idmx) in this.CorreoIMG" :key="idmx">
                                                 <img :src="`ArchivosSistema/GaleriaCorreo/${img.nombre}`" class="img-thumbnail" :alt="`img${idmx}`">
                                            </div>

                                        </div>                                        
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger waves-effect" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </form>
                
            </div>
        </div>
        <!-- modal de alta correo -->
        <div class="modal fade" id="updateCorreo" data-bs-backdrop="static" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <form class="modal-content" >
                    <div class="modal-header">
                        <h4 class="modal-title" id="bupdateCorreoTitle">Editar Correo</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-4" onsubmit="return false" v-show="this.step == 0">

                            <div class="col-12 col-lg-6">
                                <div class="input-group input-group-merge">
                                    <div class="form-floating form-floating-outline">
                                    <input type="date" id="fecha" class="form-control" v-model="detalleCorreo.fecha"/>
                                    <label for="fecha">Fecha de Creación</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-floating form-floating-outline">
                                    <select id="destinatario" name="destinatario" class="form-select" v-model="detalleCorreo.destinatario">
                                        <option value="Seleccionar Destinatario">Seleccionar Destinatario</option>
                                        <option value="Afiliados">Afiliados</option>
                                        <option value="User">User</option>
                                    </select>
                                    <label for="destinatario">Destinatario</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="asunto" class="form-control" placeholder="Asunto" v-model="detalleCorreo.asunto"/>
                                    <label for="asunto">Asunto</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="edit_container" style="overflow: hidden;">
                                    <quill-editor
                                        v-model="detalleCorreo.informacion"
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
                                <button type="button" class="btn btn-outline-danger waves-effect" data-bs-dismiss="modal">Cerrar</button>
                                <button class="btn btn-success" @click="goNextStep()">
                                    <span class="align-middle d-sm-block d-none me-2">Siguiente</span>
                                    <i class="ri-arrow-right-line ri-16px"></i>
                                </button>
                            </div>
                        </form>
                        <form class="row g-4" onsubmit="return false" v-show="this.step == 1">
                            <h6 style="color: red;">** Imagenes para el correo **</h6>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="button" class="btn btn-outline-success waves-effect" v-if="include('Crear')" for="file-editar"  onclick="document.getElementById('file-editar').click()">Agregar</button>
                                <input type="file" id="file-editar" ref="arimgupdate" accept=".png" style="display: none;" @change="archivosImgUpdate()" multiple/>
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
                                    <tr v-for="(arch, index) in this.CorreoIMG" :key="index">
                                        <td>{{ index + 1 }}</td>
                                        <td>
                                            <div class="d-flex justify-content-start align-items-center" >
                                                <div class="avatar-wrapper">
                                                    <div class="avatar me-2" >
                                                        <img :src="`ArchivosSistema/GaleriaCorreo/${arch.nombre}`"  class="w-px-100" />
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <a class="dropdown-item" type="button" style="color: red;" @click="deleteArchivosUpdate(index,arch.id_imgcorreo)">
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
                                <button class="btn btn-success" @click="editarCorreo()">
                                    <span class="align-middle d-sm-block d-none me-2">Guardar</span>
                                    <i class="ri-save-3-fill ri-16px"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                </form>
            </div>
        </div>
        <br><br><br><br><br>
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
            Correos:[],
            detalleCorreo:[],
            CorreoIMG:[],
            pagination: {
                'total': 0,
                'current_page': 0,
                'per_page': 0,
                'last_page': 0,
                'from': 0,
                'to': 0
            },
            offset:2,
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
        this.getCorreos();
    },
    methods: {
        getCorreos(){
            var url = `correo/getCorreo?buscador=${this.search}`
            axios.get(url).then(res =>{
                this.Correos = res.data.data
            })
        },
        include(permiso){
            return this.permisos.includes(permiso);
        },
        goPrevStep() {
            this.step--;
        },
        goNextStep() {
            this.step++;
        },
        changePage: function (page) {
            this.pagination.current_page = page;
            this.getCorreos(page);
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
        archivosImgUpdate(){
            var file = this.$refs.arimgupdate.files;

            for (let index = 0; index < file.length; index++) {
                const files = file[index];

                this.CorreoIMG.push(file[index]);
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
                $('#backDropModal').modal('hide');
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
        infoCorreo(c){
            this.detalleCorreo = c;
            axios.get(`correo/galeCorreo/${this.detalleCorreo.id_correo}`).then(res=>{
                this.CorreoIMG = res.data;
            })
        },
        deleteArchivos(index){
            this.correo.img.splice(index, 1);
        },
        envioCorreo(c){

            // Simular una consulta (puedes reemplazar con tu lógica)
            this.enviados = c.porcentaje_enviados;
            this.pendientes = c.porcentaje_pendientes;

            // Mostrar el SweetAlert con los datos obtenidos
            Swal.fire({
                html: `
                <div style="margin-bottom: 10px;">
                    <strong>Enviados:</strong>
                    <div style="background: #e0e0e0; border-radius: 5px; overflow: hidden;">
                    <div style="width: ${this.enviados}%; background: #4caf50; padding: 5px 0; text-align: center; color: white;">
                        ${this.enviados}%
                    </div>
                    </div>
                </div>
                <div>
                    <strong>Pendientes</strong>
                    <div style="background: #e0e0e0; border-radius: 5px; overflow: hidden;">
                    <div style="width: ${this.pendientes}%; background: red; padding: 5px 0; text-align: center; color: white;">
                        ${this.pendientes}%
                    </div>
                    </div>
                </div>
                `,
                confirmButtonText: "Cerrar",
                confirmButtonColor: "#3085d6",
            });
        },
        deleteCorreo(id_correo){
            var correo_id = id_correo;
            Swal.fire({
                title: `Eliminar Correo?`,
                text: "El correo se eliminara permanentemente!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Eliminar",
                cancelButtonColor: "#d33",
                cancelButtonText:'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {

                    axios.post(`correo/deleteCorreo/${correo_id}`,).then(res =>{

                        this.getCorreos();
                        Swal.fire({
                            title: "Excelente!",
                            text: `Se Elimino Correctamente`,
                            icon: "success"
                        });
                    })

                }
            });
        },
        editarCorreo(){
            let formData = new FormData();
            // for (let i = 0; i < this.IMGCorreonew.length; i++) {
            //     formData.append('imgCorreo[' + i + ']', this.IMGCorreonew[i]);
            // }
            formData.append('id_correo',this.detalleCorreo.id_correo);
            formData.append('fecha',this.detalleCorreo.fecha);
            formData.append('destinatario',this.detalleCorreo.destinatario);
            formData.append('asunto',this.detalleCorreo.asunto);
            formData.append('informacion',this.detalleCorreo.informacion);

            axios.post('correo/editarCorreo',formData).then(res =>{
                $('#updateCorreo').modal('hide');
                // this.IMGCorreonew = [];
                this.mostrar = 0;
                this.getCorreos();
                Swal.fire({
                    title: "Perfecto!",
                    text: "Editado Correctamente.",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2500
                });
            })
        },
        activacion(value){
            if (value.estatus == 0) {
                var estatus = 'Activar';
            } 
            if (value.estatus == 1) {
                var estatus = 'Desactivar';
            }

            for (let index = 0; index < this.Correos.length; index++) {
                if (this.Correos[index].id_correo !== value.id_correo) {
                    if (this.Correos[index].estatus == 1) {
                        swal('Hay un Correo Activo Primero hay que desactivarlo para enviar este correo',{
                            position: 'center',
                            icon: 'error',
                            buttons: false,
                            timer: 1500
                        })
                        return;
                    }
                }
            }

            Swal.fire({
                title: `${estatus} Correo`,
                // text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Si",
                cancelButtonColor: "#d33",
                cancelButtonText:'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    let formData = new FormData();
                        formData.append('bandera',estatus);
                        formData.append('id_correo',value.id_correo);
                    axios.post('correo/activacionCorreo',formData).then(res =>{
                        
                        this.getCorreos();
                        Swal.fire({
                            title: "Excelente!",
                            text: `Se ${estatus} correctamente`,
                            icon: "success"
                        });
                    })
                    
                }
            });
        },
        onEditorReady(editor) { }, // prepara el editor
        onEditorBlur() { }, // Evento de pérdida de foco
        onEditorFocus() { }, // Obtiene el evento de enfoque
        onEditorChange() { }, // evento de cambio de contenido.
    }
};
</script>
<style lang='' scoped>
</style>