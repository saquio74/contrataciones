
try {
    window.$ = window.jQuery = require('jquery');
    require('bootstrap');
} catch (e) {}


window.Vue = require('vue');
import Vuex from 'vuex'
import VueRouter from 'vue-router'

import {store} from './store/store'

Vue.use(VueRouter);
Vue.use(Vuex)


import moment  from 'moment'
moment.locale('es');

const agente       =Vue.component('listado-agentes-component', require('./components/ListadoAgentesComponent.vue'            ).default);
const nuevo        =Vue.component('nuevo-agente',              require('./components/NuevoAgenteComponent.vue'               ).default);
                    Vue.component('modificar-agente',          require('./components/ModificarAgenteComponent.vue'           ).default);
const vacaciones   =Vue.component('vacaciones-agente',         require('./components/ListadoVacaciones.vue'                  ).default);
const ingVacas     =Vue.component('cargar-vacaciones',         require('./components/CargarVacaciones.vue'                   ).default);
                    Vue.component('modificar-vacaciones',      require('./components/ModificarVacaciones.vue'                ).default);
const paraLiquidar =Vue.component('agente-liquidar',           require('./components/liquidacion/BuscarParaLiquidar.vue'     ).default);
const horas        =Vue.component('horas-ingresar',            require('./components/liquidacion/horas.vue'                  ).default);
const liquidacion  =Vue.component('liquidacion',               require('./components/liquidacion/liquidacion.vue'            ).default);
const home         =Vue.component('home',                      require('./components/Home.vue'                               ).default);
const libro        =Vue.component('libro',                     require('./components/libros/VistaLibros.vue'                 ).default);
const listProv     =Vue.component('listado-proveedores',       require('./components/contratos/ListadoContratos.vue'         ).default);
const cargarCont   =Vue.component('nuevo-proveedor',           require('./components/contratos/NuevoContrato.vue'            ).default);
                    Vue.component('modificar-proveedor',       require('./components/contratos/ModificarContratos.vue'       ).default);
                    Vue.component('nuevo-contrato',            require('./components/contratos/NuevoNumeroContrato.vue'      ).default);
                    Vue.component('login',                     require('./components/login/Login.vue'                        ).default);
const routes = [
    { path: '/'             ,name: 'Home'            , component: home         },
    { path: '/agente'       ,name: 'Foo'             , component: agente       },
    { path: '/vacaciones'   ,name: 'Bar'             , component: vacaciones   },
    { path: '/paraLiquidar' ,name: 'paraLiquidar'    , component: paraLiquidar },
    { path: '/libros'       ,name: 'libros'          , component: libro        },
    { path: '/contratos'    ,name: 'contratos'       , component: listProv     }
  ]

const router = new VueRouter({
    routes
});


const app = new Vue({
    store:store,    
    el: '#app',
    router,
}).$mount('#app');
