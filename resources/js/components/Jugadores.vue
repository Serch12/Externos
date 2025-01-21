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
                      <button type="button" class="btn btn-outline-success waves-effect" data-bs-toggle="modal" data-bs-target="#createUser">Agregar</button>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-6 col-md-6">
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
                    <li><a class="dropdown-item" href="javascript:void(0);">Share connection</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0);">Block connection</a></li>
                    <li>
                      <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item text-danger" href="javascript:void(0);">Delete</a></li>
                  </ul>
                </div>
                <div class="mx-auto my-6">
                  <img src="style/assets/img/avatars/1.png" alt="Avatar Image" class="rounded-circle w-px-100" />
                </div>
                <h5 class="mb-0 card-title">Mark Gilbert</h5>
                <span>UI Designer</span>
                <div class="d-flex align-items-center justify-content-center my-6 gap-2">
                  <a href="javascript:;" class="me-2"
                    ><span class="badge bg-label-secondary rounded-pill">Figma</span></a
                  >
                  <a href="javascript:;"><span class="badge bg-label-warning rounded-pill">Sketch</span></a>
                </div>
                <!-- <div class="d-flex align-items-center justify-content-center">
                  <a href="javascript:;" class="btn btn-primary d-flex align-items-center me-4"
                    ><i class="ri-user-follow-line ri-16px me-2"></i>Connected</a
                  >
                  <a href="javascript:;" class="btn btn-outline-secondary btn-icon"
                    ><i class="ri-mail-open-line ri-22px"></i
                  ></a>
                </div> -->
              </div>
            </div>
          </div>
          </div>
        </div>
      <br><br><br>
    </div>
</template>
<script>
export default {
  name: '',
  components: {
    
  },
  mixins: [],
  props: {
    
  },
  data() {
    return {
      vista:0
    }
  },
  computed: {
    
  },
  watch: {
    
  },
  mounted() {
    
  },
  methods: {
    
  }
};
</script>
<style lang='' scoped>
</style>