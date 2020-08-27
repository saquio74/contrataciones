import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';
import { data } from 'jquery';
axios.defaults.withCredentials = true;

Vue.use(Vuex);

export const store = new Vuex.Store({
    state:{
        hospitales:     [],
        liquidacion:    [],
        agentes:        [],
        agenFac:        [],
        contratos:      [],
        servicios:      [],
        sectores:       [],
        contratosBajas: [],
        especialidades: [],
        liquidacionM:   [],
        vacaciones:     [],
        periodos:       [],
        modificar:      [],
        user:           null,
        rol:            null,
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
        llenarVacaciones(state,vacaciones){
            state.vacaciones         = vacaciones
        },
        SET_USER(state, user){
            state.user              = user;
            state.auth              = Boolean(user);
        },
        SET_ROL(state, rol){
            state.rol               = rol
        },
        llenarAgenfac(state,agenFac){
            state.agenFac           = agenFac
        },
        llenarLiquidacion(state,liquidacion){
            state.liquidacion       = liquidacion
        },
        llenarPeriodos(state,periodos){
            state.periodos          = periodos
        },
        llenarModificar(state,liquidacion){
            state.liquidacionM         = liquidacion
        }
        
    },
    actions: {
        getHospitales: async function({commit}){
            const data              = await fetch('hospitales')
            const hospitales        = await data.json();
            return commit('llenarHospitales',hospitales)
        },
        async getPeriodos({commit}){
            const data              = await fetch('agenfac/periodo')
            const periodos          = await data.json()
            return commit('llenarPeriodos', periodos)
        },
        async getLiquidacion({commit},datos){
            const liquidacion       = await axios.post('agenfac/liquidacion',datos)
            console.log(liquidacion)
            return commit('llenarLiquidacion',liquidacion.data[0])
        },
        async getModificarLiquidacion({commit},datos){
            const liquidacion       = await axios.post('agenfac/modificar',datos)
            return commit('llenarModificar',liquidacion.data[0])
        },
        async getLiquidar({commit},datos){
            
            const data              = await axios.post('agenincs/hosp',datos)
            const agentes           = await data.data[0]
            return commit('llenarAgenfac', agentes) 
        },
        getVacaciones: async function({commit}){
            const data              = await fetch('vacaciones/vacaciones')
            const vacaciones        = await data.json();
            return commit('llenarVacaciones', vacaciones[0])
        },
        getAgentes: async function({commit}) {
            const data              = await fetch('agente/agente')
            const agentes           = await data.json()
            return commit('llenarAgentes',agentes)
        },
        getContratos: async function ({commit}) {
            const data              = await fetch('contrato/activos')
            const contratos         = await data.json()
            commit('llenarContratos',contratos)
        },
        getContratosBajas: async function ({commit}){
            const dataBajas         = await fetch('contrato/bajas')
            const contratosBajas    = await dataBajas.json()
            commit('llenarContratosBajas',contratosBajas)
        },
        getEspecialidades: async function({commit}){
            const data                   = await fetch('especialidades')
            const especialidades         = await data.json()
            commit('llenarEspecialidades',especialidades)
        },
        getServicios: async function({commit}){
            const data              = await fetch('servicios')
            const servicios         = await data.json()
            
            return commit('llenarServicios',servicios)
        },
        getSectores:  async function ({commit}){
            const data              = await fetch('sectores')
            const sectores          = await data.json()
            return commit('llenarSectores', sectores)
        },
        getProveedores:  async function ({commit}){
            const data              = await fetch('proveedor')
            const proveedor          = await data.json()
            
            return commit('llenarProveedores', proveedor)
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
        async getUser({commit}){
            const url = 'api/user';
            return axios.get(url).then(Res =>{//promesa con usuarios
                const urlRol =`roles/${Res.data.rol_id}`;
                axios.get(urlRol).then(Response=>{//promesa con roles
                    commit('SET_ROL', Response.data[0])
                }).catch(e=>{
                    commit('SET_ROL', null)
                })
                commit('SET_USER', Res.data)
            }).catch(e=>{
                commit('SET_USER', null)
            })
        },
        
    }
});