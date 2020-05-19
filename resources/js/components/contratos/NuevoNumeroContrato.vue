<template>
    <form v-on:submit.prevent="guardarContrato" method="post">
        <div class="modal fade" id="cargarContrato" tabindex="-1" role="dialog"  aria-hidden="true">
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
                    <p>{{contrato}}</p>
                    
                    <div class="form-group row">
                        
                        <label for="legajo"    class="col-sm-4 col-form-label text-center">PROVEEDOR   </label>
                        <div class="col-sm-8">
                            <select name="" class="form-control badge-secondary" @change="setProveedorId" v-model="proveedorAux">
                                <option value="0">SELECCIONE</option>
                                <option v-for="proveedors in proveedor":value="proveedors" >{{proveedors.proveedor}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="horario"   class="col-sm-4 col-form-label text-center ">APELLIDO   </label>
                        <div class="col-sm-8">
                            <input type="disabled" class="form-control text-danger badge-secondary" v-model="proveedorAux.apellido">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="horario"   class="col-sm-4 col-form-label text-center ">NOMBRE   </label>
                        <div class="col-sm-8">
                            <input type="disabled" class="form-control text-danger badge-secondary" v-model="proveedorAux.nombre">
                        </div>
                    </div>
                    <div class="form-group row">
                        
                        <label for="legajo"    class="col-sm-4 col-form-label text-center">ESPECIALIDAD   </label>
                        <div class="col-sm-8">
                            <select name="" class="form-control badge-secondary" v-model="contrato.especialidad_id">
                                <option value="">SELECCIONE</option>
                                <option v-for="especialidad in especialidades" :value="especialidad.id" :key="especialidad.id" >{{especialidad.especialidad}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="horario"   class="col-sm-4 col-form-label text-center ">CONTRATO   </label>
                        <div class="col-sm-8">
                            <input type="disabled" class="form-control text-danger badge-secondary" v-model="contrato.contrato">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="documento" class="col-sm-4 col-form-label text-center ">FECHA INICIO</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control badge-secondary" v-model="contrato.fecha_inicio">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="documento" class="col-sm-4 col-form-label text-center ">FECHA FIN</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control badge-secondary" v-model="contrato.fecha_fin">
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
import moment   from 'moment'
//import Axios    from 'axios'
export default {
    data(){
        return{
            contrato:{
                proveedor_id:         0,
                especialidad_id:      '',
                contrato:             '',
                fecha_inicio:         '',
                fecha_fin:            '',
            },
            errors:'',
            verificador:    0,
            proveedores: [],
            proveedorAux:   [],
            contratoAux: [],
        }
    },
    methods:{
        setProveedorId(){
            this.contrato.proveedor_id = this.proveedorAux.id;
        },
        guardarContrato(){
            const url = "/contrataciones-1/public/contratos/store";
           
            this.contrato.fecha_inicio  = moment(this.contrato.fecha_inicio).format("YYYY-MM-DD")
            this.contrato.fecha_fin     = moment(this.contrato.fecha_fin).format("YYYY-MM-DD")
            
            let c_fecha_inicio  = moment(this.contrato.fecha_inicio).toDate();
            let c_fecha_fin     = moment(this.contrato.fecha_fin).toDate();
            
            let existeContrato = this.buscar(this.contrato.contrato)
            
            if(c_fecha_inicio>c_fecha_fin){
                toastr.warning('la fecha de inicio no puede ser mayor a la de finalizacion')
            }else if(existeContrato){
                toastr.warning('ya existe contrato activo')
            }else{
                axios.post(url, this.contrato).then(Response=>{
                    $('#cargarContrato').modal('hide');
                    this.contrato.proveedor_id              = 0;
                    this.contrato.especialidad_id           = '';
                    this.contrato.contrato                  = '';
                    this.contrato.fecha_inicio              = '';
                    this.contrato.fecha_fin                 = '';
                    this.proveedorAux                       = [];
                    this.cont();
                    this.contBajas();
                    toastr.success('contrato cargado correctamente');
                }).catch(errors=>{
                    toastr.error('error',errors);
                });
            }
        },
        cont(){
            return this.$store.dispatch('getContratos')
        },
        contBajas(){
            return this.$store.dispatch('getContratosBajas')
        },
        buscar(contratos){
            let auxiliar = 0
            this.contratoAux = this.contratosActivos
                
            this.contratoAux.find(Response=>{
                if(Response.contrato == contratos){
                    auxiliar = 1
                    
                }
            })
            return auxiliar;
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
        especialidades(){
            return this.$store.state.especialidades
        },
        proveedoress(){
            
            return this.$store.state.proveedor
        },
        proveedor(){
            this.proveedores = this.proveedoress
            this.proveedores = this.proveedores.sort(function(a,b){
                return (a.proveedor - b.proveedor)
            });
            return this.proveedores
        }
    }
}
</script>