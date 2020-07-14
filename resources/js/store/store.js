import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';
axios.defaults.withCredentials = true;

Vue.use(Vuex);

export const store = new Vuex.Store({
    state:{
        hospitales:     [],
        agentes:        [],
        contratos:      [],
        servicios:      [],
        sectores:       [],
        contratosBajas: [],
        especialidades: [],
        proveedor:      [],
        user:           null,
        auth:           false,
    },
    mutations: {
        llenarHospitales(state,hosp){
            state.hospitales        = hosp
        },
        llenarAgentes(state,agente){
            state.agentes           = agente
        },
        llenarContratos(state,contratos){
            state.contratos         = contratos  
        },
        llenarServicios(state,servicios){
            state.servicios         = servicios
        },
        llenarSectores(state,sectores){
            state.sectores          = sectores
        },
        llenarContratosBajas(state,contratosBajas){
            state.contratosBajas    = contratosBajas
        },
        llenarEspecialidades(state,especialidades){
            state.especialidades    = especialidades
        },
        llenarProveedores(state,proveedor){
            state.proveedor         = proveedor
        },
        SET_USER(state, user){
            state.user              = user;
            state.auth              = Boolean(user);
        }
        
    },
    actions: {
        getHospitales: async function({commit}){
            const data              = await fetch('/contrataciones-1/public/hospitales')
            const hospitalesAux     = await data.json();
            
            commit('llenarHospitales',hospitalesAux)
        },
        getAgentes: async function({commit}) {
            const data              = await fetch('/contrataciones-1/public/agente/agente')
            const agentes           = await data.json()
            commit('llenarAgentes',agentes)
        },
        getContratos: async function ({commit}) {
            const data              = await fetch('/contrataciones-1/public/contrato/activos')
            const contratos         = await data.json()
            commit('llenarContratos',contratos)
        },
        getContratosBajas: async function ({commit}){
            const dataBajas         = await fetch('/contrataciones-1/public/contrato/bajas')
            const contratosBajas    = await dataBajas.json()
            commit('llenarContratosBajas',contratosBajas)
        },
        getEspecialidades: async function({commit}){
            const data                   = await fetch('/contrataciones-1/public/especialidades')
            const especialidades         = await data.json()
            commit('llenarEspecialidades',especialidades)
        },
        getServicios: async function({commit}){
            const data              = await fetch('/contrataciones-1/public/servicios')
            const servicios         = await data.json()
            commit('llenarServicios',servicios)
        },
        getSectores:  async function ({commit}){
            const data              = await fetch('/contrataciones-1/public/sectores')
            const sectores          = await data.json()
            commit('llenarSectores', sectores)
        },
        getProveedores:  async function ({commit}){
            const data              = await fetch('/contrataciones-1/public/proveedor')
            const proveedor          = await data.json()
            commit('llenarProveedores', proveedor)
        },
        async login({dispatch},creedentials){
            const url = 'login'
            await axios.get('sanctum/csrf-cookie');
            await axios.post(url,creedentials);
            return dispatch("getUser");
        },
        async logout({dispatch}){
            const url = 'logout'
            await axios.post(url);
            return dispatch("getUser");
        },
        getUser({commit}){
            const url = 'api/user';
            axios.get(url).then(Res =>{
                commit('SET_USER', Res.data)
            }).catch(e=>{
                commit('SET_USER', null)
            })
        },
        

    }
});