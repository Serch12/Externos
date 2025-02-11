<template>
    <div>
        <!-- vista de torneos -->
        <div id="main" v-if="this.vista == 0">
            <div class="row g-6">
                <div class="card">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <h5 class="card-header">Torneos</h5>
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <input type="search" id="email" class="form-control" v-model="search"
                                    placeholder="Buscar Torneos" @keyup="buscarJugador()" />
                                <button type="button" class="btn btn-outline-success waves-effect" @click="muestra(1)"
                                    v-if="include('Crear')">Agregar</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="table-responsive text-nowrap mt-2">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Copa</th>
                                        <th>Torneo</th>
                                        <th>Sede</th>
                                        <th>Categoria</th>
                                        <th>
                                            <center>Fechas</center>
                                        </th>
                                        <th>Estatus</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr v-for="(t, index) in Torneo" :key="index">
                                        <td>{{ index + 1 }} </td>
                                        <td><i :class="`ri-trophy-fill ri-30px text-${t.color_copa} me-1`"></i></td>
                                        <td>{{ t.torneo }}</td>
                                        <td>{{ t.sede }}</td>
                                        <td>{{ t.categoria }}</td>
                                        <td>
                                            <center>{{ t.fecha_inicia }} a {{ t.fecha_fin }}</center>
                                        </td>
                                        <td><span :class="`badge rounded-pill bg-label-${t.color} me-1`">{{ t.text
                                                }}</span>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="ri-more-2-line"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" type="button" style="color: orange;"
                                                        v-if="include('Vizualizar')" @click="muestra(3), infoTorneo(t)">
                                                        <i class="ri-clipboard-line me-1"></i> Vizualizar</a>
                                                    <a class="dropdown-item" type="button" style="color: #33b2ff;"
                                                        v-if="include('Editar') && t.estatus == 0" @click="muestra(2), infoTorneo(t)">
                                                        <i class="ri-pencil-line me-1"></i> Editar</a>
                                                    <a class="dropdown-item" type="button" style="color: red;"
                                                        v-if="include('Eliminar') && t.estatus == 0" @click="eliminarTorneo(t.id)">
                                                        <i class="ri-delete-bin-7-line me-1"></i> Eliminar</a>
                                                    <a class="dropdown-item" type="button" style="color: orangered;"
                                                         v-if="t.estatus == 0" @click="estatusTorneo(t)">
                                                        <i class="ri-verified-badge-fill me-1"></i> Revisión</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation example mt-3">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item disabled" v-if="pagination.current_page > 1">
                                        <a @click.prevent="changePage(pagination.current_page - 1)" class="page-link"
                                            href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                    </li>
                                    <li class="page-item" v-for="(page, index) in pageNumber" :key="index"
                                        @click.prevent="changePage(page)"
                                        v-bind:class="[page == isActived ? 'active' : 'waves-effect']">
                                        <a class="page-link" href="#">{{ page }}</a>
                                    </li>
                                    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                        <a @click.prevent="changePage(pagination.current_page + 1)" class="page-link"
                                            href="#">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- vista alta de torneos -->
        <div id="main" v-if="this.vista == 1">
            <div class="card mb-6">
                <h5 class="card-header" style="color: green;">Registro de Torneo</h5>
                <form class="card-body">
                    <h6>Datos del Torneo</h6>
                    <div class="row g-6">
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="Torneo" class="form-control" placeholder="Nombre del Torneo"
                                    v-model="newtorneo.torneo" />
                                <label for="Torneo">Torneo</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="sede" class="form-control" placeholder="sede"
                                        style="color: black;" aria-label="sede" v-model="newtorneo.sede" disabled />
                                    <label for="sede">Sede</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <select id="categoria" name="categoria" class="form-select"
                                    v-model="newtorneo.categoria">
                                    <option value="Selecciona una Categoria">Selecciona una Categoria</option>
                                    <option value="Categoria 2009">Categoria 2009</option>
                                    <option value="Categoria 2010">Categoria 2010</option>
                                    <option value="Categoria 2011">Categoria 2011</option>
                                    <option value="Categoria 2012">Categoria 2012</option>
                                </select>
                                <label for="categoria">Categoria</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <input type="email" id="direccion" class="form-control"
                                        placeholder="Ingresa una Direccion de google maps "
                                        aria-label="Ingresa una Direccion de google maps " v-model="newtorneo.direccion"
                                        aria-describedby="direccion2" />
                                    <label for="direccion">Dirección</label>
                                </div>
                                <span id="direccion2" class="input-group-text">https://maps.app.goo.gl/</span>
                            </div>
                        </div>
                        <h6>Rango de Fecha</h6>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="date" id="fecha_inicia" class="form-control"
                                    v-model="newtorneo.fecha_inicia" />
                                <label for="fecha_inicia">Fecha Inicia</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="date" id="fecha_fin" class="form-control" v-model="newtorneo.fecha_fin" />
                                <label for="fecha_fin">Fecha Fin</label>
                            </div>
                        </div>
                        <h6>Datos de Contacto</h6>
                        <div class="col-md-12">
                            <div class="form-floating form-floating-outline">
                                <div style="max-width: 800px; overflow: hidden;">
                                    <quill-editor v-model="newtorneo.contacto" style="height: 150px ;text-align: left;"
                                        ref="myQuillEditor" :options="editorOption" @blur="onEditorBlur($event)"
                                        @focus="onEditorFocus($event)" @change="onEditorChange($event)">
                                    </quill-editor>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="pt-6 mt-2">
                        <button type="button" class="btn btn-primary me-4" @click="createTorneo()">Guardar</button>
                        <button type="reset" class="btn btn-danger" @click="muestra(0)">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- vista editar de torneos -->
        <div id="main" v-if="this.vista == 2">
            <div class="card mb-6">
                <h5 class="card-header" style="color: green;">Edición de Torneo</h5>
                <form class="card-body">
                    <h6>Datos del Torneo</h6>
                    <div class="row g-6">
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="Torneo" class="form-control" placeholder="Nombre del Torneo"
                                    v-model="detalleTorneo.torneo" />
                                <label for="Torneo">Torneo</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="sede" class="form-control" placeholder="sede"
                                        style="color: black;" aria-label="sede" v-model="detalleTorneo.sede" disabled />
                                    <label for="sede">Sede</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <select id="categoria" name="categoria" class="form-select"
                                    v-model="detalleTorneo.categoria">
                                    <option value="Selecciona una Categoria">Selecciona una Categoria</option>
                                    <option value="Categoria 2009">Categoria 2009</option>
                                    <option value="Categoria 2010">Categoria 2010</option>
                                    <option value="Categoria 2011">Categoria 2011</option>
                                    <option value="Categoria 2012">Categoria 2012</option>
                                </select>
                                <label for="categoria">Categoria</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <input type="email" id="direccion" class="form-control"
                                        placeholder="Ingresa una Direccion de google maps "
                                        aria-label="Ingresa una Direccion de google maps "
                                        v-model="detalleTorneo.direccion" aria-describedby="direccion2" />
                                    <label for="direccion">Dirección</label>
                                </div>
                                <span id="direccion2" class="input-group-text">https://maps.app.goo.gl/</span>
                            </div>
                        </div>
                        <h6>Rango de Fecha</h6>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="date" id="fecha_inicia" class="form-control"
                                    v-model="detalleTorneo.fecha_inicia" />
                                <label for="fecha_inicia">Fecha Inicia</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="date" id="fecha_fin" class="form-control"
                                    v-model="detalleTorneo.fecha_fin" />
                                <label for="fecha_fin">Fecha Fin</label>
                            </div>
                        </div>
                        <h6>Datos de Contacto</h6>
                        <div class="col-md-12">
                            <div class="form-floating form-floating-outline">
                                <div style="max-width: 800px; overflow: hidden;">
                                    <quill-editor v-model="detalleTorneo.contacto"
                                        style="height: 150px ;text-align: left;" ref="myQuillEditor"
                                        :options="editorOption" @blur="onEditorBlur($event)"
                                        @focus="onEditorFocus($event)" @change="onEditorChange($event)">
                                    </quill-editor>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="pt-6 mt-2">
                        <button type="button" class="btn btn-primary me-4" @click="updateTorneo()">Editar</button>
                        <button type="reset" class="btn btn-danger" @click="muestra(0)">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- vista de vizualizacion -->
        <div id="main" v-if="this.vista == 3">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row ">
                    <!-- User Sidebar -->
                    <div class="col-xl-6 col-lg-5 col-md-5 order-1 order-md-0">
                        <!-- User Card -->
                        <div class="card mb-6">
                            <div class="card-body pt-12">
                                <div class="user-avatar-section">
                                    <div class="d-flex align-items-center flex-column">
                                        <img class="img-fluid rounded-3 mb-4" :src="`${this.detalleTorneo.img}`"
                                            height="120" width="120" alt="User avatar" style="width: 70px;" />
                                        <div class="user-info text-center">
                                            <span class="badge bg-label-dark rounded-pill">{{ this.detalleTorneo.torneo
                                                }}</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-5 col-md-5 order-1 order-md-0">
                        <!-- User Card -->
                        <div class="card mb-6">
                            <div class="card-body pt-12">

                                <div class="d-flex justify-content-around flex-wrap my-6 gap-0 gap-md-3 gap-lg-4">
                                    <div class="d-flex align-items-center me-5 gap-4">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-label-primary rounded-3">
                                                <i class="ri-football-line ri-24px"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="mb-0">Sede</h5>
                                            <span style="font-size: 14px;">{{ this.detalleTorneo.sede }}</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-4">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-label-primary rounded-3">
                                                <i class="ri-user-fill ri-24px"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="mb-0">Categoria</h5>
                                            <span style="font-size: 14px;">{{ this.detalleTorneo.categoria }}</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="d-flex justify-content-around flex-wrap my-6 gap-0 gap-md-3 gap-lg-4">
                                    <div class="d-flex align-items-center me-5 gap-4">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-label-primary rounded-3">
                                                <i class="ri-calendar-check-fill ri-24px"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="mb-0">Fecha Inicia</h5>
                                            <span style="font-size: 14px;">{{ this.detalleTorneo.fecha_inicia }}</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-4">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-label-primary rounded-3">
                                                <i class="ri-calendar-close-fill ri-24px"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="mb-0">Fecha Fin</h5>
                                            <span style="font-size: 14px;">{{ this.detalleTorneo.fecha_fin }}</span>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <!-- /User Card -->
                    </div>
                    <!--/ User Sidebar -->

                    <!-- User Content -->
                    <div class="col-xl-12 col-lg-7 col-md-7 order-0 order-md-1">
                        <!-- User Tabs -->
                        <div class="nav-align-top">
                            <ul class="nav nav-pills flex-column flex-md-row mb-6 row-gap-2">
                                <li class="nav-item">
                                    <a class="nav-link" :class="{ 'active': activeView === null }" type="button"
                                        @click="showCard(null)"><i class="ri-user-fill me-2"></i>Información</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" :class="{ 'active': activeView === 'plantilla' }" type="button"
                                        @click="showCard('plantilla')"><i class="ri-team-fill me-2"></i>Plantilla</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" :class="{ 'active': activeView === 'pago' }" type="button"
                                        @click="showCard('pago')"><i class="ri-todo-fill me-2"></i>Forma de Pago</a>
                                </li>
                            </ul>
                        </div>
                        <!--/ User Tabs -->

                        <!-- informacion -->
                        <div class="card mb-6" v-if="this.activeView == null">
                            <h5 class="card-header">Información del Torneo</h5>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-12 col-md-6 mt-2" style="color: green;">
                                        <i class="ri-trophy-fill me-2 ri-24px"></i><span class="fw-medium">Torneo:
                                            {{ this.detalleTorneo.torneo }}</span>
                                    </div>
                                    <div class="col-12 col-md-6 mt-2">
                                        <i class="ri-football-line me-2 ri-24px"></i><span class="fw-medium">Sede:
                                            {{ this.detalleTorneo.sede }}</span>
                                    </div>
                                    <div class="col-12 col-md-6 mt-2">
                                        <i class="ri-football-line me-2 ri-24px"></i><span class="fw-medium">{{
                                            this.detalleTorneo.categoria }}</span>
                                    </div>
                                    <div class="col-12 col-md-6 mt-2">
                                        <i class="ri-calendar-fill me-2 ri-24px"></i><span class="fw-medium">Fechas:
                                            {{ this.detalleTorneo.fecha_inicia }} a {{ this.detalleTorneo.fecha_fin
                                            }}</span>
                                    </div>
                                    <div class="col-12 col-md-6 mt-2">
                                        <i class="ri-map-pin-2-fill me-2 ri-24px"></i><span
                                            class="fw-medium">Dirección:</span> <a target="_blank"
                                            :href="`${this.detalleTorneo.direccion}`">{{ this.detalleTorneo.direccion
                                            }}</a>
                                    </div>
                                    <h6 class="mt-2">Datos de Contacto</h6>
                                    <div class="col-12 col-md-12 mt-2">
                                        <span class="fw-medium">
                                            <p v-html="this.detalleTorneo.contacto"></p>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="this.activeView == 'plantilla'">
                            <!-- Plantilla -->
                            <div class="card col-lg-12 me-5">
                                <h5 class="card-header">Plantilla</h5>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-md mb-12 mb-md-2">
                                                    <div class="accordion mt-4" id="accordionExample">
                                                        <div class="accordion-item active">
                                                            <h2 class="accordion-header" id="headingOne">
                                                                <button type="button" class="accordion-button"
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#accordionOne" aria-expanded="true"
                                                                    aria-controls="accordionOne">
                                                                    Jugadores
                                                                </button>
                                                            </h2>

                                                            <div id="accordionOne"
                                                                class="accordion-collapse collapse show"
                                                                data-bs-parent="#accordionExample">
                                                                <div class="accordion-body">
                                                                    <div class="table-responsive text-nowrap mt-2">
                                                                        <table class="table">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>
                                                                                        <input class="form-check-input"
                                                                                            type="checkbox"
                                                                                            v-model="value"
                                                                                            @change="TodoJugador()">
                                                                                    </th>
                                                                                    <th>Foto</th>
                                                                                    <th>Nombre</th>
                                                                                    <th>Posición</th>
                                                                                    <th>Sexo</th>
                                                                                    <th>Edad</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody class="table-border-bottom-0">
                                                                                <tr v-for="(t, index) in this.PlantillaJugador"
                                                                                    :key="index"  style="overflow: scroll;">
                                                                                    <td>
                                                                                        <input class="form-check-input"
                                                                                            type="checkbox"
                                                                                            :id="`check2${index}`"
                                                                                            v-model="seleccionJugador[t.folio]"
                                                                                            @change="activaJugador(index, t.folio, t.nombre, t.posicion, t.sexo, t.edad, t.categoria, t.sede)">
                                                                                    </td>
                                                                                    <td>
                                                                                        <div
                                                                                            class="d-flex justify-content-start align-items-center">
                                                                                            <div class="avatar-wrapper">
                                                                                                <div
                                                                                                    class="avatar me-2">
                                                                                                    <img :src="`ArchivosSistema/Jugadores/${t.id_jugador}/${t.foto}`"
                                                                                                        alt="Avatar"
                                                                                                        class="rounded-circle">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>{{ t.nombre }}</td>
                                                                                    <td>{{ t.posicion }}</td>
                                                                                    <td>{{ t.sexo }}</td>
                                                                                    <td>{{ t.edad }}</td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        <infinite-loading force-use-infinite-wrapper=".infinite-wrapper" @infinite="consultaJugador">
                                                                            <div slot="no-more">
                                                                                <div class="chip green z-depth-4 white-text">
                                                                                    <strong>No existen mas datos para cargar.</strong>
                                                                                </div>
                                                                            </div>
                                                                            <div slot="spinner">
                                                                                <div class="chip yellow z-depth-4 white-text">
                                                                                    <strong>Cargando...</strong>
                                                                                </div>
                                                                            </div>
                                                                            <div slot="no-results">
                                                                                <div class="chip red z-depth-4 white-text">
                                                                                    <strong>Sin resultados</strong>
                                                                                </div>
                                                                            </div>
                                                                        </infinite-loading>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="headingTwo">
                                                                <button type="button" class="accordion-button"
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#accordionTwo" aria-expanded="true"
                                                                    aria-controls="accordionTwo">
                                                                    Jugadores Prestamo
                                                                </button>
                                                            </h2>
                                                            <div id="accordionTwo" class="accordion-collapse collapse show"
                                                                aria-labelledby="headingTwo"
                                                                data-bs-parent="#accordionExample">
                                                                <div class="accordion-body">
                                                                    <div class="table-responsive text-nowrap mt-2">
                                                                        <table class="table">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th></th>
                                                                                    <th>Foto</th>
                                                                                    <th>Nombre</th>
                                                                                    <th>Posición</th>
                                                                                    <th>Sexo</th>
                                                                                    <th>Edad</th>
                                                                                    <th>Sede</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody class="table-border-bottom-0">
                                                                                <tr v-for="(t, index) in this.PlantillaPrestamo"
                                                                                    :key="index">
                                                                                    <td>
                                                                                        <input class="form-check-input"
                                                                                            type="checkbox" value=""
                                                                                            :id="`checkpres${index}`"
                                                                                            v-model="seleccionPrestamo[t.folio]"
                                                                                            @change="activaPrestamo(index, t.folio, t.nombre, t.posicion, t.sexo, t.edad, t.categoria, t.sede)">
                                                                                    </td>
                                                                                    <td>
                                                                                        <div
                                                                                            class="d-flex justify-content-start align-items-center">
                                                                                            <div class="avatar-wrapper">
                                                                                                <div class="avatar me-2">
                                                                                                    <img :src="`ArchivosSistema/Jugadores/${t.id_jugador}/${t.foto}`"
                                                                                                        alt="Avatar"
                                                                                                        class="rounded-circle">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>{{ t.nombre }}</td>
                                                                                    <td>{{ t.posicion }}</td>
                                                                                    <td>{{ t.sexo }}</td>
                                                                                    <td>{{ t.edad }}</td>
                                                                                    <td>{{ t.sede }}</td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        <infinite-loading force-use-infinite-wrapper=".infinite-wrapper" @infinite="consultaPrestamo">
                                                                            <div slot="no-more">
                                                                                <div class="chip green z-depth-4 white-text">
                                                                                    <strong>No existen mas datos para cargar.</strong>
                                                                                </div>
                                                                            </div>
                                                                            <div slot="spinner">
                                                                                <div class="chip yellow z-depth-4 white-text">
                                                                                    <strong>Cargando...</strong>
                                                                                </div>
                                                                            </div>
                                                                            <div slot="no-results">
                                                                                <div class="chip red z-depth-4 white-text">
                                                                                    <strong>Sin resultados</strong>
                                                                                </div>
                                                                            </div>
                                                                        </infinite-loading>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                            
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-lg-6">
                                            <h5>Jugadores Seleccionados</h5>
                                            <div class="table-responsive text-nowrap mt-2">
                                                <table class="table" style="font-size: 12px;">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <!-- <th>Folio</th> -->
                                                            <th>Nombre</th>
                                                            <th>Posición</th>
                                                            <th>Sexo</th>
                                                            <th>Edad</th>
                                                            <th>Sede</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-border-bottom-0">
                                                        <tr v-for="(t, index) in this.JugadorSeleccionado" :key="index">
                                                            <td>
                                                                {{ index + 1 }}
                                                            </td>
                                                            <!-- <td>{{ t.folio }}</td> -->
                                                            <td>{{ t.nombre }}</td>
                                                            <td>{{ t.posicion }}</td>
                                                            <td>{{ t.sexo }}</td>
                                                            <td>{{ t.edad }}</td>
                                                            <td>{{ t.sede }}</td>
                                                            <td>
                                                                <button type="button"
                                                                    class="btn btn-icon btn-outline-danger waves-effect"
                                                                    @click="deleteSelect(t.id_plantilla)">
                                                                    <i class="tf-icons ri-delete-bin-fill ri-22px"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- Info pago -->
                        <div class="card mb-6" v-if="this.activeView == 'pago' && this.DatosBancarios.length == 0">
                            <h5 class="card-header">Forma de Pago</h5>
                            <div class="card-body">
                                <form id="addNewAddressForm" class="row g-5">
                                    <div class="col-12 col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input
                                                type="text"
                                                id="nameupdate"
                                                class="form-control"
                                                v-model="newDatosbancarios.nombre"
                                                placeholder="Nombre"/>
                                            <label for="nameupdate">Nombre</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <select id="banco" name="roles" class="form-select" v-model="newDatosbancarios.banco">
                                                <option value="Seleccionar Banco">Seleccionar Banco</option>
                                                <option value="BBVA BANCOMER">BBVA BANCOMER</option>
                                                <option value="BANORTE">BANORTE</option>
                                                <option value="CITI BANAMEX">CITI BANAMEX</option>
                                                <option value="SANTANDER">SANTANDER</option>
                                                <option value="HSBC">HSBC</option>
                                                <option value="INBURSA">INBURSA</option>
                                                <option value="MIFEL">MIFEL</option>
                                                <option value="SCOTIABANK">SCOTIABANK</option>
                                                <option value="AMERICAN EXPRESS">AMERICAN EXPRESS</option>
                                                <option value="BANCO AZTECA">BANCO AZTECA</option>
                                                <option value="BANCOPPEL">BANCOPPEL</option>
                                                <option value="AFIRME">AFIRME</option>
                                            </select>
                                            <label for="banco">Banco</label>
                                        </div>
                                    </div>
                                   
                                    <div class="col-12 col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input
                                                type="text"
                                                id="cuentabancaria"
                                                class="form-control"
                                                v-model="newDatosbancarios.cuenta_bancaria"
                                                placeholder="Cuenta Bancaria"/>
                                            <label for="cuentabancaria">Cuenta Bancaria</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input
                                                type="text"
                                                id="clabebancaria"
                                                class="form-control"
                                                v-model="newDatosbancarios.clabe_bancaria"
                                                placeholder="Clabe Bancaria"/>
                                            <label for="clabebancaria">Clabe Bancaria</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input
                                                type="text"
                                                id="numerotarjeta"
                                                class="form-control"
                                                v-model="newDatosbancarios.numero_tarjeta"
                                                placeholder="Numero de tarjeta"/>
                                            <label for="numerotarjeta"> Numero de tarjeta</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-floating form-floating-outline mb-6">
                                            <input type="file"  accept="image/png,image/jpeg,.pdf" class="form-control" id="bs-validation-upload-file" ref="fileInscripcion" @change="onChangeIncripcion()">
                                            <label for="bs-validation-upload-file">Formato de Inscripción</label>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-6 d-flex flex-wrap justify-content-center gap-4 row-gap-4">
                                        <button type="button" class="btn btn-primary" @click="createPago()">Guardar</button>
                                        <!-- <button type="reset" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close">Cancelar</button> -->
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card mb-6" v-if="this.activeView == 'pago' && this.DatosBancarios.length != 0">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <h5 class="card-header">Forma de Pago</h5>
                                </div>
                                <div class="col-12 col-md-6 mt-3" >
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end" style="padding: var(--bs-card-cap-padding-y) var(--bs-card-cap-padding-x);">
                                        <button type="button" class="btn btn-outline-info waves-effect" @click="modoUpdate()" v-if="this.activacion ==  true">Editar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form id="addNewAddressForm" class="row g-5">
                                    <div class="col-12 col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input
                                                type="text"
                                                id="nameupdate"
                                                class="form-control"
                                                v-model="DatosBancarios[0].nombre"
                                                placeholder="Nombre" :disabled="activacion" style="color: black;"/>
                                            <label for="nameupdate">Nombre</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <select id="banco" name="roles" class="form-select" v-model="DatosBancarios[0].banco" :disabled="activacion" style="color: black;">
                                                <option value="Seleccionar Banco">Seleccionar Banco</option>
                                                <option value="BBVA BANCOMER">BBVA BANCOMER</option>
                                                <option value="BANORTE">BANORTE</option>
                                                <option value="CITI BANAMEX">CITI BANAMEX</option>
                                                <option value="SANTANDER">SANTANDER</option>
                                                <option value="HSBC">HSBC</option>
                                                <option value="INBURSA">INBURSA</option>
                                                <option value="MIFEL">MIFEL</option>
                                                <option value="SCOTIABANK">SCOTIABANK</option>
                                                <option value="AMERICAN EXPRESS">AMERICAN EXPRESS</option>
                                                <option value="BANCO AZTECA">BANCO AZTECA</option>
                                                <option value="BANCOPPEL">BANCOPPEL</option>
                                                <option value="AFIRME">AFIRME</option>
                                            </select>
                                            <label for="banco">Banco</label>
                                        </div>
                                    </div>
                                   
                                    <div class="col-12 col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input
                                                type="number"
                                                id="cuentabancaria"
                                                class="form-control"
                                                v-model="DatosBancarios[0].cuenta_bancaria"
                                                placeholder="Cuenta Bancaria" :disabled="activacion" style="color: black;"/>
                                            <label for="cuentabancaria">Cuenta Bancaria</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input
                                                type="number"
                                                id="clabebancaria"
                                                class="form-control"
                                                v-model="DatosBancarios[0].clabe_bancaria"
                                                placeholder="Clabe Bancaria" :disabled="activacion" style="color: black;"/>
                                            <label for="clabebancaria">Clabe Bancaria</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <input
                                                type="number"
                                                id="numerotarjeta"
                                                class="form-control"
                                                v-model="DatosBancarios[0].numero_tarjeta"
                                                placeholder="Numero de tarjeta" :disabled="activacion" style="color: black;"/>
                                            <label for="numerotarjeta"> Numero de tarjeta</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6" v-if="this.activacion">
                                        <p>Formato de Inscripción: 
                                            <a type="button" class="btn btn-warning" :href="`ArchivosSistema/DatoBancario/${this.DatosBancarios[0].id_datos_bancarios}/${this.DatosBancarios[0].archivo}`" 
                                            target="_blank" onclick="window.open(this.href, this.target, 'width=650,height=650'); return false;">
                                                <i class="ri-file-pdf-2-fill ri-2test0px me-2"></i>
                                            </a>
                                        </p>
                                    </div>
                                    <div class="col-12 col-md-6"v-else>
                                        <div class="form-floating form-floating-outline mb-6">
                                            <input type="file"  accept="image/png,image/jpeg,.pdf" class="form-control" id="bs-validation-upload-file" ref="fileInscripcionUpdate" @change="onChangeIncripcionUpdate()">
                                            <label for="bs-validation-upload-file">Formato de Inscripción</label>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-6 d-flex flex-wrap justify-content-center gap-4 row-gap-4"  v-if="this.activacion ==  false">
                                        <button type="button" class="btn btn-primary" @click="updatePago()">Editar</button>
                                        <button type="reset" class="btn btn-outline-danger" @click="modoUpdate()">Cancelar</button>
                                    </div>

                                   
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-lg-5 col-md-5">
                    <div class="card mb-6">
                        <div class="card-body">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="javascript:void(0)" class="btn btn-danger" @click="muestra(0)">
                                    <i class="ri-arrow-left-long-fill ri-16px me-2"></i>Regresar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal Body -->
        <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
            role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Nuevos Archivos
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="" class="form-label">Documentación</label>
                            <input type="file" class="form-control" name="" id="" aria-describedby="fileArch"
                                multiple />
                            <div id="fileArch" class="form-text tex-red">Solo Archivos PDF</div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Tipo Archivo</label>
                            <select class="form-select form-select-lg" name="" id="">
                                <option value="Selecciona una Opción">Selecciona una Opción</option>
                                <option value="">New Delhi</option>
                                <option value="">Istanbul</option>
                                <option value="">Jakarta</option>
                            </select>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>




        <br><br><br>
    </div>
</template>
<script>
import axios from 'axios';
import 'quill/dist/quill.core.css'
import 'quill/dist/quill.snow.css'
import 'quill/dist/quill.bubble.css'
import { quillEditor } from 'vue-quill-editor';
import InfiniteLoading from 'vue-infinite-loading';
export default {
    name: '',
    components: {
        quillEditor,
        InfiniteLoading
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
            vista: 0,
            search: '',
            value: '',
            Torneo: [],
            newtorneo: {
                torneo: '',
                sede: this.sede,
                categoria: 'Selecciona una Categoria',
                direccion: '',
                fecha_inicia: '',
                fecha_fin: '',
                contacto: ''
            },
            newDatosbancarios:{
                nombre:'',
                banco:'Seleccionar Banco',
                cuenta_bancaria:'',
                clabe_bancaria:'',
                numero_tarjeta:'',
                tipo_tarjeta:'',
                archivo:''
            },
            activeView: null,
            editorOption: {},
            detalleTorneo: [],
            DocumentacionTorneo: [],
            DataJugador:[],
            PlantillaJugador: [],
            seleccionJugador: {},
            DataPrestamo:[],
            PlantillaPrestamo: [],
            seleccionPrestamo: {},
            JugadorSeleccionado: [],
            cargaSeleccionado: [],
            DatosBancarios:[],
            pagination: {
                'total': 0,
                'current_page': 0,
                'per_page': 0,
                'last_page': 0,
                'from': 0,
                'to': 0
            },
            cargando: false,
            noMasDatos: false,
            cargando2: false,
            noMasDatos2: false,
            busy:false,
            activacion:true,
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
        },
    },
    watch: {

    },
    mounted() {
        this.getTorneo();
    },
    methods: {
        getTorneo(page) {
            if (this.search == '') {

                var url = `torneo/getTorneo?rol=${this.rol_usuario}&sede=${this.sede}&page=` + page;
                axios.get(url).then(response => {

                    this.Torneo = response.data.muestra.data,
                        this.pagination = response.data.pagination
                });
            } else {
                this.search
                var url = `torneo/getTorneo?rol=${this.rol_usuario}&sede=${this.sede}&buscador=${this.search}&page=` + page;
                axios.get(url).then(response => {
                    this.Torneo = response.data.muestra.data
                    this.pagination = response.data.pagination
                });
            }
        },
        muestra(valor) {
            this.vista = valor;
        },
        include(permiso) {
            return this.permisos.includes(permiso);
        },
        changePage: function (page) {
            this.pagination.current_page = page;
            this.getTorneo(page);
        },
        showCard(view) {
            this.activeView = view;
        },
        createTorneo() {
            if (this.newtorneo.torneo == '') {
                this.$toast.error("Ingresa el nombre del Torneo", {
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
            if (this.newtorneo.categoria == 'Selecciona una Categoria') {
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
            if (this.newtorneo.direccion == '') {
                this.$toast.error("Ingresa la Dirección", {
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
            if (this.newtorneo.fecha_inicia == '') {
                this.$toast.error("Ingresa la Fecha de Inicio", {
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
            if (this.newtorneo.fecha_fin == '') {
                this.$toast.error("Ingresa la Fecha de Fin", {
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
            if (this.newtorneo.contacto == '') {
                this.$toast.error("Ingresa los Datos de Contacto", {
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
            formData.append('creacion', this.id_usuario_logeado);
            formData.append('torneo', this.newtorneo.torneo);
            formData.append('sede', this.newtorneo.sede);
            formData.append('categoria', this.newtorneo.categoria);
            formData.append('direccion', this.newtorneo.direccion);
            formData.append('fecha_inicia', this.newtorneo.fecha_inicia);
            formData.append('fecha_fin', this.newtorneo.fecha_fin);
            formData.append('contacto', this.newtorneo.contacto);
            axios.post('torneo/createTorneo', formData).then(response => {
                this.getTorneo();
                this.newtorneo = {
                    torneo: '',
                    sede: this.sede,
                    categoria: 'Selecciona una Categoria',
                    direccion: '',
                    fecha_inicia: '',
                    fecha_fin: '',
                    contacto: ''
                }
                this.vista = 0;
                Swal.fire({
                    title: 'Exitoso',
                    text: "Se Registro correctamente!",
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2500,
                });
            })
        },
        infoTorneo(t) {
            this.detalleTorneo = t;
            // axios.get(`torneo/plantillaJugador?sede=${this.detalleTorneo.sede}&categoria=${this.detalleTorneo.categoria}`).then(response => {
            //     this.PlantillaJugador = response.data.plantilla;
            //     this.PlantillaPrestamo = response.data.prestamo;
            // })
            // this.consultaJugador($state);
            axios.get(`torneo/detalleSeleccionado/${this.detalleTorneo.id_torneo}`).then(response => {
                this.JugadorSeleccionado = response.data
                
                this.JugadorSeleccionado.map(jugador => {
                    this.PlantillaJugador.map(j => {
                        if (j.folio === jugador.folio) {
                            this.seleccionJugador[j.folio] = true;
                        }
                    });
                    this.PlantillaPrestamo.map(p => {
                        if (p.folio === jugador.folio) {
                            this.seleccionPrestamo[p.folio] = true;
                        }
                    });

                });
            })
            axios.get(`torneo/InfoExterna/${this.detalleTorneo.id_torneo}`).then(response =>{
                this.DatosBancarios = response.data.bancarios;
            })




        },
        updateTorneo() {
            if (this.detalleTorneo.torneo == '') {
                this.$toast.error("Ingresa el nombre del Torneo", {
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
            if (this.detalleTorneo.categoria == 'Selecciona una Categoria') {
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
            if (this.detalleTorneo.direccion == '') {
                this.$toast.error("Ingresa la Dirección", {
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
            if (this.detalleTorneo.fecha_inicia == '') {
                this.$toast.error("Ingresa la Fecha de Inicio", {
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
            if (this.detalleTorneo.fecha_fin == '') {
                this.$toast.error("Ingresa la Fecha de Fin", {
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
            if (this.detalleTorneo.contacto == '') {
                this.$toast.error("Ingresa los Datos de Contacto", {
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
            formData.append('id_torneo', this.detalleTorneo.id_torneo);
            formData.append('torneo', this.detalleTorneo.torneo);
            formData.append('sede', this.detalleTorneo.sede);
            formData.append('categoria', this.detalleTorneo.categoria);
            formData.append('direccion', this.detalleTorneo.direccion);
            formData.append('fecha_inicia', this.detalleTorneo.fecha_inicia);
            formData.append('fecha_fin', this.detalleTorneo.fecha_fin);
            formData.append('contacto', this.detalleTorneo.contacto);
            axios.post('torneo/updateTorneo', formData).then(response => {
                this.getTorneo();
                this.vista = 0;
                Swal.fire({
                    title: 'Exitoso',
                    text: "Se Edito correctamente!",
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2500,
                });
            })
        },



        TodoJugador() {
            this.cargaSeleccionado = [];

            if (this.value == true) {
                for (let index = 0; index < this.PlantillaJugador.length; index++) {
                    $(`#check2${index}`).prop('checked', true);
                    this.cargaSeleccionado.push({
                        folio: this.PlantillaJugador[index].folio,
                        nombre: this.PlantillaJugador[index].nombre,
                        posicion: this.PlantillaJugador[index].posicion,
                        sexo: this.PlantillaJugador[index].sexo,
                        edad: this.PlantillaJugador[index].edad,
                        categoria: this.PlantillaJugador[index].categoria,
                        sede: this.PlantillaJugador[index].sede,
                    });


                }
                let formData = new FormData();
                formData.append('bandera', 'multiple');
                formData.append('id_torneo', this.detalleTorneo.id_torneo);
                formData.append('selecccion', JSON.stringify(this.cargaSeleccionado));
                axios.post('torneo/seleccionadosJugador', formData).then(response => {
                    axios.get(`torneo/detalleSeleccionado/${this.detalleTorneo.id_torneo}`).then(response => {
                        this.JugadorSeleccionado = response.data
                    })
                })
            }

            if (this.value == false) {
                for (let index = 0; index < this.PlantillaJugador.length; index++) {
                    $(`#check2${index}`).prop('checked', false);
                }
                this.cargaSeleccionado = [];
            }
        },
        activaJugador(index, folio, nombre, posicion, sexo, edad, categoria, sede) {
            var num = $(`#check2${index}`).prop('checked');

            if (num == true) {
                var nuevoJugador = {
                    folio: folio,
                    nombre: nombre,
                    posicion: posicion,
                    sexo: sexo,
                    edad: edad,
                    categoria: categoria,
                    sede: sede,
                };
                let formData = new FormData();
                formData.append('bandera', 'individual');
                formData.append('id_torneo', this.detalleTorneo.id_torneo);
                formData.append('selecccion', JSON.stringify(nuevoJugador));
                axios.post('torneo/seleccionadosJugador', formData).then(response => {
                    axios.get(`torneo/detalleSeleccionado/${this.detalleTorneo.id_torneo}`).then(response => {
                        this.JugadorSeleccionado = response.data
                    })
                })
            }
            if (num == false) {
                this.JugadorSeleccionado.forEach(function (p, index, object) {
                    if (p.folio === folio) {
                        let formData = new FormData();
                        formData.append('bandera', 'unico');
                        formData.append('id_plantilla', p.id_plantilla);
                        axios.post('torneo/deleteJugador', formData).then(response => {
                            object.splice(index, 1);
                        })
                    }
                });
            }
        },
        activaPrestamo(index, folio, nombre, posicion, sexo, edad, categoria, sede) {
            var num = $(`#checkpres${index}`).prop('checked');

            if (num == true) {
                var jugadorPrestamo = {
                    folio: folio,
                    nombre: nombre,
                    posicion: posicion,
                    sexo: sexo,
                    edad: edad,
                    categoria: categoria,
                    sede: sede,
                };
                let formData = new FormData();
                formData.append('bandera', 'individual');
                formData.append('id_torneo', this.detalleTorneo.id_torneo);
                formData.append('selecccion', JSON.stringify(jugadorPrestamo));
                axios.post('torneo/seleccionadosJugador', formData).then(response => {
                    axios.get(`torneo/detalleSeleccionado/${this.detalleTorneo.id_torneo}`).then(response => {
                        this.JugadorSeleccionado = response.data
                    })
                })
            }
            if (num == false) {
                this.JugadorSeleccionado.forEach(function (p, index, object) {
                    if (p.folio === folio) {
                        let formData = new FormData();
                        formData.append('bandera', 'unico');
                        formData.append('id_plantilla', p.id_plantilla);
                        axios.post('torneo/deleteJugador', formData).then(response => {
                            object.splice(index, 1);
                        })
                    }
                });
            }
        },
        deleteSelect(value) {
            this.id_plantilla = value;
            Swal.fire({
                title: "Estas seguro?",
                text: "Se eliminara definitivamente!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Eliminar",
                cancelButtonColor: "#d33",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    let formData = new FormData();
                    formData.append('bandera', 'unico');
                    formData.append('id_plantilla', this.id_plantilla);
                    axios.post('torneo/deleteJugador', formData).then(response => {
                        axios.get(`torneo/detalleSeleccionado/${this.detalleTorneo.id_torneo}`).then(response => {
                            this.JugadorSeleccionado = response.data
                        })
                        Swal.fire({
                            title: 'Exitoso',
                            text: "Se Elimino correctamente!",
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2500,
                        });
                    })

                }
            });
        },
        consultaJugador($state) {
            if (this.cargando || this.noMasDatos) {
                $state.complete(); 
                return;
            }

            this.cargando = true; 
            var doctor = 0;
            if (this.page === 1) this.PlantillaJugador = [];
            
            this.page++;

            var url = `torneo/plantillaJugador?sede=${this.detalleTorneo.sede}&categoria=${this.detalleTorneo.categoria}&doctor=${doctor}&page=${this.page}`;
            
            axios.get(url).then(response => {
                let posts = response.data.plantilla;
                if (posts.length) {
                    let nuevosDatos = posts.filter(nuevo => 
                        !this.PlantillaJugador.some(existente => existente.id === nuevo.id)
                    );
                    this.PlantillaJugador = this.PlantillaJugador.concat(nuevosDatos);
                    $state.loaded();
                } else {
                    $state.complete();
                }
                this.JugadorSeleccionado.map(jugador => {
                this.PlantillaJugador.map(j => {
                    if (j.folio === jugador.folio) {
                        this.seleccionJugador[j.folio] = true;
                    }
                });
                this.PlantillaPrestamo.map(p => {
                    if (p.folio === jugador.folio) {
                        this.seleccionPrestamo[p.folio] = true;
                    }
                });

            });
            }).catch(error => {
                console.error("Error al cargar los datos:", error);
                $state.complete();
            });

            
        },
        consultaPrestamo($state){
            if (this.cargando2 || this.noMasDatos2) {
                $state.complete(); 
                return;
            }

            this.cargando2 = true; 
            var doctor2 = 0;
            if (this.page1 === 1) this.PlantillaPrestamo = [];
            
            this.page1++;

            var url = `torneo/plantillaJugador?sede=${this.detalleTorneo.sede}&categoria=${this.detalleTorneo.categoria}&doctor2=${doctor2}&page1=${this.page1}`;
            
            axios.get(url).then(response => {
                let posts = response.data.prestamo;
                if (posts.length) {
                    let nuevosDatos = posts.filter(nuevo => 
                        !this.PlantillaPrestamo.some(existente => existente.id === nuevo.id)
                    );
                    this.PlantillaPrestamo = this.PlantillaPrestamo.concat(nuevosDatos);
                    $state.loaded();
                } else {
                    $state.complete();
                }

                this.JugadorSeleccionado.map(jugador => {
                this.PlantillaJugador.map(j => {
                        if (j.folio === jugador.folio) {
                            this.seleccionJugador[j.folio] = true;
                        }
                    });
                    this.PlantillaPrestamo.map(p => {
                        if (p.folio === jugador.folio) {
                            this.seleccionPrestamo[p.folio] = true;
                        }
                    });

                });
            }).catch(error => {
                console.error("Error al cargar los datos:", error);
                $state.complete();
            });
        },
        onChangeIncripcion(){
            var fileedit = this.$refs.fileInscripcion.files[0];
            this.newDatosbancarios.archivo = fileedit
        },
        onChangeIncripcionUpdate(){
            var fileedit = this.$refs.fileInscripcionUpdate.files[0];
            this.DatosBancarios[0].archivo = fileedit
        },
        createPago(){
            if (this.newDatosbancarios.nombre == '') {
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
            if (this.newDatosbancarios.banco == '') {
                this.$toast.error("Selecciona un Banco", {
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
            if (this.newDatosbancarios.cuenta_bancaria == '') {
                this.$toast.error("Ingresa una Cuenta Bancaria", {
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
            if (this.newDatosbancarios.clabe_bancaria == '') {
                this.$toast.error("Ingresa una Clabe Bancaria", {
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
            if (this.newDatosbancarios.archivo == '') {
                this.$toast.error("Ingresa Formato de Inscripción", {
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
                formData.append('id_torneo',this.detalleTorneo.id_torneo);
                formData.append('nombre',this.newDatosbancarios.nombre);
                formData.append('banco',this.newDatosbancarios.banco);
                formData.append('cuenta_bancaria',this.newDatosbancarios.cuenta_bancaria);
                formData.append('clabe_bancaria',this.newDatosbancarios.clabe_bancaria);
                formData.append('numero_tarjeta',this.newDatosbancarios.numero_tarjeta);
                formData.append('tipo_tarjeta',this.newDatosbancarios.tipo_tarjeta);
                formData.append('archivo',this.newDatosbancarios.archivo);
            axios.post('torneo/createDatoBancario',formData).then(response =>{
                axios.get(`torneo/InfoExterna/${this.detalleTorneo.id_torneo}`).then(response =>{
                    this.DatosBancarios = response.data.bancarios;
                })
                this.newDatosbancarios = {
                    nombre:'',
                    banco:'Seleccionar Banco',
                    cuenta_bancaria:'',
                    clabe_bancaria:'',
                    numero_tarjeta:'',
                    tipo_tarjeta:'',
                    archivo:''
                }
                Swal.fire({
                    title: 'Exitoso',
                    text: "Se Agrego correctamente!",
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2500,
                });
            })
        },
        modoUpdate(){
            if (this.activacion == true) {
                
                this.activacion = false;
            }else{
              
                this.activacion = true;
            }
        },
        updatePago(){
            if (this.DatosBancarios[0].nombre == '') {
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
            if (this.DatosBancarios[0].banco == '') {
                this.$toast.error("Selecciona un Banco", {
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
            if (this.DatosBancarios[0].cuenta_bancaria == '') {
                this.$toast.error("Ingresa una Cuenta Bancaria", {
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
            if (this.DatosBancarios[0].clabe_bancaria == '') {
                this.$toast.error("Ingresa una Clabe Bancaria", {
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
            if (this.DatosBancarios[0].archivo == '') {
                this.$toast.error("Ingresa Formato de Inscripción", {
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
                formData.append('id_datos_bancarios',this.DatosBancarios[0].id_datos_bancarios);
                formData.append('nombre',this.DatosBancarios[0].nombre);
                formData.append('banco',this.DatosBancarios[0].banco);
                formData.append('cuenta_bancaria',this.DatosBancarios[0].cuenta_bancaria);
                formData.append('clabe_bancaria',this.DatosBancarios[0].clabe_bancaria);
                formData.append('numero_tarjeta',this.DatosBancarios[0].numero_tarjeta);
                formData.append('tipo_tarjeta',this.DatosBancarios[0].tipo_tarjeta);
                formData.append('archivo',this.DatosBancarios[0].archivo);
            axios.post('torneo/updateDatoBancario',formData).then(response =>{
                axios.get(`torneo/InfoExterna/${this.detalleTorneo.id_torneo}`).then(response =>{
                    this.DatosBancarios = response.data.bancarios;
                })
                this.activacion = true;
                
                Swal.fire({
                    title: 'Exitoso',
                    text: "Se Edito correctamente!",
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2500,
                });
            })
        },
        estatusTorneo(t){
            this.id_torneo = t.id_torneo;

            if (t.estatus == 0) {
                Swal.fire({
                    title: "Estas seguro?",
                    text: "Se mandara a Revisón!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Aceptar",
                    cancelButtonColor: "#d33",
                    cancelButtonText: "Cancelar",
                }).then((result) => {
                    if (result.isConfirmed) {
                        let formData = new FormData();
                        formData.append('id_torneo', this.id_torneo);
                        formData.append('bandera', 'revision');
                        axios.post('torneo/estatusTorneo', formData).then(response => {
                          this.getTorneo();
                            Swal.fire({
                                title: 'Exitoso',
                                text: "Se Cambio el estatus correctamente!",
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 2500,
                            });
                        })

                    }
                });
            }
        },

  
        onEditorReady(editor) { }, // prepara el editor
        onEditorBlur() { }, // Evento de pérdida de foco
        onEditorFocus() { }, // Obtiene el evento de enfoque
        onEditorChange() { }, // evento de cambio de contenido

    }
};
</script>
<style scoped>
.infinite-wrapper {
    height: 500px; /* Ajusta según necesidad */
    overflow: auto;
    border: 1px solid #ccc; /* Opcional: solo para visualizar */
}
</style>