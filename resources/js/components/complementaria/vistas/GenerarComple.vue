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
                <div class="col-sm-4">

                        <label class="text"> FECHA         </label>
                        <input type="date" v-model="fecha" class="form-control badge-secondary" >
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
                    <div class="form-group row">
                        <label for="documento" class="col-sm-4 col-form-label text-center " >BONIFICACION      </label>
                        <div class="col-sm-12">
                            <select class="form-control badge-secondary" v-model="bonificacion">
                                <option value="0">0</option>
                                <option value="20" selected>20</option>
                                <option value="30">30</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <label class="text"> HORAS         </label>
                    <input type="number"  v-model="horas" @keyup="calculateComplementaria" class="form-control badge-secondary">
                </div>
                <div class="col-sm-4">
                    <label class="text"> SUBTOT         </label>
                    <input type="text" disabled v-model="subtot" class="form-control badge-secondary text-danger">
                </div>
                <div class="col-sm-4">
                    <label class="text"> BONIFICACION         </label>
                    <input type="text" disabled v-model="bonvalor" class="form-control badge-secondary text-danger">
                </div>
                <div class="col-sm-4">
                    <label class="text"> TOTAL         </label>
                    <input type="text" disabled v-model="total" class="form-control badge-secondary text-danger">
                </div>
                <br>
                <button type="submit" class="btn btn-dark">Generar Complementaria</button>
            </form>
    </div>
</template>
<script>
import axios from 'axios'
import toastr from 'toastr'
import moment from 'moment'
export default {
    data(){
        return{
            periodo:{

            },
            agente:{
            },
            legajo:         '',
            horas:          '',
            subtot:         '',
            bonvalor:       '',
            total:          '',
            bonificacion:   '',
            fecha: moment().format('YYYY-MM-DD'),
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
            let data = await axios.get(`agenincs/liquidacion/${this.agente.LEGAJO}`)
            this.agente = data.data[0]
            
        },
        calculateComplementaria(){
            this.subtot      = Math.round((this.horas * this.agente.VALOR) *100)/100
            this.bonvalor    = Math.round((this.subtot* this.bonificacion))/100
            this.total       = this.subtot + this.bonvalor
        },
        async saveComplementaria(){
            let complementaria= {
                leg:             this.agente.LEGAJO,
                periodo:         this.periodo.periodo,
                anio:            this.periodo.anio,
                horas:           this.horas,
                inciso:          this.agente.IDINC,
                valor:           this.agente.VALOR,
                bonificacion:    this.bonificacion,
                subtot:          this.subtot,
                bonvalor:        this.bonvalor,
                total:           this.total,
                hospital:        this.agente.IDHOSP,
                fecha:           moment(this.fecha).format('YYYY-MM-DD')
            }
            
            if(!complementaria.leg || !this.periodo || !this.horas){
                toastr.error('el campo legajo debe estar completo e invocado')
                return
            }
            try {
                let save = await axios.post('complementaria/store',complementaria);
                this.legajo=         ''
                this.horas=          ''
                this.subtot=         ''
                this.bonvalor=       ''
                this.total=          ''
                this.bonificacion=   ''
                this.agente=         {}
                this.periodo =       {}
                toastr.success('Complementaria guardada correctamente')   
            } catch (error) {
                toastr.error('Ocurrio un error')
            }

        }
    },
    computed:{
        periodos(){
            return this.$store.state.periodos
        },
    }
    
}
</script>