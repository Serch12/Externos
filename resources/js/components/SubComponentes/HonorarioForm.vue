<template>
    <div>
        <div v-if="this.muestra == 0">
          <div class="row">
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
                    <tr v-for="(dh, index) in DetalleHonorario" :key="index">
                      <td>{{ index+1 }}</td>
                      <td>{{dh.nombre_honorario}}</td>
                      <td>{{ dh.RFC === null ? 'N/A' : dh.RFC }}</td>
                      <td>${{ formatPrice(dh.subtotal) }}</td>
                      <td>${{ formatPrice(dh.iva) }}</td>
                      <td>${{ formatPrice(dh.iva_retenido) }}</td>
                      <td>${{ formatPrice(dh.isr) }}</td>
                      <td>${{ formatPrice(dh.total) }}</td>
                      <td><span :class="`badge rounded-pill bg-label-${dh.color} me-1`">{{dh.text}}</span></td>
                      <td>
                        <button type="button" class="btn btn-sm btn-danger waves-effect waves-light" @click="ArchivoPDF(dh)" v-if="dh.estatus == 1">
                          Subir PDF
                        </button>
                        <button type="button" class="btn btn-icon btn-outline-info waves-effect" v-if="dh.estatus == 0" @click="infoHonorario(dh),vista(2)" >
                          <span class="tf-icons ri-edit-2-fill ri-22px"></span>
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
          <div class="row invoice-edit">
            <!-- Invoice Edit-->
            <div class="col-lg-9 col-12 mb-lg-0 mb-6">
              <div class="card invoice-preview-card p-sm-12 p-6">
                <div class="card-body invoice-preview-header rounded-4 text-heading p-6 px-3">
                  <div class="row mx-0 px-3 row-gap-6">
                    <div class="col-md-6 ps-0">
                      <div class="d-flex svg-illustration align-items-center gap-2 mb-6">
                        <span class="app-brand-logo demo">
                            <img src="style/logos/logo-_amfpro_pro_color.png" alt="logo" width="250px">
                        </span>
                      </div>
                      <!-- <p class="mb-1">Av. Industria Automotriz n.33 int. 203</p>
                      <p class="mb-1">Col. Parque Industrial Lerma, Lerma, Estado de México. CP. 52004</p>
                      <p class="mb-0">+728 690 6040</p> -->
                    </div>
                    <div class="col-md-6 col-8 pe-0 ps-0 ps-md-2">
                      <dl class="row mb-0 gx-4">
                        <dt class="col-sm-5 mb-2 d-md-flex align-items-center justify-content-start">
                          <span class="h5 text-capitalize mb-0 text-nowrap">No.Recibo</span>
                        </dt>
                        <dd class="col-sm-7">
                          <div class="input-group input-group-merge input-group-sm">
                            <span class="input-group-text">#</span>
                            <input type="text" class="form-control" v-model="DetalleHonorario.numero_recibo" id="invoiceId" />
                          </div>
                        </dd>
                        
                      </dl>
                    </div>
                  </div>
                </div>

                <div class="card-body py-6 px-0">
                  <div class="row">
                    <div class="col-md-6 col-sm-7">
                      <h6>Honorario a:</h6>
                      <table>
                        <tbody>
                          <tr>
                            <td class="pe-4">Nombre:</td>
                            <td>{{this.DetalleHonorario.nombre_honorario}}</td>
                          </tr>
                          <tr>
                            <td class="pe-4">RFC:</td>
                            <td><input type="text" class="form-control" v-model="DetalleHonorario.RFC" id="RFC" /></td>
                          </tr>
                          <tr>
                            <td class="pe-4">Sede:</td>
                            <td>{{this.DetalleHonorario.sede}}</td>
                          </tr>
                          
                        </tbody>
                      </table>
                    </div>
                    <div class="col-md-6 col-sm-5 col-12 mb-sm-0 mb-6">
                      <h6>Datos Bancarios:</h6>
                      <select class="form-select mb-4 w-60" @change="selectBanco()" v-model="detallebanco" >
                        <option value="Selecciona un Dato Bancario">Selecciona un Dato Bancario</option>
                        <option v-for="(db, index) in DatoBancario" :key="index" :value="db">{{db.banco}}</option>
                      </select>
                      <p class="mb-1"><b>Banco:</b> {{ this.DetalleHonorario.banco }}</p>
                      <p class="mb-1"><b>Cuenta Bancaria:</b> {{ this.DetalleHonorario.cuenta_bancaria }}</p>
                      <p class="mb-1"><b>Clabe Interbancaria:</b> {{ this.DetalleHonorario.clabe_interbancaria }}</p>
                    </div>
                  </div>
                </div>
                <hr class="mb-6 mt-0" />
                <div class="card-body pt-0 px-0">
                  <form class="source-item">
                    <div class="mb-4" data-repeater-list="group-a">
                      <div class="repeater-wrapper pt-0 pt-md-9" data-repeater-item>
                        <div class="d-flex border rounded position-relative pe-0">
                          <div class="row w-100 p-5 gx-5">
                            
                            <div class="col-md-3 col-12 mb-md-0 mb-5">
                              <h6 class="h6 repeater-title">Subtotal</h6>
                              <input type="number" class="form-control invoice-item-price mb-5" v-model="DetalleHonorario.subtotal" placeholder="0.00" min="12" />
                              <div class="d-flex flex-column gap-2 text-heading">
                                <span>Honorario PDF:</span>
                                <a class="btn btn-danger d-grid w-100 waves-effect waves-light" target="_blank" :href="`ArchivosSistema/Honorario/${DetalleHonorario.archivo_recibo}`" onclick="window.open(this.href, this.target, 'width=650,height=650');return false;">
                                  <span class="d-flex align-items-center justify-content-center text-nowrap">
                                    <i class="ri-file-pdf-2-fill ri-16px me-2"></i>Honorario</span>
                                </a>
                              </div>
                            </div>
                            <div class="col-md-2 col-12 mb-md-0 mb-4">
                              <h6 class="h6 repeater-title">IVA</h6>
                              <input type="number" class="form-control invoice-item-qty" v-model="DetalleHonorario.iva" placeholder="0.00" min="1" max="50" />
                            </div>
                            <div class="col-md-2 col-12 mb-md-0 mb-4">
                              <h6 class="h6 repeater-title">IVA Retenido</h6>
                              <input type="number" class="form-control invoice-item-qty" v-model="DetalleHonorario.iva_retenido" placeholder="0.00" min="1" max="50" />
                            </div>
                            <div class="col-md-2 col-12 mb-md-0 mb-4">
                              <h6 class="h6 repeater-title">ISR</h6>
                              <input type="number" class="form-control invoice-item-qty" v-model="DetalleHonorario.isr" placeholder="0.00" min="1" max="50" />
                            </div>
                            <div class="col-md-2 col-12 pe-0">
                              <h6 class="h6 repeater-title">Total</h6>
                              <input type="number" class="form-control invoice-item-qty" v-model="DetalleHonorario.total" placeholder="0.00" min="1" max="50" />
                            </div>
                          </div>
                          
                        </div>
                      </div>
                    </div>
                    
                  </form>
                </div>
              </div>
            </div>
            <!-- /Invoice Edit-->

            <!-- Invoice Actions -->
            <div class="col-lg-3 col-12 invoice-actions">
              <div class="card mb-6">
                <div class="card-body">
                  <button class="btn btn-success d-grid w-100 mb-4" @click="AgregarHonorario()">
                    <span class="d-flex align-items-center justify-content-center text-nowrap">
                      <i class="ri-money-dollar-circle-line ri-16px scaleX-n1-rtl me-2"></i>Guardar Honorario</span>
                  </button>
                  <button class="btn btn-danger d-grid w-100" >
                    <span class="d-flex align-items-center justify-content-center text-nowrap">
                      <i class="ri-close-circle-line ri-16px me-2"></i>Cancelar Honorario</span>
                  </button>
                </div>
              </div>

              <div>
                <div class="d-flex justify-content-between mb-4">
                  <p class="mb-1" style="color: red;">** Recuerda Verificar tu Recibo de Honorario con tu PDF previamente cargado.**</p>
                </div>
                
              </div>
              
            </div>
            <!-- /Invoice Actions -->
          </div>
        </div>
        <div v-if="this.muestra == 2">
          <div class="row invoice-edit">
            <!-- Invoice Edit-->
            <div class="col-lg-9 col-12 mb-lg-0 mb-6">
              <div class="card invoice-preview-card p-sm-12 p-6">
                <div class="card-body invoice-preview-header rounded-4 text-heading p-6 px-3">
                  <div class="row mx-0 px-3 row-gap-6">
                    <div class="col-md-6 ps-0">
                      <div class="d-flex svg-illustration align-items-center gap-2 mb-6">
                        <span class="app-brand-logo demo">
                            <img src="style/logos/logo-_amfpro_pro_color.png" alt="logo" width="250px">
                        </span>
                      </div>
                      <!-- <p class="mb-1">Av. Industria Automotriz n.33 int. 203</p>
                      <p class="mb-1">Col. Parque Industrial Lerma, Lerma, Estado de México. CP. 52004</p>
                      <p class="mb-0">+728 690 6040</p> -->
                    </div>
                    <div class="col-md-6 col-8 pe-0 ps-0 ps-md-2">
                      <dl class="row mb-0 gx-4">
                        <dt class="col-sm-5 mb-2 d-md-flex align-items-center justify-content-start">
                          <span class="h5 text-capitalize mb-0 text-nowrap">No.Recibo</span>
                        </dt>
                        <dd class="col-sm-7">
                          <div class="input-group input-group-merge input-group-sm">
                            <span class="input-group-text">#</span>
                            <input type="text" class="form-control" v-model="DetalleHonorario.numero_recibo" id="invoiceId" />
                          </div>
                        </dd>
                        
                      </dl>
                    </div>
                  </div>
                </div>

                <div class="card-body py-6 px-0">
                  <div class="row">
                    <div class="col-md-6 col-sm-7">
                      <h6>Honorario a:</h6>
                      <table>
                        <tbody>
                          <tr>
                            <td class="pe-4">Nombre:</td>
                            <td>{{this.DetalleHonorario.nombre_honorario}}</td>
                          </tr>
                          <tr>
                            <td class="pe-4">RFC:</td>
                            <td><input type="text" class="form-control" v-model="DetalleHonorario.RFC" id="RFC" /></td>
                          </tr>
                          <tr>
                            <td class="pe-4">Sede:</td>
                            <td>{{this.DetalleHonorario.sede}}</td>
                          </tr>
                          
                        </tbody>
                      </table>
                    </div>
                    <div class="col-md-6 col-sm-5 col-12 mb-sm-0 mb-6">
                      <h6>Datos Bancarios:</h6>
                      <select class="form-select mb-4 w-60" @change="selectBanco()" v-model="detallebanco" >
                        <option value="Selecciona un Dato Bancario">Selecciona un Dato Bancario</option>
                        <option v-for="(db, index) in DatoBancario" :key="index" :value="db">{{db.banco}}</option>
                      </select>
                      <p class="mb-1"><b>Banco:</b> {{ this.DetalleHonorario.banco }}</p>
                      <p class="mb-1"><b>Cuenta Bancaria:</b> {{ this.DetalleHonorario.cuenta_bancaria }}</p>
                      <p class="mb-1"><b>Clabe Interbancaria:</b> {{ this.DetalleHonorario.clabe_interbancaria }}</p>
                    </div>
                  </div>
                </div>
                <hr class="mb-6 mt-0" />
                <div class="card-body pt-0 px-0">
                  <form class="source-item">
                    <div class="mb-4" data-repeater-list="group-a">
                      <div class="repeater-wrapper pt-0 pt-md-9" data-repeater-item>
                        <div class="d-flex border rounded position-relative pe-0">
                          <div class="row w-100 p-5 gx-5">
                            
                            <div class="col-md-3 col-12 mb-md-0 mb-5">
                              <h6 class="h6 repeater-title">Subtotal</h6>
                              <input type="number" class="form-control invoice-item-price mb-5" v-model="DetalleHonorario.subtotal" placeholder="0.00" min="12" />
                              <div class="d-flex flex-column gap-2 text-heading">
                                <span>Honorario PDF:</span>
                                <a class="btn btn-danger d-grid w-100 waves-effect waves-light" target="_blank" :href="`ArchivosSistema/Honorario/${DetalleHonorario.archivo_recibo}`" onclick="window.open(this.href, this.target, 'width=650,height=650');return false;">
                                  <span class="d-flex align-items-center justify-content-center text-nowrap">
                                    <i class="ri-file-pdf-2-fill ri-16px me-2"></i>Honorario</span>
                                </a>
                              </div>
                            </div>
                            <div class="col-md-2 col-12 mb-md-0 mb-4">
                              <h6 class="h6 repeater-title">IVA</h6>
                              <input type="number" class="form-control invoice-item-qty" v-model="DetalleHonorario.iva" placeholder="0.00" min="1" max="50" />
                            </div>
                            <div class="col-md-2 col-12 mb-md-0 mb-4">
                              <h6 class="h6 repeater-title">IVA Retenido</h6>
                              <input type="number" class="form-control invoice-item-qty" v-model="DetalleHonorario.iva_retenido" placeholder="0.00" min="1" max="50" />
                            </div>
                            <div class="col-md-2 col-12 mb-md-0 mb-4">
                              <h6 class="h6 repeater-title">ISR</h6>
                              <input type="number" class="form-control invoice-item-qty" v-model="DetalleHonorario.isr" placeholder="0.00" min="1" max="50" />
                            </div>
                            <div class="col-md-2 col-12 pe-0">
                              <h6 class="h6 repeater-title">Total</h6>
                              <input type="number" class="form-control invoice-item-qty" v-model="DetalleHonorario.total" placeholder="0.00" min="1" max="50" />
                            </div>
                          </div>
                          
                        </div>
                      </div>
                    </div>
                    
                  </form>
                </div>
              </div>
            </div>
            <!-- /Invoice Edit-->

            <!-- Invoice Actions -->
            <div class="col-lg-3 col-12 invoice-actions">
              <div class="card mb-6">
                <div class="card-body">
                  <button class="btn btn-success d-grid w-100 mb-4" @click="UpdateHonorario()">
                    <span class="d-flex align-items-center justify-content-center text-nowrap">
                      <i class="ri-money-dollar-circle-line ri-16px scaleX-n1-rtl me-2"></i>Editar Honorario</span>
                  </button>
                  <button class="btn btn-danger d-grid w-100" >
                    <span class="d-flex align-items-center justify-content-center text-nowrap">
                      <i class="ri-close-circle-line ri-16px me-2"></i>Cancelar Honorario</span>
                  </button>
                </div>
              </div>

              <div>
                <div class="d-flex justify-content-between mb-4">
                  <p class="mb-1" style="color: red;">** Recuerda Verificar tu Recibo de Honorario con tu PDF previamente cargado.**</p>
                </div>
                
              </div>
              
            </div>
            <!-- /Invoice Actions -->
          </div>
        </div>
        <br><br><br><br><br><br><br>
    </div>
</template>
<script>
import axios from 'axios';

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
          DetalleHonorario:[],
          DatoBancario:[],
          detallebanco:'Selecciona un Dato Bancario',

      }
  },
  computed: {
      
  },
  created() {
        this.$on('iniciaHonorario', this.getHonorario);
    },
  mounted() {
      
  },
  methods: {
    getHonorario(){
      axios.get(`honorario/DetalleHonorario/${this.user_id}`).then(response => {
        this.DetalleHonorario = response.data.detalle;
        this.DatoBancario = response.data.banco;
      });
    },
    vista(valor){
      this.muestra = valor;
    },
    formatPrice(value) {
      let val = (value / 1).toFixed(2).replace(',', '.')
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    },
    selectBanco(){
      this.DetalleHonorario.banco = this.detallebanco.banco;
      this.DetalleHonorario.cuenta_bancaria = this.detallebanco.cuenta_bancaria; 
      this.DetalleHonorario.clabe_interbancaria = this.detallebanco.clabe_bancaria; 
      
    },
    ArchivoPDF(dh){
      if (dh.estatus == 1) {
        Swal.fire({
          title: "Sube tu PDF de Honorario",
          html: `
            <div class="col-md-12 fv-plugins-icon-container">
              <div class="form-floating form-floating-outline">
                <input class="form-control" type="file" accept=".pdf" id="swal-input-file" name="formValidationFile">
                <label for="formValidationFile">Honorario PDF</label>
              </div>
            </div>
          `,
          showCancelButton: true,
          confirmButtonText: "Subir",
          preConfirm: () => {
            const fileInput = document.getElementById("swal-input-file");
            if (!fileInput.files.length) {
              Swal.showValidationMessage("Please select a file");
              return false;
            }
            return fileInput.files[0];
          }
        }).then((result) => {
          if (result.isConfirmed) {
            const file = result.value;   
            
            let formData = new FormData();
            formData.append("id_detalle_pago_honorario", dh.id_detalle_pago_honorario);
            formData.append("file", file);
            formData.append("nombre_honorario", dh.nombre_honorario);
            formData.append("sede", dh.sede);
            axios.post('honorario/lectorPDF',formData).then(response => {
              this.DetalleHonorario = response.data;
              this.muestra = 1;
            })
          }
        });

      }
    },
    AgregarHonorario(){
      if (this.DetalleHonorario.RFC == '') {
        this.$toast.error("Ingresa tu RFC", {
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
      if (this.DetalleHonorario.subtotal == '') {
        this.$toast.error("Ingresa el subtotal", {
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
      if (this.DetalleHonorario.iva == '') {
        this.$toast.error("Ingresa el iva", {
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
      if (this.DetalleHonorario.iva_retenido == '') {
        this.$toast.error("Ingresa el iva retenido", {
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
      if (this.DetalleHonorario.isr == '') {
        this.$toast.error("Ingresa el isr", {
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
      if (this.DetalleHonorario.total == '') {
        this.$toast.error("Ingresa el Total", {
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
      if (this.detallebanco == 'Selecciona un Dato Bancario') {
        this.$toast.error("Selecciona un Dato Bancario", {
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
      axios.post('honorario/AgregarHonorario',this.DetalleHonorario).then(response => {
        
        this.muestra = 0;
        this.DetalleHonorario = [];
        this.DatoBancario = [];
        this.getHonorario();
        Swal.fire({
          title: 'Éxito',
          text: "Se Agrego Correctamente!",
          icon: 'success',
          showConfirmButton: false,
          timer: 2500,
        });
      })
    },
    infoHonorario(dh){
      this.DetalleHonorario = dh;
    }
  }
};
</script>
<style lang='' scoped>
</style>