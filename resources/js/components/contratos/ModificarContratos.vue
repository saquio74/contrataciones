<template>
    <form v-on:submit.prevent="updateProveedor" method="post">
        <div class="modal fade" id="modificar" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header badge-dark">
                    <h5 class="Nuevo Agente" id="nuevo">Modificar proveedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body badge-dark">
                   
                    <hr>
                    
                    
                    <div class="form-group row">
                        
                        <label for="legajo"    class="col-sm-4 col-form-label text-center">PROVEEDOR   </label>
                        <div class="col-sm-8">
                            <input type="number" disabled class="form-control text-danger badge-secondary" v-model="proveedor.proveedor">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="horario"   class="col-sm-4 col-form-label text-center ">NOMBRE   </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control text-danger badge-secondary" v-model="proveedor.nombre">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="horario"   class="col-sm-4 col-form-label text-center ">APELLIDO   </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control text-danger badge-secondary" v-model="proveedor.apellido">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="documento" class="col-sm-4 col-form-label text-center " >DNI      </label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control badge-secondary" v-model="proveedor.dni">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="documento" class="col-sm-4 col-form-label text-center ">CUIL      </label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control badge-secondary" v-model="proveedor.cuil">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="documento" class="col-sm-4 col-form-label text-center ">GENERO      </label>
                        <div class="col-sm-8">
                            <select name=""  class="form-control badge-secondary" v-model="proveedor.genero">
                                <option value="">SELECCIONE</option>
                                <option value="F">FEMENINO</option>
                                <option value="M">MASCULINO</option>
                                <option value="U">NO REFIERE</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="documento" class="col-sm-4 col-form-label text-center ">MATRICULA      </label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control badge-secondary" v-model="proveedor.matricula">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="documento" class="col-sm-4 col-form-label text-center ">HOSPITAL      </label>
                        <div class="col-sm-8">
                            <select name="" class="form-control badge-secondary" v-model="proveedor.hospital_id">
                                <option value="">SELECCIONE</option>
                                <option v-for="hospital in hospitales" :key="hospital.ID" :value="hospital.ID">{{hospital.HOSPITAL}}</option>
                                
                            </select>
                        </div>
                    </div>
                    <span v-for="error in errors" class="text-danger">{{error}}</span>
                    
                </div>
                <div class="modal-footer badge-secondary">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" @click="$emit('speak')">Modificar Proveedor</button>
                </div>
                </div>
            </div>
        </div>
     </form>
</template>
<script>
import axios from 'axios';
import toastr from 'toastr';
export default {
    props:{
        proveedorModificar:{

        },
    },
    data(){
        return{
            proveedor:{
                
            },
            errors:'',
        }

    },
    mounted: function(){
        //this.getProveedor();
    },
    methods:{
        async getProveedor(){
            try {
                let data        = await axios.get(`proveedor/${this.proveedorModificar.id}`)
                let proveedor   = data.data[0]
                this.proveedor = proveedor
                
            } catch (errors) {
                this.errors = errors
                toastr.error('ocurrio un error')
            }
        },
        async updateProveedor(){
            try {
                let data        = await axios.put(`proveedor/update`, this.proveedor)
                await this.$store.dispatch('getProveedores')
                
                toastr.success('proveedor modificado correctamente')
                $('#modificar').modal('hide');
                this.proveedor  ={};
                this.errors     = ''

            } catch (e) {
                this.errors = e.response.data
                toastr.error('ocurrio un error')
            }
        }
    },
    computed:{
        hospitales(){
            
            return this.$store.state.hospitales
        }
    },
    watch:{
        proveedorModificar:{
            handler: function(){
                this.getProveedor()
            }
        }
    }
}
</script>