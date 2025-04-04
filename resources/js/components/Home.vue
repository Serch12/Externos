<template>
    <div>
        <div  v-if="this.vista == 0">
            <div class="row">
                <!-- <div class="layout-demo-wrapper">
                    <div class="layout-demo-placeholder">
                        <img src="style/logos/Animación-Logo-AMFPRO.gif" class="img-fluid" style="width: 400px;"/>
                    </div>
                    <div class="layout-demo-info">

                    </div>
                </div> -->
                <div class="card app-calendar-wrapper">
                    <div class="row g-0">
                        <!-- Calendar Sidebar -->
                        <div class="col-xl-3 col-lg-4 app-calendar-sidebar border-end" id="app-calendar-sidebar">
                            <div class="p-5 my-sm-0 mb-4 border-bottom">
                                <button class="btn btn-success btn-toggle-sidebar w-100" data-bs-toggle="offcanvas" data-bs-target="#createRecordatorio" aria-controls="createRecordatorio">
                                    <i class="ri-add-line ri-16px me-1_5"></i>
                                    <span class="align-middle">Añadir Nota</span>
                                </button>
                            </div>
                            <div class="px-4">
                                <!-- inline calendar (flatpicker) -->
                                <div class="inline-calendar"></div>

                                <hr class="mb-5 mx-n4 mt-3" />
                                <!-- Filter -->
                                <div class="mb-4 ms-1">
                                    <h5>Filtro de Eventos</h5>
                                </div>

                                <div class="app-calendar-events-filter text-heading">
                                    <div class="form-check form-check-danger mb-5 ms-3">
                                        <input
                                            class="form-check-input input-filter"
                                            type="checkbox"
                                            id="select-torneo"
                                            :true-value="true"
                                            :false-value="false"
                                            v-model="selectCalendario.torneo" @change="TipeEvent(selectCalendario.torneo)"/>
                                        <label class="form-check-label" for="select-torneo">Torneo</label>
                                    </div>
                                    <div class="form-check mb-5 ms-3">
                                        <input
                                            class="form-check-input input-filter"
                                            type="checkbox"
                                            id="select-notas"
                                            :true-value="true"
                                            :false-value="false"
                                            v-model="selectCalendario.notas" @change="TipeEvent(selectCalendario.notas)"/>
                                        <label class="form-check-label" for="select-notas">Notas</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Calendar Sidebar -->

                        <!-- Calendar & Modal -->
                        <div class="col-xl-9 col-lg-8 app-calendar-content">
                            <div class="card shadow-none border-0">
                                <div class="card-body pb-0">
                                    <!-- FullCalendar -->
                                    <FullCalendar :options="calendarOptions" id="calendar"/>
                                    <!-- <div id="calendar"></div> -->
                                </div>
                            </div>
                            <div class="app-overlay"></div>
                            <!-- FullCalendar Offcanvas create -->
                            <div class="offcanvas offcanvas-end event-sidebar" tabindex="-1" id="createRecordatorio" aria-labelledby="addEventSidebarLabel">
                                <div class="offcanvas-header border-bottom">
                                    <h5 class="offcanvas-title" id="addEventSidebarLabel">Añadir Recordatorio</h5>
                                    <button
                                    type="button"
                                    class="btn-close text-reset"
                                    data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                    <form class="event-form pt-0" id="eventForm" onsubmit="return false">
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input
                                        type="text"
                                        class="form-control"
                                        id="eventTitulo"
                                        name="eventTitulo"
                                        placeholder="Titulo" 
                                        v-model="newrecordatorio.titulo"/>
                                        <label for="eventTitulo">Titulo</label>
                                    </div>
                                
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input
                                        type="date"
                                        class="form-control"
                                        id="eventStartDate"
                                        name="eventStartDate"
                                        v-model="newrecordatorio.fecha_inicia" />
                                        <label for="eventStartDate">Fecha Inicio</label>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-5">
                                        <input
                                        type="date"
                                        class="form-control"
                                        id="eventEndDate"
                                        name="eventEndDate"
                                        v-model="newrecordatorio.fecha_fin"/>
                                        <label for="eventEndDate">Fecha Fin</label>
                                    </div>
                                
                                    <div class="form-floating form-floating-outline mb-5">
                                        <textarea class="form-control" name="eventDescription" id="eventDescription" v-model="newrecordatorio.descripcion"></textarea>
                                        <label for="eventDescription">Descripción</label>
                                    </div>
                                    <div class="mb-5 d-flex justify-content-sm-between justify-content-start my-6 gap-2">
                                        <div class="d-flex">
                                        <button type="button" id="addEventBtn" class="btn btn-success btn-add-event me-4" @click="RecordatorioCreate()">
                                            Crear
                                        </button>
                                        <button
                                            type="reset"
                                            class="btn btn-outline-danger btn-cancel me-sm-0 me-1"
                                            data-bs-dismiss="offcanvas">
                                            Cancelar
                                        </button>
                                        </div>
                                        <button class="btn btn-outline-danger btn-delete-event d-none">Delete</button>
                                    </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                        <!-- /Calendar & Modal -->
                    </div>
              </div>
            </div>
        </div>

        <div class="modal fade" id="basicModal" data-bs-backdrop="static" tabindex="-1">
            <div class="modal-dialog">
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
                        <button type="button" class="btn btn-success" @click="cambiarPassword()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        <br><br><br>

    </div>
</template>
<script>
import FullCalendar from '@fullcalendar/vue'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction';
import listPlugin from '@fullcalendar/list';
import timeGridPlugin from '@fullcalendar/timegrid';
export default {
    name: '',
    components: {
        FullCalendar
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
            calendarOptions: {
                plugins: [
                    listPlugin,
                    dayGridPlugin,
                    timeGridPlugin,
                    interactionPlugin // needed for dateClick
                ],
                droppable: true,
                locale:'es',
                timeZone: 'GMT-5',
                buttonText:{
                    today:    'Hoy',
                    month:    'Mes',
                    week:     'Semana',
                    day:      'Día',
                    list:     'Lista'
                },
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                initialView: 'dayGridMonth',
                // editable: true,
                selectable: true,
                selectMirror: true,
                dayMaxEvents: true,
                weekends: true,
                select: this.handleDateSelect,

                slotLabelFormat:{
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                },
                eventTimeFormat: {
                    hour: 'numeric',
                    minute: '2-digit',
                    hour12: true
                },
                events: [],
                eventClick:this.handleDateClick,
                dateClick: this.CalendarClick,
            },
            vista:0,
            checkInterval:null,
            cambio:{
                id:this.id_usuario_logeado,
                password:''
            },

            /* DATA DE CALENDARIO*/
            Torneos:[],
            Notas:[],
            Calendario:[],

            selectCalendario:{
                torneo:true,
                notas:true
            },
            detalleTorneo:{
                torneo:'',
                categoria:''
            },
            detalleNota:{
                nota:'',
                descripcion:''
            },
            newrecordatorio:{
                id_user:this.id_usuario_logeado,
                titulo:'',
                nombre:'',
                descripcion:'',
                fecha_inicia:'',
                fecha_fin:'',
            },
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

        this.getCalendario();
    },

    methods: {
        CalendarClick:function (info) {
            if(info.view.type == 'timeGridWeek' || info.view.type == 'timeGridDay'){
                let str = info.dateStr;
                var fecha = str.split("T")[0];
                console.log(fecha);
                
                this.newrecordatorio.fecha_inicia = fecha;
            }
            if(info.view.type == 'dayGridMonth'){

                this.newrecordatorio.fecha_inicia = info.dateStr;
                this.newrecordatorio.fecha_fin = info.dateStr;
            }
            $('#createRecordatorio').offcanvas('show');
        },
        handleDateClick: function(info) {
            var eventObj = info.event;

            if (eventObj.url) {
                alert(
                'Clicked ' + eventObj.title + '.\n' +
                'Will open ' + eventObj.url + ' in a new tab'
                );

                // window.open(eventObj.url);

                info.jsEvent.preventDefault(); // prevents browser from following link in current tab.
            } else {
               


                if (eventObj.extendedProps.tipo === 'torneo') {
                    this.detalleTorneo = {
                        torneo: eventObj.title,
                        categoria: eventObj.extendedProps.categoria,
                        fecha_inicia: eventObj.extendedProps.fecha_inicia,
                        fecha_fin: eventObj.extendedProps.fecha_fin,
                        sede: eventObj.extendedProps.sede,


                    };
                    this.dateCalendar(this.detalleTorneo);
                }
                if (eventObj.extendedProps.tipo === 'nota') {
                    this.detalleNota = {
                        titulo: eventObj.title,
                        fecha_inicia: eventObj.extendedProps.fecha_inicia,
                        fecha_termina: eventObj.extendedProps.fecha_termina,
                        descripcion: eventObj.extendedProps.descripcion,
                    };
                    this.dateCalendar(this.detalleNota);
                }


            }
        },
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
                    title: "Exelente!",
                    text: "Se cambio la contraseña correctamente!.",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2500
                });
                this.cambio = {
                    password:''
                }
                $('#basicModal').modal('hide');
            })
        },
        getCalendario(){
            let url = `home/Calendario?buscador=${this.search}`;
            axios.get(url).then(response => {
                this.Calendario = response.data.calendario;

                this.TipeEvent();

            });

        },
        TipeEvent(){

            this.calendarOptions.events = [];
            var Torneo = this.Calendario.torneo;
            var Notas = this.Calendario.nota;

            if (this.selectCalendario.torneo == true) {

               this.dataTorneo = Torneo.map(eventotorneo => ({
                    ...eventotorneo,
                    title:eventotorneo.torneo,
                    start: eventotorneo.fecha_inicia,
                    end:eventotorneo.fecha_fin,
                    tipo:'torneo',
                    color: '#ff4d49',
                    extendedProps: {
                        categoria: `${eventotorneo.categoria}`,
                        fecha_inicia: `${eventotorneo.fecha_inicia}`,
                        fecha_fin: `${eventotorneo.fecha_fin}`,
                        sede: `${eventotorneo.sede}`,
                    },
                }));
            }else{
                this.dataTorneo = [];

            }
            if (this.selectCalendario.notas == true) {

               this.dataNota = Notas.map(eventonota => ({
                    ...eventonota,
                    title:eventonota.titulo,
                    start: eventonota.fecha_inicia,
                    end:eventonota.fecha_termina,
                    tipo:'nota',
                    color: '#73c72f',
                    extendedProps: {
                        descripcion: `${eventonota.descripcion}`,
                    },
                }));
            }else{
                this.dataNota = [];

            }

            this.calendarOptions.events = [...this.dataTorneo,...this.dataNota];
        },
        Eventos(){

            let eventosFiltrados = todosLosEventos.filter(evento =>
                this.selectedCategories.includes(evento.tipo)
            );

            this.calendarOptions.events = eventosFiltrados.map(evento => ({
                id: evento.id_torneo,
                title: evento.nombre || "Evento sin título",
                start: evento.fecha_inicio,
                end: evento.fecha_fin || evento.fecha_inicio,
                allDay: true,
                backgroundColor: this.getEventColor(evento.tipo),
                borderColor: this.getEventColor(evento.tipo)
            }));
        },
        dateCalendar(value){
            const {
                titulo,
                torneo,
                descripcion,    
                categoria,
                sede,
                fecha_inicia,
                fecha_fin,  
            } = value;
            

            Swal.fire({
                title: ` 
                    ${titulo ? `<b class="text-center">${titulo}</b>` : ''}
                    ${torneo ? `<b class="text-center">${torneo}</b>` : ''}`,
                html: `

                    <table class="table" style="font-size: 14px;">
                        <tbody>
                            <tr>
                                ${categoria ? `<td colspan="2"><b>Categoria:</b></td>` : ''}
                                ${categoria ? `<td colspan="2">${categoria}</td>` : ''}
                                ${descripcion ? `<td colspan="2"><b>Descripción:</b></td>` : ''}
                                ${descripcion ? `<td colspan="2">${descripcion}</td>` : ''}
                            </tr>
                            <tr>
                                ${fecha_inicia ? `<td colspan="2"><b>Fecha Inicia:</b></td>` : ''}
                                ${fecha_inicia ? `<td colspan="2">${fecha_inicia}</td>` : ''}
                            </tr>
                            <tr>
                                ${fecha_fin ? `<td colspan="2"><b>Fecha Fin:</b></td>` : ''}
                                ${fecha_fin ? `<td colspan="2">${fecha_fin}</td>` : ''}
                            </tr>
                            <tr>
                                ${sede ? `<td colspan="2"><b>Sede:</b></td>` : ''}
                                ${sede ? `<td colspan="2">${sede}</td>` : ''}
                            </tr>
                        </tbody>
                    </table>
                `,
                showCancelButton: true,
                cancelButtonText: "Cancelar",
                cancelButtonColor: "#d33",
                showConfirmButton: false,

            }).then((result) => {
                if (result.isConfirmed) {


                }
            });
        },
        RecordatorioCreate(){
            if (this.newrecordatorio.titulo == '') {
                this.$toast.error("Añade un Titulo", {
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
            if (this.newrecordatorio.fecha_inicia == '') {
                this.$toast.error("Añade una Fecha Inicial", {
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
            if (this.newrecordatorio.fecha_fin == '') {
                this.$toast.error("Añade una Fecha Final", {
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
            if (this.newrecordatorio.descripcion == '') {
                this.$toast.error("Añade una Descripción", {
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
            formData.append('id_user', this.newrecordatorio.id_user); 
            formData.append('titulo', this.newrecordatorio.titulo);
            formData.append('descripcion', this.newrecordatorio.descripcion);
            formData.append('fecha_inicia', this.newrecordatorio.fecha_inicia);
            formData.append('fecha_fin', this.newrecordatorio.fecha_fin);

            axios.post('home/RecordatorioCreate', formData).then(res =>{
                this.newrecordatorio = {
                    id_user:this.id_usuario_logeado,
                    titulo:'',
                    nombre:'',
                    descripcion:'',
                    fecha_inicia:'',
                    fecha_fin:'',
                }
                this.getCalendario();
                $('#createRecordatorio').offcanvas('hide');
                Swal.fire({
                    title: 'Éxito',
                    text: "Se Registro correctamente!",
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2500,
                    });
                })
        }



    }
};
</script>
<style lang='' scoped>

</style>