<template>
  <div class="container-xxl flex-grow-1 container-p-y" style="padding-top: 4.5rem !important;">
    <div class="card">
        <div class="card-header bg-primary text-center">
            <h5 class="text-white mb-0">REGISTRO DE VISORÍAS - AMFPRO</h5>
        </div>
        <div class="card-body pt-4">
        <form @submit.prevent="enviarFormulario()">
          <div class="row mb-4">
  <div class="col-12">
    <div class="d-flex align-items-center p-3 border-start border-4 border-info bg-label-info rounded-3 shadow-sm position-relative overflow-hidden">
      <i class="ri-information-line position-absolute" style="right: -10px; bottom: -10px; font-size: 5rem; opacity: 0.1; transform: rotate(-15deg); color: #00cfe8;"></i>
      
      <div class="avatar flex-shrink-0 me-3">
        <span class="avatar-initial rounded-circle shadow-sm bg-info text-white">
          <i class="ri-information-line ri-24px"></i>
        </span>
      </div>
      <div class="d-flex flex-column z-1">
        <div class="d-flex align-items-center mb-1">
          <h6 class="mb-0 fw-bold text-info text-uppercase me-2">Aviso Importante</h6>
        </div>
        <span class="text-body">Las visorías en la <strong>AMFPRO</strong> son totalmente gratuitas en todo el territorio nacional.</span>
      </div>
    </div>
  </div>
</div>

<div class="row mb-4">
  <div class="col-12">
    <div class="card border-0 shadow-none" style="background-color: rgba(234, 134, 143, 0.08); border: 1px dashed #ea868f !important; border-radius: 12px;">
      <div class="card-body p-4">
        <div class="row align-items-center">
          <div class="col-12 col-sm-auto text-center mb-3 mb-sm-0">
            <div class="position-relative d-inline-block">
                <div class="bg-danger p-3 rounded-3 shadow">
                    <i class="tf-icons ri-contract-line ri-22px text-white" style="font-size: 2.5rem;"></i>
                </div>
            </div>
          </div>
          
          <div class="col-12 col-sm">
            <h6 class="mb-1 text-danger fw-bold d-flex align-items-center justify-content-center justify-content-sm-start text-uppercase">
              Acción Obligatoria
            </h6>
            <p class="mb-3 text-dark small">
              Es indispensable descargar el <strong>Formato de Consentimiento</strong>, imprimirlo, firmarlo y tenerlo listo para tu registro.
            </p>
            
            <div class="d-flex flex-wrap gap-2 justify-content-center justify-content-sm-start">
                <a href="CONSENTIMIENTOS_FIRMADOS_TALENTOS.pdf" download class="btn btn-danger btn-md shadow-sm d-inline-flex align-items-center px-4">
                  <i class="ri-file-download-line me-2"></i> DESCARGAR FORMATO PDF
                </a>
            </div>
          </div>
        </div>
        
        <!-- <div class="mt-3 pt-3 border-top border-danger border-opacity-10">
          <small class="text-muted">
            <i class="ri-question-line me-1"></i> ¿Problemas con la descarga? 
            <a href="CONSENTIMIENTOS_FIRMADOS_TALENTOS.pdf" download class="text-danger fw-bold">Haz clic aquí manualmente</a>.
          </small>
        </div> -->
      </div>
    </div>
  </div>
</div>
          <div class="divider divider-primary">
            <div class="divider-text"><center>DATOS PERSONALES</center></div>
          </div>
          
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Nombre Completo *</label>
              <input type="text" v-model="form.nombre" class="form-control" />
            </div>
            <div class="col-md-6">
              <label class="form-label">¿A qué VISORIA vas a asistir? (Lugar) *</label>
              <select v-model="form.lugar_visoria" class="form-select">
                <option value="">Seleccione el lugar...</option>
                <option value="CDMX">CDMX</option>
                <option value="León">León</option>
                <option value="Guadalajara">Guadalajara</option>
              </select>
            </div>
            <!-- <div class="col-md-3">
              <label class="form-label">Edad *</label>
              <input type="number" v-model="form.edad" class="form-control" />
            </div> -->
            <div class="col-md-4">
              <label class="form-label">Fecha de Nacimiento *</label>
              <input type="date" v-model="form.fecha_nacimiento" class="form-control" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Estatura (cm) *</label>
              <input type="number" v-model="form.estatura" class="form-control" placeholder="Ej: 175" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Peso (kg) *</label>
              <input type="number" v-model="form.peso" class="form-control" placeholder="Ej: 70" />
            </div>
          </div>

          <div class="divider divider-primary mt-5">
            <div class="divider-text">PERFIL DEPORTIVO</div>
          </div>
          
          <div class="row g-3">
            <div class="col-md-4">
              <label class="form-label">Posición *</label>
              <select v-model="form.posicion" class="form-select">
                <option value="">Seleccione...</option>
                <option value="Portero">Portero</option>
                <option value="Defensa">Defensa</option>
                <option value="Medio">Medio</option>
                <option value="Delantero">Delantero</option>
              </select>
            </div>
            <div class="col-md-4">
              <label class="form-label d-block">Perfil *</label>
              <div class="mt-2">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" v-model="form.perfil" value="Derecho" id="perfilD" />
                  <label class="form-check-label" for="perfilD">Derecho</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" v-model="form.perfil" value="Izquierdo" id="perfilI" />
                  <label class="form-check-label" for="perfilI">Izquierdo</label>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <label class="form-label">¿Eres? *</label>
              <select v-model="form.profesional_amateur" class="form-select">
                <option value="Amateur">Amateur</option>
                <option value="Profesional">Profesional</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Tiempo jugando fútbol *</label>
              <input type="text" v-model="form.tiempo_jugando" class="form-control" />
            </div>
            <div class="col-md-6">
              <label class="form-label">Equipos donde has jugado *</label>
              <textarea v-model="form.equipos_jugando" class="form-control" rows="1"></textarea>
            </div>
          </div>

          <div class="divider divider-primary mt-5">
            <div class="divider-text">CONTACTO Y EDUCACIÓN</div>
          </div>

          <div class="row g-3">
            <div class="col-md-12">
              <label class="form-label">Domicilio particular *</label>
              <input type="text" v-model="form.domicilio" class="form-control" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Teléfono *</label>
              <input type="tel" v-model="form.telefono" class="form-control" maxlength="10" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Correo electrónico *</label>
              <input type="email" v-model="form.correo" class="form-control" />
            </div>
            <div class="col-md-4">
              <label class="form-label">Escuela donde estudias *</label>
              <input type="text" v-model="form.escuela" class="form-control" />
            </div>
            <div class="col-md-6">
              <label class="form-label">Persona que lo recomienda *</label>
              <input type="text" v-model="form.persona_recomienda" class="form-control" />
            </div>
          </div>

          <div class="divider divider-primary mt-5">
            <div class="divider-text">SALUD Y SEGURIDAD</div>
          </div>

          <div class="row g-3">
            <div class="col-md-12">
              <label class="form-label">¿Tienes alguna enfermedad o lesión importante? *</label>
              <div class="input-group">
                <select v-model="form.enfermedad" class="form-select" style="max-width: 150px;">
                  <option value="No">No</option>
                  <option value="Si">Si</option>
                </select>
                <input type="text" v-model="form.enfermedad_detalle" class="form-control" placeholder="Especifique enfermedad o lesión..." v-if="form.enfermedad === 'Si'">
              </div>
            </div>
            <div class="col-md-12 mt-4">
              <label class="form-label">Cuando te invitaron a venir al Club, ¿te solicitaron algún tipo de pago económico? *</label>
              <div class="d-flex gap-3">
                <div class="form-check">
                  <input class="form-check-input" type="radio" v-model="form.solicitud_dinero" value="SI" id="pagoS" />
                  <label class="form-check-label" for="pagoS">SI</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" v-model="form.solicitud_dinero" value="NO" id="pagoN" />
                  <label class="form-check-label" for="pagoN">NO</label>
                </div>
              </div>
            </div>

            <div class="col-md-12" v-if="form.solicitud_dinero === 'SI'">
              <label class="form-label">¿Quién te pidió algún tipo de pago? *</label>
              <input type="text" v-model="form.nombre_quien_pago" class="form-control" />
            </div>

            <div class="mt-4 pt-3 border-top border-success border-opacity-10">
                <label class="form-label fw-bold text-success">
                    <i class="ri-upload-cloud-2-line me-1"></i> ADJUNTAR FORMATO FIRMADO (IMAGEN O PDF) *
                </label>
                <div class="input-group">
                    <input 
                        type="file" 
                        class="form-control" 
                        id="inputGroupFile02" 
                        accept="image/*,application/pdf"
                        @change="handleFileUpload($event)"
                    />
                    <label class="input-group-text" for="inputGroupFile02">Subir</label>
                </div>
                <small class="text-muted">Formatos permitidos: JPG, PNG, PDF. Tamaño máx: 2MB</small>
            </div>
            <div class="col-md-12">
              <div class="card bg-light-warning border-warning p-3">
                <p class="small mb-2"><strong>DESLINDE DE RESPONSABILIDAD:</strong> Confirmo que al momento de realizar la prueba físico-técnica me presento en buen estado de salud, sin ninguna lesión anterior y acepto toda la responsabilidad en caso de sufrir alguna lesión durante este tiempo de prueba cubriendo los gastos médicos y liberando a la AMFPRO de cualquier responsabilidad...</p>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" v-model="form.terminos" id="terminos" />
                  <label class="form-check-label fw-bold" for="terminos">SI acepto Aviso de Privacidad<a href="AVISO_DE_PRIVACIDAD_SIMPLIFICADO_TALENTOS.pdf" download class="text-primary fw-bold">
                    <i class="ri-download-line"></i> Haz clic aquí para consultar Aviso de Privacidad de Talentos AMFPro.
                </a></label>
                </div>
              </div>
            </div>
          </div>

          <div class="mt-5 text-center">
            <button type="submit" class="btn btn-success btn-lg px-5" :disabled="loading">
              <span v-if="loading" class="spinner-border spinner-border-sm me-2"></span>
              ENVIAR REGISTRO
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
  mounted () {
    this.descargarArchivo();
  },
  data() {
    return {
      loading: false,
      form: {
        nombre: '',
        lugar_visoria: '',
        edad: '',
        fecha_nacimiento: '',
        posicion: '',
        perfil: '',
        estatura: '',
        peso: '',
        tiempo_jugando: '',
        equipos_jugando: '',
        profesional_amateur: 'Amateur',
        domicilio: '',
        telefono: '',
        correo: '',
        escuela: '',
        persona_recomienda: '',
        enfermedad: 'No',
        enfermedad_detalle: '',
        terminos: false,
        solicitud_dinero: 'NO',
        nombre_quien_pago: '',
        formato_firmado: null
      }
    }
  },
  methods: {
    descargarArchivo() {
      // Ruta del archivo (Asegúrate de que esté en tu carpeta public de Laravel)
      const urlArchivo = 'CONSENTIMIENTOS_FIRMADOS_TALENTOS.pdf'; 
      
      // Creamos un enlace temporal
      const link = document.createElement('a');
      link.href = urlArchivo;
      link.setAttribute('download', 'Deslinde_AMFPRO.pdf'); // Nombre con el que se guardará
      document.body.appendChild(link);
      link.click();
      
      // Limpiamos el DOM
      document.body.removeChild(link);
    },
    handleFileUpload(event) {
        this.form.formato_firmado = event.target.files[0];
    },
    showError(msg) {
        this.$toast.error(msg, {
            position: "top-center",
            timeout: 2500,
            hideProgressBar: true,
            closeButton: "button",
            icon: true,
        });
    },
    async enviarFormulario() {
        // Mapeo de validaciones: campo -> mensaje de error
        const validations = [
            { field: 'nombre', msg: 'Ingresa tu nombre completo' },
            { field: 'lugar_visoria', msg: 'Selecciona el lugar de la visoria' },
            // { field: 'edad', msg: 'Ingresa tu edad' },
            { field: 'fecha_nacimiento', msg: 'Selecciona la fecha de nacimiento' },
            { field: 'estatura', msg: 'Ingresa tu estatura' },
            { field: 'peso', msg: 'Ingresa tu peso' },
            { field: 'posicion', msg: 'Selecciona tu posición' },
            { field: 'perfil', msg: 'Selecciona tu perfil (Derecho/Izquierdo)' },
            { field: 'tiempo_jugando', msg: 'Ingresa cuánto tiempo llevas jugando' },
            { field: 'equipos_jugando', msg: 'Ingresa los equipos donde has jugado' },
            { field: 'domicilio', msg: 'Ingresa tu domicilio particular' },
            { field: 'telefono', msg: 'Ingresa un número de teléfono de 10 dígitos' },
            { field: 'correo', msg: 'Ingresa tu correo electrónico' },
            { field: 'escuela', msg: 'Ingresa el nombre de tu escuela' },
            { field: 'persona_recomienda', msg: 'Ingresa quién te recomienda' },
        ];

        // Validar campos obligatorios básicos
        for (let item of validations) {
            if (!this.form[item.field] || this.form[item.field] === '') {
                this.showError(item.msg);
                return;
            }
        }

        // Validaciones condicionales y específicas
        if (this.form.enfermedad === 'Si' && !this.form.enfermedad_detalle) {
            this.showError("Por favor especifica tu enfermedad o lesión");
            return;
        }

        if (this.form.solicitud_dinero === 'SI' && !this.form.nombre_quien_pago) {
            this.showError("Por favor indica quién te solicitó el pago");
            return;
        }

        if (this.form.telefono.length !== 10) {
            this.showError("El teléfono debe ser de 10 dígitos");
            return;
        }

        if (!this.form.terminos) {
            this.showError("Debe aceptar el deslinde de responsabilidad");
            return;
        }

        if (!this.form.formato_firmado) {
            this.showError("Es obligatorio adjuntar el formato de consentimiento firmado");
            return;
        }
        let formData = new FormData();
        for (let key in this.form) {
            formData.append(key, this.form[key]);
        }
        this.loading = true;
        try {
            const response = await axios.post('visorias/registro', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            });

            Swal.fire({
                title: 'Registro Exitoso',
                text: "¡Tus datos han sido registrados correctamente!",
                icon: 'success',
                showConfirmButton: true,
                confirmButtonText: 'Ok',
                confirmButtonColor: '#3085d6',
                allowOutsideClick: false // Recomendado para obligar a leer el mensaje
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirección al sitio externo
                    window.location.href = "https://amfpro.mx/talentos";
                }
            });
            
            // Limpiar input file manualmente (el reset del form no limpia el DOM del input file)
            document.getElementById('inputGroupFile02').value = '';
            this.form = {
                nombre: '',
                lugar_visoria: '',
                edad: '',
                fecha_nacimiento: '',
                posicion: '',
                perfil: '',
                estatura: '',
                peso: '',
                tiempo_jugando: '',
                equipos_jugando: '',
                profesional_amateur: 'Amateur',
                domicilio: '',
                telefono: '',
                correo: '',
                escuela: '',
                persona_recomienda: '',
                enfermedad: 'No',
                enfermedad_detalle: '',
                terminos: false,
                solicitud_dinero: 'NO',
                nombre_quien_pago: ''
            }

        } catch (error) {
            this.showError("Error al enviar el registro o el archivo es muy pesado.");
        } finally {
            this.loading = false;
        }
    },
    
  }
}
</script>

<style lang="scss" scoped>
.divider-primary {
  margin: 2rem 0 1rem 0;
}
.bg-light-warning {
  background-color: #fff8e1;
}
// Quitar flechas de input number
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
</style>