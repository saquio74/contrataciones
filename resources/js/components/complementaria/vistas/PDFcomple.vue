<template>
    <form  @submit.prevent="getPdf" >
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
            <label class="text"> periodo    </label>
            <select class="form-control badge-secondary" v-model="periodo" id="periodo" name='periodo'>
                <option value=''>seleccione</option>
                <option v-for="periodo in periodos" :value="periodo"  >{{periodo.periodo+ ' ' + periodo.anio}}</option>
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
        <button type="submit" class="btn btn-dark">Generar PDF</button>
    </form>
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
        this.getFechas()
        this.buscarPermiso()
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
        async getPdf(){
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
                let response = await axios.post('complementaria/getPDF',complementaria,{responseType: 'blob'})
                
                let pdf      = await new Blob(
                    [response.data], 
                    {type: 'application/pdf'});
                    const fileURL = URL.createObjectURL(pdf);
                    window.open(fileURL);
            } catch (error) {
                toastr.error(error.response)
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