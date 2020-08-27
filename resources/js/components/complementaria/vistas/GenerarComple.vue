<template>
    <div>
        <form  @submit.prevent="saveComplementaria" >
                <div class="col-sm-4 ">
                    <label class="text"> periodo    </label>
                    <select class="form-control badge-secondary" v-model="periodo" id="periodo" name='periodo'>
                        <option value=''>seleccione</option>
                        <option v-for="periodo in periodos" :value="periodo" >{{periodo.periodo+ ' ' + periodo.anio}}</option>
                    </select>
                </div>
                <div class="row col-sm-6">
                    <div class="col-sm-8">

                        <label class="text"> LEGAJO         </label>
                        <input type="int" v-model="agente.LEGAJO" class="form-control badge-secondary" >
                    </div>
                    <div class="col-sm-4">
                        <br>
                        <br>
                        <button type="button" class="btn btn-primary" @click="buscarAgente()"> buscar</button>
                    </div>
                </div>
                <div class="col-sm-4">
                    <label class="text"> NOMBRE         </label>
                    <input type="text" disabled v-model="agente.NOMBRE" class="form-control badge-secondary text-danger">
                </div>
                <div class="col-sm-4">
                    <label class="text"> HORAS         </label>
                    <input type="number"  v-model="complementaria.horas" class="form-control badge-secondary">
                </div>
                <div class="col-sm-4">
                    <label class="text"> BONIFICACION         </label>
                    <input type="number"  v-model="complementaria.horas" class="form-control badge-secondary">
                </div>
                <div class="col-sm-4">
                    <label class="text"> SUBTOT         </label>
                    <input type="text" disabled v-model="agente.NOMBRE" class="form-control badge-secondary text-danger">
                </div>
                <div class="col-sm-4">
                    <label class="text"> BONIFICACION         </label>
                    <input type="text" disabled v-model="agente.NOMBRE" class="form-control badge-secondary text-danger">
                </div>
                <div class="col-sm-4">
                    <label class="text"> TOTAL         </label>
                    <input type="text" disabled v-model="agente.NOMBRE" class="form-control badge-secondary text-danger">
                </div>
                <br>
                <button type="submit" class="btn btn-dark">Generar Complementaria</button>
            </form>
    </div>
</template>
<script>
import axios from 'axios'
export default {
    data(){
        return{
            hospital:{
                
            },
            complementaria:{},
            periodo:{

            },
            legajo:'',
            agente:{

            }
        }

    },
    created(){
        
        this.getPeriodo()
    },
    methods:{
        
        getPeriodo(){
            this.$store.dispatch('getPeriodos')
        },
        async buscarAgente(){
            let data = await axios.get(`agente/${this.agente.LEGAJO}`)
            this.agente = data.data[0]
            console.log(this.agente)
            
        },
        saveComplementaria(){

        }
    },
    computed:{
        periodos(){
            return this.$store.state.periodos
        },
    }
    
}
</script>