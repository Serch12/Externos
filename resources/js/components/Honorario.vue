<template>
    <div>
        <div id="main" v-if="this.vista == 0 && this.rol_usuario != 'Root'">
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
                                    <span class="d-none d-sm-block"><i class="tf-icons ri-git-repository-line me-2"></i> Historial Honorario</span><i class="ri-git-repository-line ri-20px d-sm-none"></i></button>
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
                                <HistorialHonorario
                                :user_id="this.id_usuario_logeado"
                                ref="ejecutaHistorial">

                                </HistorialHonorario>
                                <!-- <div class="row">
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
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
         <div id="main" v-else>
            <div class="row">
                    <!-- Users List Table -->
                    <div class="card">
                    
                        <div class="row">
                             <div class="row" v-if="this.AdminHistorial.length == 0">
                                <center class="mt-2">
                                    <h5 class="card-header" style="color: green;">No hay Honorarios Activos</h5>
                                    <img src="style/assets/img_externos/no_hay_honorarios.png" alt="img" style="max-width: 300px;">
                                </center>
                            </div>
                            <div class="table-responsive text-nowrap mt-2">
                                 <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>RFC</th>
                                        <th>Subtotal</th>
                                        <th>Iva</th>
                                        <th>Iva Retenido</th>
                                        <th>ISR</th>
                                        <th>Total</th>
                                        <th>Estatus</th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                    <tr v-for="(dh, index) in AdminHistorial" :key="index">
                                        <td>{{ index+1 }}</td>
                                        <td>{{dh.nombre_honorario}}</td>
                                        <td>{{ dh.RFC === null ? 'N/A' : dh.RFC }}</td>
                                        <td>${{ formatPrice(dh.subtotal) }}</td>
                                        <td>${{ formatPrice(dh.iva) }}</td>
                                        <td>${{ formatPrice(dh.iva_retenido) }}</td>
                                        <td>${{ formatPrice(dh.isr) }}</td>
                                        <td>${{ formatPrice(dh.total) }}</td>
                                        <td><span :class="`badge rounded-pill bg-label-${dh.color} me-1`">{{dh.text}}</span></td>
                                        
                                    </tr>
                                    </tbody>
                                </table>
                                <!-- <nav aria-label="Page navigation example mt-3">
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
                                </nav> -->
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div id="main" v-if="this.vista == 1">
            <div class="row invoice-preview">
            <!-- Invoice -->
            <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-6">
                <div class="card invoice-preview-card p-sm-12 p-6">
                <div class="card-body invoice-preview-header rounded-4 p-6">
                    <div
                    class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column text-heading align-items-xl-center align-items-md-start align-items-sm-center flex-wrap gap-6">
                    <div>
                        <div class="d-flex svg-illustration align-items-center gap-2 mb-6">
                        <span class="app-brand-logo demo">
                            <img src="style/logos/logo-_amfpro_pro_color.png" alt="logo" width="250px">
                        </span>
                        </div>
                    </div>
                    <div class="col-md-4 col-8 pe-0 ps-0 ps-md-2">
                            <dl class="row mb-0 gx-4">
                            <dt class="col-sm-5 mb-2 d-md-flex align-items-center justify-content-start">
                                <span class="h5 text-capitalize mb-0 text-nowrap">No.Recibo:</span>
                            </dt>
                            <dd class="col-sm-7">
                                <!-- <div class="input-group input-group-merge input-group-sm">
                                <span class="input-group-text">#</span>
                                <input type="number" class="form-control" v-model="HistorialDetalle.numero_recibo" id="invoiceId">
                                </div> -->
                            </dd>
                            <dt class="col-sm-5 mb-2 d-md-flex align-items-center justify-content-start">
                                <span class="fw-normal">{{this.HistorialDetalle.numero_recibo}}</span>
                            </dt>
                            <!-- <dd class="col-sm-7">
                                <input type="text" class="form-control form-control-sm invoice-date flatpickr-input" placeholder="12/13/2013" readonly="readonly">
                            </dd>
                            <dt class="col-sm-5 d-md-flex align-items-center justify-content-start">
                                <span class="fw-normal text-nowrap">Due Date:</span>
                            </dt>
                            <dd class="col-sm-7 mb-0">
                                <input type="text" class="form-control form-control-sm due-date flatpickr-input" placeholder="4/23/2023" readonly="readonly">
                            </dd> -->
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="card-body py-6 px-0">
                    <div class="d-flex justify-content-between flex-wrap gap-6">
                    <div>
                        <h6>Honorario:</h6>
                        <p class="mb-1">Nombre: {{ this.HistorialDetalle.nombre_honorario }}</p>
                        <p class="mb-1">Sede: {{this.HistorialDetalle.sede}}</p>
                        <p class="mb-1">RFC: {{this.HistorialDetalle.RFC}}</p>
                    </div>
                    <div>
                        <h6>Datos Bancarios:</h6>
                        <table>
                        <tbody>
                            <tr>
                            <td class="pe-4">Banco:</td>
                            <td>{{this.HistorialDetalle.banco}}</td>
                            </tr>
                            <tr>
                            <td class="pe-4">Cuenta Bancaria:</td>
                            <td>{{ this.HistorialDetalle.cuenta_bancaria }}</td>
                            </tr>
                            <tr>
                            <td class="pe-4">Cuenta Interbancaria:</td>
                            <td>{{this.HistorialDetalle.clabe_interbancaria}}</td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                    </div>
                </div>
                    <div class="table-responsive border rounded-4 border-bottom-0">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                <th>Subtotal</th>
                                <th>Iva</th>
                                <th>Iva Retenido</th>
                                <th>ISR</th>
                                <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td class="text-nowrap text-heading">${{formatPrice(this.HistorialDetalle.subtotal)}}</td>
                                <td class="text-nowrap">${{ formatPrice(this.HistorialDetalle.iva) }}</td>
                                <td> ${{ formatPrice(this.HistorialDetalle.iva_retenido) }}</td>
                                <td>${{ formatPrice(this.HistorialDetalle.isr) }}</td>
                                <td>${{this.HistorialDetalle.total}}</td>
                                </tr>
                            </tbody>
                        </table>

                        
                    </div>  
                </div>
            </div>
            <!-- /Invoice -->

            <!-- Invoice Actions -->
            <div class="col-xl-3 col-md-4 col-12 invoice-actions">
                <div class="card">
                <div class="card-body">
                    <button class="btn btn-danger d-grid w-100 mb-4" @click="vista(0)">
                    <span class="d-flex align-items-center justify-content-center text-nowrap">
                        <i class="ri-send-plane-line ri-16px scaleX-n1-rtl me-2"></i>Regresar</span>
                    </button>
                    <a class="btn btn-info d-grid w-100 waves-effect waves-light" target="_blank" :href="`https://test-intranet.amfpro.mx/ArchivosSistema/ReciboHonorarios/${HistorialDetalle.archivo_recibo_pago_persona}`" 
                    onclick="window.open(this.href, this.target, 'width=650,height=650');return false;" v-if="this.HistorialDetalle.archivo_recibo_pago_persona != null">
                        <span class="d-flex align-items-center justify-content-center text-nowrap">
                            <i class="ri-file-pdf-2-fill ri-16px me-2"></i>Comprobante de Pago</span>
                        </a>
                </div>
                </div>
            </div>
            <!-- /Invoice Actions -->
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
            AdminHistorial :[],
            DetalleAdmin:[]
        }
    },
    computed: {
        
    },
    
    mounted() {
        this.iniciaHonorario();
        this.iniciaHistorial();

        this.getAdmin();
    },
    methods: {
        include(permiso){
            return this.permisos.includes(permiso);
        },

        iniciaHonorario(){
            if (this.$refs.ejecutaHono) {
                this.$refs.ejecutaHono.getHonorario();
            } 
        },
        iniciaHistorial(){
            if (this.$refs.ejecutaHono) {
                this.$refs.ejecutaHistorial.getHistorial();
            } 
        },
        getAdmin(){
            axios.get('honorario/HistorialAdmin').then(response => {
                this.AdminHistorial  = response.data.historial;
            });
        },
        formatPrice(value) {
            let val = (value / 1).toFixed(2).replace(',', '.')
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        },
    }
};
</script>
<style lang='' scoped>
</style>