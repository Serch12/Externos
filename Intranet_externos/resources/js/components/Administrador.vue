    <template>
        <div id="main" v-if="this.vista == 0">
            <div class="row">
                <!-- Users List Table -->
                <div class="card">
                
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <h5 class="card-header">Usuario</h5>
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <input type="search" id="email"class="form-control"  v-model="search" placeholder="Buscar Registro" />
                                <button type="button" class="btn btn-outline-success waves-effect" data-bs-toggle="modal" data-bs-target="#editUser">Agregar</button>
                            </div>
                        </div>
                        <div class="table-responsive text-nowrap mt-2">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Foto</th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Rol</th>
                                        <th>Estatus</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr v-for="(user, index) in Usuario" :key="index">
                                        <td>{{ index+1 }}</td>
                                        <td>
                                            <div class="d-flex justify-content-start align-items-center">
                                                <div class="avatar-wrapper">
                                                    <div class="avatar me-2">
                                                        <img :src="`${user.img}`" alt="Avatar" class="rounded-circle">
                                                    </div>
                                                </div>
                                            </div>
                        
                                        </td>
                                        <td>{{ user.name }}</td>
                                        <td>{{ user.email }}</td>
                                        <td>{{ user.rol_name }}</td>
                                        <td><span :class="`badge rounded-pill ${user.color} me-1`">{{user.text}}</span></td>
                                        <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="ri-more-2-line"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:void(0);"><i class="ri-pencil-line me-1"></i> Edit</a>
                                                <a class="dropdown-item" href="javascript:void(0);" style="color: red;"><i class="ri-delete-bin-7-line me-1"></i> Delete</a>
                                            </div>
                                        </div>
                                        </td>
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
            <!-- Moda de alta usuario -->
            <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                    <div class="modal-content">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="modal-body p-0">
                            <div class="text-center mb-6">
                                <h4 class="mb-2">Agregar Usuario</h4>
                            </div>
                            <form id="editUserForm" class="row g-5">
                                <div class="col-12 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                    <input
                                        type="text"
                                        id="name"
                                        class="form-control"
                                        v-model="registro.name"
                                        placeholder="Nombre" />
                                    <label for="name">Nombre</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                    <select id="roles" name="roles" class="form-select" v-model="registro.rol">
                                        <option value="Selecciona un Rol">Selecciona un Rol</option>
                                        <option v-for="(rol, index) in Roles" :key="index" v-bind:value="rol.name">{{rol.name}}</option>
                                    </select>
                                    <label for="roles">Roles</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                    <input
                                        type="text"
                                        id="email"
                                        class="form-control"
                                        v-model="registro.email"
                                        placeholder="ejemplo@gmail.com" />
                                    <label for="email">Email</label>
                                    </div>
                                </div>
                            
                                <div class="col-12 col-md-6">
                                    <div class="form-password-toggle">
                                        <div class="input-group input-group-merge">
                                        
                                        <div class="form-floating form-floating-outline">
                                            <input
                                            type="password"
                                            id="password"
                                            class="form-control @error('password') @enderror"
                                            v-model="registro.password"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="password" />
                                            <label for="password">Password</label>
                                        </div>
                                        <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="editBillingAddress" v-model="registro.activacion"/>
                                    <label for="editBillingAddress" class="text-heading">Activar Usuario?</label>
                                    </div>
                                </div>
                                <div class="col-12 text-center d-flex flex-wrap justify-content-center gap-4 row-gap-4">
                                    <button type="button" class="btn btn-primary" @click="agregaUser()">Guardar</button>
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
    export default {
        name: '',
        components: {
            
        },
        mixins: [],
        props: [
            'id_usuario_logeado',
            'name_usuario_logeado',
            'rol_usuario',
            'componente'
        ],
        data() {
            return {
                vista:0,
                search:'',
                registro:{
                    name:'',
                    rol:'Selecciona un Rol',
                    email:'',
                    password:'',
                    activacion:false
                },
                Usuario:[],
                Roles:[],
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
            this.getAdministrador();
        },
        methods: {
            getAdministrador(page){
                if (this.search == '') {
                
                var url = `administrador/Busqueda?page=`+page;
                axios.get(url).then(response => {

                    this.Usuario = response.data.muestra.data,
                    this.Roles = response.data.roles
                    this.pagination = response.data.pagination
                });
            } else {
                this.search
                var url = `administrador/Busqueda?buscador=${this.search}&page=`+page;
                axios.get(url).then(response => {
                    this.Usuario = response.data.muestra.data
                    this.pagination = response.data.pagination
                });
            }
            },
            changePage: function (page) {
                this.pagination.current_page = page;
                this.getAdministrador(page);
            },
            agregaUser(){
                if (this.registro.name == '') {
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
                }

                let formData = new FormData();
                    formData.append('name',this.registro.name);
                    formData.append('rol',this.registro.rol);
                    formData.append('email',this.registro.email);
                    formData.append('password',this.registro.password);
                    formData.append('estatus',this.registro.activacion);
                axios.post('administrador/createUser',formData).then(res =>{
                    this.registro ={
                        name:'',
                        rol:'Selecciona un Rol',
                        email:'',
                        password:'',
                        activacion:false
                    }
                    this.getAdministrador();
                    $('#editUser').modal('hide');
                    Swal.fire({
                        title: 'Exitoso',
                        text: "Se Agrego correctamente!",
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