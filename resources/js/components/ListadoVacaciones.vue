<template>
    <div class="panel panel-default   col-sm-12">
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
            
            
        </div>
        <div class="form-group row badge-dark col-sm-12">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cargarVacaciones">
                    Cargar Vacaciones
                </button>
            </div>
        <table class="table table-striped table-dark table-bordered table-hover">
            <thead>
                <tr>
                    <th>LEGAJO</th>
                    <th>DNI</th>
                    <th>NOMBRE</th>
                    <th>DEPENDENCIA</th>
                    <th>COMIENZA</th>
                    <th>FINALIZA-</th>
                    <th>AÑO</th>
                    <!--<th scope="col" v-if="auxiliar===0" v-on:click="ordenadosDesc('LEGAJO');auxiliar++"  >LEGAJO</th>
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
                    <th scope="col">FECHA DE INGRESO</th>-->
                </tr>
            </thead>
            <tbody>
                <tr  v-for="vacacion in vacaciones" :key="vacacion.LEGAJO" >
                    <th>
                        {{vacacion.LEGAJO}}
                    </th>
                    <th>
                        {{vacacion.DNI}}
                    </th>
                    <th>
                        {{vacacion.NOMBRE.toUpperCase()}}
                    </th>
                    <th>
                        {{vacacion.HOSPITAL.toUpperCase()}}
                    </th>
                    <th>
                        {{
                            formatoFecha(vacacion.fecha_inicio)
                        }}
                    </th>
                    <th>
                        {{
                            formatoFecha(vacacion.fecha_final)
                        }}
                    </th>
                    <th>
                        {{
                            vacacion.anio
                        }}
                    </th>
                    
                    <th width="10px">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModificarAgente">
                            editar
                        </button>
                        <a href="#" class="btn btn-primary btn-small">Datos</a>
                    </th>
                </tr>
            </tbody>
        </table>
        <cargar-vacaciones/>            
    </div>
</template>
<script>
    import toastr from 'toastr'
    import moment from 'moment'
    import axios  from 'axios'

    export default{
        data(){
            return{
                vacaciones: [],
                legajo:     '',
                dni:        '',
                nombre:     '',
                agentes:    [],
                auxiliar:    0,
            }
        },
        created:function(){
            this.getVacaciones()
        },
        methods:{
            getVacaciones:function(){
                var urlVacaciones = 'vacaciones/vacaciones';
                axios.get(urlVacaciones).then(Response=>{
                    this.vacaciones = Response.data
                    console.log(Response.data)
                });
            },
            formatoFecha:function(d){
                return moment(d).format("DD-MM-YY")
            }
        },
        computed:{
            searchAgentes: function(){
                if (this.nombre) {
                    return this.vacaciones.filter((vacacion)=>vaciones.NOMBRE.toUpperCase().includes(this.nombre.toUpperCase()))
                }
                if(this.legajo){
                    return this.vacaciones.filter((vacacion)=>vaciones.LEGAJO.toString().includes(this.legajo.toString()))
                }
                if(this.dni){
                    return this.vacaciones.filter((vacacion)=>vaciones.DNI.toString().includes(this.dni.toString()))
                }
                return this.vacaciones
            }
        }
    }
</script>