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
                <form class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="backDropModalTitle">Agregar Correo</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-6 mt-2">
                            <div class="form-floating form-floating-outline">
                                <input
                                type="text"
                                id="nameBackdrop"
                                class="form-control"
                                placeholder="Enter Name" />
                                <label for="nameBackdrop">Name</label>
                            </div>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col mb-2">
                            <div class="form-floating form-floating-outline">
                                <input
                                type="email"
                                id="emailBackdrop"
                                class="form-control"
                                placeholder="xxxx@xxx.xx" />
                                <label for="emailBackdrop">Email</label>
                            </div>
                            </div>
                            <div class="col mb-2">
                            <div class="form-floating form-floating-outline">
                                <input type="date" id="dobBackdrop" class="form-control" />
                                <label for="dobBackdrop">DOB</label>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success">Guardar</button>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                            Cerrar
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <br><br><br>
    </div>
</template>
<script>
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
            search:''
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
    }
};
</script>
<style lang='' scoped>
</style>