<template>
    <div>
        <div  v-if="this.vista == 0">
            <div class="row">
                <div class="layout-demo-wrapper">
                    <div class="layout-demo-placeholder">
                    <img
                        src="style/logos/Animación-Logo-AMFPRO.gif"
                        class="img-fluid" style="width: 400px;"/>
                    </div>
                    <div class="layout-demo-info">
                    <!-- <h4>Layout container</h4>
                    <p>Container layout sets a <code>max-width</code> at each responsive breakpoint.</p> -->
                    </div>
                </div>
            </div>
        </div>
        <br><br>
        <div class="modal fade" id="basicModal" 
            tabindex="-1" aria-labelledby="modalTitleId"
            aria-hidden="true">

            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId"> Cambio de Contraseña </h5>
                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                    </div>
                    <div class="modal-body">
                        <p class="ml-4">Hola! <b>{{this.name_usuario_logeado}}</b> para poder continuar tienes que cambiar tu contraseña!</p>
                        <div class="mb-3">
                            <div class="form-password-toggle">
                                <div class="input-group input-group-merge">
                                
                                <div class="form-floating form-floating-outline">
                                    <input
                                    type="password"
                                    id="password"
                                    class="form-control"
                                     v-model="cambio.password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" />
                                    <label for="password">Password</label>
                                </div>
                                <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line"></i></span>
                                </div>
                            </div>                            
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        
                        <button type="button" class="btn btn-primary" @click="cambiarPassword()">Guardar</button>
                    </div>
                </div>
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
        'password',   
        'componente'
    ],
    data() {
        return {
            vista:0,
            checkInterval:null,
            cambio:{
                id:this.id_usuario_logeado,
                password:''
            }
        }
    },
    computed: {

    },
    watch: {
        
    },
    mounted() {

        this.checkInterval = setInterval(() => {
        console.log("Revisando contraseña:", this.password);
            if (this.password === '0') {
                $('#basicModal').modal('show');
                clearInterval(this.checkInterval); // Detiene la verificación
            }
        }, 1000);
    },

    methods: {
        cambiarPassword(){
            if (this.cambio.password === '') {
                this.$toast.error("Debes ingresar una nueva contraseña", {
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
            const pass = this.cambio;
            axios.post('home/cambioPassword',pass).then(res =>{
                Swal.fire({
                    icon: 'success',
                    text: `Se cambio la contraseña correctamente!.`,
                    showConfirmButton: false,
                    timer: 2500,
                })
                this.cambio = {
                    password:''
                }
                $('#basicModal').modal('hide');
            })
        },
    }
};
</script>
<style lang='' scoped>
</style>