<template>
    <div>
        <div id="main" v-if="this.vista == 0">
            <div class="row">
                <!-- Users List Table -->
                <div class="card">
                
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <h5 class="card-header">Parrilla</h5>
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <input type="search" id="email"class="form-control"  v-model="search" placeholder="Buscar Post" @keyup="buscarPost()"/>
                                <button type="button" class="btn btn-outline-success waves-effect" v-if="include('Crear')" @click="muestra(1)">Agregar</button>
                            </div>
                        </div>
                        <div class="table-responsive text-nowrap mt-2">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Titulo</th>
                                        <th>Categoria</th>
                                        <th>Fecha de creación</th>
                                        <th><center>Estatus</center></th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr v-for="(p, index) in listaPost" :key="index">
                                        <td>{{ index+1 }}</td>
                                        <td>{{ p.titulo }}</td>
                                        <td>{{ p.categoria }}</td>
                                        <td>{{ p.fecha }}</td>
                                        <td>
                                            <button type="button" class="btn rounded-pill btn-success waves-effect waves-light" @click.prevent="cambiarEstatus(p.id_p,0)" v-if="p.estatus == 1">Publicado</button>
                                            <button type="button" class="btn rounded-pill btn-warning waves-effect waves-light"  @click.prevent="cambiarEstatus(p.id_p,1)" v-else>Publicar</button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-icon btn-outline-info waves-effect"  v-if="include('Editar')" @click="muestra(2),infoEditar(p)">
                                                <i class="tf-icons ri-edit-box-fill ri-22px"></i>
                                            </button>
                                        </td>
                                        <!-- <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="ri-more-2-line"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" type="button" style="color: orange;" v-if="include('Vizualizar')" @click="muestra(1),infoUsuario(p)">
                                                    <i class="ri-clipboard-line me-1"></i> Vizualizar</a>
                                                <a class="dropdown-item" type="button" style="color: #33b2ff;" v-if="include('Editar')" 
                                                    data-bs-toggle="modal" data-bs-target="#editp" @click="infoUsuario(p)">
                                                    <i class="ri-pencil-line me-1"></i> Editar</a>
                                                <a class="dropdown-item" type="button" style="color: red;" v-if="include('Eliminar')" @click="eliminarPerfil(p.id)">
                                                    <i class="ri-delete-bin-7-line me-1"></i> Eliminar</a>
                                            </div>
                                        </div>
                                        </td> -->
                                    </tr>
                                </tbody>
                            </table>
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
                </div>
            </div>
        </div>
        <!-- vista alta de torneos -->
        <div id="main" v-if="this.vista == 1">
            <div class="card mb-6">
                <h5 class="card-header" style="color: green;">Nuevo Post</h5>
                <form class="card-body">
                  <div class="row g-6">
                    <div class="col-md-6">
                      <div class="form-floating form-floating-outline">
                        <input type="text" id="titulo" class="form-control" placeholder="Nombre del Titulo"  @input="crearRuta(1)" v-model="nuevoPost.titulo"/>
                        <label for="Titulo">Titulo</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="input-group input-group-merge">
                        <div class="form-floating form-floating-outline">
                          <input
                            type="text"
                            id="ruta"
                            class="form-control"
                            placeholder="ruta" style="color: black;"
                            aria-label="ruta" v-model="nuevoPost.ruta" disabled/>
                          <label for="ruta">Ruta</label>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="input-group input-group-merge">
                        <div class="form-floating form-floating-outline">
                          <input
                            type="text"
                            id="subtitulo"
                            class="form-control"
                            placeholder="subtitulo"
                            aria-label="subtitulo" v-model="nuevoPost.subtitulo"/>
                          <label for="subtitulo">Subtitulo</label>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="input-group input-group-merge">
                        <div class="form-floating form-floating-outline">
                          <input
                            type="date"
                            id="fecha"
                            class="form-control"
                            placeholder="fecha"
                            aria-label="fecha" v-model="nuevoPost.fecha"/>
                          <label for="fecha">Fecha</label>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <select id="categoria" name="categoria" class="form-select" v-model="nuevoPost.categoria">
                                <option value="Selecciona una Categoria">Selecciona una Categoria</option>
                                <option value="comunicados">Comunicados</option>
                                <option value="noticias">Noticias</option>
                            </select>
                            <label for="categoria">Categoria</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6" >
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="file" class="form-control" id="bs-validation-upload-file" accept="image/png,image/jpeg" ref="filesolo" @change="onChangeFileUploadSolo()">
                            <label for="bs-validation-upload-file">Foto</label>
                        </div>
                        <div class="file-path-wrapper">
                            <p class="grey-text"><b>Dimensiones: 1440px * 600px | Peso Max. 2MB | Formato: JPG o PNG</b></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <figure v-show="imagenMiniatura != ''">
                            <img width="120" height="120" :src="imagen" alt="imagen principal post">
                        </figure>
                    </div>
                    <h6>Galeria</h6>
                    <div class="col-md-12">
                        <vue-dropzone
                            ref="myVueDropzone"
                            id="dropzone"
                            :options="dropzoneOptions"
                            >
                            <div class="dropzone-custom-content">
                                <p class="dropzone-custom-title gray-text">Dimensiones: 940px * 480px | Peso Max. 2MB | Formato: JPG o PNG</p>
                                <div class="subtitle">...Haz clic aquí o arrastra las imágenes</div>
                            </div>
                        </vue-dropzone>
                    </div>
                    <h6>Información</h6>
                    <div class="col-md-12">
                        <div class="form-floating form-floating-outline">
                            <div class="edit_container">
                                <quill-editor
                                    v-model="content"
                                    style="height: 300px ;text-align: left;"
                                    ref="myQuillEditor"
                                    :options="editorOption"
                                    @blur="onEditorBlur($event)"
                                    @focus="onEditorFocus($event)"
                                    @change="onEditorChange($event)">
                                </quill-editor>
                            </div>
                        </div>
                       
                    </div>
                  </div>
                  
                  
                  <div class="pt-6 mt-6">
                    <button type="button" class="btn btn-primary me-4" @click="crearPost()">Guardar</button>
                    <button type="reset" class="btn btn-danger" @click="muestra(0)">Cancelar</button>
                  </div>
                </form>
            </div>
        </div>
         <!-- vista editar de torneos -->
         <div id="main" v-if="this.vista == 2">
            <div class="card mb-6">
                <h5 class="card-header" style="color: green;">Editar Post</h5>
                <form class="card-body">
                  <div class="row g-6">
                    <div class="col-md-6">
                      <div class="form-floating form-floating-outline">
                        <input type="text" id="titulo" class="form-control" placeholder="Nombre del Titulo"  @input="crearRuta(1)" v-model="editaPost.titulo"/>
                        <label for="Titulo">Titulo</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="input-group input-group-merge">
                        <div class="form-floating form-floating-outline">
                          <input
                            type="text"
                            id="ruta"
                            class="form-control"
                            placeholder="ruta" style="color: black;"
                            aria-label="ruta" v-model="editaPost.ruta" disabled/>
                          <label for="ruta">Ruta</label>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="input-group input-group-merge">
                        <div class="form-floating form-floating-outline">
                          <input
                            type="text"
                            id="subtitulo"
                            class="form-control"
                            placeholder="subtitulo"
                            aria-label="subtitulo" v-model="editaPost.subtitulo"/>
                          <label for="subtitulo">Subtitulo</label>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="input-group input-group-merge">
                        <div class="form-floating form-floating-outline">
                          <input
                            type="date"
                            id="fecha"
                            class="form-control"
                            placeholder="fecha"
                            aria-label="fecha" v-model="editaPost.fecha"/>
                          <label for="fecha">Fecha</label>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <select id="categoria" name="categoria" class="form-select" v-model="editaPost.categoria">
                                <option value="Selecciona una Categoria">Selecciona una Categoria</option>
                                <option value="comunicados">Comunicados</option>
                                <option value="noticias">Noticias</option>
                            </select>
                            <label for="categoria">Categoria</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6" >
                        <div class="form-floating form-floating-outline mb-6">
                            <input type="file" class="form-control" id="bs-validation-upload-file" accept="image/png,image/jpeg"
                                ref="filesoloeditar" @change="onChangeFileUploadSoloEditar()">
                            <label for="bs-validation-upload-file">Foto</label>
                        </div>
                        <div class="file-path-wrapper">
                            <p class="grey-text"><b>Dimensiones: 1440px * 600px | Peso Max. 2MB | Formato: JPG o PNG</b></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <figure v-if="imagenMiniatura == ''">
                            <img width="150" v-show="this.exist_imgp == true"
                            height="190"
                            :src="`ArchivosSistema/Post/${editaPost.imagen_sola}`"
                            alt="imagen principal post"
                            class=" z-depth-4"> 
                            <img width="150" v-show="this.exist_imgp == false"
                            height="190"
                            :src="`https://test-intranet.amfpro.mx/ArchivosSistema/Post/${editaPost.imagen_sola}`"
                            alt="imagen principal post"
                            class=" z-depth-4"> 
                        </figure>
                        <figure v-else>
                            <img width="150"
                            height="190"
                            :src="imagen"
                            alt="imagen principal post">
                        </figure>
                    </div>
                    <h6>Galeria</h6>
                    <div class="col-md-12">
                         <a href="#*" v-for="(imagen, index) in carruselImagenes" :key="index"  >
                            <div class="image-container">
                                    <img :src="`ArchivosSistema/Post/${imagen.nombre}`" width="80px" :alt="`${imagen.nombre}`" v-show="imagen.img_value == true"/>
                                    <img :src="`https://test-intranet.amfpro.mx/ArchivosSistema/Post/${imagen.nombre}`" width="80px" :alt="`${imagen.nombre}`" v-show="imagen.img_value == false"/>
                                   
                                    <div class="overlay">
                                        <button type="button" class="btn btn-icon btn-outline-danger waves-effect"   @click="quitaImagen(index, imagen.id_imagen)">
                                            <i class="tf-icons ri-delete-bin-2-fill ri-22px"></i>
                                        </button>
                                    </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-12">
                        <vue-dropzone
                            ref="myVueDropzoneEdit"
                            id="dropzone"
                            :options="dropzoneOptions">
                            <div class="dropzone-custom-content">
                                <p class="dropzone-custom-title gray-text">Dimensiones: 940px * 480px | Peso Max. 2MB | Formato: JPG o PNG</p>
                                <div class="subtitle">...Haz clic aquí o arrastra las imágenes</div>
                            </div>
                        </vue-dropzone>
                    </div>
                    <h6>Información</h6>
                    <div class="col-md-12">
                        <div class="form-floating form-floating-outline">
                            <div class="edit_container">
                                <quill-editor
                                    v-model="contentEditar"
                                    style="height: 300px ;text-align: left;"
                                    ref="myQuillEditor"
                                    :options="editorOption"
                                    @blur="onEditorBlur($event)"
                                    @focus="onEditorFocus($event)"
                                    @change="onEditorChange($event)">
                                </quill-editor>
                            </div>
                        </div>
                       
                    </div>
                  </div>
                  
                  
                  <div class="pt-6 mt-6">
                    <button type="button" class="btn btn-primary me-4" @click="editarPost()">Editar</button>
                    <button type="reset" class="btn btn-danger" @click="muestra(0)">Cancelar</button>
                  </div>
                </form>
            </div>
        </div>
        <br><br><br>
    </div>
</template>
<script>
    import axios from 'axios';
    import 'quill/dist/quill.core.css'
    import 'quill/dist/quill.snow.css'
    import 'quill/dist/quill.bubble.css'
    import { quillEditor } from 'vue-quill-editor';
    import vue2Dropzone from 'vue2-dropzone'
    import 'vue2-dropzone/dist/vue2Dropzone.min.css'
    export default {
        name: '',
        components: {
            vueDropzone: vue2Dropzone,
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
                nuevoPost: {
                    titulo:'', subtitulo: '', ruta:'', imagen_sola:'', imagenes:'', fecha:'', categoria:'Selecciona una Categoria',
                    informacion:''
                },
                imagenMiniatura:'',
                editaPost: {
                    id_p:'',titulo:'', subtitulo: '', ruta:'', imagen_sola:'', imagenes:'', fecha:'', categoria:'Selecciona una Categoria',
                    informacion:''
                },
                search:'',
                listaPost:[],
                pagination: {
                    'total': 0, 'current_page': 0, 'per_page': 0, 'last_page': 0, 'from': 0, 'to': 0
                },
                offset: 2,
                listaImagenes:[],
                nuevalista:'',
                dropzoneOptions: {
                    url: './post/imagenes',
                    thumbnailWidth: 150,
                    maxFilesize: 5,
                    addRemoveLinks: true,
                    acceptedFiles: '.jpg, .jpeg, .png',
                    dictDefaultMessage: '...Haz clic aquí o arrastra las imágenes',
                    headers: {
                        "X-CSRF-TOKEN": document.head.querySelector("[name=csrf-token]").content
                    }

                },
                file: '',
                fileeditar:'',
                content: ``,
                exist_imgp:'',
                contentEditar: ``,
                editorOption: {},
                carruselImagenes:[]
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
            },
            imagen(){
                return this.imagenMiniatura
            },
            
        },
        watch: {
            
        },
        mounted() {
            this.getPost();
        },
        methods: {
            getPost(page){
                if (this.search == '') {
                    var url = `post/busqueda?page=`+page;
                    axios.get(url).then(response => {

                        this.listaPost= response.data.listaPost.data
                        this.pagination = response.data.pagination
                        // this.identificador = response.data.ultimo
                    });
                } else {
                    this.search
                    var url = `post/busqueda?buscador=${this.search}&page=`+page;
                    axios.get(url).then(response => {

                        this.listaPost = response.data.listaPost.data
                        this.pagination = response.data.pagination
                        // this.identificador = response.data.ultimo
                    });
                }
            },
            include(permiso){
                return this.permisos.includes(permiso);
            },
            muestra(valor){
                this.vista = valor;
            },
            cambiarvistaeditar(valor){
                this.mostrareditar = valor;
                this.editaPost= {
                        titulo:'',
                        subtitulo: '',
                        ruta:'',
                        imagen_sola:'',
                        imagenes:'',
                        fecha:'',
                        categoria:'Selecciona categoria',
                        informacion:''
                    }
                this.contentEditar=''
                this.imagenMiniatura =''
            },
            infoEditar(lp){
                this.editaPost.id_p = lp.id_p
                this.editaPost.titulo = lp.titulo
                this.editaPost.subtitulo = lp.subtitulo
                this.editaPost.ruta = lp.ruta
                this.editaPost.fecha = lp.fecha
                this.editaPost.categoria = lp.categoria
                this.editaPost.informacion = lp.informacion
                this.editaPost.imagen_sola = lp.imagen_p
                this.contentEditar= lp.informacion
                this.exist_imgp = lp.exist_imgp;

                axios.get(`post/buscaImagenes/${this.editaPost.id_p}`).then((res)=>{
                    this.carruselImagenes = res.data.imagenes
                })
            },
            onChangeFileUploadSolo(){
                this.file = this.$refs.filesolo.files[0];
                console.log(this.file);
                if (this.file.type != 'image/png' && this.file.type != 'image/jpeg') {
                    Swal.fire({
                        title: 'Error',
                        text: "Solo se permiten archivos PNG y JPEG",
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2500,
                    });
                    this.$refs.filesolo.value = null;
                    return;
                }
                this.nuevoPost.imagen_sola = this.file
                this.cargarImagen(this.file)
            },
            onChangeFileUploadSoloEditar(){
                this.fileeditar = this.$refs.filesoloeditar.files[0];
                // console.log(this.file);
                if (this.fileeditar.type != 'image/png' && this.fileeditar.type != 'image/jpeg') {
                    Swal.fire({
                        title: 'Error',
                        text: "Solo se permiten archivos PNG y JPEG!",
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2500,
                    });
                    this.$refs.filesoloeditar.value = null;
                    return;
                }
                this.editaPost.imagen_sola = this.fileeditar
                this.cargarImagen(this.fileeditar)
            },
                cargarImagen(file){
                    let reader = new FileReader();

                    reader.onload = (e) => {
                        this.imagenMiniatura = e.target.result
                    }
                    reader.readAsDataURL(file)
                },
                onChangeFileUploadCarousel(){
                    this.nuevalista = '';
                    this.listaImagenes = []
                    this.$forceUpdate();
                    this.fileimagenes = this.$refs.filecarousel.files;
                    for (let index = 0; index < this.$refs.filecarousel.files.length; index++) {
                        if (this.fileimagenes[index].type != 'image/png' && this.fileimagenes[index] != 'image/jpeg') {
                            Swal.fire({
                                title: 'Error',
                                text: "Solo se permiten archivos PNG y JPEG!",
                                icon: 'error',
                                showConfirmButton: false,
                                timer: 2500,
                            });
                            this.$refs.filecarousel.value = null;
                            $('#imagenes').val('');
                            return;
                        }
                        this.listaImagenes.push(this.fileimagenes[index].name)

                    }
                    this.nuevoPost.imagenes = this.fileimagenes
                    this.nuevalista = Array.from(this.fileimagenes);
                    console.log(this.nuevalista)
                    console.log(this.listaImagenes)

                },
                quitaImagen(index, id){
                    this.carruselImagenes.splice(index,1)
                    axios.delete(`post/eliminaImagen/${id}`).then((res)=>{
                        Swal.fire({
                            title: 'Exitoso',
                            text: "Se Elimino correctamente!",
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2500,
                        });
                    })

                },
            crearPost(){

                this.nuevoPost.informacion = this.content;
                if (this.nuevoPost.titulo == '') {
                    this.$toast.error("Debes Ingresar un Titulo", {
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
                if (this.nuevoPost.subtitulo === '') {
                    this.$toast.error("Debes Ingresar un Subtitulo", {
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
                if (this.nuevoPost.ruta === '') {
                    this.$toast.error("Debes Ingresar un Ruta", {
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
                if (this.nuevoPost.imagen_sola === '') {
                    this.$toast.error("Debes adjuntar una Imagen", {
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
                if (this.nuevoPost.fecha === '') {
                    this.$toast.error("Debes seleccionar una Fecha", {
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
                if (this.nuevoPost.categoria === 'Selecciona una Categoria') {
                    this.$toast.error("Debes Ingresar una Categoria", {
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
                if (this.nuevoPost.informacion === '') {
                    this.$toast.error("Debes Ingresar información del Post", {
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
                formData.append('titulo', this.nuevoPost.titulo);
                formData.append('subtitulo', this.nuevoPost.subtitulo);
                formData.append('ruta', this.nuevoPost.ruta);
                formData.append('imagen_sola', this.nuevoPost.imagen_sola);
                const files = this.$refs.myVueDropzone.getAcceptedFiles();

                for (let i = 0; i < files.length; i++) {
                    formData.append('files[' + i + ']', files[i]);
                }
                formData.append('fecha', this.nuevoPost.fecha);
                formData.append('categoria', this.nuevoPost.categoria);
                formData.append('informacion', this.nuevoPost.informacion);
                axios.post('post/nuevo',formData).then(res =>{
                    Swal.fire({
                        title: 'Exitoso',
                        text: "Se Guardo correctamente!",
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2500,
                    });
                    this.nuevoPost= {
                        titulo:'',
                        subtitulo: '',
                        ruta:'',
                        imagen_sola:'',
                        imagenes:'',
                        fecha:'',
                        categoria:'Selecciona categoria',
                        informacion:''
                    }
                    this.vista = 0;
                    $('#imagenes').val('');
                    $('#input-file-now').val('');
                    this.getPost();
                })

            },
            buscarPost() {
                clearTimeout(this.tiempoBusqueda)
                this.tiempoBusqueda = setTimeout(this.getPost, 200)
            },
            changePage: function (page) {
                this.pagination.current_page = page;
                this.getPost(page);
            },
            cambiarEstatus(id_p,value){
                var estatus = value;
                var id = id_p;
                axios.put(`post/cambio-estatus/${id}/${estatus}`).then(res =>{
                    Swal.fire({
                        title: 'Exitoso',
                        text: "Se cambio el estatus del post!",
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2500,
                    });
                    this.getPost();
                })
            },
            crearRuta(bandera){

                if (bandera ==1) {
                    var titulo = this.nuevoPost.titulo;
                    titulo = titulo.toLowerCase();
                    titulo = titulo.replace(/[á]/g, 'a');
                    titulo = titulo.replace(/[é]/g, 'e');
                    titulo = titulo.replace(/[í]/g, 'i');
                    titulo = titulo.replace(/[ó]/g, 'o');
                    titulo = titulo.replace(/[ú]/g, 'u');
                    titulo = titulo.replace(/[ñ]/g, 'n');
                    titulo = titulo.replace(/ /g, '-');
                    $("#ruta").val(titulo);
                    this.nuevoPost.ruta = titulo
                }
                if(bandera == 2){
                    var titulo = $(".editarTitulo").val()
                    titulo = titulo.toLowerCase();
                    titulo = titulo.replace(/[á]/g, 'a');
                    titulo = titulo.replace(/[é]/g, 'e');
                    titulo = titulo.replace(/[í]/g, 'i');
                    titulo = titulo.replace(/[ó]/g, 'o');
                    titulo = titulo.replace(/[ú]/g, 'u');
                    titulo = titulo.replace(/[ñ]/g, 'n');
                    titulo = titulo.replace(/ /g, '-');
                    $("#editarRuta").val(titulo);
                    this.editaPost.ruta = titulo
                }

            },
            afterUploadComplete (event){
                console.log(event.upload.filename)
            },
            onEditorReady (editor) {}, // prepara el editor
            onEditorBlur () {}, // Evento de pérdida de foco
            onEditorFocus () {}, // Obtiene el evento de enfoque
            onEditorChange () {}, // evento de cambio de contenido
            editarPost(){
                if (this.editaPost.titulo == '') {
                    this.$toast.error("Debes Ingresar un Titulo", {
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
                if (this.editaPost.subtitulo === '') {
                    this.$toast.error("Debes Ingresar un Subtitulo", {
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
                if (this.editaPost.ruta === '') {
                    this.$toast.error("Debes Ingresar un Ruta", {
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
                if (this.editaPost.imagen_sola === '') {
                    this.$toast.error("Debes adjuntar una Imagen", {
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
                if (this.editaPost.fecha === '') {
                    this.$toast.error("Debes seleccionar una Fecha", {
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
                if (this.editaPost.categoria === 'Selecciona una Categoria') {
                    this.$toast.error("Debes Ingresar una Categoria", {
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
                if (this.editaPost.informacion === '') {
                    this.$toast.error("Debes Ingresar información del Post", {
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
                // const editaPost = this.editaPost
                // axios.put(`post/edita/${this.editaPost.id_p}`, editaPost).then((res)=>{
                //     console.log(res);
                // })
                let formData = new FormData();
                formData.append('titulo', this.editaPost.titulo);
                formData.append('subtitulo', this.editaPost.subtitulo);
                formData.append('ruta', this.editaPost.ruta);
                formData.append('imagen_sola', this.editaPost.imagen_sola);
                // for (let index = 0; index < this.nuevalista.length; index++) {
                //     let filecarousel = this.nuevalista[index];
                //     formData.append('imagenes[' + index + ']', filecarousel);
                // }
                const files = this.$refs.myVueDropzoneEdit.getAcceptedFiles();
                for (let i = 0; i < files.length; i++) {
                    formData.append('filesEdita[' + i + ']', files[i]);
                }
                formData.append('fecha', this.editaPost.fecha);
                formData.append('categoria', this.editaPost.categoria);
                formData.append('informacion', this.contentEditar);
                axios.post(`post/edita/${this.editaPost.id_p}`,formData).then(res =>{
                    Swal.fire({
                        title: 'Exitoso',
                        text: "Se Edito Correctamente!",
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2500,
                    });
                    this.editaPost= {
                        titulo:'',
                        subtitulo: '',
                        ruta:'',
                        imagen_sola:'',
                        imagenes:'',
                        fecha:'',
                        categoria:'Selecciona categoria',
                        informacion:''
                    }
                    this.vista = 0
                    // this.nuevalista = '';
                    // $('#imagenes').val('');
                    $('#input-file-now-editar').val('');
                    this.getPost();
                })
            },
        },
    };
</script>
<style scoped>
.quill-editor{
    height: 350px;
}
.ql-toolbar.ql-snow{
    text-align: left;
}
.imghover  img{
    margin: 2%;
    grid-gap: 30px;
    transition: all 300ms;
    position: relative;
    overflow: hidden;
    border-radius: 6px;
    box-shadow: 0px 15px 25px;
    cursor: pointer;
}
.imghover  img:hover{
    transform: scale(1.30);
}

.image-container {
    margin: 2%;
    display: inline-block;
    position: relative;
}
.image-container img{
    margin: 2%;
    display: inline-block;
    position: relative;
    grid-gap: 30px;
    transition: all 300ms;
    border-radius: 6px;
    box-shadow: 0px 15px 25px;
    object-fit: cover;
    cursor: pointer;
}
/* .image-container .img:hover{
  transform: scale(1.30);
} */

.image-container:hover img {
  transform: rotate(10deg);
  /* transform: scale(1.30); */
}

.overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgb(210 223 231 / 50%);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.image-container:hover .overlay {
  opacity: 1;
}

.overlay i {
  color: #ff0000;
  font-size: 20px;
}
</style>