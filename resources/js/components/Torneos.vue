<template>
    <div>
        <!-- vista de jugadores -->
        <div id="main" v-if="this.vista == 0">
            <div class="row g-6">
            <div class="card">  
                <div class="row">
                <div class="col-12 col-md-6">
                    <h5 class="card-header">Torneos</h5>
                </div>
                <div class="col-12 col-md-6 mt-3">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <input type="search" id="email"class="form-control"  v-model="search" placeholder="Buscar Torneos" @keyup="buscarJugador()"/>
                        <button type="button" class="btn btn-outline-success waves-effect" data-bs-toggle="modal" data-bs-target="#createJugador">Agregar</button>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6" v-for="(jur, index) in Torneo" :key="index">
                <div class="card">
                <div class="card-body text-center">
                    <div class="dropdown btn-pinned">
                    <button
                        type="button"
                        class="btn dropdown-toggle hide-arrow p-4"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="ri-more-2-line ri-22px text-muted"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                        <a class="dropdown-item" type="button" style="color: orange;" v-if="include('Vizualizar')" @click="infoJugador(jur),muestra(1)">
                            <i class="ri-clipboard-line me-1"></i> Vizualizar</a>  
                        </li>
                        <li>
                        <a class="dropdown-item" type="button" style="color: #33b2ff;" v-if="include('Editar')" 
                            data-bs-toggle="modal" data-bs-target="#editJugador" @click="infoJugador(jur)">
                            <i class="ri-pencil-line me-1"></i> Editar</a>  
                        </li>
                        <li v-if="jur.estatus == 1">
                        <a class="dropdown-item" type="button" style="color: green;" v-if="include('Permisos')" @click="infoJugador(jur)">
                            <i class="ri-checkbox-circle-fill me-1"></i> Activar</a>  
                        </li>
                        <li v-if="jur.estatus == 0">
                        <a class="dropdown-item" type="button" style="color: red;" v-if="include('Permisos')" @click="infoJugador(jur)">
                            <i class="ri-close-circle-fill me-1"></i> Desactivar</a>  
                        </li>
                        <li>
                        <a class="dropdown-item" type="button" style="color: red;" v-if="include('Eliminar')">
                        <i class="ri-delete-bin-7-line me-1"></i> Eliminar</a>
                        </li>
                    </ul>
                    </div>
                    <div class="mx-auto my-6">
                    <img  :src="`ArchivosSistema/Jugadores/${jur.id_jugador}/${jur.foto}`" alt="Avatar Image" style="width: 70px;"/>
                    </div>
                    <h5 class="mb-0 card-title">{{jur.nombre}}</h5>
                    <span>{{jur.categoria}}</span>
                    <div class="d-flex align-items-center justify-content-center my-6 gap-2">
                    <span :class="`badge bg-label-${jur.color} rounded-pill`">Sede: {{ jur.sede }}</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-around mb-6">
                    <div>
                        <h5 class="mb-0">Posición</h5>
                        <span>{{jur.posicion}}</span>
                    </div>
                    <div>
                        <h5 class="mb-0">Sexo</h5>
                        <span>{{jur.sexo}}</span>
                    </div>
                    <!-- <div>
                        <h5 class="mb-0">2.14k</h5>
                        <span>Connections</span>
                    </div> -->
                    </div>
                </div>
                </div>
            </div>
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
            search:'',
            Torneo:[],


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
        },
    },
    watch: {
        
    },
    mounted() {
        
    },
    methods: {
        getTorneo(){

        },
        include(permiso){
            return this.permisos.includes(permiso);
        },
        changePage: function (page) {
            this.pagination.current_page = page;
            this.getTorneo(page);
        },
    }
};
</script>
<style>

</style>