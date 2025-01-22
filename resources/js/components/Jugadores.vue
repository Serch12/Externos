<template>
    <div>
      <div id="main" v-if="this.vista == 0">
        <div class="row g-6">
          <div class="card">  
            <div class="row">
              <div class="col-12 col-md-6">
                  <h5 class="card-header">Jugadores</h5>
              </div>
              <div class="col-12 col-md-6 mt-3">
                  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                      <input type="search" id="email"class="form-control"  v-model="search" placeholder="Buscar Jugadores" @keyup="buscarJugador()"/>
                      <button type="button" class="btn btn-outline-success waves-effect" data-bs-toggle="modal" data-bs-target="#createJugador">Agregar</button>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-6 col-md-6" v-for="(jur, index) in Jugadores" :key="index">
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
                      <a class="dropdown-item" type="button" style="color: orange;" v-if="include('Vizualizar')" 
                        data-bs-toggle="modal" data-bs-target="#editUser" @click="infoUsuario(user)">
                        <i class="ri-clipboard-line me-1"></i> Vizualizar</a>  
                    </li>
                    <li>
                      <a class="dropdown-item" type="button" style="color: #33b2ff;" v-if="include('Editar')" 
                        data-bs-toggle="modal" data-bs-target="#editUser" @click="infoUsuario(user)">
                        <i class="ri-pencil-line me-1"></i> Editar</a>  
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
      <!-- MODAL QUE CREA EL JUGADOR -->
      <div class="modal fade" id="createJugador" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-add-new-address">
          <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body p-0">
              <div class="text-center mb-6">
                <h4 class="address-title mb-2">Agregar Jugador</h4>
              </div>
              <form id="addNewAddressForm" class="row g-5">
                  <div class="col-12">
                      <div class="row g-5">
                          <div class="col-md mb-md-0">
                              <div class="form-check custom-option custom-option-basic">
                                  <label class="form-check-label custom-option-content" for="customRadioHome">
                                  <input
                                      name="customRadioTemp"
                                      class="form-check-input"
                                      type="radio"
                                      value=""
                                      id="customRadioHome"
                                      checked @click="accionSubmenu()"/>
                                  <span class="custom-option-header">
                                      <span class="h6 mb-0 d-flex align-items-center"><i class="ri-account-box-fill ri-20px me-1"></i>Datos</span>
                                  </span>
                                  <!-- <span class="custom-option-body">
                                      <small>Delivery time (9am – 9pm)</small>
                                  </span> -->
                                  </label>
                              </div>
                          </div>
                          <div class="col-md mb-md-0">
                              <div class="form-check custom-option custom-option-basic">
                                  <label class="form-check-label custom-option-content" for="customRadioOffice">
                                  <input
                                      name="customRadioTemp"
                                      class="form-check-input"
                                      type="radio"
                                      value=""
                                      id="customRadioOffice" @click="accionSubmenu()"/>
                                  <span class="custom-option-header">
                                      <span class="h6 mb-0 d-flex align-items-center"><i class="ri-id-card-fill ri-20px me-1"></i>Documentación</span>
                                  </span>
                                  <!-- <span class="custom-option-body">
                                      <small>Delivery time (9am – 5pm) </small>
                                  </span> -->
                                  </label>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- campos de acceso -->
                  <div class="col-12 col-md-6" v-if="this.submenu == false">
                    <div class="form-floating form-floating-outline">
                      <input type="file"  accept="image/png,image/jpeg" class="form-control" id="bs-validation-upload-file" ref="fileFoto" @change="onChangeFoto()">
                      <label for="bs-validation-upload-file">Foto</label>
                    </div>
                  </div>
                  <div class="col-12 col-md-6" v-if="this.submenu == false">
                    <div class="form-floating form-floating-outline">
                      <input
                        type="text"
                        id="name"
                        class="form-control"
                        v-model="newjugador.nombre"
                        placeholder="Nombre"/>
                      <label for="name">Nombre</label>
                    </div>
                  </div>
                  <div class="col-12 col-md-6" v-if="this.submenu == false">
                    <div class="form-floating form-floating-outline">
                      <input
                        type="date"
                        id="fecha"
                        class="form-control"
                        v-model="newjugador.fecha_nacimiento" @change="mostrarEdad(newjugador.fecha_nacimiento)"/>
                      <label for="fecha">Fecha de Nacimiento</label>
                    </div>
                  </div>
                  <div class="col-12 col-md-6" v-if="this.submenu == false">
                    <div class="form-floating form-floating-outline">
                      <input
                        type="number"
                        id="edad"
                        class="form-control"
                        v-model="newjugador.edad" disabled/>
                      <label for="edad">Edad</label>
                    </div>
                  </div>
                  <div class="col-12 col-md-6" v-if="this.submenu == false">
                    <div class="form-floating form-floating-outline">
                      <input
                        type="text"
                        id="posicion"
                        class="form-control"
                        v-model="newjugador.posicion"/>
                      <label for="posicion">Posición</label>
                    </div>
                  </div>
                  <div class="col-12 col-md-6" v-if="this.submenu == false">
                    <div class="form-floating form-floating-outline">
                      <select id="sexo" name="sexo" class="form-select" v-model="newjugador.sexo">
                        <option value="Selecciona el Sexo">Selecciona el Sexo</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                      </select>
                      <label for="sexo">Sexo</label>
                    </div>
                  </div>
                 
                  <div class="col-12 col-md-6" v-if="this.submenu == false">
                    <div class="form-floating form-floating-outline">
                      <select id="categoria" name="categoria" class="form-select" v-model="newjugador.categoria">
                        <option value="Selecciona una Categoria">Selecciona una Categoria</option>
                        <option value="Categoria 2009">Categoria 2009</option>
                        <option value="Categoria 2010">Categoria 2010</option>
                        <option value="Categoria 2011">Categoria 2011</option>
                        <option value="Categoria 2012">Categoria 2012</option>
                      </select>
                      <label for="categoria">Categoria</label>
                    </div>
                  </div>
                  <div class="col-12 col-md-6" v-if="this.submenu == false">
                    <div class="form-floating form-floating-outline">
                      <input
                        type="text"
                        id="sede"
                        class="form-control"
                        v-model="newjugador.sede" disabled/>
                      <label for="sede">Sede</label>
                    </div>
                  </div>

                  <!-- campos de informacion -->
                 
                  <div class="col-12 col-md-6" v-if="this.submenu == true">
                    <div class="form-floating form-floating-outline">
                      <input type="file"  accept="image/png,image/jpeg" class="form-control" id="bs-validation-upload-file_acta" ref="fileActa" @change="onChangeActa()">
                      <label for="bs-validation-upload-file_acta">Acta de Nacimiento</label>
                    </div>
                  </div>
                  <div class="col-12 col-md-6" v-if="this.submenu == true">
                    <div class="form-floating form-floating-outline">
                      <input type="file"  accept="image/png,image/jpeg" class="form-control" id="bs-validation-upload-file_curp" ref="fileCurp" @change="onChangeCurp()">
                      <label for="bs-validation-upload-file_curp">Curp</label>
                    </div>
                  </div>
                  <div class="col-12 col-md-6" v-if="this.submenu == true">
                    <div class="form-floating form-floating-outline">
                      <input type="file"  accept="image/png,image/jpeg" class="form-control" id="bs-validation-upload-file_ident" ref="fileIdent" @change="onChangeIdentificacion()">
                      <label for="bs-validation-upload-file_ident">Identificación</label>
                    </div>
                  </div>
                  <div class="col-12 mt-6 d-flex flex-wrap justify-content-center gap-4 row-gap-4">
                      <button type="button" class="btn btn-primary" @click="agregaJugador()">Guardar</button>
                      <button type="reset" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <br><br><br>
    </div>
</template>
<script>
import moment from 'moment';
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
      newjugador:{
        foto:'',
        nombre:'',
        fecha_nacimiento:'',
        edad:'',
        posicion:'',
        sexo:'Selecciona el Sexo',
        apodo:'',
        categoria:'Selecciona una Categoria',
        sede:this.sede,
        acta_nacimiento:'',
        curp:'',
        identificacion:''
      },
      Jugadores:[],
      submenu:false,
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
    this.getJugador();
  },
  methods: {
    getJugador(page){
      if (this.search == '') {
                
        var url = `jugadores/getJugador?rol=${this.rol_usuario}&sede=${this.sede}&page=`+page;
        axios.get(url).then(response => {

          this.Jugadores = response.data.muestra.data,
          this.pagination = response.data.pagination
        });
      } else {
        this.search
        var url = `jugadores/getJugador?rol=${this.rol_usuario}&sede=${this.sede}&buscador=${this.search}&page=`+page;
        axios.get(url).then(response => {
          this.Jugadores = response.data.muestra.data
          this.pagination = response.data.pagination
        });
      }
    },
    include(permiso){
      return this.permisos.includes(permiso);
    },
    changePage: function (page) {
      this.pagination.current_page = page;
      this.getJugador(page);
    },
    buscarJugador() {               
      clearTimeout(this.tiempoBusqueda)
      this.tiempoBusqueda = setTimeout(this.getJugador, 200)
    },
    mostrarEdad(fechaNacimiento){
      let nacimiento = moment(fechaNacimiento);
      let hoy = moment();
      let edad = 0;
      if(nacimiento < hoy){
          edad = hoy.diff(nacimiento, 'years');
          this.newjugador.edad = edad;
      }else{
        this.$toast.error("La fecha de nacimiento no puede ser superior a la fecha actual del sistema.!", {
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
        this.newjugador.fecha_nacimiento = ''
      }
      return edad;
    },
    accionSubmenu(){
      if (this.submenu == false) {
        this.submenu = true;
      } else {
        this.submenu = false;
      }
    },
    agregaJugador(){
      if (this.newjugador.foto == '') {
        this.$toast.error("Añade una Fotografia", {
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
      if (this.newjugador.nombre == '') {
        this.$toast.error("Ingresa el Nombre", {
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
      if (this.newjugador.fecha_nacimiento == '') {
        this.$toast.error("Ingresa la Fecha de Nacimiento", {
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
      if (this.newjugador.categoria == '') {
        this.$toast.error("Selecciona una Categoria", {
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
      if (this.newjugador.acta_nacimiento == '') {
        this.$toast.error("Añade la Acta de Nacimiento", {
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
      if (this.newjugador.curp == '') {
        this.$toast.error("Añade la Curp", {
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
      if (this.newjugador.identificacion == '') {
        this.$toast.error("Añade la Identificación", {
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
        formData.append('creacion',this.id_usuario_logeado);
        formData.append('foto',this.newjugador.foto);
        formData.append('nombre',this.newjugador.nombre);
        formData.append('fecha_nacimiento',this.newjugador.fecha_nacimiento);
        formData.append('edad',this.newjugador.edad);
        formData.append('posicion',this.newjugador.posicion);
        formData.append('sexo',this.newjugador.sexo);
        formData.append('categoria',this.newjugador.categoria);
        formData.append('sede',this.newjugador.sede);
        formData.append('acta_nacimiento',this.newjugador.acta_nacimiento);
        formData.append('curp',this.newjugador.curp);
        formData.append('identificacion',this.newjugador.identificacion);
      axios.post('jugadores/createJugador',formData).then(response=>{
        this.getJugador();
        $('#createJugador').modal('hide');
        this.newjugador = {
          foto:'',
          nombre:'',
          fecha_nacimiento:'',
          edad:'',
          posicion:'',
          sexo:'',
          apodo:'',
          categoria:'Selecciona una Categoria',
          sede:this.sede,
          acta_nacimiento:'',
          curp:'',
          identificacion:''
        }
        Swal.fire({
          title: 'Exitoso',
          text: "Se Registro correctamente!",
          icon: 'success',
          showConfirmButton: false,
          timer: 2500,
        });
    })
    },
    onChangeFoto(){
      var fileedit = this.$refs.fileFoto.files[0];
      this.newjugador.foto = fileedit
    },
    onChangeActa(){
      var actafile = this.$refs.fileActa.files[0];
      this.newjugador.acta_nacimiento = actafile
    },
    onChangeCurp(){
      var curpfile = this.$refs.fileCurp.files[0];
      this.newjugador.curp = curpfile
    },
    onChangeIdentificacion(){
      var idenfile = this.$refs.fileIdent.files[0];
      this.newjugador.identificacion = idenfile
    },
  }
};
</script>
<style lang='' scoped>
</style>