import Vue from 'vue';
import Vuex from 'vuex';
//import mapState from 'map'
import axios from 'axios';
Vue.use(Vuex);

export const store = new Vuex.Store({
    state:{
        hospitales:[],
        agentes:[],
    },
    mutations: {
        llenarHospitales(state,hosp){
            state.hospitales = hosp
        },
        llenarAgentes(state,agente){
            state.agentes = agente
        }
        
    },
    actions: {
        getHospitales: async function({commit}){
            const data = await fetch('/contrataciones-1/public/hospitales')
            const hospitalesAux = await data.json();
            
            commit('llenarHospitales',hospitalesAux)
        },
        getAgentes: async function({commit}) {
            const data = await fetch('/contrataciones-1/public/agente/agente')
            const agentes = await data.json();
            commit('llenarAgentes',agentes)
        }
    }
});