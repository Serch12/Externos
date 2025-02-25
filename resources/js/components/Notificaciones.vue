<template>
    <div>
        <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-4 me-xl-1">
            <a class="nav-link btn btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow" type="button"
                data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                <i class="ri-notification-3-fill ri-22px"></i>
                <span class="position-absolute top-0 start-50 translate-middle-y badge badge-dot bg-danger mt-2 border" v-if="notifications.length > 0"></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end py-0">
                <li class="dropdown-menu-header border-bottom py-50">
                    <div class="dropdown-header d-flex align-items-center py-2">
                        <h6 class="mb-0 me-auto">Notificaciones</h6>
                        <div class="d-flex align-items-center"  v-if="notifications.length > 0">
                            <span class="badge rounded-pill bg-label-primary fs-xsmall me-2">{{notifications.length}} Nuevos</span>
                            <a type="button"  class="btn btn-text-secondary rounded-pill btn-icon dropdown-notifications-all" @click="limpiaNoti()"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Marcar todo como leido">
                                <i class="ri-mail-open-line text-heading ri-20px"></i>
                            </a>
                        </div>
                    </div>
                </li>
                <li class="dropdown-notifications-list scrollable-container">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item list-group-item-action dropdown-notifications-item" v-if="this.notifications.length == 0">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar">
                                        <span class="avatar-initial rounded-circle bg-label-danger ri-information-fill ri-20px"></span>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 small mt-2">Sin Notificaciones</h6>
                                </div>
                            </div>
                        </li>
                    
                        <li class="list-group-item list-group-item-action dropdown-notifications-item" v-else v-for="(noti, index) in notifications" :key='index' @click="eliminarNoti(noti.id_notificacion,noti.url)">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar">
                                        <span :class="`avatar-initial rounded-circle bg-label-${noti.color} ${noti.icon} ri-20px`"></span>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 small">{{noti.modulo}}</h6>
                                    <small class="mb-1 d-block text-body">{{noti.descripcion}}</small>
                                    <small class="text-muted"> <timeago :datetime="noti.created_at" :auto-update="60"></timeago></small>
                                </div>
                            </div>
                        </li>
                    
                    </ul>
                </li>
            </ul>
          </li>
    </div>
</template>
<script>
import axios from 'axios';
import VueTimeago from 'vue-timeago'

Vue.use(VueTimeago, {
    name: 'Timeago', // Component name, `Timeago` by default
    locale: 'es', // Default locale
    // We use `date-fns` under the hood
    // So you can use all locales from it
    locales: {
        'zh-CN': require('date-fns/locale/zh_cn'),
        ja: require('date-fns/locale/ja'),
        es: require('date-fns/locale/es') // Idioma español
    }
})

export default {
    name: '',
    components: {
        
    },
    mixins: [],
    props: [

        'id_usuario_logeado',
        'name_usuario_logeado',
        'email',
        'rol_usuario'

    ],
    data() {
        return {
            notifications:[],
            eliminacion:[]
        }
    },
    computed: {
        
    },
    watch: {
        
    },
    mounted() {
        this.getNotificacion();
        // canal que envia de estatus en proceso a en revision de modulo de cotizaciones
        window.Echo.channel('torneo_canal')
        .listen('TorneoChangedEvent',(torneo) => {
            for (const [key, value] of Object.entries(torneo)) {
                    var id_usuario = value.creacion
                    var name_torneo = value.torneo
                    var estatus = value.estatus;
                }
                
            if (this.id_usuario_logeado == id_usuario && estatus == 3) {
                this.$toast.error(`Se rechazo el Pago del Torneo ${name_torneo}`, {
                    position: "top-right",
                    timeout: 5000,
                    closeOnClick: true,
                    pauseOnFocusLoss: true,
                    pauseOnHover: true,
                    draggable: true,
                    draggablePercent: 0.6,
                    showCloseButtonOnHover: true,
                    hideProgressBar: true,
                    closeButton: "button",
                    icon: true,
                    rtl: false
                });
                
            }
            if (this.id_usuario_logeado == id_usuario && estatus == 2) {
                this.$toast.success(`Se realizo el Pago del Torneo ${name_torneo}`, {
                    position: "top-right",
                    timeout: 5000,
                    closeOnClick: true,
                    pauseOnFocusLoss: true,
                    pauseOnHover: true,
                    draggable: true,
                    draggablePercent: 0.6,
                    showCloseButtonOnHover: true,
                    hideProgressBar: true,
                    closeButton: "button",
                    icon: true,
                    rtl: false
                });
                
            }
            this.getNotificacion();
        });
    },
    methods: {
        getNotificacion(){
            axios.get('notificacion/getNotificacion').then(response=>{
                this.notifications = response.data.noti
            })
        },
        eliminarNoti(id_notificacion, url) {
            axios.post(`notificacion/eliminaNotificacion/${id_notificacion}`).then(response => {
                window.location.href = `${url}`;
                this.getNotificacion();
            });

        },
        limpiaNoti(){
            for (let index = 0; index < this.notifications.length; index++) {
                const id = this.notifications[index].id_notificacion;
                this.eliminacion.push({
                    id_notificacion:id
                });
            }
            let formData = new FormData();
                formData.append('notificacion',JSON.stringify(this.eliminacion))
                axios.post(`notificacion/limpiaNotificacion`,formData).then(res => {
                    this.notifications = res.data

                    this.$toast.success("Se Limpio tu barra de Notificaciones", {
                        position: "top-right",
                        timeout: 5000,
                        closeOnClick: true,
                        pauseOnFocusLoss: true,
                        pauseOnHover: true,
                        draggable: true,
                        draggablePercent: 0.6,
                        showCloseButtonOnHover: true,
                        hideProgressBar: true,
                        closeButton: "button",
                        icon: true,
                        rtl: false
                    });
                    this.getNotificacion();
                })
        }
    }
};
</script>
<style lang='' scoped>
</style>