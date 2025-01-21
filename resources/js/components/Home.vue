<template>
    <div  v-if="this.vista == 0">
        <div class="row">
            <div class="layout-demo-wrapper">
                <div class="layout-demo-placeholder">
                <img
                    src="style/assets/img/layouts/layout-horizontal-container-light.png"
                    class="img-fluid"
                    alt="Layout container"
                    data-app-light-img="layouts/layout-horizontal-container-light.png"
                    data-app-dark-img="layouts/layout-horizontal-container-dark.png" />
                </div>
                <div class="layout-demo-info">
                <h4>Layout container</h4>
                <p>Container layout sets a <code>max-width</code> at each responsive breakpoint.</p>
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
        'componente'
    ],
    data() {
        return {
            vista:0,
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