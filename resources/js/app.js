
try {
    window.$ = window.jQuery = require('jquery');
    require('bootstrap');
} catch (e) {}


import toastr from 'toastr'
window.Vue = require('vue');
import axios from 'axios'
import Vuex from 'vuex'
import VueRouter from 'vue-router'

import {store} from './store/store'

Vue.use(toastr)
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
const login        =Vue.component('login',                     require('./components/login/Login.vue'                        ).default);
                    Vue.component('usuario',                   require('./components/login/UsuarioEstado.vue'                ).default);
const nuevoUsuario =Vue.component('nUsuario',                  require('./components/login/Register'                         ).default);
const contaduria   =Vue.component('contaduria',                require('./components/contaduria/Contaduria.vue'              ).default);
                    Vue.component('getPDF',                    require('./components/contaduria/vistas/GenerarPDF.vue'       ).default);
                    Vue.component('modificar-liquidacion',     require('./components/contaduria/vistas/ModificarLiquidacion.vue').default);
const comple       =Vue.component('complementaria',            require('./components/complementaria/complementaria.vue'      ).default);
                    Vue.component('borrar-comples',            require('./components/complementaria/vistas/BorrarComple.vue' ).default);
                    Vue.component('generar-comple',            require('./components/complementaria/vistas/GenerarComple.vue').default);
                    Vue.component('pdf-comples',               require('./components/complementaria/vistas/PDFcomple.vue'    ).default);
const inciso       =Vue.component('inciso',                    require('./components/incisos/VistaIncisos.vue').default)
const routes = [
    { path: '/'             ,name: 'Home'            , component: login        },
    { path: '/agente'       ,name: 'Foo'             , component: agente       },
    { path: '/vacaciones'   ,name: 'Bar'             , component: vacaciones   },
    { path: '/paraLiquidar' ,name: 'paraLiquidar'    , component: paraLiquidar },
    { path: '/libros'       ,name: 'libros'          , component: libro        },
    { path: '/login'        ,name: 'login'           , component: login        },
    { path: '/contratos'    ,name: 'contratos'       , component: listProv     },
    { path: '/contaduria'   ,name: 'contaduria'      , component: contaduria   },
    { path: '/comple'       ,name: 'complementaria'  , component: comple       },
    { path: '/inciso'       ,name: 'inciso'          , component: inciso       },
  ]

const router = new VueRouter({
    routes
});
store.dispatch('getUser')

const app = new Vue({
    store:store,
    axios,
    toastr,   
    el: '#app',
    router,
}).$mount('#app');
