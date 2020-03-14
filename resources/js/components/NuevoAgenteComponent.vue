<template >
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
                    
                    <input type="hidden" value='0' id="legajo" name='activo'>
                    
                    <div class="form-group row">
                        
                        <label for="legajo"    class="col-sm-4 col-form-label text-center">LEGAJO   </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control badge-secondary" id="legajo" name='legajo' value=''>
                        </div>
                    </div>
                    <div class="form-group row">
                        
                        <label for="documento" class="col-sm-4 col-form-label text-center ">DNI      </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control badge-secondary" id="dni" name='dni' value=''>
                        </div>
                    </div>
                    <div class="form-group row">
                        
                        <label for="horario"   class="col-sm-4 col-form-label text-center ">NOMBRE   </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control badge-secondary" id="nombre" name='nombre' value=''>
                        </div>
                    </div>
                    <div class="form-group row">
                        
                        <label for="horario"   class="col-sm-4 col-form-label text-center ">TELEFONO </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control badge-secondary" id="telefono" name='telefono' value=''>
                        </div>
                    </div>
                    <div class="form-group row">
                        
                        <label for="legajo"    class="col-sm-4 col-form-label text-center ">HOSPITAL </label>
                        <div class="col-sm-8">
                            <select  class="form-control badge-secondary" id="hospitales" name='idhosp'>
                                <option value="">Seleccione</option>
                                <option v-for="hosp in hospitales" :key="hosp.ID" :value="hosp" >{{hosp.HOSPITAL}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        
                        <label for="legajo" class="col-sm-4 col-form-label text-center ">INCISO     </label>
                        <div class="col-sm-8">
                            <select multiple class="form-control badge-secondary" id="inciso" name='inciso[]'>
                            <option v-for="inc in incisos" :value="inc.INCISO" :key="inc.ID">{{inc.INCISO}}</option>       
                                
                                        
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        
                        <label for="legajo" class="col-sm-4 col-form-label text-center ">SECTOR     </label>
                        <div class="col-sm-8">
                            <select  class="form-control badge-secondary" id="sector" name='sec'>
                                <option value="">Seleccione</option>
                                <option v-for="serv in servicios" :value="serv.SERVICIO" :key="serv.ID">{{serv.SERVICIO}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        
                        <label for="legajo"   class="col-sm-4 col-form-label text-center ">SERVICIO </label>
                        <div class="col-sm-8">
                            <select  class="form-control badge-secondary" id="servicio" name='idservicio'>
                                <option value="">Seleccione</option>
                                <option v-for="sect in sectores" :value="sect.SECTOR" :key="sect.SECTOR">{{sect.SECTOR}}</option>
                                        
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        
                        <label for="horario"   class="col-sm-4 col-form-label text-center ">HORARIO </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control badge-secondary" id="horario" name='horario' value=''>
                        </div>
                    </div>
                    
                    
                </div>
                <div class="modal-footer badge-secondary">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
                </div>
            </div>
        </div>
</template>
<script>
    import toastr from 'toastr'
    import moment from 'moment'
    export default {
        data(){
            return {
                
                hospitales: [],
                servicios:[],
                sectores:[],
                incisos:[],
                legajo: '',
                dni:'',
                nombre:'',
                hospital:{},
                servicio:'',
                sector:'',
                activo:'',
                auxiliar:0,
            }
        },
        created: function(){
            
            this.getHospitales();
            this.getServicios();
            this.getSectores();
            this.getIncisos();
        },
        methods:{
            getHospitales:function(){
                var urlHospitales = '/contrataciones-1/public/hospitales';
                axios.get(urlHospitales).then(Response=>{
                    this.hospitales = Response.data
                });
            },
            getServicios:function(){
                var urlServicios = '/contrataciones-1/public/servicios';
                axios.get(urlServicios).then(Response=>{
                    this.servicios = Response.data
                });
            },
            getSectores:function(){
                var urlSectores = '/contrataciones-1/public/sectores';
                axios.get(urlSectores).then(Response=>{
                    this.sectores = Response.data
                });
            },
            getIncisos:function(){
                var urlIncisos = '/contrataciones-1/public/incisos';
                axios.get(urlIncisos).then(Response=>{
                    this.incisos = Response.data
                });

            },
            crearAgente:function(){
                var url = '';
            }
            
        }
    }
</script>
