<template>
    <div class="col-sm-12" v-if="rol.id==1">
        <div class="col-sm-12">
            
            <button type="button" class="btn btn-outline-success" v-on:click="vista=0">Agregar Inciso</button>
            <button type="button" class="btn btn-outline-success" v-on:click="vista=1">Modificar Incisos</button>
            <br>
            
        </div>
        <div class="col-sm-12" v-if="vista == 0">
            <div class="row col-sm-12">
                <div class="col-sm-4">
                    <label for="" class="text-white">INCISO</label>
                    <input type="text" v-model="nInciso.inciso" class="form-control badge-secondary">
                </div>
                <div class="col-sm-4">
                    <label for="" class="text-white">VALOR</label>
                    <input type="text" v-model="nInciso.valor" class="form-control badge-secondary">
                </div>
                <div class="col-sm-4">
                    <br>
                    <button type="button" class="btn btn-primary" v-on:click="agregarInciso()">
                        Agregar Inciso
                    </button>
                </div>
            </div>
        </div>
        <div v-if="vista==1">
            <table class="table table-striped table-dark table-bordered table-hover">
                <thead>
                    <tr>
                        
                        <th scope="col">INCISO</th>
                        <th scope="col">VALOR</th>
                        <th scope="col">BORRAR</th>
                    </tr>
                </thead>
                <tbody>
                    <tr  v-for="inciso in incisos" :key="inciso.ID" >
                        <th>
                            {{inciso.INCISO}}
                        </th>
                        <th>
                            <div class="row col-sm-12">
                                <div class="col-sm-8">

                                    <input type="text" v-model="inciso.VALOR" class="form-control badge-secondary">
                                </div>
                                <div class="col-sm-4">
                                    <button type="button" class="btn btn-primary" v-on:click="modificarInciso(inciso)">
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </th>
                        <th width="10px">
                            
                            <button type="button" class="btn btn-outline-danger" v-on:click="borrarInciso(inciso)">
                                eliminar
                            </button>
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
        <!--<modificar-inciso :agenteData="aux"></modificar-inciso>-->
    </div>
    <div v-else>
        <h2 class="display-1">
            no pose permiso para entrar aqui
        </h2>
    </div>
    
</template>
<script>
import axios from 'axios'
import toastr from 'toastr'
export default {
    data(){
        return{
            valor:'',
            nInciso:{
                inciso:'',
                valor:''
            },
            vista:0,
        }
    },
    created(){
        this.getIncisos();
    },
    methods:{
        async getIncisos(){
            await this.$store.dispatch('getIncisos')
        },
        async modificarInciso(incisoModificar){
            let inciso = {
                id:     incisoModificar.ID,
                inciso: incisoModificar.INCISO,
                valor:  incisoModificar.VALOR
            }
            try {
                await axios.put('inciso/update', inciso)
                this.getIncisos()
                toastr.success('guardado correctamente')
            } catch (error) {
                toastr.error(error)
            }
        },
        async agregarInciso(){
            try {
                await axios.post('inciso/store', this.nInciso)
                this.getIncisos()
                this.nInciso.inciso = ''
                this.nInciso.valor  = ''
                toastr.success('Agregado Correctamente')
            } catch (error) {
                toastr.error(error)
            }
        },
        async borrarInciso(inciso){
            try {
                await axios.delete(`inciso/delete/${inciso.ID}`)
                await this.getIncisos()
                toastr.success('Borrado Correctamente')
            } catch (error) {
                toastr.error(error)
            }
        }
    },
    computed:{
        incisos(){
            return this.$store.state.incisos
        },
        rol(){
            return this.$store.state.rol
        }
    }
    
}
</script>