<template>
    <div class="panel panel-default   col-sm-12" v-if="rol.special =='all-access' || permiso">
        <h1 class="text-center">Listado General de vacaciones</h1>
        <div class="form-group row badge-dark col-sm-12">
            <hr>
            <hr>
            
            <div class="col-sm-2">
                <label class="text"> legajo      </label>
                <input type="int" v-model="legajo"    v-if="vacaciones.length" class="form-control badge-secondary" id="legajo" name='legajo'>
            </div>
            <div class="col-sm-2">
                <label class="text"> DNI      </label>
                <input type="int" v-model="dni"    v-if="vacaciones.length" class="form-control badge-secondary" id="legajo" name='legajo'>
            </div>
            <div class="col-sm-2">
                <label class="text"> nombre      </label>
                <input type="text" v-model="nombre"   v-if="vacaciones.length" class="form-control badge-secondary" id="nombre" name='nombre'>
            </div>
            <hr>
            <hr>
            <hr>
            <p>{{searchVacaciones.length}}</p>
            
        </div>
        <div class="form-group row badge-dark col-sm-12" v-if="permisoCrear">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cargar">
                    Cargar Vacaciones
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
                    <th scope="col" v-if="auxiliar===0" v-on:click="ordenadosDesc('HOSPITAL');auxiliar++"  >DEPENDENCIA</th>
                    <th scope="col" v-else v-on:click="ordenadosAsc('HOSPITAL');auxiliar--" >DEPENDENCIA</th>
                    <th>COMIENZA</th>
                    <th>FINALIZA-</th>
                    <th>AÑO</th>
                    <!--<th scope="col" v-if="auxiliar===0" v-on:click="ordenadosDesc('SERVICIO');auxiliar++"  >SERVICIO</th>
                    <th scope="col" v-else v-on:click="ordenadosAsc('SERVICIO');auxiliar--" >SERVICIO</th>
                    <th scope="col" v-if="auxiliar===0" v-on:click="ordenadosDesc('SECTOR');auxiliar++"  >SECTOR</th>
                    <th scope="col" v-else v-on:click="ordenadosAsc('SECTOR');auxiliar--" >SECTOR</th>
                    <th scope="col" >ACTIVO</th>
                    <th scope="col">FECHA DE INGRESO</th>-->
                </tr>
            </thead>
            <tbody>
                <tr  v-for="vacacion in searchVacaciones" :key="vacacion.ID" >
                    <th>
                        {{vacacion.LEGAJO}}
                    </th>
                    <th>
                        {{vacacion.DNI}}
                    </th>
                    <th>
                        {{vacacion.NOMBRE}}
                    </th>
                    <th>
                        {{vacacion.HOSPITAL}}
                    </th>
                    <th>
                        {{
                            formatoFecha(vacacion.fecha_inicio)
                        }}
                    </th>
                    <th>
                        {{
                            formatoFecha(vacacion.fecha_fin)
                        }}
                    </th>
                    <th>
                        {{
                            vacacion.anio
                        }}
                    </th>
                    
                    <th width="10px" v-if="rol.special =='all-access' ||  permisoEditar">
                        <button type="button" class="btn btn-success" v-on:click="buscarDatos(vacacion)"  data-toggle="modal" data-target="#modificar">
                            editar
                        </button>
                    
                        
                    </th>
                    <th width="10px" v-if="rol.special =='all-access' ||  permisoBorrar">
                        <button type="button" class="btn btn-danger" v-on:click.prevent="borrarVacaciones(vacacion.id)" >
                            borrar
                        </button>

                    </th>
                </tr>
            </tbody>
        </table>
        <div v-if="rol.special =='all-access' ||  permisoCrear">

            <cargar-vacaciones @speak="speakMethod()"/>
        </div>
        <div v-if="rol.special =='all-access' ||  permisoEditar">

            <modificar-vacaciones @speak="speakMethod()" :listaModificar="vacacionAux"/>           
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

    export default {
        data(){
            return{
                
                legajo:     '',
                dni:        '',
                nombre:     '',
                agentes:    [],
                auxiliar:    0,
                vacacionAux:[],
                permiso:'',
                permisoEditar:'',
                permisoBorrar:'',
                permisoCrear:''
            }
        },
        created:function(){
            
            this.buscarPermiso()
        },
        methods:{
            async buscarPermiso(){
                
                this.permiso = await this.permisos.find(valor =>{
                    return valor.slug === 'vacaciones.navegar'
                })
                this.permisoEditar = await this.permisos.find(valor =>{
                    return valor.slug === 'vacaciones.editar'
                })
                this.permisoBorrar = await this.permisos.find(valor =>{
                    return valor.slug === 'vacaciones.borrar'
                })
                this.permisoCrear = await this.permisos.find(valor =>{
                    return valor.slug === 'vacaciones.crear'
                })
                if(this.permiso){
                    this.getVacaciones()
                }
                
            },
            getVacaciones: async function(){
                $('table').on('scroll', function() {
                    $("#" + this.id + " > *").width($(this).width() + $(this).scrollLeft());
                });
                await this.$store.dispatch('getVacaciones')
            },
            formatoFecha:function(d){
                return moment(d).format("DD-MM-YY")
            },
            buscarDatos:function(datos){
                
                this.vacacionAux = datos
                
            },
            
            ordenadosAsc: function(prop) {
                this.vacaciones.sort(function(a,b){
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
                this.vacaciones.reverse();
            },
            borrarVacaciones:function(id){
                var borrar = '/contrataciones-1/public/vacaciones/delete/' + id;
                axios.delete(borrar).then(Response=>{
                    this.getVacaciones();
                    toastr.success('eliminado satisfactoriamente');
                }) 
            },
        },
        
        computed:{
            vacaciones(){
                return this.$store.state.vacaciones
            },
            searchVacaciones: function(){
                if (this.nombre) {
                    return this.vacaciones.filter((vacacion)=>vacacion.NOMBRE.toUpperCase().includes(this.nombre.toUpperCase()))
                }
                if(this.legajo){
                    return this.vacaciones.filter((vacacion)=>vacacion.LEGAJO.toString().includes(this.legajo.toString()))
                }
                if(this.dni){
                    return this.vacaciones.filter((vacacion)=>vacacion.DNI.toString().includes(this.dni.toString()))
                }
                return this.vacaciones
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