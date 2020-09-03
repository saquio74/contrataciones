<template>
    <div>

        <form  @submit.prevent="getComplementaria" >
            <div class="col-sm-3 " v-if="rol.special =='all-access'">
                <label class="text"> hospital    </label>
                <select class="form-control badge-secondary" v-model="hospital" id="hospital" name='hospital'>
                    <option value=''>seleccione</option>
                    <option v-for="hosp in hospitales" :key="hosp.ID" :value="hosp.ID" >{{hosp.HOSPITAL}}</option>
                </select>
            </div>
            <div class="col-sm-3 " v-else>
                <label class="text"> hospital    </label>
                <select class="form-control badge-secondary" v-model="hospital" id="hospital" name='hospital'>
                    <option value=''>seleccione</option>
                    <option v-for="hosp in hospitalesAux" :key="hosp.ID" :value="hosp.ID" >{{hosp.HOSPITAL}}</option>
                </select>
            </div>
            
            <div class="col-sm-3 ">
                <label class="text"> fecha    </label>
                <select class="form-control badge-secondary" v-model="fecha" >
                    <option value=''>seleccione</option>
                    <option v-for="fecha in fechas" :value="fecha.fecha" :key="fecha.fecha" >{{fecha.fecha}}</option>
                </select>
            </div>
            <br>
            <button type="submit" class="btn btn-dark">Buscar complementarias</button>
        </form>
        <table class="table table-striped table-dark table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">LEGAJO</th>
                    <th scope="col">INCISO</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">HORAS</th>
                    <th scope="col">SUBTOTAL</th>
                    <th scope="col">BONIF.</th>
                    <th scope="col">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <tr  v-for="agente in comples" :key="agente.legajo" >
                    <th>
                        {{agente.legajo}}
                    </th>
                    <th>
                        {{agente.inciso}}
                    </th>
                    <th>
                        {{agente.nombre.toUpperCase()}}
                    </th>
                    <th>
                        {{agente.horas}}
                    </th>
                    <th>
                        {{agente.subtot}}
                    </th>
                    <th>
                        {{agente.bonvalor}}
                    </th>
                    <th>
                        {{agente.total}}
                    </th >
                    <th width="10px">
                        <button type="button" class="btn btn-danger" v-on:click="borrarComplementaria(agente)">
                            eliminar
                        </button>
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
import axios from 'axios'
import toastr from 'toastr'
export default {
    data(){
        return{
            hospital:{
                
            },
            periodo:{

            },
            comples:{},

            fecha:'',
            vista:0,
            aux:{

            },
            permiso:    [],
            hospitalesAux: [],
        }
    },
    created: function(){
        this.getHosp()
        this.getPeriodo()
        this.buscarPermiso();
        
    },
    methods:{
        async buscarPermiso(){
            await this.permisos.find(valor =>{
                let cadena = valor.name.split(" ")
                if(cadena[0]=='Liquidar'){
                    this.permiso.push(valor.slug)
                }
            })
            await this.hospitales.find(hospital=>{
                this.permiso.find(perm => {
                    
                    if(perm == hospital.ID){
                        this.hospitalesAux.push(hospital)
                    }
                })
            })
            
        },
        async getHosp(){
            await this.$store.dispatch('getHospitales')
        },
        getPeriodo(){
            this.$store.dispatch('getPeriodos')
        },
        getFechas(){
            this.$store.dispatch('getFechas')
        },
        async getComplementaria(){
            let complementaria = {
                periodo:        this.periodo.periodo,
                anio:           this.periodo.anio,
                hospital:       this.hospital.HOSPITAL,
                hospital_id:    this.hospital.ID,
                fecha:          this.fecha
            }
            if(!this.periodo || !this.hospital || !this.fecha){
                toastr.error('no puedes generar un PDF sin esos datos')
            }
            try {
                
                let response       = await axios.post('complementaria/get',complementaria)
                this.comples        = response.data
            } catch (error) {
                toastr.error(error)
            }
        },
        async borrarComplementaria(agente){
            try {
                let response    = await axios.delete(`complementaria/delete/${agente.id}`)
                this.getComplementaria()
                this.getFechas()
                toastr.success('borrado correctamente')
            } catch (error) {
                toastr.error(error)
            }
        }
    },
    computed:{
        hospitales(){
            return this.$store.state.hospitales
        },
        periodos(){
            return this.$store.state.periodos
        },
        fechas(){
            return this.$store.state.fechas
        },
        rol(){
            return this.$store.state.rol
        },
        permisos(){
            return this.$store.state.permisos
        }
    }
}
</script>