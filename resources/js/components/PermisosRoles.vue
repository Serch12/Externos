<template>
    <div>
        <div id="main" v-if="this.vista == 0">
            <div class="row">
                <h4 class="mb-1">Lista de Roles</h4>
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
                                        data-bs-target="#addRoleModal"
                                        data-bs-toggle="modal"
                                        class="btn btn-sm btn-primary mb-4 text-nowrap add-new-role">
                                        Añadir Role
                                    </button>
                                    <p class="mb-0">
                                        Añadir nuevo role
                                    </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Vista de roles -->
                    <div class="col-xl-4 col-lg-6 col-md-6" v-for="(r, index) in Roles" :key="index">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <p class="mb-0">Total 4 usuarios</p>
                                    <!-- <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                        <li
                                            data-bs-toggle="tooltip"
                                            data-popup="tooltip-custom"
                                            data-bs-placement="top"
                                            title="Vinnie Mostowy"
                                            class="avatar pull-up">
                                            <img class="rounded-circle" src="style/assets/img/avatars/5.png" alt="Avatar" />
                                        </li>
                                        <li
                                            data-bs-toggle="tooltip"
                                            data-popup="tooltip-custom"
                                            data-bs-placement="top"
                                            title="Allen Rieske"
                                            class="avatar pull-up">
                                            <img class="rounded-circle" src="style/assets/img/avatars/12.png" alt="Avatar" />
                                        </li>
                                        <li
                                            data-bs-toggle="tooltip"
                                            data-popup="tooltip-custom"
                                            data-bs-placement="top"
                                            title="Julee Rossignol"
                                            class="avatar pull-up">
                                            <img class="rounded-circle" src="style/assets/img/avatars/6.png" alt="Avatar" />
                                        </li>
                                        <li class="avatar">
                                            <span
                                            class="avatar-initial rounded-circle pull-up bg-lighter text-body"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="bottom"
                                            title="3 more"
                                            >+3</span
                                            >
                                        </li>
                                    </ul> -->
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="role-heading">
                                    <h5 class="mb-1">{{r.name}}</h5>
                                    <a type="button" data-bs-toggle="modal" data-bs-target="#updateRoleModal" class="role-edit-modal" style="color: #4caf50;" @click="infoRoles(r)">
                                        <p class="mb-0">Editar Role</p>
                                    </a>
                                    </div>
                                    <a type="button" class="text-danger" @click="deleteRole(r)"><i class="ri-delete-bin-6-fill ri-22px"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
         <!-- Modal añade rol y permisos -->
        <div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-dialog-centered modal-add-new-role">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body p-0">
                        <div class="text-center mb-6">
                            <h4 class="role-title mb-2 pb-0">Añadir Nuevo Role</h4>
                            <p>Establecer permisos</p>
                        </div>
                        <!-- Add role form -->
                        <form id="addRoleForm" class="row g-3" onsubmit="return false">
                            <div class="col-12 mb-3">
                            <div class="form-floating form-floating-outline">
                                <input
                                    type="text"
                                    id="modalRoleName"
                                    v-model="role.nombre"
                                    class="form-control"
                                    placeholder="Introduzca un nombre de rol"
                                    tabindex="-1" />
                                <label for="modalRoleName">Nombre Rol</label>
                            </div>
                            </div>
                            <div class="col-12">
                                <h5 class="mb-6">Role Permisos</h5>
                                <!-- Permission table -->
                                <div class="table-responsive">
                                    <table class="table table-flush-spacing">
                                        <tbody>
                                            <tr>
                                                <td class="text-nowrap fw-medium"> Acceso al Administrador 
                                                    <i class="ri-information-line" data-bs-toggle="tooltip" data-bs-placement="top" title="Permite un acceso completo al sistema"></i>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="form-check mb-0 mt-1">
                                                            <input class="form-check-input" type="checkbox" id="selectAll" v-model="admincheck" @change="checkAdmin()"/>
                                                            <label class="form-check-label" for="selectAll">Seleccione Todos</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                            <!-- <td class="text-nowrap fw-medium">{{this.role.nombre}}</td> -->
                                                <td>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="form-check mb-0 mt-1 me-4 me-lg-12" v-for="(p, index) in Permissions" :key="index">
                                                            <input class="form-check-input" type="checkbox" :id="`date${index}`" @change="checkPermiso(index,p.id,p.name)"/>
                                                            <label class="form-check-label" for="date"> {{ p.name }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            <!-- Permission table -->
                            </div>
                            <div class="col-12 d-flex flex-wrap justify-content-center gap-4 row-gap-4">
                            <button type="button" class="btn btn-primary" @click="agregarRole()">Guardar</button>
                            <button
                                type="reset"
                                class="btn btn-outline-danger"
                                data-bs-dismiss="modal"
                                aria-label="Close">
                                Cancelar
                            </button>
                            </div>
                        </form>
                        <!--/ Add role form -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal editar rol y permisos -->
        <div class="modal fade" id="updateRoleModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-dialog-centered modal-add-new-role">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body p-0">
                        <div class="text-center mb-6">
                            <h4 class="role-title mb-2 pb-0">Editar Role</h4>
                            <p>Establecer permisos</p>
                        </div>
                        <!-- Add role form -->
                        <form id="addRoleForm" class="row g-3" onsubmit="return false">
                            <div class="col-12 mb-3">
                            <div class="form-floating form-floating-outline">
                                <input
                                    type="text"
                                    id="modalRoleName"
                                    v-model="detalleRole.name"
                                    class="form-control"
                                    placeholder="Introduzca un nombre de rol"
                                    tabindex="-1" />
                                <label for="modalRoleName">Nombre Rol</label>
                            </div>
                            </div>
                            <div class="col-12">
                                <h5 class="mb-6">Role Permisos</h5>
                                <!-- Permission table -->
                                <div class="table-responsive">
                                    <table class="table table-flush-spacing">
                                        <tbody>
                                            <tr>
                                                <td class="text-nowrap fw-medium"> Acceso al Administrador 
                                                    <i class="ri-information-line" data-bs-toggle="tooltip" data-bs-placement="top" title="Permite un acceso completo al sistema"></i>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="form-check mb-0 mt-1">
                                                            <input class="form-check-input" type="checkbox" id="selectAlluPDATE" v-model="admincheckUpdate" @change="checkAdminUpdate()"/>
                                                            <label class="form-check-label" for="selectAlluPDATE">Seleccione Todos</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                            <!-- <td class="text-nowrap fw-medium">{{this.role.nombre}}</td> -->
                                                <td>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="form-check mb-0 mt-1 me-4 me-lg-12" v-for="(p, index) in this.detallePermisos" :key="index">
                                                            <input class="form-check-input" type="checkbox" :id="`dateUpdate${index}`" @change="checkPermisoUpdate(index,p.id,p.name)"/>
                                                            <label class="form-check-label" for="date"> {{ p.name }} </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            <!-- Permission table -->
                            </div>
                            <div class="col-12 d-flex flex-wrap justify-content-center gap-4 row-gap-4">
                            <button type="button" class="btn btn-primary" @click="updateRole()">Editar</button>
                            <button
                                type="reset"
                                class="btn btn-outline-danger"
                                data-bs-dismiss="modal"
                                aria-label="Close">
                                Cancelar
                            </button>
                            </div>
                        </form>
                        <!--/ Add role form -->
                    </div>
                </div>
            </div>
        </div>
        <br><br><br>
    </div>
</template>
<script>
import { update } from 'lodash';

export default {
    name: '',
    components: {
        
    },
    mixins: [],
    props: {
        
    },
    data() {
        return {
            vista:0,
            Roles:[],
            Permissions:[],
            role:{
                nombre:'',
            },
            admincheck:false,
            admincheckUpdate:false,
            newpermisos:[],
            detallePermisos:[
                {
                    id:'',
                    name:'Crear'
                },
                {
                    id:'',
                    name:'Editar'
                },{
                    id:'',
                    name:'Eliminar'
                },
                {
                    id:'',
                    name:'Vizualizar'
                },
            ],
            newpermisosUpdate:[],
            detalleRole:[]
        }
    },
    computed: {
        
    },
    watch: {
        
    },
    mounted() {
        this.getPermisosRoles();
    },
    methods: {
        getPermisosRoles(){
            var url = `access/Muestra`;
            axios.get(url).then(response => {
                this.Roles = response.data.roles
                this.Permissions = response.data.permisos
            });
        },
        checkAdmin(){
            this.newpermisos = [];

            if (this.admincheck == true) {
                for (let index = 0; index < this.Permissions.length; index++) {
                    $(`#date${index}`).prop('checked', true);
                    this.newpermisos.push({
                        id: this.Permissions[index].id,
                        name: this.Permissions[index].name,
                    });
                }
            }else{
                for (let index = 0; index < this.Permissions.length; index++) {
                    $(`#date${index}`).prop('checked', false);
                    this.newpermisos = [];
                }
            }
        },
        checkPermiso(index,id,name){
            var check = $(`#date${index}`).prop('checked');
            if (check == true) {
                this.newpermisos.push({
                    id: id,
                    name:name
                })
            }else{
                this.newpermisos.splice(index, 1);
            }
        },
        agregarRole(){
            
            if (this.role.nombre == '') {
                this.$toast.error("Ingresa un Role", {
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

            if (this.newpermisos.length == 0) {
                this.$toast.error("Selecciona los Permisos", {
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
                formData.append('name',this.role.nombre);
                formData.append('permisos',JSON.stringify(this.newpermisos));

            axios.post('access/createRole',formData).then(response=>{
                this.getPermisosRoles();
                this.role = {
                    nombre:'',
                }
                this.admincheck = false;
                this.newpermisos =[];
                $('#addRoleModal').modal('hide');
                Swal.fire({
                    title: 'Exitoso',
                    text: "Se Agrego correctamente!",
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2500,
                });
            })

        },
        infoRoles(r){
           
            this.detalleRole = r;
            this.checkDetalleUpdate(this.detalleRole.permissions);
        },
        checkDetalleUpdate(permisos){

            this.newpermisosUpdate = [];
            for (let index = 0; index < this.detallePermisos.length; index++) {
                $(`#dateUpdate${index}`).prop('checked',false);
            }
            this.permisos = permisos;

            for (let index = 0; index < this.permisos.length; index++) {
                for (let idx = 0; idx < this.detallePermisos.length; idx++) {
                    if (this.permisos[index].name == this.detallePermisos[idx].name) {
                        $(`#dateUpdate${idx}`).prop('checked', true);
                        this.newpermisosUpdate.push({
                            id: this.permisos[index].id,
                            name: this.permisos[index].name,
                        });
                    }
                    
                }
            }
        },
        checkAdminUpdate(){
            this.newpermisosUpdate = [];

            if (this.admincheckUpdate == true) {
                for (let index = 0; index < this.detallePermisos.length; index++) {
                    $(`#dateUpdate${index}`).prop('checked', true);
                    this.newpermisosUpdate.push({
                        id: this.detallePermisos[index].id,
                        name: this.detallePermisos[index].name,
                    });
                }
            }else{
                for (let index = 0; index < this.detallePermisos.length; index++) {
                    $(`#dateUpdate${index}`).prop('checked', false);
                    this.newpermisosUpdate = [];
                }
            }
        },
        checkPermisoUpdate(index,id,name){
            var check = $(`#dateUpdate${index}`).prop('checked');
            if (check == true) {
                this.newpermisosUpdate.push({
                    id: id,
                    name:name
                })
            }else{
                this.newpermisosUpdate.splice(index, 1);
            }
        },
        updateRole(){
            if (this.detalleRole.name == '') {
                this.$toast.error("Ingresa un Role", {
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

            if (this.newpermisosUpdate.length == 0) {
                this.$toast.error("Selecciona los Permisos", {
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
                formData.append('id',this.detalleRole.id);
                formData.append('name',this.detalleRole.name);
                formData.append('permisos',JSON.stringify(this.newpermisosUpdate));

            axios.post('access/updateRole',formData).then(response=>{
                this.getPermisosRoles();
                this.admincheckUpdate = false;
                this.newpermisosUpdate =[];
                $('#updateRoleModal').modal('hide');
                Swal.fire({
                    title: 'Exitoso',
                    text: "Se Edito Correctamente!",
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2500,
                });
            })
        },
        deleteRole(r){
            this.id_role = r.id;
            Swal.fire({
                title: "Estas seguro?",
                text: "Se eliminara definitivamente!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Eliminar",
                cancelButtonColor: "#d33",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    let formData = new FormData();
                        formData.append('id',this.id_role);
                    axios.post('access/deleteRole',formData).then(response =>{
                        this.getPermisosRoles();
                        Swal.fire({
                            title: 'Exitoso',
                            text: "Se Elimino Correctamente!",
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2500,
                        });
                    })
                    
                }
            });
        }
    }
};
</script>
<style lang='' scoped>
</style>