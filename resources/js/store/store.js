import Vue from 'vue';
import Vuex from 'vuex';

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
    },
    mutations: {
        llenarHospitales(state,hosp){
            state.hospitales = hosp
        },
        llenarAgentes(state,agente){
            state.agentes   = agente
        },
        llenarContratos(state,contratos){
            state.contratos = contratos  
        },
        llenarServicios(state,servicios){
            state.servicios = servicios
        },
        llenarSectores(state,sectores){
            state.sectores  = sectores
        },
        llenarContratosBajas(state,contratosBajas){
            state.contratosBajas    = contratosBajas
        },
        llenarEspecialidades(state,especialidades){
            state.especialidades    = especialidades
        },
        llenarProveedores(state,proveedor){
            state.proveedor         = proveedor
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
    }
});