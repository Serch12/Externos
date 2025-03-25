<template>
    <div>
        <div id="main" v-if="this.vista == 0">
            <div class="col-md-12">
                <div class="card mb-6">
                <div class="card-header p-0">
                    <div class="nav-align-top">
                        <ul class="nav nav-tabs nav-fill" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button type="button" class="nav-link waves-effect active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-home" aria-controls="navs-justified-home" aria-selected="true">
                                    <span class="d-none d-sm-block"><i class="tf-icons ri-football-line me-2"></i> Talentos AMFpro </span><i class="ri-football-line ri-20px d-sm-none"></i></button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button type="button" class="nav-link waves-effect" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-profile" aria-controls="navs-justified-profile" aria-selected="false" tabindex="-1">
                                    <span class="d-none d-sm-block"><i class="tf-icons ri-git-repository-line me-2"></i> Banners Talentos</span><i class="ri-git-repository-line ri-20px d-sm-none"></i></button>
                            </li>
                            <span class="tab-slider" style="left: 0px; width: 165.135px; bottom: 0px;"></span>
                        </ul>
                    </div>
                </div>
                <div class="card-body pt-5">
                    <div class="tab-content p-0">
                        <div class="tab-pane fade active show" id="navs-justified-home" role="tabpanel">
                            <div class="row g-6 mt-2">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <h5 class="card-header">Talentos AMFpro</h5>
                                    </div>
                                    <div class="col-12 col-md-6 mt-3">
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <input type="search" id="email" class="form-control" v-model="search"
                                                placeholder="Buscar Talentos AMFpro" @keyup="buscarTalentos()" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12" v-if="this.Talentos.length == 0">
                                    <center>
                                        <h5 class="card-header text-success">Sin Información</h5>
                                        <img src="style/logos/img_no hay datos.png" alt="img_sindato" style="width: 200px;">
                                    </center>
                                </div>
                                <div class="row" v-else>
                                    <div class="table-responsive text-nowrap mt-2">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Banner</th>
                                                    <th>Fecha</th>
                                                    <th>Año</th>
                                                    <th>Copa</th>
                                                    <th>Fase</th>
                                                    <th>Categoria</th>
                                                    <th>Estatus</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                <tr v-for="(t, index) in Talentos" :key="index">
                                                    <td>{{ index+1 }}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-start align-items-center" >
                                                            <div class="avatar-wrapper">
                                                                <div class="avatar me-2" >
                                                                    <img :src="`https://test-intranet.amfpro.mx/ArchivosSistema/GaleriaTalentos/${t.hidder}`" v-if="t.exit_hidder == false">
                                                                    <img :src="`ArchivosSistema/Talentos/${t.hidder}`" v-else>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><center>{{ t.fecha }}</center></td>
                                                    <td>{{ t.year }}</td>
                                                    <td>{{ t.copa }}</td>
                                                    <td>{{ t.fase }}</td>
                                                    <td>{{ t.categoria }}</td>
                                                    <td>
                                                        <center>
                                                            <button class="btn btn-outline-primary btn-icon waves-effect" v-if="t.estatus == 0" @click="activacionEstatus(t.id_talento,t.estatus)">
                                                                <i class="ri-checkbox-circle-fill ri-22px"></i>
                                                            </button>
                                                            <button class="btn btn-outline-danger btn-icon waves-effect" v-else @click="activacionEstatus(t.id_talento,t.estatus)">
                                                                <i class="ri-close-circle-fill ri-22px"></i>
                                                            </button>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                <i class="ri-more-2-line"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" type="button" style="color: orange;"
                                                                    v-if="include('Vizualizar')" @click="muestra(1), infoTalento(t)">
                                                                    <i class="ri-clipboard-line me-1"></i> Vizualizar</a>
                                                                <a class="dropdown-item" type="button" style="color: #33b2ff;"
                                                                    v-if="include('Editar') && (t.estatus == 0)" @click="muestra(2), infoTalento(t)">
                                                                    <i class="ri-pencil-line me-1"></i> Editar</a>
                                                                <a class="dropdown-item" type="button" style="color: red;"
                                                                    v-if="include('Eliminar') && (t.estatus == 0)" @click="Talentodelete(t.id_talento)">
                                                                    <i class="ri-delete-bin-7-line me-1"></i> Eliminar</a>
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
                        <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
                            <div class="row g-6 mt-2">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <h5 class="card-header">Banners Talento</h5>
                                    </div>
                                    <div class="col-12 col-md-6 mt-3">
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <input type="search" id="email"class="form-control"  v-model="search" placeholder="Buscar Registro" @keyup="buscarUsuario()"/>
                                            <button type="button" class="btn btn-outline-success waves-effect" data-bs-toggle="modal" data-bs-target="#altaBanner">Agregar</button>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-md-6" v-for="(r, index) in BannerTable" :key="index" style="border-color: #33b2ff;">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="role-heading">
                                                        <div class="d-flex justify-content-start align-items-center">
                                                            <div class="avatar-wrapper">
                                                                <div class="avatar me-2" >
                                
                                                                    <img :src="`ArchivosSistema/BannerDate/${r.banners}`" class="w-px-100" />

                                                                </div>
                                                            </div>
                                                        </div>
                                                    <a type="button" data-bs-toggle="modal" data-bs-target="#editarBanner" class="role-edit-modal" style="color: #4caf50;" @click="infoBanner(r)">
                                                        <p class="mb-0">Editar Banner</p>
                                                    </a>
                                                    </div>
                                                    <a type="button" class="text-success" v-if="r.estatus == 0"><i class="ri-checkbox-circle-fill ri-22px"></i></a>
                                                    <a type="button" class="text-danger" v-else><i class="ri-close-circle-fill ri-22px"></i></a>
                                                    <a type="button" class="text-danger" @click="deleteSede(r)"><i class="ri-delete-bin-6-fill ri-22px"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <!-- VISTA QUE AGREGARA LA GALERIA DE TALENTOS DE DICHA COPA -->
        <div id="main" v-if="this.vista == 1">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-6">
                        <div class="user-profile-header-banner">
                            <img :src="`https://test-intranet.amfpro.mx/ArchivosSistema/GaleriaTalentos/${this.detalleTalento.hidder}`" alt="Banner image" class="rounded-top" v-if="this.detalleTalento.exit_hidder == false"/>
                            <img :src="`ArchivosSistema/Talentos/${this.detalleTalento.hidder}`" alt="Banner image" class="rounded-top" v-else/>
                        </div>
                        <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-5">
                            <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                                <!-- <img
                                :src="`${this.detalleTorneo.img}`"
                                alt="torneo"
                                class="d-block h-auto ms-0 ms-sm-5 rounded-4 user-profile-img" style="width: 80px;"/> -->
                            </div>
                            <div class="flex-grow-1 mt-4 mt-sm-12">
                                <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-5 flex-md-row flex-column gap-6">
                                    <div class="user-profile-info">
                                        <h4 class="mb-2">{{this.detalleTalento.copa}}</h4>
                                        <ul
                                        class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4">
                                        <li class="list-inline-item">
                                            <i class="ri-user-fill ri-24px"></i><span class="fw-medium">{{this.detalleTalento.categoria}}</span>
                                        </li>
                                        <!-- <li class="list-inline-item">
                                            <i class="ri-map-pin-line me-2 ri-24px"></i><span class="fw-medium">{{this.detalleTorneo.sede}}</span>
                                        </li> -->
                                        <li class="list-inline-item">
                                            <i class="ri-calendar-line me-2 ri-24px"></i
                                            ><span class="fw-medium"> {{this.detalleTalento.fecha}}</span>
                                        </li>
                                        </ul>
                                    </div>
                                    <!-- <a href="javascript:void(0)" class="btn btn-primary">
                                        <i class="ri-user-follow-line ri-16px me-2"></i>Connected
                                    </a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-5 col-md-5">
                        <!-- About User -->
                        <div class="card mb-6">
                            <div class="card-body">
                                <small class="card-text text-uppercase text-muted small">Información</small>
                                <ul class="list-unstyled my-3 py-1">
                                    <li class="d-flex align-items-center mb-4">
                                    <i class="ri-trophy-fill ri-24px"></i><span class="fw-medium mx-2">Copa:</span>
                                    <span>{{this.detalleTalento.copa}}</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-4">
                                    <i class="ri-medal-fill ri-24px"></i><span class="fw-medium mx-2">Categoria:</span>
                                    <span>{{this.detalleTalento.categoria}}</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-4">
                                    <i class="ri-medal-2-fill ri-24px"></i><span class="fw-medium mx-2">Fase:</span>
                                    <span>{{ this.detalleTalento.fase }}</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-4">
                                    <i class="ri-article-line ri-24px"></i><span class="fw-medium mx-2">Descripción:</span>
                                    <span>{{this.detalleTalento.descripcion}}</span>
                                    </li>
                                    
                                </ul>

                            </div>
                        </div>
                        <!--/ About User -->
                    </div>
                    <div class="col-xl-6 col-lg-7 col-md-7">

                        <center>
                            <!-- Projects table -->
                                <swiper-container
                                    pagination="true"
                                    centered-slides="true"
                                    effect="cube"
                                    grab-cursor="true"
                                    cube-effect-shadow="true"
                                    cube-effect-slide-shadows="true"
                                    cube-effect-shadow-scale="0.94"
                                    events-prefix="swiper-">
                                    <swiper-slide v-for="(t, index) in galeriaTalento" :key="index">
                                        <center>
                                            <img :src="`https://test-intranet.amfpro.mx/ArchivosSistema/GaleriaTalentos/${t.img}`" style="width: 400px;" v-if="t.exit_img == false">
                                            <img :src="`ArchivosSistema/Talentos/${t.img}`" alt="imagen" style="width: 400px;" v-else/>
                                        </center>
                                    </swiper-slide>
                                </swiper-container>
                            <!--/ Projects table -->
                        </center>
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
        </div>
        <!-- VISTA QUE editara la galeria de talentos -->
        <div id="main" v-if="this.vista == 2">
            <div class="card mb-6">
                <h5 class="card-header" style="color: green;">Editar Registro Talentos</h5>
                <form class="card-body">
                    <!-- <h6>Datos del Torneo</h6> -->
                    <div class="row g-6">
                        <div class="col-md-4">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="Copa" class="form-control"  style="color: green;" v-model="detalleTalento.copa" disabled/>
                                <label for="Copa">Copa</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="Fecha" class="form-control"  style="color: green;" v-model="detalleTalento.fecha" disabled/>
                                <label for="Fecha">Fecha</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <input type="number" id="year" class="form-control" 
                                        style="color: green;" aria-label="year" v-model="detalleTalento.year" disabled />
                                    <label for="year">Año</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="categoria" class="form-control" 
                                        style="color: green;" aria-label="categoria" v-model="detalleTalento.categoria" disabled />
                                    <label for="categoria">Categoria</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <input type="number" id="num_jugadores" class="form-control" 
                                        style="color: green;" aria-label="num_jugadores" v-model="detalleTalento.num_jugadores" disabled />
                                    <label for="num_jugadores">Número Jugadores</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating form-floating-outline">
                                <select id="fase" name="fase" class="form-select" v-model="detalleTalento.fase" @change="questionCopa(detalleTalento.fase)">
                                    <option value="Selecciona una Fase">Selecciona una Fase</option>
                                    <option value="Fase de Grupos">Fase de Grupos</option>
                                    <option value="Octavos de Final">Octavos de Final</option>
                                    <option value="Cuartos de Final">Cuartos de Final</option>
                                    <option value="Semifinal">Semifinal</option>
                                    <option value="Final">Final</option>
                                </select>
                                <label for="fase">Fase</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline mb-6">
                                <textarea class="form-control h-px-75" id="bs-validation-bio" name="bs-validation-bio" rows="3" placeholder="Escribe una Descripción" v-model="detalleTalento.descripcion"></textarea>
                                <label for="bs-validation-bio">Descripción</label>
                            </div>
                        </div>
                       

                        <div class="col-md-6">
                            <ul class="list-group mb-4">
                                <li class="list-group-item p-5">
                                    <div class="d-flex gap-4 flex-sm-row flex-column align-items-center">
                                        <div class="flex-shrink-0 d-flex align-items-center">
                                            <img :src="imagenMiniatura" alt="google home" class="w-px-100" v-if="imagenMiniatura != ''">
                                            <img :src="this.detalleTalento.exit_hidder ? `ArchivosSistema/Talentos/${this.detalleTalento.hidder}` : `https://test-intranet.amfpro.mx/ArchivosSistema/GaleriaTalentos/${this.detalleTalento.hidder}`" class="w-px-100" alt="sin_img" v-else>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="row text-center text-sm-start">
                                                <div class="col-md-12">
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="file"  accept="image/png,image/jpeg" class="form-control" id="bs-validation-upload-file" ref="fileBanner" @change="onChangeBanner()">
                                                        <label for="bs-validation-upload-file">Banner</label>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <hr class="mt-0" style="color:black">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <h5 class="card-header">Galeria</h5>
                                </div>
                                <div class="col-12 col-md-6 mt-3">
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button type="button" class="btn btn-outline-success waves-effect" v-if="include('Crear')" for="file-upload"  onclick="document.getElementById('file-upload').click()">Agregar</button>
                                        <input type="file" id="file-upload" ref="escudo" accept="image/*" style="display: none;" @change="imgEscudo()" multiple/>
                                    </div>
                                </div>
                            </div>
                            <center v-if="this.galeriaTalento.length == 0">
                                <h5 class="card-header text-success">Sin Imagenes</h5>
                                <img src="style/logos/img_no hay datos.png" alt="img_sindato" style="width: 150px;">
                            </center>
                            <div class="table-responsive text-nowrap mt-2" v-else>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>IMG</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <tr v-for="(img, index) in galeriaTalento" :key="index">
                                            <td>{{ index+1 }}</td>
                                            <td>
                                                <div class="d-flex justify-content-start align-items-center">
                                                    <div class="avatar-wrapper">
                                                        <div class="avatar me-2" >
                        
                                                            <img :src="img.url" class="w-px-100" v-if="img.talento_id == ''"/>
                                                            <img :src="img.exit_img ? `ArchivosSistema/Talentos/${img.img}` : `https://test-intranet.amfpro.mx/ArchivosSistema/GaleriaTalentos/${img.img}`" class="w-px-100" alt="sin_img" v-else>

                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            
                                            <td>
                                                <button type="button" class="btn btn-outline-danger btn-icon waves-effect" @click="deleteImagen(index,img.id_img_talento)">
                                                    <i class="ri-delete-bin-line ri-22px"></i>
                                                </button>
                                            </td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <div class="pt-6 mt-2">
                        <button type="button" class="btn btn-primary me-4" @click="updateTalentos()">Editar</button>
                        <button type="reset" class="btn btn-danger" @click="muestra(0)">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Modal de alta de banner -->
        <div class="modal fade" id="altaBanner" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalFullTitle" style="color: green;">Registro Banners</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="card-body">
                            <!-- <h6>Datos del Torneo</h6> -->
                            <div class="row g-6">
                                <div class="col-md-4">
                                    <div class="user-profile-header-banner">
                                        <img src="style/assets/img/fondo5.jpg" alt="Banner image" class="rounded-top" style="height: 200px;" v-if="this.newBanner.banner == ''"/>
                                        <img :src="imagenBanner" alt="Banner image" class="rounded-top" style="height: 200px;" v-else>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn rounded-pill btn-success waves-effect waves-light" v-if="include('Crear')" for="file-banner"  onclick="document.getElementById('file-banner').click()">Agregar</button>
                                    <input type="file" id="file-banner" ref="bannernew" accept="image/*" style="display: none;" @change="onChangeFileUploadBanner()"/>
                                </div>
                                <div class="col-md-6">
                                    <p style="color: red;">Ingresa los proximos torneos</p>
                                    <div class="edit_container" style="overflow: hidden;">
                                        <quill-editor
                                            v-model="newBanner.prox_torneo"
                                            style="height: 200%;"
                                            ref="myQuillEditorEditar"
                                            :options="editorOption"
                                            
                                            @blur="onEditorBlur($event)"
                                            @focus="onEditorFocus($event)"
                                            @change="onEditorChange($event)">
                                        </quill-editor>
                                    </div>
                                </div>
                               
                                <hr class="mt-4" style="color:black">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <h5 class="card-header">Galeria</h5>
                                        </div>
                                        <div class="col-12 col-md-6 mt-3">
                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                <button type="button" class="btn rounded-pill btn-success waves-effect waves-light" v-if="include('Crear')" for="file-upload"  onclick="document.getElementById('file-upload').click()">Agregar</button>
                                                <input type="file" id="file-upload" ref="escudo" accept="image/*" style="display: none;" @change="imgPops()" multiple/>
                                            </div>
                                        </div>
                                    </div>
                                    <center v-if="this.galeriaBanner.length == 0">
                                        <h5 class="card-header text-success">Sin Imagenes</h5>
                                        <img src="style/logos/img_no hay datos.png" alt="img_sindato" style="width: 150px;">
                                    </center>
                                    <div class="table-responsive text-nowrap mt-2" v-else>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>IMG</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                <tr v-for="(img, index) in galeriaBanner" :key="index">
                                                    <td>{{ index+1 }}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-start align-items-center">
                                                            <div class="avatar-wrapper">
                                                                <div class="avatar me-2" >
                                
                                                                    <img :src="img.url" class="w-px-100" />

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    
                                                    <td>
                                                        <button type="button" class="btn btn-outline-danger btn-icon waves-effect" @click="deletPops(index,img.id_img_talento)">
                                                            <i class="ri-delete-bin-line ri-22px"></i>
                                                        </button>
                                                    </td>
                                                    
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="agregaBanner()">Guardar</button>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"> Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal de editar de banner -->
        <div class="modal fade" id="editarBanner" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalFullTitle" style="color: green;">Editar Banners</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="card-body">
                            <!-- <h6>Datos del Torneo</h6> -->
                            <div class="row g-6">
                                <div class="col-md-4">
                                    <div class="user-profile-header-banner">
                                        <img src="style/assets/img/fondo5.jpg" alt="Banner image" class="rounded-top" style="height: 200px;" v-if="this.DetalleBanner.banners == ''"/>
                                        <img :src="`ArchivosSistema/BannerDate/${DetalleBanner.banners}`" alt="Banner image" class="rounded-top" style="height: 200px;" v-else>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn rounded-pill btn-success waves-effect waves-light" v-if="include('Crear')" for="file-bannerupdate"  onclick="document.getElementById('file-bannerupdate').click()">Agregar</button>
                                    <input type="file" id="file-bannerupdate" ref="bannerupdate" accept="image/*" style="display: none;" @change="onChangeBannerUpdate()">
                                </div>
                                <div class="col-md-6">
                                    <p style="color: red;">Ingresa los proximos torneos</p>
                                    <div class="edit_container" style="overflow: hidden;">
                                        <quill-editor
                                            v-model="DetalleBanner.prox_torneo"
                                            style="height: 200%;"
                                            ref="myQuillEditorEditar"
                                            :options="editorOption"
                                            
                                            @blur="onEditorBlur($event)"
                                            @focus="onEditorFocus($event)"
                                            @change="onEditorChange($event)">
                                        </quill-editor>
                                    </div>
                                </div>
                               
                                <hr class="mt-4" style="color:black">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <h5 class="card-header">Galeria</h5>
                                        </div>
                                        <div class="col-12 col-md-6 mt-3">
                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                <button type="button" class="btn rounded-pill btn-success waves-effect waves-light" v-if="include('Crear')" for="file-galeupdate"  onclick="document.getElementById('file-galeupdate').click()">Agregar</button>
                                                <input type="file" id="file-galeupdate" ref="galeriabannerimg" accept="image/*" style="display: none;" @change="imgPops()" multiple/>
                                            </div>
                                        </div>
                                    </div>
                                    <center v-if="this.Bannergaleria.length == 0">
                                        <h5 class="card-header text-success">Sin Imagenes</h5>
                                        <img src="style/logos/img_no hay datos.png" alt="img_sindato" style="width: 150px;">
                                    </center>
                                    <div class="table-responsive text-nowrap mt-2" v-else>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>IMG</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                <tr v-for="(img, index) in Bannergaleria" :key="index">
                                                    <td>{{ index+1 }}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-start align-items-center">
                                                            <div class="avatar-wrapper">
                                                                <div class="avatar me-2" >
                                
                                                                    <img :src="`ArchivosSistema/BannerDate/${img.img_banner}`" class="w-px-100" />

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    
                                                    <td>
                                                        <button type="button" class="btn btn-outline-danger btn-icon waves-effect" @click="deletPops(index,img.id_img_talento)">
                                                            <i class="ri-delete-bin-line ri-22px"></i>
                                                        </button>
                                                    </td>
                                                    
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="editarBanner()">Editar</button>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"> Cerrar</button>
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
import { register } from 'swiper/element/bundle'
register()

export default {
    name: '',
    components: {
        quillEditor,
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
            imagenMiniatura:'',
            Talentos:[],
            detalleTalento:[],
            galeriaTalento:[],
            /* Banner */
            BannerTable:[],
            newBanner:{
                banner:'',
                prox_torneo:''
            },
            galeriaBanner:[],
            imagenBanner:'',
            DetalleBanner:[],
            Bannergaleria:[],
            editorOption: {},
            offset: 2,
            pagination: {
                'total': 0,
                'current_page': 0,
                'per_page': 0,
                'last_page': 0,
                'from': 0,
                'to': 0
            },
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
        this.getTalentos();
        this.getBanner();
    },
    methods: {
        getTalentos(page) {
            let url = `talentos/getTalentos?buscador=${this.search}&page=` + page;
            axios.get(url).then(response => {
                this.Talentos = response.data.muestra.data;
                this.pagination = response.data.pagination;
            });
        },
        muestra(valor) {
            this.vista = valor;
        },
        include(permiso) {
            return this.permisos.includes(permiso);
        },
        changePage: function (page) {
            this.pagination.current_page = page;
            this.getTalentos(page);
        },
        buscarTalentos() {               
            clearTimeout(this.tiempoBusqueda)
            this.tiempoBusqueda = setTimeout(this.getTalentos, 200)
        },
        infoTalento(t){
            this.detalleTalento = t;
            axios.get(`talentos/galeriaTalento/${t.id_talento}`).then(response => {
                this.galeriaTalento = response.data;
            });
        },
        onChangeBanner() {
            this.file = this.$refs.fileBanner.files[0];
            
            this.detalleTalento.hidder = this.file
            this.loadingHidden(this.file);
        },
        loadingHidden(file){
            let reader = new FileReader();

            reader.onload = (e) => {
                this.imagenMiniatura = e.target.result
            }
            reader.readAsDataURL(file)
        },
        activacionEstatus(id_talento,value){
            this.id_talento = id_talento;
            
            if (value == 0) {
                var valor = 1;
            }
            if (value == 1) {
                var valor = 0
            }
            this.valor = valor;
            let formData = new FormData();
                formData.append('id_talento',this.id_talento);
                formData.append('estatus',this.valor);
            axios.post('talentos/activacion',formData).then(response =>{
                this.getTalentos();
                Swal.fire({
                    title: "Perfecto!",
                    text: "Estatus cambiado Correctamente.",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2500
                });
            })
        },
        imgEscudo(){
            const archivos = this.$refs.escudo.files;
            for (let index = 0; index < archivos.length; index++) {
                const img = archivos[index];
                this.galeriaTalento.push({
                    talento_id: '',
                    img: img,
                    url: URL.createObjectURL(img)
                });
            }
        },
        deleteImagen(index,id) {
            
            URL.revokeObjectURL(this.galeriaTalento[index].url); 
            this.galeriaTalento.splice(index, 1);

            axios.post(`talentos/eliminarImagen/${id}`).then(response => {
                Swal.fire({
                    title: "Perfecto!",
                    text: "Imagen Eliminada Correctamente.",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2500
                });
            });
        },
        updateTalentos(){
            let formData = new FormData();
            formData.append('id_talento',this.detalleTalento.id_talento);
            formData.append('copa',this.detalleTalento.copa);
            formData.append('fecha',this.detalleTalento.fecha);
            formData.append('year',this.detalleTalento.year);   
            formData.append('categoria',this.detalleTalento.categoria);
            formData.append('num_jugadores',this.detalleTalento.num_jugadores);
            formData.append('fase',this.detalleTalento.fase);
            formData.append('descripcion',this.detalleTalento.descripcion);
            formData.append('hidder',this.detalleTalento.hidder);
            this.galeriaTalento.forEach((item, index) => {
                if (item.img) {
                    formData.append('galerianew[]', item.img);
                }
            });
            axios.post('talentos/updateTalento',formData).then(response =>{
                this.getTalentos();
                this.muestra(0);
                Swal.fire({
                    title: "Perfecto!",
                    text: "Editado Correctamente.",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2500
                });
            })
        },
        Talentodelete(id){
            this.id_talento = id;
            Swal.fire({
                title: "Estas seguro?",
                text: "Se eliminaran definitivamente!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Aceptar",
                cancelButtonColor: "#d33",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    let formData = new FormData();
                    formData.append('id_talento', this.id_talento);
                    axios.post('talentos/Talentodelete', formData).then(response => {
                        this.getTalentos();
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


        getBanner(page) {
            let url = `talentos/getBanner?buscador=${this.search}&page=` + page;
            axios.get(url).then(response => {
                this.BannerTable = response.data.date.data;
                this.pagination2 = response.data.pagination2;
            });
        },


        onChangeFileUploadBanner(){
            this.filenew = this.$refs.bannernew.files[0];
            if (this.filenew.type != 'image/png' && this.filenew.type != 'image/jpeg') {
                swal('Solo se permiten archivos PNG y JPEG', {
                    position: 'center',
                    icon: 'error',
                    buttons: false,
                    timer: 1600
                })
                this.$refs.bannernew.value = null;
                return;
            }
            this.newBanner.banner = this.filenew
            this.cargarImagen(this.filenew)
        },
        cargarImagen(file){
            let reader = new FileReader();

            reader.onload = (e) => {
                this.imagenBanner = e.target.result
            }
            reader.readAsDataURL(file)
        },
        imgPops(){
            const archivos = this.$refs.escudo.files;
            for (let index = 0; index < archivos.length; index++) {
                const img = archivos[index];
                this.galeriaBanner.push({
                    img: img,
                    url: URL.createObjectURL(img)
                });
            }
        },
        deletPops(index) {
            
            URL.revokeObjectURL(this.galeriaBanner[index].url); 
            this.galeriaBanner.splice(index, 1);
        },

        agregaBanner(){
            if (this.newBanner.banner == '') {
                this.$toast.error("Ingresa un Banner", {
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
            }
            if (this.newBanner.prox_torneo == '') {
                this.$toast.error("Ingresa los Proximos Torneos", {
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
            }
            if (this.galeriaBanner.length == 0) {
                this.$toast.error("Agrega imagenes a la Galeria", {
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
            }
            
            let formData = new FormData();
                formData.append('banners',this.newBanner.banner);
                formData.append('prox_torneo',this.newBanner.prox_torneo);
                // formData.append('galeriaBanner',JSON.stringify(this.galeriaBanner));
                for (let i = 0; i < this.galeriaBanner.length; i++) {
                    formData.append('img[' + i + ']', this.galeriaBanner[i].img);
                }
            axios.post('talentos/createBanner',formData).then(response=>{
                $('#altaBanner').modal('hide');
                this.newBanner = {
                    banner:'',
                    prox_torneo:'',
                }
                this.getBanner();
                Swal.fire({
                    title: 'Exitoso',
                    text: "Se Agrego Correctamente!",
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2500,
                });
            })
        },
        infoBanner(b){
            this.DetalleBanner = b;

            axios.get(`talentos/Bannergaleria/${this.DetalleBanner.id_banner}`).then(response =>{
                this.Bannergaleria = response.data
            })
        },
        onChangeBannerUpdate(){
            this.fileup = this.$refs.bannerupdate.files[0];
            if (this.fileup.type != 'image/png' && this.fileup.type != 'image/jpeg') {
                swal('Solo se permiten archivos PNG y JPEG', {
                    position: 'center',
                    icon: 'error',
                    buttons: false,
                    timer: 1600
                })
                this.$refs.bannerupdate.value = null;
                return;
            }
            this.DetalleBanner.banners = this.fileup
            this.cargarImagen(this.fileup)
        },

        onEditorReady (editor) {}, // prepara el editor
        onEditorBlur () {}, // Evento de pérdida de foco
        onEditorFocus () {}, // Obtiene el evento de enfoque
        onEditorChange () {}, // evento de cambio de contenido
}
};
</script>
<style scoped>

swiper-slide {
  background-position: center;
  background-size: cover;
  block-size: 250px;
  inline-size: 250px;
}

swiper-container {
  margin: auto;
  block-size: 250px;
  inline-size: 250px;
}
</style>