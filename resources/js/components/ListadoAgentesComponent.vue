<template>
    <div class="panel panel-default   col-sm-12">

        <h1 class="text-center">Listado General de agentes</h1>
        <div class="form-group badge-black row col-sm-12">
            <button v-on:click="getActivos" type="submit" class="btn btn-outline-dark">ALTAS</button>
            <button v-on:click="getBajas"   type="submit" class="btn btn-outline-dark">BAJAS</button>
            <button v-on:click="getAgentes"  type="submit" class="btn btn-outline-dark">TODOS</button>
            <button type="submit" class="btn btn-outline-dark">VACACIONES</button>
        </div>
        
        <div class="form-group row badge-dark col-sm-12">
            <hr>
            <hr>

            <button v-on:click="getAgentes" class="btn btn-primary" v-if="!agentes.length">Listar</button>
            <div class="col-sm-2">
                <label class="text"> legajo      </label>
                <input type="int" v-model="legajo"    v-if="agentes.length" class="form-control badge-secondary" id="legajo" name='legajo'>
            </div>
            <div class="col-sm-2">
                <label class="text"> DNI      </label>
                <input type="int" v-model="dni"    v-if="agentes.length" class="form-control badge-secondary" id="legajo" name='legajo'>
            </div>
            <div class="col-sm-2">
                <label class="text"> nombre      </label>
                <input type="text" v-model="nombre"   v-if="agentes.length" class="form-control badge-secondary" id="nombre" name='nombre'>
            </div>
            <div class="col-sm-2">
                <label class="text"> hospital    </label>
                <input type="text" v-model="hospital" v-if="agentes.length" class="form-control badge-secondary" id="hospital" name='hospital'>
            </div>
            <div class="col-sm-2">
                <label class="text"> servicio    </label>
                <input type="text" v-model="servicio" v-if="agentes.length" class="form-control badge-secondary" id="servicio" name='servicio'>
            </div>
            
            
            
            <hr>
            <hr>
            <div class="col-sm-6">
                <label class="text">TOTAL DE AGENTES:</label>
                
                <P>  {{searchAgentes.length}}</P>
            </div>
            
                   
        </div>
        <div class="form-group row badge-dark col-sm-12">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#NuevoAgente">
                Nuevo Agente
            </button>
        </div>
        <table class="table table-striped table-dark table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">LEGAJO</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">HOSPITAL</th>
                    <th scope="col">SERVICIO</th>
                    <th scope="col">SECTOR</th>
                    <th scope="col">ACTIVO</th>
                    <th scope="col">FECHA DE INGRESO</th>
                </tr>
            </thead>
                    
            <tbody>
                <tr  v-for="agente in searchAgentes" :key="agente.LEGAJO" >
                    <th>
                        {{agente.LEGAJO}}
                    </th>
                    <th>
                        {{agente.DNI}}
                    </th>
                    <th>
                        {{agente.NOMBRE.toUpperCase()}}
                    </th>
                    <th>
                        {{agente.HOSPITAL.toUpperCase()}}
                    </th>
                    <th>
                        {{agente.SERVICIO}}
                    </th>
                    <th>
                        {{agente.SECTOR}}
                    </th >
                    <th v-if="agente.ACTIVO==0">
                        ACTIVO
                    </th>
                    <th v-else>
                        BAJA
                    </th>
                    <th>
                        {{since(agente.fecha_ingreso)}}
                    </th>
                </tr>
            </tbody>
        </table>
        <div class="modal fade" id="NuevoAgente" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="Nuevo Agente" id="nuevo">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
                </div>
            </div>
        </div>

        <button v-on:click="notificacion"  type="submit" class="btn btn-outline-dark">TODOS</button>
        
    </div>
</template>

<script>
    import toastr from 'toastr'
    import moment from 'moment'
    export default{
        
        
        data(){
            return {
                agentes:  [],
                legajo: '',
                dni:'',
                nombre:'',
                hospital:'',
                servicio:'',
                activo:'',
                auxiliar:[],
            }
        },
        created: function(){
            this.getAgentes();
        },
        methods:{
            getAgentes: function(){
                var urlAgentes ='agente';
                axios.get(urlAgentes).then(Response => {
                    this.agentes = Response.data
                    toastr.success('contenido cargado satisfactoriamente');
                });
            },
            getActivos: function(){
                var urlActivos ='activos';
                axios.get(urlActivos).then(Response => {
                    this.agentes = Response.data
                    toastr.success('contenido cargado satisfactoriamente');
                });
            },
            getBajas: function(){
                var urlBajas = 'bajas';
                axios.get(urlBajas).then(Response=>{
                    this.agentes = Response.data
                    toastr.success('contenido cargado satisfactoriamente');
                });
            },
            getOrdenadosAsc: function(){
                var urlOrdAsc = 'ordenadosAsc';
                axios.get(urlOrdAsc).then(Response=>{
                    this.agentes = Response.data
                    toastr.success('contenido cargado satisfactoriamente');
                });
            },
            getOrdenadosDesc: function(){
                var urlOrdDesc = 'ordenadosDesc';
                axios.get(urlOrdDesc).then(Response=>{
                    this.agentes = Response.data
                    toastr.success('contenido cargado satisfactoriamente');
                });
            },
            since: function(d){
                if(d=='0000-00-00 00:00:00'){
                    d='fecha no inicializada'
                    return d
                }else{
                    return moment(d).fromNow();
                }
            },
            notificacion: function(){
                toastr.warning('prueba');
                
            }
        },
        computed:{
            searchAgentes: function(){
                if (this.nombre) {
                    return this.agentes.filter((agente)=>
                    agente.NOMBRE.toUpperCase().includes(this.nombre.toUpperCase())
                    )
                }else if(this.hospital){
                    return this.agentes.filter((agente)=>agente.HOSPITAL.toUpperCase().includes(this.hospital.toUpperCase()))
                }else if(this.servicio){
                    return this.agentes.filter((agente)=>agente.SERVICIO.toUpperCase().includes(this.servicio.toUpperCase()))
                }else if(this.legajo){
                    return this.agentes.filter((agente)=>agente.LEGAJO.toString().includes(this.legajo.toString()))
                }else if(this.dni){
                    return this.agentes.filter((agente)=>agente.DNI.toString().includes(this.dni.toString()))
                }else{
                    return this.agentes
                }
                
            }
        }
    }
    
</script>
