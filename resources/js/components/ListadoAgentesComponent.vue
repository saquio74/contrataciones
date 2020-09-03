<template>
    <div class="panel panel-default col-sm-12" v-if="rol.special =='all-access' || permiso">
        <h1 class="text-center">Listado General de agentes</h1>
        <div class="badge-black row col-sm-12">
            <button v-on:click="getActivos" type="submit" class="btn btn-outline-dark">ALTAS</button>
            <button v-on:click="getBajas"   type="submit" class="btn btn-outline-dark">BAJAS</button>
            <button v-on:click="getAgentes"  type="submit" class="btn btn-outline-dark">TODOS</button>
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
                <label class="text"> DNI         </label>
                <input type="int" v-model="dni"    v-if="agentes.length" class="form-control badge-secondary" id="legajo" name='legajo'>
            </div>
            <div class="col-sm-2">
                <label class="text"> nombre      </label>
                <input type="text" v-model="nombre"   v-if="agentes.length" class="form-control badge-secondary" id="nombre" name='nombre'>
            </div>
            <div class="col-sm-2">
                <label class="text"> hospital    </label>
                <select class="form-control badge-secondary" @change="getPorHospital" v-model="hospital" id="hospital" name='hospital'>
                    <option value=''>seleccione</option>
                    <option v-for="hosp in hospitales" :key="hosp.ID" :value="hosp" >{{hosp.HOSPITAL}}</option>
                </select>
            </div>
            <div class="col-sm-2">
                <label class="text"> servicio    </label>
                <select class="form-control badge-secondary" v-model="servicio" id="servicio" name='servicio'>
                    <option value=''>seleccione</option>
                    <option v-for="serv in servicios" :value="serv.SERVICIO" :key="serv.ID">{{serv.SERVICIO}}</option>
                </select>
            </div>
            <div class="col-sm-2">
                <label class="text"> sectores    </label>
                <select class="form-control badge-secondary" v-model="sector" id="servicio" name='servicio'>
                    <option value=''>seleccione</option>
                    <option v-for="sect in sectores" :value="sect.SECTOR" :key="sect.SECTOR">{{sect.SECTOR}}</option>

                </select>
            </div>
            <hr>
            <hr>
            <div class="col-sm-6">
                <label class="text">TOTAL DE AGENTES:</label>
                <P>  {{searchAgentes.length}}</P>
            </div>
        </div>
        <div class="form-group row badge-dark col-sm-12" v-if="permisoCrear">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#NuevoAgente">
                Nuevo Agente
            </button>
        </div>
        <table class="table table-striped table-dark table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col" v-if="auxiliar===0" v-on:click="ordenadosDesc('LEGAJO');auxiliar++"  >LEGAJO</th>
                    <th scope="col" v-else v-on:click="ordenadosAsc('LEGAJO');auxiliar--" >LEGAJO</th>
                    <th scope="col" v-if="auxiliar===0" v-on:click="ordenadosDesc('DNI');auxiliar++"  >DNI</th>
                    <th scope="col" v-else v-on:click="ordenadosAsc('DNI');auxiliar--" >DNI</th>
                    <th scope="col" v-if="auxiliar===0" v-on:click="ordenadosDesc('NOMBRE');auxiliar++"  >NOMBRE</th>
                    <th scope="col" v-else v-on:click="ordenadosAsc('NOMBRE');auxiliar--" >NOMBRE</th>
                    <th scope="col" v-if="auxiliar===0" v-on:click="ordenadosDesc('HOSPITAL');auxiliar++"  >HOSPITAL</th>
                    <th scope="col" v-else v-on:click="ordenadosAsc('HOSPITAL');auxiliar--" >HOSPITAL</th>
                    <th scope="col" v-if="auxiliar===0" v-on:click="ordenadosDesc('SERVICIO');auxiliar++"  >SERVICIO</th>
                    <th scope="col" v-else v-on:click="ordenadosAsc('SERVICIO');auxiliar--" >SERVICIO</th>
                    <th scope="col" v-if="auxiliar===0" v-on:click="ordenadosDesc('SECTOR');auxiliar++"  >SECTOR</th>
                    <th scope="col" v-else v-on:click="ordenadosAsc('SECTOR');auxiliar--" >SECTOR</th>
                    <th scope="col" >ACTIVO</th>
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
                        {{agente.SERVICIO.toUpperCase()}}
                    </th>
                    <th>
                        {{agente.SECTOR.toUpperCase()}}
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
                    <th width="10px" v-if="rol.special =='all-access' ||  permisoEditar">
                        <button type="button" class="btn btn-success" v-on:click="getLegajo(agente)" data-toggle="modal" data-target="#ModificarAgente">
                            editar
                        </button>
                    </th>
                    <th width="10px" v-if="rol.special =='all-access' ||  permisoBorrar">
                        <button type="button" class="btn btn-outline-danger" v-on:click="borrar(agente)" >
                            borrar
                        </button>
                    </th>
                </tr>
            </tbody>
        </table>
        <div v-if="rol.special =='all-access' ||  permisoCrear">

            <nuevo-agente @speak="speakMethod()"/>
        </div>
        <div v-if="rol.special =='all-access' ||  permisoEditar">

            <modificar-agente @speak="speakMethod()" :listaHospitales="hospitales" :listaServicios="servicios" :listaSectores="sectores" :agenteModificar="agenteAux"  />
        </div>
    </div>
    <div v-else>
        <h2 class="display-1">
            no pose permiso para entrar aqui
        </h2>
    </div>
</template>

<script>
    import toastr from 'toastr'
    import moment from 'moment'
    import axios  from 'axios'
    import jquery from 'jquery'
    
    
export default {
        
        data(){
            return {
                agenteAux: [],
                agentes:  [],
                hospitales: [],
                servicios:[],
                sectores:[],
                legajo: '',
                dni:'',
                nombre:'',
                hospital:{},
                servicio:'',
                sector:'',
                activo:'',
                auxiliar:0,
                permiso:'',
                permisoEditar:'',
                permisoBorrar:'',
                permisoCrear:'',
            }
        },
        created(){
            
            this.buscarPermiso()
        },
        methods:{
            async buscarPermiso(){
                
                this.permiso = await this.permisos.find(valor =>{
                    return valor.slug === 'agentes.ver'
                })
                this.permisoEditar = await this.permisos.find(valor =>{
                    return valor.slug === 'agentes.editar'
                })
                this.permisoBorrar = await this.permisos.find(valor =>{
                    return valor.slug === 'agentes.borrar'
                })
                this.permisoCrear = await this.permisos.find(valor =>{
                    return valor.slug === 'agentes.crear'
                })
                if(this.permiso){
                    this.getAgentes();
                    this.getHospitales();
                    this.getServicios();
                    this.getSectores();
                }
                
            },
            getAgentes: function(){
                $('table').on('scroll', function() {
                    $("#" + this.id + " > *").width($(this).width() + $(this).scrollLeft());
                });
                var urlAgentes ='agente/agente';
                axios.get(urlAgentes).then(Response => {
                    this.agentes = Response.data
                    toastr.success('contenido cargado satisfactoriamente');
                });
            },
            getActivos: function(){
                var urlActivos ='agente/activos';
                axios.get(urlActivos).then(Response => {
                    this.agentes = Response.data
                    toastr.success('contenido cargado satisfactoriamente');
                });
            },
            getBajas: function(){
                var urlBajas = 'agente/bajas';
                axios.get(urlBajas).then(Response=>{
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
            getPorHospital:function(){
                if(this.hospital!=''){
                    var urlPorHospital = '/agente/porhospital/' + this.hospital.ID; 
                    axios.get(urlPorHospital).then(Response=>{
                    this.agentes = Response.data.IDINC
                    });
                }
            },
            speakMethod: function () {
                setTimeout(()=>{
                    this.getAgentes()
                },1000)
                
            },
            getLegajo: function(agent){
                this.agenteAux = agent
            },
            ordenadosAsc: function(prop) {
                this.agentes.sort(function(a,b){
                    if(prop === 'LEGAJO'){
                        return (a.LEGAJO - b.LEGAJO)
                    }
                    if(prop === 'DNI'){
                        return (a.DNI - b.DNI)
                    }
                    if(prop ==='NOMBRE'){
                        return (a.NOMBRE.localeCompare(b.NOMBRE))
                    }
                    if(prop ==='HOSPITAL'){
                        return (a.HOSPITAL.localeCompare(b.HOSPITAL))
                    }
                    if(prop ==='SERVICIO'){
                        return (a.SERVICIO.localeCompare(b.SERVICIO))
                    }
                    if(prop ==='SECTOR'){
                        return (a.SECTOR.localeCompare(b.SECTOR))
                    }
                });
            },
            ordenadosDesc:function(prop){
                this.ordenadosAsc(prop);
                this.agentes.reverse();
            },
            async borrar(agente){
                try {
                    await axios.delete(`agente/delete/${agente.LEGAJO}`)
                    toastr.success('BORRADO CORRECTAMENTE')
                    this.getAgentes()
                } catch (error) {
                    toastr.error(error)
                }
            }
        },
        computed:{
            searchAgentes: function(){
                if (this.nombre) {
                    return this.agentes.filter((agente)=>agente.NOMBRE.toUpperCase().includes(this.nombre.toUpperCase()))
                }
                if(this.servicio){
                    return this.agentes.filter((agente)=>agente.SERVICIO.toUpperCase().includes(this.servicio.toUpperCase()))
                }
                if(this.legajo){
                    return this.agentes.filter((agente)=>agente.LEGAJO.toString().includes(this.legajo.toString()))
                }
                if(this.dni){
                    return this.agentes.filter((agente)=>agente.DNI.toString().includes(this.dni.toString()))
                }
                if(this.sector){
                    return this.agentes.filter((agente)=>agente.SECTOR.toString().includes(this.sector.toString()))
                }
                return this.agentes
            },
            userConfirm(){
                return this.$store.state.user
            },
            permisos(){
                return this.$store.state.permisos
            },
            rol(){
                return this.$store.state.rol
            }
            
        }
    }
    
</script>
