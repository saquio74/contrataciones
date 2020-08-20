import VueRouter from 'vue-router'
Vue.use(VueRouter);

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
const contaduria   =Vue.component('contaduria',                require('./components/contaduria/Contaduria.vue'              ).default);

const routes = [
    { path: '/'             ,name: 'Home'            , component: home         },
    { path: '/agente'       ,name: 'Foo'             , component: agente       },
    { path: '/vacaciones'   ,name: 'Bar'             , component: vacaciones   },
    { path: '/paraLiquidar' ,name: 'paraLiquidar'    , component: paraLiquidar },
    { path: '/contaduria'   ,name: 'contaduria'      , component: contaduria }
  ]

export const router = new VueRouter({
    routes


});