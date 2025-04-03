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
                                <button class="btn btn-success btn-toggle-sidebar w-100" data-bs-toggle="offcanvas" data-bs-target="#addEventSidebar" aria-controls="addEventSidebar">
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
                            <!-- FullCalendar Offcanvas -->
                            <div
                            class="offcanvas offcanvas-end event-sidebar"
                            tabindex="-1"
                            id="addEventSidebar"
                            aria-labelledby="addEventSidebarLabel">
                            <div class="offcanvas-header border-bottom">
                                <h5 class="offcanvas-title" id="addEventSidebarLabel">Add Event</h5>
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
                                    id="eventTitle"
                                    name="eventTitle"
                                    placeholder="Event Title" />
                                    <label for="eventTitle">Title</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-5">
                                    <select class="select2 select-event-label form-select" id="eventLabel" name="eventLabel">
                                        <option data-label="primary" value="Business" selected>Business</option>
                                        <option data-label="danger" value="Personal">Personal</option>
                                        <option data-label="warning" value="Family">Family</option>
                                        <option data-label="success" value="Holiday">Holiday</option>
                                        <option data-label="info" value="ETC">ETC</option>
                                    </select>
                                    <label for="eventLabel">Label</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-5">
                                    <input
                                    type="text"
                                    class="form-control"
                                    id="eventStartDate"
                                    name="eventStartDate"
                                    placeholder="Start Date" />
                                    <label for="eventStartDate">Start Date</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-5">
                                    <input
                                    type="text"
                                    class="form-control"
                                    id="eventEndDate"
                                    name="eventEndDate"
                                    placeholder="End Date" />
                                    <label for="eventEndDate">End Date</label>
                                </div>
                                <div class="mb-5">
                                    <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input allDay-switch" id="allDaySwitch" />
                                    <label class="form-check-label" for="allDaySwitch">All Day</label>
                                    </div>
                                </div>
                                <div class="form-floating form-floating-outline mb-5">
                                    <input
                                    type="url"
                                    class="form-control"
                                    id="eventURL"
                                    name="eventURL"
                                    placeholder="https://www.google.com" />
                                    <label for="eventURL">Event URL</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-5 select2-primary">
                                    <select
                                    class="select2 select-event-guests form-select"
                                    id="eventGuests"
                                    name="eventGuests"
                                    multiple>
                                    <option data-avatar="1.png" value="Jane Foster">Jane Foster</option>
                                    <option data-avatar="3.png" value="Donna Frank">Donna Frank</option>
                                    <option data-avatar="5.png" value="Gabrielle Robertson">Gabrielle Robertson</option>
                                    <option data-avatar="7.png" value="Lori Spears">Lori Spears</option>
                                    <option data-avatar="9.png" value="Sandy Vega">Sandy Vega</option>
                                    <option data-avatar="11.png" value="Cheryl May">Cheryl May</option>
                                    </select>
                                    <label for="eventGuests">Add Guests</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-5">
                                    <input
                                    type="text"
                                    class="form-control"
                                    id="eventLocation"
                                    name="eventLocation"
                                    placeholder="Enter Location" />
                                    <label for="eventLocation">Location</label>
                                </div>
                                <div class="form-floating form-floating-outline mb-5">
                                    <textarea class="form-control" name="eventDescription" id="eventDescription"></textarea>
                                    <label for="eventDescription">Description</label>
                                </div>
                                <div class="mb-5 d-flex justify-content-sm-between justify-content-start my-6 gap-2">
                                    <div class="d-flex">
                                    <button type="submit" id="addEventBtn" class="btn btn-success btn-add-event me-4">
                                        Add
                                    </button>
                                    <button
                                        type="reset"
                                        class="btn btn-outline-secondary btn-cancel me-sm-0 me-1"
                                        data-bs-dismiss="offcanvas">
                                        Cancel
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
                eventClick:this.handleDateClick 
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
            detalleCalendario:[]
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
                this.dateCalendar();

                this.detalleCalendario ={
                    torneo:eventObj.title,
                    categoris:eventObj.extendedProps.categoria,
                    
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
                    color: '#ff4d49',
                    extendedProps: {
                        categoria: `${eventotorneo.categoria}`,
                    },
                })); 
            }else{
                this.dataTorneo = [];
                
            }
            if (this.selectCalendario.notas == true) {        

               this.dataNota = Notas.map(eventonota => ({
                    ...eventonota,
                    title:eventonota.nombre,
                    start: eventonota.inicia_fecha,
                    end:eventonota.fin_fecha,
                    color: '#73c72f',
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
        dateCalendar(){

            Swal.fire({
                title: "Editar Datos de Pago?",
                html: `
                    <label for="fecha_pago" style="color:black">Ingresa una Fecha:</label>
                    <input id="fecha_pago" type="text" value="${this.detalleCalendario.torneo}">

                  
                `,
                icon: "warning",
                showCancelButton: true,
                cancelButtonText: "Cancelar",
                confirmButtonColor: "#12B8F2",
                cancelButtonColor: "#d33",
                confirmButtonText: "Editar",
            
            }).then((result) => {
                if (result.isConfirmed) {
                    

                }
            });
        }

    
    }
};
</script>
<style lang='' scoped>

</style>