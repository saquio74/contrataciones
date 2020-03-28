<template >
    <form v-on:submit.prevent="modificarAgente" method="post">
        <div class="modal fade" id="ModificarAgente" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header badge-dark">
                    <h5 class="Modificar Agente" id="modificar">Modificar Agente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body badge-dark">
                    
                    <hr>
                    <p>{{agente}}</p>
                    
                    <div class="form-group row">
                        <label for="legajo"    class="col-sm-4 col-form-label text-center">LEGAJO   </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control badge-secondary" v-model="agente.legajo"  value=''>
                        </div>
                    </div>
                    <div class="form-group row">
                        
                        <label for="documento" class="col-sm-4 col-form-label text-center ">DNI      </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control badge-secondary" v-model="agente.dni"  value=''>
                        </div>
                    </div>
                    <div class="form-group row">
                        
                        <label for="horario"   class="col-sm-4 col-form-label text-center ">NOMBRE   </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control badge-secondary" v-model="agente.nombre"  value=''>
                        </div>
                    </div>
                    <div class="form-group row">
                        
                        <label for="horario"   class="col-sm-4 col-form-label text-center ">TELEFONO </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control badge-secondary" v-model="agente.telefono"  value=''>
                        </div>
                    </div>
                    <div class="form-group row">
                        
                        <label for="legajo"    class="col-sm-4 col-form-label text-center ">HOSPITAL </label>
                        <div class="col-sm-8">
                            <select  class="form-control badge-secondary" v-model="agente.idhosp" >
                                <option selected v-for="hosp in hospitalAux"     :key="hosp.ID" :value="hosp.ID">{{hosp.HOSPITAL}}</option>
                                <option v-for="hosp in listaHospitales" :key="hosp.ID" :value="hosp.ID" >{{hosp.HOSPITAL}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        
                        <label for="legajo" class="col-sm-4 col-form-label text-center ">INCISO     </label>
                        <div class="col-sm-8">
                            <select multiple class="form-control badge-secondary" v-model="agente.inciso">
                            <option v-for="inc in incisos" :value="inc.ID" :key="inc.ID" >{{inc.INCISO}}</option>       
                            </select>
                        </div>
                    </div>  
                    <div class="form-group row">
                        
                        <label for="legajo" class="col-sm-4 col-form-label text-center ">SERVICIO     </label>
                        <div class="col-sm-8">
                            <select  class="form-control badge-secondary" v-model="agente.idservicio" >
                                <option value="">Seleccione</option>
                                <option v-for="serv in listaServicios" :value="serv.ID" :key="serv.ID">{{serv.SERVICIO}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        
                        <label for="legajo"   class="col-sm-4 col-form-label text-center ">SECTOR </label>
                        <div class="col-sm-8">
                            <select  class="form-control badge-secondary" v-model="agente.sec" >
                                <option value="">Seleccione</option>
                                <option v-for="sect in listaSectores" :value="sect.ID" :key="sect.SECTOR">{{sect.SECTOR}}</option>
                                        
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        
                        <label for="horario"   class="col-sm-4 col-form-label text-center ">HORARIO </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control badge-secondary" v-model="agente.horario"  value=''>
                        </div>
                    </div>
                    <span v-for="error in errors" :key="error" class="text-danger">{{error}}</span>
                    
                </div>
                <div class="modal-footer badge-secondary">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" @click="$emit('speak')">Agregar Agente</button>
                </div>
                </div>
            </div>
        </div>
     </form>
</template>
<script>
    import toastr from 'toastr'
    import moment from 'moment'
    import axios  from 'axios';
    
    export default {
        props:{
            listaHospitales:{

            },
            listaServicios:{

            },
            listaSectores:{

            },
            agenteModificar:{

            }
        },
        data(){
            
            return {
                hospitales:[],
                servicios:[],
                sectores:[],
                hospitalAux:[],
                agenInc:[],
                incisos:[],
                agente:{
                    legajo: '',
                    dni:'',
                    nombre:'',
                    telefono:'',
                    idhosp:'',
                    inciso:[],
                    sec:'',
                    idservicio:'',
                    horario:'',
                    activo:0,
                },
                errors:[],
                auxiliar:0,
            }
        },
        
        created: function(){
            this.getIncisos();
        },
        methods:{
            getIncisos:function(){
                var urlIncisos = '/contrataciones-1/public/incisos';
                axios.get(urlIncisos).then(Response=>{
                    this.incisos = Response.data
                });

            },
            resetInciso:function(){
                this.agente.inciso = []
            },
            getAgenInc:function(inciso){
                var urlIncisos = '/contrataciones-1/public/agenincs/' + inciso;
                axios.get(urlIncisos).then(Response=>{
                    this.resetInciso()
                    this.agenInc = Response.data
                    var agen
                    for(agen of this.agenInc){
                        this.agente.inciso.push(agen.ID)
                    }
                });
            },
            modificarAgente:function(){
                var urlAgentes = '/contrataciones-1/public/agente/update';
                axios.post(urlAgentes,this.agente).then(response=>{
                    console.log(urlAgentes);
                    $('#ModificarAgente').modal('hide');
                    toastr.success('agente modificado satisfactoriamente satisfactoriamente');
                }).catch(errors=>{
                    this.errors = errors.response.data
                });
            },
            buscarAgente:function(){
                this.agente.legajo      = this.agenteModificar.LEGAJO
                this.agente.dni         = this.agenteModificar.DNI
                this.agente.nombre      = this.agenteModificar.NOMBRE
                this.agente.telefono    = this.agenteModificar.TELEFONO
                this.agente.idhosp      = this.agenteModificar.IDHOSP
                this.agente.sec         = this.agenteModificar.SEC
                this.agente.idservicio  = this.agenteModificar.IDSERVICIO
                this.agente.horario     = this.agenteModificar.HORARIO
                this.getAgenInc(this.agenteModificar.LEGAJO);
                //this.agente.inciso      = this.agenInc.id
                
                

                
                
            },
            
            
        },
        watch:{
            agenteModificar:{
                handler: function(){
                    this.buscarAgente();
                    
                } 
            }
        },
        
        
    
    }
</script>