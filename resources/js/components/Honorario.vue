<template>
    <div>
        <div id="main" v-if="this.vista == 0">
            <div class="col-md-12">
                <div class="card mb-6">
                <div class="card-header p-0">
                    <div class="nav-align-top">
                        <ul class="nav nav-tabs nav-fill" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button type="button" class="nav-link waves-effect active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-home" aria-controls="navs-justified-home" aria-selected="true">
                                    <span class="d-none d-sm-block"><i class="tf-icons ri-football-line me-2"></i> Honorario </span><i class="ri-football-line ri-20px d-sm-none"></i></button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button type="button" class="nav-link waves-effect" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-profile" aria-controls="navs-justified-profile" aria-selected="false" tabindex="-1">
                                    <span class="d-none d-sm-block"><i class="tf-icons ri-git-repository-line me-2"></i> Historial Honorario1</span><i class="ri-git-repository-line ri-20px d-sm-none"></i></button>
                            </li>
                            <span class="tab-slider" style="left: 0px; width: 165.135px; bottom: 0px;"></span>
                        </ul>
                    </div>
                </div>
                <div class="card-body pt-5">
                    <div class="tab-content p-0">
                        <div class="tab-pane fade active show" id="navs-justified-home" role="tabpanel">
                            <div class="row g-6 mt-2">
                                
                               <HonorarioFrom
                               :user_id="this.id_usuario_logeado"
                               ref="ejecutaHono">

                               </HonorarioFrom>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
                            <div class="row g-6 mt-2">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <h5 class="card-header">Historial Honorario</h5>
                                    </div>
                                    <div class="col-12 col-md-6 mt-3">
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <input type="search" id="email"class="form-control"  v-model="search" placeholder="Buscar Registro" @keyup="buscarUsuario()"/>
                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                <button type="button" class="btn btn-outline-success waves-effect" v-if="include('Crear')" for="file-upload"  onclick="document.getElementById('file-upload').click()">Agregar</button>
                                                <input type="file" id="file-upload" ref="escudo" accept="image/*" style="display: none;" @change="imgPops()" multiple/>
                                            </div>
                                        </div>
                                    </div>
                                    <center class="mt-2">
                                        <h5 class="card-header" style="color: green;">Sin Historial</h5>
                                        <img src="style/assets/img_externos/no_hay_honorarios.png" alt="img" style="max-width: 300px;">
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <br><br><br><br><br><br>
    </div>
</template>
<script>
import HonorarioFrom from './SubComponentes/HonorarioForm.vue';
import HistorialHonorario from './SubComponentes/HistorialHonorario.vue';
export default {
    name: '',
    components: {
        HonorarioFrom,
        HistorialHonorario
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
            search: '',
        }
    },
    computed: {
        
    },
    
    mounted() {
        this.iniciaHonorario();
    },
    methods: {
        include(permiso){
            return this.permisos.includes(permiso);
        },

        iniciaHonorario(){
            if (this.$refs.ejecutaHono) {
                this.$refs.ejecutaHono.getHonorario();
            } 
        }
    }
};
</script>
<style lang='' scoped>
</style>