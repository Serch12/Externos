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
                                    <span class="d-none d-sm-block"><i class="tf-icons ri-git-repository-line me-2"></i> Banners AMFPRO</span><i class="ri-git-repository-line ri-20px d-sm-none"></i></button>
                            </li>
                            <span class="tab-slider" style="left: 0px; width: 165.135px; bottom: 0px;"></span>
                        </ul>
                    </div>
                </div>
                <div class="card-body pt-5">
                    <div class="tab-content p-0">
                        <div class="tab-pane fade active show" id="navs-justified-home" role="tabpanel">
                            <div class="row g-4 mt-2">
                                
                                <!-- Cabecera y Buscador -->
                                <div class="col-12 d-flex flex-column flex-md-row justify-content-between align-items-center">
                                    <h5 class="card-title mb-3 mb-md-0 fw-bold">Talentos AMFpro</h5>
                                    
                                    <!-- Contenedor para alinear Buscador y Botón -->
                                    <div class="d-flex flex-column flex-sm-row align-items-center gap-3">
                                        
                                        <!-- Buscador -->
                                        <div class="input-group w-auto">
                                            <span class="input-group-text bg-transparent border-end-0">
                                                <i class="ri-search-line"></i>
                                            </span>
                                            <input type="search" id="email" class="form-control border-start-0 ps-0" v-model="search"
                                                placeholder="Buscar Talentos AMFpro..." @keyup="buscarTalentos()" />
                                        </div>

                                        <!-- Botón Agregar -->
                                        <!-- Nota: Ajusta la función @click a la que utilices para abrir tu formulario de creación (ej. muestra(3)) -->
                                        <button type="button" class="btn btn-primary text-nowrap" v-if="include('Crear')" @click="muestra(3)">
                                            <i class="ri-add-line me-1"></i> Agregar
                                        </button>
                                        
                                    </div>
                                </div>

                                <!-- Estado Vacío (Sin Información) -->
                                <div class="col-12" v-if="Talentos.length === 0">
                                    <div class="d-flex flex-column align-items-center justify-content-center py-5">
                                        <img src="style/logos/img_no hay datos.png" alt="Sin Datos" class="mb-3" style="width: 150px; opacity: 0.8;">
                                        <h5 class="text-muted fw-semibold">No se encontró información</h5>
                                    </div>
                                </div>

                                <!-- Tabla de Datos -->
                                <div class="col-12" v-else>
                                    <div class="table-responsive text-nowrap rounded border">
                                        <table class="table table-hover align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th>Banner</th>
                                                    <th class="text-center">Fecha</th>
                                                    <th>Año</th>
                                                    <th>Copa</th>
                                                    <th>Fase</th>
                                                    <th>Categoría</th>
                                                    <th class="text-center">Estatus</th>
                                                    <th class="text-center">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                <tr v-for="(t, index) in Talentos" :key="index">
                                                    <td class="text-center fw-medium">{{ index + 1 }}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-start align-items-center">
                                                            <div class="avatar-wrapper">
                                                                <div class="avatar me-2">
                                                                    <img :src="`https://test-intranet.amfpro.mx/ArchivosSistema/GaleriaTalentos/${t.hidder}`" 
                                                                        v-if="t.exit_hidder === false" class="rounded">
                                                                    <img :src="`ArchivosSistema/Talentos/${t.hidder}`" 
                                                                        v-else class="rounded">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">{{ t.fecha }}</td>
                                                    <td>{{ t.year }}</td>
                                                    <td>{{ t.copa }}</td>
                                                    <td><span class="badge bg-label-info">{{ t.fase }}</span></td>
                                                    <td>{{ t.categoria }}</td>
                                                    <td class="text-center">
                                                        <button class="btn btn-sm btn-icon rounded-pill" 
                                                                :class="t.estatus == 0 ? 'btn-outline-primary' : 'btn-outline-danger'" 
                                                                @click="activacionEstatus(t.id_talento, t.estatus)"
                                                                data-bs-toggle="tooltip" 
                                                                title="Cambiar Estatus">
                                                            <i class="ri-22px" :class="t.estatus == 0 ? 'ri-checkbox-circle-fill' : 'ri-close-circle-fill'"></i>
                                                        </button>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="d-flex justify-content-center align-items-center gap-2">
                                                            
                                                            <button type="button" class="btn btn-sm btn-icon btn-outline-warning" 
                                                                    v-if="include('Vizualizar')" @click="muestra(1); infoTalento(t)"
                                                                    data-bs-toggle="tooltip" title="Visualizar">
                                                                <i class="ri-clipboard-line"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-icon btn-outline-info" 
                                                                    v-if="include('Editar') && t.estatus == 0" @click="muestra(2); infoTalento(t)">
                                                                    <i class="ri-pencil-line"></i>
                                                            </button>

                                                            <button type="button" class="btn btn-sm btn-icon btn-outline-danger" 
                                                                    v-if="include('Eliminar') && t.estatus == 0" @click="Talentodelete(t.id_talento)">
                                                                        <i class="ri-delete-bin-7-line"></i>
                                                            </button>

                                                            
                                                            
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Paginación -->
                                    <nav aria-label="Navegación de páginas" class="mt-4">
                                        <ul class="pagination justify-content-center">
                                            <li class="page-item" :class="{ disabled: pagination.current_page <= 1 }">
                                                <a @click.prevent="changePage(pagination.current_page - 1)" class="page-link" href="#">
                                                    <i class="ri-arrow-left-s-line"></i> Anterior
                                                </a>
                                            </li>
                                            <li class="page-item" v-for="(page, index) in pageNumber" :key="index"
                                                @click.prevent="changePage(page)"
                                                :class="[page == isActived ? 'active' : 'waves-effect']">
                                                <a class="page-link" href="#">{{ page }}</a>
                                            </li>
                                            <li class="page-item" :class="{ disabled: pagination.current_page >= pagination.last_page }">
                                                <a @click.prevent="changePage(pagination.current_page + 1)" class="page-link" href="#">
                                                    Siguiente <i class="ri-arrow-right-s-line"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                                
                            </div>
                        </div>
                        <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
                            <div class="row g-6 mt-2">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <h5 class="card-header">Banners AMFPRO</h5>
                                    </div>
                                    <div class="col-12 col-md-6 mt-3">
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <input type="search" id="email"class="form-control"  v-model="search" placeholder="Buscar Registro" @keyup="buscarUsuario()"/>
                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                <button type="button" class="btn btn-outline-success waves-effect" v-if="include('Crear')" for="file-upload"  onclick="document.getElementById('file-upload').click()">Agregar</button>
                                                <input type="file" id="file-upload" ref="escudo" accept="image/*" style="display: none;" @change="imgPops()" multiple/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="table-responsive text-nowrap mt-2">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>IMG</th>
                                                        <th>Fecha Inicio</th>
                                                        <th>Fecha Fin</th>
                                                        <!-- <th><center>Estatus</center></th> -->
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-border-bottom-0">
                                                    <tr v-for="(t, index) in BannerTable" :key="index">
                                                        <td>{{ index+1 }}</td>
                                                        <td>
                                                            <div class="d-flex justify-content-start align-items-center" >
                                                                <div class="avatar-wrapper">
                                                                    <div class="avatar me-2" >
                                                                        <img :src="`ArchivosSistema/BannerDate/${t.img_banner}`" class="w-px-100" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{ t.fecha_publicacion }}</td>
                                                        <td>{{ t.fecha_fin_publi }}</td>
                                                        
                                                        <td>
                                                            <button class="btn btn-outline-primary btn-icon waves-effect" v-if="t.estatus == 0" @click="EstatusBanner(t.id_imgbanner,t.estatus)" title="Activar">
                                                                <i class="ri-checkbox-circle-fill ri-22px"></i>
                                                            </button>
                                                            <button class="btn btn-outline-danger btn-icon waves-effect" v-else @click="EstatusBanner(t.id_imgbanner,t.estatus)" title="Desactivar">
                                                                <i class="ri-close-circle-fill ri-22px"></i>
                                                            </button>
                                                            <button class="btn btn-outline-danger btn-icon waves-effect" @click="deleteBanner(t.id_imgbanner)">
                                                                <i class="ri-delete-bin-fill ri-22px"></i>
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
                </div>
                </div>
            </div>
        </div>
        <!-- VISTA detalle LA GALERIA DE TALENTOS DE DICHA COPA -->
        <div id="main" v-if="vista == 1">
            <!-- Header / Banner del Perfil -->
            <div class="card shadow-sm border-0 mb-4 rounded-3 overflow-hidden">
                <div class="position-relative">
                    <!-- Banner Image -->
                    <img :src="`https://test-intranet.amfpro.mx/ArchivosSistema/GaleriaTalentos/${detalleTalento.hidder}`" 
                        class="w-100 object-fit-cover" style="height: 250px;" 
                        alt="Banner image" v-if="detalleTalento.exit_hidder == false"/>
                    <img :src="`ArchivosSistema/Talentos/${detalleTalento.hidder}`" 
                        class="w-100 object-fit-cover" style="height: 250px;" 
                        alt="Banner image" v-else/>
                    
                    <!-- Capa oscura superpuesta (opcional para resaltar el texto) -->
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0) 100%);"></div>
                    
                    <!-- Título Flotante sobre el Banner -->
                    <div class="position-absolute bottom-0 start-0 w-100 p-4 text-white">
                        <h2 class="text-white fw-bold mb-2">{{ detalleTalento.copa }}</h2>
                        <div class="d-flex flex-wrap gap-4 align-items-center fw-medium">
                            <span class="d-flex align-items-center">
                                <i class="ri-user-fill ri-xl me-2 text-primary"></i> {{ detalleTalento.categoria }}
                            </span>
                            <span class="d-flex align-items-center">
                                <i class="ri-calendar-line ri-xl me-2 text-info"></i> {{ detalleTalento.fecha }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contenido Principal -->
            <div class="row g-4 mb-4">
                
                <!-- Tarjeta de Información -->
                <div class="col-12 col-lg-5">
                    <div class="card shadow-sm border-0 h-100 rounded-3">
                        <div class="card-header bg-transparent border-bottom pt-4 pb-3">
                            <h5 class="mb-0 fw-bold text-uppercase fs-7 text-muted">
                                <i class="ri-file-info-line me-2"></i>Información del Torneo
                            </h5>
                        </div>
                        <div class="card-body pt-4">
                            <ul class="list-unstyled mb-0">
                                <li class="d-flex align-items-start mb-4">
                                    <div class="avatar avatar-sm flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-primary"><i class="ri-trophy-fill"></i></span>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Copa</small>
                                        <span class="fw-medium text-dark">{{ detalleTalento.copa }}</span>
                                    </div>
                                </li>
                                <li class="d-flex align-items-start mb-4">
                                    <div class="avatar avatar-sm flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-success"><i class="ri-medal-fill"></i></span>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Categoría</small>
                                        <span class="fw-medium text-dark">{{ detalleTalento.categoria }}</span>
                                    </div>
                                </li>
                                <li class="d-flex align-items-start mb-4">
                                    <div class="avatar avatar-sm flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-warning"><i class="ri-medal-2-fill"></i></span>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Fase</small>
                                        <span class="fw-medium text-dark">{{ detalleTalento.fase }}</span>
                                    </div>
                                </li>
                                <li class="d-flex align-items-start">
                                    <div class="avatar avatar-sm flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-info"><i class="ri-article-line"></i></span>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Descripción</small>
                                        <p class="fw-medium text-dark mb-0" style="text-align: justify;">{{ detalleTalento.descripcion }}</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta de Galería Swiper -->
                <div class="col-12 col-lg-7">
                    <div class="card shadow-sm border-0 h-100 rounded-3">
                        <div class="card-header bg-transparent border-bottom pt-4 pb-3">
                            <h5 class="mb-0 fw-bold text-uppercase fs-7 text-muted">
                                <i class="ri-gallery-line me-2"></i>Galería Visual
                            </h5>
                        </div>
                        <div class="card-body d-flex align-items-center justify-content-center p-4 bg-lighter">
                            
                            <!-- Validamos si hay imágenes -->
                            <div v-if="galeriaTalento.length === 0" class="text-center text-muted my-5">
                                <i class="ri-image-line fs-1 mb-2 d-block opacity-50"></i>
                                <p>No hay imágenes disponibles</p>
                            </div>

                            <!-- Swiper Container -->
                            <swiper-container v-else
                                pagination="true"
                                centered-slides="true"
                                effect="cube"
                                grab-cursor="true"
                                cube-effect-shadow="true"
                                cube-effect-slide-shadows="true"
                                cube-effect-shadow-scale="0.94"
                                events-prefix="swiper-"
                                style="width: 100%; max-width: 400px; aspect-ratio: 1/1;" class="rounded shadow-sm">
                                
                                <swiper-slide v-for="(t, index) in galeriaTalento" :key="index" class="d-flex justify-content-center bg-white">
                                    <img :src="`https://test-intranet.amfpro.mx/ArchivosSistema/GaleriaTalentos/${t.img}`" 
                                        class="w-100 h-100 object-fit-cover" v-if="t.exit_img == false">
                                    <img :src="`ArchivosSistema/Talentos/${t.img}`" 
                                        class="w-100 h-100 object-fit-cover" alt="imagen" v-else/>
                                </swiper-slide>
                                
                            </swiper-container>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botonera Footer -->
            <div class="d-flex justify-content-end mt-2">
                <button type="button" class="btn btn-outline-danger px-4 rounded-pill shadow-sm" @click="muestra(0)">
                    <i class="ri-arrow-left-line me-2"></i>Regresar a Talentos
                </button>
            </div>
        </div>
        <!-- VISTA QUE editara la galeria de talentos -->
        <div id="main" v-if="vista == 2">
            <div class="card shadow-sm border-0 mb-4 rounded-3">
                <!-- Encabezado Limpio -->
                <div class="card-header bg-transparent border-bottom pt-4 pb-3 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-success fw-bolder">
                        <i class="ri-edit-2-fill me-2 align-middle"></i>Edición de Talento
                    </h5>
                    <span class="badge bg-label-success rounded-pill px-3 py-2">Estatus: Activo</span>
                </div>
                
                <div class="card-body p-4">
                    <!-- SECCIÓN 1: Panel de Información (Solo Lectura) -->
                    <h6 class="text-uppercase text-muted fw-semibold mb-3 fs-7">Información del Torneo</h6>
                    <div class="row g-3 mb-5">
                        <div class="col-6 col-md-3">

                             <div class="form-floating form-floating-outline">
                                <select id="feCopa" class="form-select fw-medium" v-model="detalleTalento.copa">
                                    <option value="">Selecciona una Copa</option>
                                    <option value="Copa Chivas">Copa Chivas</option>
                                    <option value="Copa Tecos">Copa Tecos</option>
                                    <option value="Copa Sultanes">Copa Sultanes</option>
                                    <option value="Copa Bajio">Copa Bajio</option>
                                    <option value="Copa Vallarta">Copa Vallarta</option>
                                    <option value="Copa USA">Copa USA</option>
                                    <option value="Torneo LIGA MX">Torneo LIGA MX</option>
                                </select>
                                <label for="feCopa">Copa</label>
                            </div>
                        </div>
                        <div class="col-6 col-md-2">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="Fechad" class="form-control fw-medium" v-model="detalleTalento.fecha" />
                                <label for="Fechad">Fecha</label>
                            </div>
                        </div>
                        <div class="col-6 col-md-2">
                            <div class="form-floating form-floating-outline">
                                <input type="number" id="dsedeYear" class="form-control fw-medium" v-model="detalleTalento.year" />
                                <label for="dsedeYear">Año</label>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">

                            <div class="form-floating form-floating-outline">
                                <select id="categoriadedf" class="form-select fw-medium" v-model="detalleTalento.categoria">
                                   <option value="">Selecciona una Categoria</option>
                                    <option value="Categoria 2009">Categoria 2009</option>
                                    <option value="Categoria 2010">Categoria 2010</option>
                                    <option value="Categoria 2011">Categoria 2011</option>
                                    <option value="Categoria 2012">Categoria 2012</option>
                                    <option value="Categoria 2013">Categoria 2013</option>
                                    <option value="Categoria 2014">Categoria 2014</option>
                                </select>
                                <label for="categoriadedf">Categoria</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <div class="form-floating form-floating-outline">
                                <select id="fasefde" class="form-select fw-medium" v-model="detalleTalento.fase">
                                    <option value="" disabled>Selecciona una Fase</option>
                                    <option value="Fase de Grupos">Fase de Grupos</option>
                                    <option value="Octavos de Final">Octavos de Final</option>
                                    <option value="Cuartos de Final">Cuartos de Final</option>
                                    <option value="Semifinal">Semifinal</option>
                                    <option value="Final">Final</option>
                                </select>
                                <label for="fasefde">Fase Actual</label>
                            </div>
                        </div>
                    </div>

                    <!-- SECCIÓN 2: Campos Editables y Banner -->
                    <h6 class="text-uppercase text-muted fw-semibold mb-3 fs-7">Detalles Configurables</h6>
                    <div class="row g-4 mb-5">
                        <div class="col-lg-7">
                            <div class="row g-4">
                                <div class="col-12">
                                    <div class="form-floating form-floating-outline">
                                        <textarea class="form-control" id="bs-validation-bio" style="height: 130px; resize: none;" placeholder="Describe los detalles..." v-model="detalleTalento.descripcion"></textarea>
                                        <label for="bs-validation-bio">Descripción General</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Carga de Banner Estilo "Drag & Drop" -->
                        <div class="col-lg-5">
                            <div class="border border-dashed rounded-3 p-3 h-100 d-flex flex-column align-items-center justify-content-center text-center bg-lighter position-relative">
                                <img :src="imagenMiniatura" alt="miniatura" class="rounded-3 shadow-sm mb-3 w-100 object-fit-cover" style="max-height: 140px;" v-if="imagenMiniatura != ''">
                                <img :src="this.detalleTalento.exit_hidder ? `ArchivosSistema/Talentos/${this.detalleTalento.hidder}` : `https://test-intranet.amfpro.mx/ArchivosSistema/GaleriaTalentos/${this.detalleTalento.hidder}`" class="rounded-3 shadow-sm mb-3 w-100 object-fit-cover" style="max-height: 140px;" alt="sin_img" v-else>
                                
                                <div class="w-100 position-relative">
                                    <input type="file" accept="image/png,image/jpeg" class="form-control form-control-sm" id="banner-upload" ref="fileBanner" @change="onChangeBanner()">
                                </div>
                                <small class="text-muted mt-2">Formatos permitidos: JPG, PNG.</small>
                            </div>
                        </div>
                    </div>

                    <!-- SECCIÓN 3: Galería de Imágenes (Estilo Mosaico) -->
                    <div class="d-flex justify-content-between align-items-end mb-3">
                        <h6 class="text-uppercase text-muted fw-semibold mb-0 fs-7">Galería Visual</h6>
                        <div v-if="include('Crear')">
                            <button type="button" class="btn btn-sm btn-primary rounded-pill px-3 shadow-sm" onclick="document.getElementById('file-upload').click()">
                                <i class="ri-upload-cloud-2-line me-1"></i> Subir Fotos
                            </button>
                            <input type="file" id="file-upload" ref="escudo" accept="image/*" class="d-none" @change="imgEscudo()" multiple/>
                        </div>
                    </div>

                    <div class="p-4 bg-lighter rounded-3 border">
                        <!-- Estado Vacío -->
                        <div class="text-center py-5" v-if="galeriaTalento.length === 0">
                            <div class="avatar avatar-xl bg-label-secondary rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center">
                                <i class="ri-image-add-line fs-2"></i>
                            </div>
                            <h6 class="fw-semibold mb-1">Tu galería está vacía</h6>
                            <p class="text-muted mb-0 small">Sube imágenes para mostrar el talento en acción.</p>
                        </div>

                        <!-- Grid de Imágenes -->
                        <div class="row g-3" v-else>
                            <div class="col-6 col-md-4 col-lg-3" v-for="(img, index) in galeriaTalento" :key="index">
                                <div class="card bg-dark text-white border-0 overflow-hidden shadow-sm h-100 position-relative group-hover">
                                    <img :src="img.url" class="card-img w-100 h-100 object-fit-cover" style="min-height: 120px;" v-if="img.talento_id == ''"/>
                                    <img :src="img.exit_img ? `ArchivosSistema/Talentos/${img.img}` : `https://test-intranet.amfpro.mx/ArchivosSistema/GaleriaTalentos/${img.img}`" class="card-img w-100 h-100 object-fit-cover" style="min-height: 120px;" alt="galeria_img" v-else>
                                    
                                    <!-- Botón Eliminar Flotante -->
                                    <div class="position-absolute top-0 end-0 p-2">
                                        <button type="button" class="btn btn-sm btn-danger btn-icon rounded-circle shadow" @click="deleteImagen(index, img.id_img_talento)" data-bs-toggle="tooltip" title="Eliminar foto">
                                            <i class="ri-close-line"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Botones Footer -->
                    <div class="d-flex justify-content-end gap-3 mt-5 pt-4 border-top">
                        <button type="button" class="btn btn-outline-secondary px-4 rounded-pill" @click="muestra(0)">
                            Cancelar
                        </button>
                        <button type="button" class="btn btn-success px-4 rounded-pill shadow-sm" @click="updateTalentos()">
                            <i class="ri-check-double-line me-2"></i> Guardar Cambios
                        </button>
                    </div>
                    
                </div>
            </div>
        </div>

        <!-- vista agregar galeria talemtos -->
        <div id="main" v-if="vista == 3">
            <div class="card shadow-sm border-0 mb-4 rounded-3">
                <!-- Encabezado Limpio -->
                <div class="card-header bg-transparent border-bottom pt-4 pb-3 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-success fw-bolder">
                        <i class="ri-edit-2-fill me-2 align-middle"></i>Agregar Registro
                    </h5>
                </div>
                
                <div class="card-body p-4">
                    <!-- SECCIÓN 1: Panel de Información (Solo Lectura) -->
                    <h6 class="text-uppercase text-muted fw-semibold mb-3 fs-7">Información del Torneo</h6>
                    <div class="row g-4 mb-5">
                        <div class="col-6 col-md-3">
                            <div class="form-floating form-floating-outline">
                                <select id="Copa" class="form-select fw-medium" v-model="new_registro.copa">
                                    <option value="">Selecciona una Copa</option>
                                    <option value="Copa Chivas">Copa Chivas</option>
                                    <option value="Copa Tecos">Copa Tecos</option>
                                    <option value="Copa Sultanes">Copa Sultanes</option>
                                    <option value="Copa Bajio">Copa Bajio</option>
                                    <option value="Copa Vallarta">Copa Vallarta</option>
                                    <option value="Copa USA">Copa USA</option>
                                    <option value="Torneo LIGA MX">Torneo LIGA MX</option>
                                </select>
                                <label for="Copa">Copa</label>
                            </div>
                        </div>
                        <div class="col-6 col-md-2">
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="Fecha" class="form-control fw-medium" v-model="new_registro.fecha" />
                                <label for="Fecha">Fecha</label>
                            </div>
                        </div>
                        <div class="col-6 col-md-2">
                            <div class="form-floating form-floating-outline">
                                <input type="number" id="Year" class="form-control fw-medium" v-model="new_registro.year" />
                                <label for="Year">Año</label>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="form-floating form-floating-outline">
                                <select id="categoria" class="form-select fw-medium" v-model="new_registro.categoria">
                                   <option value="">Selecciona una Categoria</option>
                                    <option value="Categoria 2009">Categoria 2009</option>
                                    <option value="Categoria 2010">Categoria 2010</option>
                                    <option value="Categoria 2011">Categoria 2011</option>
                                    <option value="Categoria 2012">Categoria 2012</option>
                                    <option value="Categoria 2013">Categoria 2013</option>
                                    <option value="Categoria 2014">Categoria 2014</option>
                                </select>
                                <label for="categoria">Categoria</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <div class="form-floating form-floating-outline">
                                <select id="fase" class="form-select fw-medium" v-model="new_registro.fase">
                                    <option value="" disabled>Selecciona una Fase</option>
                                    <option value="Fase de Grupos">Fase de Grupos</option>
                                    <option value="Octavos de Final">Octavos de Final</option>
                                    <option value="Cuartos de Final">Cuartos de Final</option>
                                    <option value="Semifinal">Semifinal</option>
                                    <option value="Final">Final</option>
                                </select>
                                <label for="fase">Fase Actual</label>
                            </div>
                        </div>
                    </div>

                    <!-- SECCIÓN 2: Campos Editables y Banner -->
                    <h6 class="text-uppercase text-muted fw-semibold mb-3 fs-7">Detalles Configurables</h6>
                    <div class="row g-4 mb-5">
                        <div class="col-lg-7">
                            <div class="row g-4">
                                
                                <div class="col-12">
                                    <div class="form-floating form-floating-outline">
                                        <textarea class="form-control" id="bs-validation-bio" style="height: 130px; resize: none;" placeholder="Describe los detalles..." v-model="new_registro.descripcion"></textarea>
                                        <label for="bs-validation-bio">Descripción General</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Carga de Banner Estilo "Drag & Drop" -->
                        <div class="col-lg-5">
                            <div class="border border-dashed rounded-3 p-3 h-100 d-flex flex-column align-items-center justify-content-center text-center bg-lighter position-relative">
                                <img :src="imagenMiniaturaNew" alt="miniatura" class="rounded-3 shadow-sm mb-3 w-100 object-fit-cover" style="max-height: 140px;" v-if="imagenMiniaturaNew != ''">
                                <!-- <img :src="this.detalleTalento.exit_hidder ? `ArchivosSistema/Talentos/${this.detalleTalento.hidder}` : `https://test-intranet.amfpro.mx/ArchivosSistema/GaleriaTalentos/${this.detalleTalento.hidder}`" class="rounded-3 shadow-sm mb-3 w-100 object-fit-cover" style="max-height: 140px;" alt="sin_img" v-else> -->
                                
                                <div class="w-100 position-relative">
                                    <input type="file" accept="image/png,image/jpeg" class="form-control form-control-sm" id="banner-upload" ref="fileBanner" @change="onChangeBannerNew()">
                                </div>
                                <small class="text-muted mt-2">Formatos permitidos: JPG, PNG.</small>
                            </div>
                        </div>
                    </div>

                    <!-- SECCIÓN 3: Galería de Imágenes (Estilo Mosaico) -->
                    <div class="d-flex justify-content-between align-items-end mb-3">
                        <h6 class="text-uppercase text-muted fw-semibold mb-0 fs-7">Galería Visual</h6>
                        <div v-if="include('Crear')">
                            <button type="button" class="btn btn-sm btn-primary rounded-pill px-3 shadow-sm" onclick="document.getElementById('file-uploadNew').click()">
                                <i class="ri-upload-cloud-2-line me-1"></i> Subir Fotos
                            </button>
                            <input type="file" id="file-uploadNew" ref="escudo" accept="image/*" class="d-none" @change="imgEscudoNew()" multiple/>
                        </div>
                    </div>

                    <div class="p-4 bg-lighter rounded-3 border">
                        <!-- Estado Vacío -->
                        <div class="text-center py-5" v-if="galeriaTalentoNew.length === 0">
                            <div class="avatar avatar-xl bg-label-secondary rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center">
                                <i class="ri-image-add-line fs-2"></i>
                            </div>
                            <h6 class="fw-semibold mb-1">Tu galería está vacía</h6>
                            <p class="text-muted mb-0 small">Sube imágenes para mostrar el talento en acción.</p>
                        </div>

                        <!-- Grid de Imágenes -->
                        <div class="row g-3" v-else>
                            <div class="col-6 col-md-4 col-lg-3" v-for="(img, index) in galeriaTalentoNew" :key="index">
                                <div class="card bg-dark text-white border-0 overflow-hidden shadow-sm h-100 position-relative group-hover">
                                    <img :src="img.url" class="card-img w-100 h-100 object-fit-cover" style="min-height: 120px;" v-if="img.talento_id == ''"/>
                                    <!-- <img :src="img.exit_img ? `ArchivosSistema/Talentos/${img.img}` : `https://test-intranet.amfpro.mx/ArchivosSistema/GaleriaTalentos/${img.img}`" class="card-img w-100 h-100 object-fit-cover" style="min-height: 120px;" alt="galeria_img" v-else> -->
                                    
                                    <!-- Botón Eliminar Flotante -->
                                    <div class="position-absolute top-0 end-0 p-2">
                                        <button type="button" class="btn btn-sm btn-danger btn-icon rounded-circle shadow" @click="deleteImagenNew(index)" data-bs-toggle="tooltip" title="Eliminar foto">
                                            <i class="ri-close-line"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Botones Footer -->
                    <div class="d-flex justify-content-end gap-3 mt-5 pt-4 border-top">
                        <button type="button" class="btn btn-outline-secondary px-4 rounded-pill" @click="muestra(0)">
                            Cancelar
                        </button>
                        <button type="button" class="btn btn-success px-4 rounded-pill shadow-sm" @click="createTalentos()">
                            <i class="ri-check-double-line me-2"></i> Guardar Cambios
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
            imagenMiniaturaNew:'',
            new_registro:{
                copa:'',
                fecha:'',
                year:'',
                categoria:'',
                jugadores:'',
                fase:''

            },
            Talentos:[],
            detalleTalento:[],
            galeriaTalento:[],
            galeriaTalentoNew:[],
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
        onChangeBannerNew() {
            this.file = this.$refs.fileBanner.files[0];
            
            this.new_registro.hidder = this.file
            this.loadingHiddenNew(this.file);
        },
        loadingHiddenNew(file){
            let reader = new FileReader();

            reader.onload = (e) => {
                this.imagenMiniaturaNew = e.target.result
            }
            reader.readAsDataURL(file)
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
        imgEscudoNew(){
            const archivos = this.$refs.escudo.files;
            for (let index = 0; index < archivos.length; index++) {
                const img = archivos[index];
                this.galeriaTalentoNew.push({
                    talento_id: '',
                    img: img,
                    url: URL.createObjectURL(img)
                });
            }
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
        deleteImagenNew(index) {
            
            URL.revokeObjectURL(this.galeriaTalento[index].url); 
            this.galeriaTalentoNew.splice(index, 1);

            // axios.post(`talentos/eliminarImagen/${id}`).then(response => {
            //     Swal.fire({
            //         title: "Perfecto!",
            //         text: "Imagen Eliminada Correctamente.",
            //         icon: "success",
            //         showConfirmButton: false,
            //         timer: 2500
            //     });
            // });
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
                            title: 'Éxito',
                            text: "Se Elimino correctamente!",
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2500,
                        });
                    })

                }
            });
        },


        createTalentos(){
            let formData = new FormData();
                formData.append('copa',this.new_registro.copa);
                formData.append('fecha',this.new_registro.fecha);
                formData.append('year',this.new_registro.year);
                formData.append('categoria',this.new_registro.categoria);
                formData.append('fase',this.new_registro.fase);
                formData.append('descripcion',this.new_registro.descripcion);
                formData.append('hidder',this.new_registro.hidder);
                this.galeriaTalentoNew.forEach((item, index) => {
                    if (item.img) {
                        formData.append('galeriaNuevo[]', item.img);
                    }
                });

                axios.post('talentos/createTalento',formData).then(response=>{
                    this.getTalentos();
                    this.muestra(0);
                    Swal.fire({
                        title: "Perfecto!",
                        text: "Agregado Correctamente.",
                        icon: "success",
                    showConfirmButton: false,
                    timer: 2500
                });
        
            })

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
            if (this.galeriaBanner.length != 0) {
                Swal.fire({
                    title: "¿Ingresa los datos correspondientes?",
                    html: `
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="date" id="fecha_publicacion" class="form-control"  style="color: green;"/>
                                    <label for="fecha_publicacion">Fecha Publicación</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="date" id="fecha_fin" class="form-control"  style="color: green;"/>
                                    <label for="fecha_fin">Fecha Fin Publicación</label>
                                </div>
                            </div>
                            
                        </div>

                    `,
                    icon: "warning",
                    showCancelButton: true,
                    cancelButtonText: "Cancelar",
                    confirmButtonColor: "#6BDE4F",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Agregar",
                preConfirm: () => {
                    // Obtener el valor seleccionado
                    const fecha_inicia = document.getElementById('fecha_publicacion').value;
                    const fecha_fin = document.getElementById('fecha_fin').value;
                    
                    if (fecha_inicia == '') {
                        Swal.showValidationMessage('Ingresa la fecha de inicio de publicación');
                        return false; // Evita que la ventana modal se cierre    
                    }
                    if (fecha_fin == '') {
                        Swal.showValidationMessage('Ingresa la fecha de fin de publicación');
                        return false; // Evita que la ventana modal se cierre    
                    }
            
                    this.fecha_publicacion = fecha_inicia;
                    this.fecha_fin_publi = fecha_fin;
                    return true;
                }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#modalloading').modal('show');
                        let formData = new FormData();
                            for (let i = 0; i < this.galeriaBanner.length; i++) {
                                formData.append('img[' + i + ']', this.galeriaBanner[i].img);
                            }
                            formData.append('fecha_publicacion',this.fecha_publicacion);
                            formData.append('fecha_fin_publi',this.fecha_fin_publi);
                        axios.post('talentos/createBanner',formData).then(response=>{
                            this.galeriaBanner = [];
                            this.getBanner();
                            $('#modalloading').modal('hide');
                            Swal.fire({
                                title: 'Éxito',
                                text: "Se Agrego Correctamente!",
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 2500,
                            });
                        })
                    }
                });
            }
            
            
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
        EstatusBanner(id_imgbanner,value){
            this.id_imgbanner = id_imgbanner;
            
            if (value == 0) {
                var valor = 1;
            }
            if (value == 1) {
                var valor = 0
            }
            this.valor = valor;
            let formData = new FormData();
                formData.append('id_imgbanner',this.id_imgbanner);
                formData.append('estatus',this.valor);
            axios.post('talentos/InactivoActivo',formData).then(response =>{
                this.getBanner();
                Swal.fire({
                    title: "Perfecto!",
                    text: "Estatus cambiado Correctamente.",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2500
                });
            })
        },
        deleteBanner(id){
            this.id = id;
            Swal.fire({
                title: 'Estas seguro?',
                text: "Se eliminara permanentemente!",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText:'Cancelar',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Eliminar'
            }).then((result) => {
                if (result.isConfirmed) {
                    let formData = new FormData();
                    formData.append('id_imgbanner',this.id);
                    axios.post(`talentos/deleteBanner`,formData).then(response => {
                        this.getBanner();
                        Swal.fire({
                            title: 'Eliminado',
                            text: "Se elimino Correctamente!",
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2500,
                        })
                    });
                }
            })
        },



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