<template>
    <div>
        <div v-if="this.muestra == 0">
            <div class="row" v-if="this.HistorialHono.length == 0">
                <center class="mt-2">
                    <h5 class="card-header" style="color: green;">Sin Historial</h5>
                    <img src="style/assets/img_externos/no_hay_honorarios.png" alt="img" style="max-width: 300px;">
                </center>
            </div>
            <div class="row" v-else>
                <div class="col-12 col-md-6">
                <h5 class="card-header">Honorario</h5>
                </div>
                <div class="col-12 col-md-12 mt-3">
                <div class="table-responsive text-nowrap" style="font-size: 14px;">
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
                        <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr v-for="(dh, index) in this.HistorialHono" :key="index">
                            <td>{{ index+1 }}</td>
                            <td>{{dh.nombre_honorario}}</td>
                            <td>{{ dh.RFC === null ? 'N/A' : dh.RFC }}</td>
                            <td>${{ formatPrice(dh.subtotal) }}</td>
                            <td>${{ formatPrice(dh.iva) }}</td>
                            <td>${{ formatPrice(dh.iva_retenido) }}</td>
                            <td>${{ formatPrice(dh.isr) }}</td>
                            <td>${{ formatPrice(dh.total) }}</td>
                            <td><span class="badge rounded-pill bg-label-success me-1">Pagado</span></td>
                            <td>
                                <button type="button" class="btn btn-icon btn-outline-warning waves-effect"@click="infoHonorario(dh),vista(1)" >
                                    <span class="tf-icons ri-file-text-fill ri-22px"></span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
        <div v-if="this.muestra == 1">
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
    </div>
</template>
<script>
export default {
    name: '',
    components: {
        
    },
    mixins: [],
    props: {
        user_id: null,
    },
    data() {
        return {
            muestra:0,
            HistorialHono:[],
            HistorialDetalle:[],
        }
    },
    computed: {
        
    },
    created() {
        this.$on('iniciaHonorario', this.getHistorial);
    },
    mounted() {
        
    },
    methods: {
        getHistorial(){
            axios.get(`honorario/HistorialHonorario/${this.user_id}`).then(response => {
                
                this.HistorialHono = response.data.historial;
                // this.DatoBancario = response.data.banco;
            });
        },
        vista(valor){
            this.muestra = valor;
        },
        formatPrice(value) {
            let val = (value / 1).toFixed(2).replace(',', '.')
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        },
        infoHonorario(dh){
            this.HistorialDetalle = dh;
        },
    }
};
</script>
<style lang='' scoped>
</style>