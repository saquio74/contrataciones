<template>
    <div class="bg-secondary col-sm-12 form-group" >
        <div class="col-sm-12">
            <button type="button" class="btn btn-outline-success" v-on:click="vista=2">Modificar Liquidacion</button>
            <button type="button" class="btn btn-outline-success" v-on:click="vista=1">Generar PDF</button>
            <button type="button" class="btn btn-outline-success" v-on:click="vista=0">Generar Excel</button>
        </div>
        <div class="col-sm-12" v-if="vista==1">
            <form  @submit.prevent="getPdf" >
                <div class="col-sm-3 ">
                    <label class="text"> hospital    </label>
                    <select class="form-control badge-secondary" v-model="hospital" id="hospital" name='hospital'>
                        <option value=''>seleccione</option>
                        <option v-for="hosp in hospitales" :key="hosp.ID" :value="hosp" >{{hosp.HOSPITAL}}</option>
                    </select>
                </div>
                <div class="col-sm-3 ">
                    <label class="text"> periodo    </label>
                    <select class="form-control badge-secondary" v-model="periodo" id="periodo" name='periodo'>
                        <option value=''>seleccione</option>
                        <option v-for="periodo in periodos" :value="periodo" >{{periodo.periodo+ ' ' + periodo.anio}}</option>
                    </select>
                </div>
                <br>
                <button type="submit" class="btn btn-dark">Generar PDF</button>
            </form>
        </div>
        <div class="col-sm-12" v-if="vista==0">

            <form  @submit.prevent="getExcel" >
                <div class="col-sm-3 ">
                    <label class="text"> hospital    </label>
                    <select class="form-control badge-secondary" v-model="hospital" id="hospital" name='hospital'>
                        <option value=''>seleccione</option>
                        <option v-for="hosp in hospitales" :key="hosp.ID" :value="hosp" >{{hosp.HOSPITAL}}</option>
                    </select>
                </div>
                <div class="col-sm-3 ">
                    <label class="text"> periodo    </label>
                    <select class="form-control badge-secondary" v-model="periodo" id="periodo" name='periodo'>
                        <option value=''>seleccione</option>
                        <option v-for="periodo in periodos" :value="periodo" >{{periodo.periodo+ ' ' + periodo.anio}}</option>
                    </select>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">generar Excel</button>
            </form>
        </div>
        <div class="col-sm-12" v-if="vista==2">

            <form  @submit.prevent="getLiquidacion" >
                <div class="col-sm-3 ">
                    <label class="text"> hospital    </label>
                    <select class="form-control badge-secondary" v-model="hospital" id="hospital" name='hospital'>
                        <option value=''>seleccione</option>
                        <option v-for="hosp in hospitales" :key="hosp.ID" :value="hosp" >{{hosp.HOSPITAL}}</option>
                    </select>
                </div>
                <div class="col-sm-3 ">
                    <label class="text"> periodo    </label>
                    <select class="form-control badge-secondary" v-model="periodo" id="periodo" name='periodo'>
                        <option value=''>seleccione</option>
                        <option v-for="periodo in periodos" :value="periodo" >{{periodo.periodo+ ' ' + periodo.anio}}</option>
                    </select>
                </div>
                <br>
                <button type="submit" class="btn btn-danger">Buscar Liquidacion</button>
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
                <tr  v-for="agente in liquidacionM" :key="agente.LEGAJO" >
                    <th>
                        {{agente.leg}}
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
                        {{agente.subtot.toFixed(2)}}
                    </th>
                    <th>
                        {{agente.bonvalor.toFixed(2)}}
                    </th>
                    <th>
                        {{agente.total.toFixed(2)}}
                    </th >
                    <th width="10px">
                        <button type="button" class="btn btn-warning" v-on:click="modificar(agente)" data-toggle="modal" data-target="#ModificarLiquidacion">
                            editar
                        </button>
                        <button type="button" class="btn btn-danger" v-on:click="borrarLiquidacion(agente)">
                            eliminar
                        </button>
                    </th>
                </tr>
            </tbody>
        </table>
        <modificar-liquidacion :agenteData="aux"></modificar-liquidacion>
        </div>
    </div>
    
</template>
<script>
import axios    from 'axios'
import toastr   from 'toastr'
export default {
    props:{
        verificador:{

        }
    },
    data(){
        return{
            hospital:{
                
            },
            periodo:{

            },
            vista:0,
            aux:{

            }
        }
    },
    created: function(){
        this.getHosp()
        this.getPeriodo()
        
    },
    methods:{
        async getPdf(){
            let datos={
                hospital_id:    this.hospital.ID,
                hospital:       this.hospital.HOSPITAL,
                periodo:        this.periodo.periodo,
                anio:           this.periodo.anio
            }
            if(!datos.hospital || !datos.periodo){
                toastr.error('datos vacios')
                return
            }
            try {
                let response    = await axios.post('agenfac/liquidacionpdf',datos,{responseType: 'blob'})
                let pdf         = await new Blob(
                    [response.data], 
                    {type: 'application/pdf'});
                    const fileURL = URL.createObjectURL(pdf);
                    window.open(fileURL);
                
            } catch (error) {
                console.log(error)
            }
        },
        async getExcel(){
            let datos={
                hospital_id:    this.hospital.ID,
                hospital:       this.hospital.HOSPITAL,
                periodo:        this.periodo.periodo,
                anio:           this.periodo.anio
            }
            if(!datos.hospital || !datos.periodo){
                toastr.error('datos vacios')
                return
            }
            try{
                let response    = await axios.post('agenfac/excel', datos,{responseType: 'blob'})
                let blob = new Blob(
                    [response.data],
                    {type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64"}
                );
                let link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = datos.hospital+''+'.xlsx';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }catch(error){
                console.log(error.data)
            }
        },
        async getLiquidacion(){
            let datos={
                hospital_id:    this.hospital.ID,
                hospital:       this.hospital.HOSPITAL,
                periodo:        this.periodo.periodo,
                anio:           this.periodo.anio
            }
            if(!datos.hospital || !datos.periodo){
                toastr.error('datos vacios')
                return
            }
            try {
                
                this.liquidacion    = await this.$store.dispatch('getModificarLiquidacion',datos)
                console.log(this.liquidacion.length)
                if(this.liquidacion.length>0){
                    toastr.success('contenido cargado correctamente')
                }else{
                    toastr.error(`el hospital ${this.datos.hospital} no arrojo resultados`)
                }
                
            } catch (error) {
                
            }
        },
        getHosp(){
            this.$store.dispatch('getHospitales')
        },
        getPeriodo(){
            this.$store.dispatch('getPeriodos')
        },
        async borrarLiquidacion(agente){
            try {
                await axios.delete(`agenfac/delete/${agente.id}`)
                toastr.success('borrado correctamente')
                await this.getLiquidacion()
            } catch (error) {
                toastr.error(error.error)
                console.log(error)
            }
        },
        modificar(data){
            this.aux = data
        }
    },
    computed:{
        hospitales(){
            return this.$store.state.hospitales
        },
        periodos(){
            return this.$store.state.periodos
        },
        liquidacionM(){
            return this.$store.state.liquidacionM
        }
    },
}
</script>