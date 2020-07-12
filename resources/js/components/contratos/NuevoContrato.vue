<template>
    <form v-on:submit.prevent="crearProveedor" method="post">
        <div class="modal fade" id="cargar" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header badge-dark">
                    <h5 class="Nuevo Agente" id="nuevo">Nuevo Agente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body badge-dark">
                   
                    <hr>
                    <p>{{proveedor}}</p>
                    
                    <div class="form-group row">
                        
                        <label for="legajo"    class="col-sm-4 col-form-label text-center">PROVEEDOR   </label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control text-danger badge-secondary" v-model="proveedor.proveedor">
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
                            <select name="" id="hospital" class="form-control badge-secondary" v-model="proveedor.hospital">
                                <option value="">SELECCIONE</option>
                                <option v-for="hospital in hospitales" :key="hospital.ID" :value="hospital.ID">{{hospital.HOSPITAL}}</option>
                                
                            </select>
                        </div>
                    </div>
                    <span v-for="error in errors" :key="error" class="text-danger">{{error}}</span>
                    
                </div>
                <div class="modal-footer badge-secondary">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" v-on:click="verificador++">Agregar Proveedor</button>
                    
                </div>
                </div>
            </div>
        </div>
    </form>
</template>
<script>
import axios    from 'axios'
import toastr   from 'toastr'

export default {
    data(){
        return{
            proveedor:{
                proveedor:  0,
                nombre:     '',
                apellido:   '',
                dni:        '',
                cuil:       '',
                genero:     '',
                matricula:  '',
                hospital:   '',
            },
            errors:'',
            verificador: 0.
        }
    },
    methods:{
        crearProveedor:  function(){
            let existProveedor = this.getProveedor(this.proveedor.proveedor)
            let url = 'proveedor/nuevo'
            
            if(existProveedor && this.verificador == 1){
                toastr.warning('existe un proveedor con ese numero o DNI, presione nuevamente si desea ingresarlo');
            }else{
                axios.post(url,this.proveedor).then(response=>{
                    console.log(url)
                    console.log(response.data)
                    toastr.success('contenido cargado satisfactoriamente');
                    this.verificador = 0
                    this.cont()
                    this.contBajas()
                    $('#cargar').modal('hide');
                }).catch(errors=>{
                    this.errors = errors.response.data
                });
            }
        },
        getProveedor(proveedor){
            var contratado = this.contratosActivos.find(x=>{
                if(x.proveedor == this.proveedor.proveedor){
                    return -1
                }
            })
            if(contratado == null){
                contratado = this.contratosBajas.find(x=>{
                    if(x.proveedor == this.proveedor.proveedor){
                        return -1
                    }
                })
            }
            if(contratado == null){
                contratado = this.contratosActivos.find(x=>{
                    if(x.dni == this.proveedor.dni){
                        return -1
                    }
                })
            }
            if(contratado == null){
                contratado = this.contratosBajas.find(x=>{
                    if(x.dni == this.proveedor.dni){
                        return -1
                    }
                })
            }
            return contratado
        },
        cont(){
            return this.$store.dispatch('getContratos')
        },
        contBajas(){
            return this.$store.dispatch('getContratosBajas')
        },
        
    },
    computed:{
        hospitales(){
            return this.$store.state.hospitales
        },
        contratosActivos(){
            return this.$store.state.contratos
        },
        contratosBajas(){
            return this.$store.state.contratosBajas
        },
    }
}
</script>