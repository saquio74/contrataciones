/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

try {
    window.$ = window.jQuery = require('jquery');
    //window.Popper = require('popper.js');

    //require('bootstrap-sass');
    require('bootstrap');
} catch (e) {}


window.Vue = require('vue');


import VueRouter from 'vue-router';
Vue.use(VueRouter);


import moment  from 'moment'
moment.locale('es');

const agente       =Vue.component('listado-agentes-component', require('./components/ListadoAgentesComponent.vue'            ).default);
                    Vue.component('nuevo-agente',              require('./components/NuevoAgenteComponent.vue'               ).default);
                    Vue.component('modificar-agente',          require('./components/ModificarAgenteComponent.vue'           ).default);
const vacaciones   =Vue.component('vacaciones-agente',         require('./components/ListadoVacaciones.vue'                  ).default);
                    Vue.component('cargar-vacaciones',         require('./components/CargarVacaciones.vue'                   ).default);
                    Vue.component('modificar-vacaciones',      require('./components/ModificarVacaciones.vue'                ).default);
const paraLiquidar =Vue.component('agente-liquidar',           require('./components/liquidacion/BuscarParaLiquidar.vue'     ).default);
const liquidacion  =Vue.component('liquidacion',               require('./components/liquidacion/liquidacion.vue'            ).default);
const home         =Vue.component('home',                      require('./components/Home.vue'                               ).default);


const routes = [
    { path: '/'             ,name: 'Home'            , component: home         },
    { path: '/agente'       ,name: 'Foo'             , component: agente       },
    { path: '/vacaciones'   ,name: 'Bar'             , component: vacaciones   },
    { path: '/paraLiquidar' ,name: 'paraLiquidar'    , component: paraLiquidar }
  ]

const router = new VueRouter({
    routes


});





const app = new Vue({
    el: '#app',
    router
}).$mount('#app');
