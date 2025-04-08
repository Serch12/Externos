<template>
    <div>
        <div  v-if="this.vista == 0">
            <div class="row">
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
                        id_recordario: eventObj.extendedProps.id_recordario,


                    };
                    this.dateCalendar(this.detalleTorneo);
                }
                if (eventObj.extendedProps.tipo === 'nota') {
                    this.detalleNota = {
                        titulo: eventObj.title,
                        fecha_inicia: eventObj.extendedProps.fecha_inicia,
                        fecha_termina: eventObj.extendedProps.fecha_termina,
                        descripcion: eventObj.extendedProps.descripcion,
                        id_recordario: eventObj.extendedProps.id_recordario,
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
                        id_recordario: `${eventotorneo.id_recordario}`,
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
                        id_recordario: `${eventonota.id_recordario}`,
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
            console.log(value);
            
            const {
                id_recordario,
                titulo,
                torneo,
                descripcion,    
                categoria,
                sede,
                fecha_inicia,
                fecha_fin,
                fecha_termina
            } = value;
            

            Swal.fire({
                html: `
                    ${titulo ? `<h5><b class="text-center">${titulo}</b></h5>` : ''}
                    ${torneo ? `<h5><b class="text-center">${torneo}</b></h5>` : ''}
                    ${titulo ? 
                        `<div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-icon btn-outline-info waves-effect" id="btn-edit">
                                <span class="tf-icons ri-edit-box-fill ri-22px"></span>
                            </button>
                            <button type="button" class="btn btn-icon btn-outline-danger waves-effect" id="btn-delete">
                                <span class="tf-icons ri-delete-bin-6-fill ri-22px"></span>
                            </button>
                        </div>` 
                    : ''}
                     
                    <br><br>
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
                                ${fecha_termina ? `<td colspan="2"><b>Fecha Fin:</b></td>` : ''}
                                ${fecha_termina ? `<td colspan="2">${fecha_termina}</td>` : ''}
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
                didOpen: () => {
                    const swalContainer = Swal.getPopup();

                    swalContainer.querySelector('#btn-edit').addEventListener('click', () => {
                        Swal.fire({
                            html: `
                                <h5><b class="text-center">Editar Recordatorio</b></h5><br>
                                <div class="row">
                                    <div class="col-12 col-lg-12">
                                        <div class="input-group input-group-merge">
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" id="titulo" class="form-control" value="${titulo}"/>
                                                <label for="titulo">Titulo</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 mt-2">
                                        <div class="input-group input-group-merge">
                                            <div class="form-floating form-floating-outline">
                                                <input type="date" id="fecha_inicia" class="form-control" value="${fecha_inicia}"/>
                                                <label for="fecha_inicia">Fecha Inicia</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 mt-2">
                                        <div class="input-group input-group-merge">
                                            <div class="form-floating form-floating-outline">
                                                <input type="date" id="fecha_termina" class="form-control" value="${fecha_termina}"/>
                                                <label for="fecha_termina">Fecha Inicia</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-12 mt-2">
                                        <div class="input-group input-group-merge">
                                            <div class="form-floating form-floating-outline">
                                                <textarea class="form-control" id="descripcion">${descripcion}</textarea>
                                                <label for="descripcion">Descripción</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                               
                            `,
                            showCancelButton: true,
                            cancelButtonText: "Cancelar",
                            confirmButtonColor: "#12B8F2",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Editar",
                        preConfirm: () => {
                            // Obtener el valor seleccionado
                            const date_titulo = document.getElementById('titulo').value;
                            const date_fechainicia = document.getElementById('fecha_inicia').value;
                            const date_fechatermina = document.getElementById('fecha_termina').value;
                            const date_descripcion = document.getElementById('descripcion').value;

                            // Validar si se ha seleccionado una forma de pago
                            if (date_titulo === '') {
                                Swal.showValidationMessage('Ingresa un Titulo');
                                return false; // Evita que la ventana modal se cierre
                            }
                            if (date_fechainicia == '') {
                                Swal.showValidationMessage('Ingresa una Fecha Inicial');
                                return false; // Evita que la ventana modal se cierre    
                            }
                            if (date_fechatermina == '') {
                                Swal.showValidationMessage('Ingresa una Fecha Final');
                                return false; // Evita que la ventana modal se cierre    
                            }
                            if (!date_descripcion.trim()) {
                                Swal.showValidationMessage('Ingresa una Descripción');
                                return false; // Evita que la ventana modal se cierre    
                            }
                        
                            this.fecha_inicia = date_fechainicia;
                            this.fecha_termina = date_fechatermina;
                            this.titulo = date_titulo;
                            this.descripcion = date_descripcion;
                            this.id_recordario = id_recordario;
                            return true;
                        }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                let formData = new FormData();
                                formData.append('id_recordario', this.id_recordario);
                                formData.append('fecha_inicia', this.fecha_inicia);
                                formData.append('fecha_termina', this.fecha_termina);
                                formData.append('titulo', this.titulo);
                                formData.append('descripcion', this.descripcion);

                                axios.post('home/RecordatorioUpdate', formData).then(res =>{
                                    this.getCalendario();
                                    Swal.fire({
                                        title: 'Éxito',
                                        text: "Se Edito correctamente!",
                                        icon: 'success',
                                        showConfirmButton: false,
                                        timer: 2500,
                                    });
                                })
                            }
                        });
                    });

                    swalContainer.querySelector('#btn-delete').addEventListener('click', () => {
                        Swal.fire({
                            title: "Estas seguro?",
                            text: "Se eliminara definitivamente!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            cancelButtonText: "Cancelar",
                            confirmButtonText: "Eliminar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                let formData = new FormData();
                                formData.append('id_recordario', id_recordario);

                                axios.post('home/RecordatorioDelete', formData).then(res =>{
                                    this.getCalendario();
                                    Swal.fire({
                                        title: "Eliminado!",
                                        text: "se elimino correctamente.",
                                        icon: "success"
                                    });
                                })
                            }
                        });
                    });
                }

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
            formData.append('id_recordario', this.newrecordatorio.id_user); 
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
        },



    }
};
</script>
<style lang='' scoped>

</style>