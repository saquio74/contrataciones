<template >
    <form v-on:submit.prevent="crearAgente" method="post">
        <div class="modal fade" id="NuevoAgente" tabindex="-1" role="dialog"  aria-hidden="true">
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
                    <p>{{agente}}</p>
                    
                    
                    
                    <div class="form-group row">
                        
                        <label for="legajo"    class="col-sm-4 col-form-label text-center">LEGAJO   </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control badge-secondary" v-model="agente.legajo" id="legajo" name='legajo' value=''>
                        </div>
                    </div>
                    <div class="form-group row">
                        
                        <label for="documento" class="col-sm-4 col-form-label text-center ">DNI      </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control badge-secondary" v-model="agente.dni" id="dni" name='dni' value=''>
                        </div>
                    </div>
                    <div class="form-group row">
                        
                        <label for="horario"   class="col-sm-4 col-form-label text-center ">NOMBRE   </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control badge-secondary" v-model="agente.nombre" id="nombre" name='nombre' value=''>
                        </div>
                    </div>
                    <div class="form-group row">
                        
                        <label for="horario"   class="col-sm-4 col-form-label text-center ">TELEFONO </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control badge-secondary" v-model="agente.telefono" id="telefono" name='telefono' value=''>
                        </div>
                    </div>
                    <div class="form-group row">
                        
                        <label for="legajo"    class="col-sm-4 col-form-label text-center ">HOSPITAL </label>
                        <div class="col-sm-8">
                            <select  class="form-control badge-secondary" v-model="agente.idhosp" id="hospitales" name='idhosp'>
                                <option value="">Seleccione</option>
                                <option v-for="hosp in hospitales" :key="hosp.ID" :value="hosp.ID" >{{hosp.HOSPITAL}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        
                        <label for="legajo" class="col-sm-4 col-form-label text-center ">INCISO     </label>
                        <div class="col-sm-8">
                            <select multiple class="form-control badge-secondary" v-model="agente.inciso" id="inciso" name='inciso[]'>
                            <option v-for="inc in incisos" :value="inc.ID" :key="inc.ID">{{inc.INCISO}}</option>       
                                
                                        
                            </select>
                        </div>
                    </div>  
                    <div class="form-group row">
                        
                        <label for="legajo" class="col-sm-4 col-form-label text-center ">SERVICIO     </label>
                        <div class="col-sm-8">
                            <select  class="form-control badge-secondary" v-model="agente.idservicio" id="sector" name='sec'>
                                <option value="">Seleccione</option>
                                <option v-for="serv in servicios" :value="serv.ID" :key="serv.ID">{{serv.SERVICIO}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        
                        <label for="legajo"   class="col-sm-4 col-form-label text-center ">SECTOR </label>
                        <div class="col-sm-8">
                            <select  class="form-control badge-secondary" v-model="agente.sec" id="servicio" name='idservicio'>
                                <option value="">Seleccione</option>
                                <option v-for="sect in sectores" :value="sect.ID" :key="sect.SECTOR">{{sect.SECTOR}}</option>
                                        
                            </select>
                        </div>
                    </div>
                        
                    <div class="form-group row">
                        
                        <label for="horario"   class="col-sm-4 col-form-label text-center ">HORARIO </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control badge-secondary" v-model="agente.horario" id="horario" name='horario' value=''>
                        </div>
                    </div>
                    <span v-for="error in errors" :key="error" class="text-danger">{{error}}</span>
                    
                </div>
                <div class="modal-footer badge-secondary">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" @click="$emit('')">Agregar Agente</button>
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
        data(){
            return {
                
                hospitales: [],
                servicios:[],
                sectores:[],
                incisos:[],
                provincias:[],
                municipios:[],
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
            
            this.getHospitales();
            this.getServicios();
            this.getSectores();
            this.getIncisos();
            //this.getProvincias();
        },
        methods:{
            getHospitales:function(){
                var urlHospitales = '/contrataciones/public/hospitales';
                axios.get(urlHospitales).then(Response=>{
                    this.hospitales = Response.data
                });
            },
            getServicios:function(){
                var urlServicios = '/contrataciones/public/servicios';
                axios.get(urlServicios).then(Response=>{
                    this.servicios = Response.data
                });
            },
            getSectores:function(){
                var urlSectores = '/contrataciones/public/sectores';
                axios.get(urlSectores).then(Response=>{
                    this.sectores = Response.data
                });
            },
            getIncisos:function(){
                var urlIncisos = '/contrataciones/public/incisos';
                axios.get(urlIncisos).then(Response=>{
                    this.incisos = Response.data
                });

            },
            crearAgente(){
                var url = 'agente/store';
                axios.post(url,this.agente).then(response=>{
                    //console.log(this.agente.inciso)
                    
                    console.log(response.data)
                    this.reset()
                    toastr.success('agente guardado satisfactoriamente');
                }).catch(errors=>{
                    this.errors = errors.response.data
                    toastr.error('ocurrio un error')
                });
            },

            reset(){
                $('#NuevoAgente').modal('hide');
                    this.agente.legajo      = '';
                    this.agente.dni         = '';
                    this.agente.nombre      = '';
                    this.agente.telefono    = '';
                    this.agente.idhosp      = '';
                    this.agente.inciso      = [];
                    this.agente.sec         = '';
                    this.agente.idservicio  = '';
                    this.agente.horario     = '';
            }
            
            
        }
    }
</script>
