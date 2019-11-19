
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('selectize');

window.Vue      = require('vue');
window.moment   = require('moment');


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('calendario', require('./components/Calendario.vue'));
Vue.component('modal', require('./components/Modal.vue'));

// const files = require.context('./', true, /\.vue$/i)

// files.keys().map(key => {
//     return Vue.component(_.last(key.split('/')).split('.')[0], files(key))
// })

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: function() {
        return {
            modal: false,
            usuarioId: null,
            horasDisponibles: null,
            fecha: null,
            trimestres: [],
        }
    },
    methods: {
        modalEliminar(id) {
            this.modal = true;
            this.entidadId = id;
        },
        obtenerHorasCompetencia(event) {
            var id = event.target.value;
            axios.get('/obtener_horas_competencia/'+id).then(function(response) {
                document.getElementById('horas').setAttribute('max', response.data);
                document.getElementById('horas-disponibles').innerHTML = response.data;
            })
        },
        obtenerTrimestresDisponibles() {
            axios.get('/trimestres/obtener_trimestres', {
                params: {
                    fecha: this.fecha,
                }
            }).then(response => {
                this.trimestres = response.data;
            })
        }

    }
});
