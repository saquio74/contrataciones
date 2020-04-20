<template>
    <div class="panel panel-default   col-sm-12">
        <h1 class="text-center">Carga y listado de libros </h1>
        
        <div class="form-group row badge-dark col-sm-12">
            <hr>
            <hr>
            <div class="col-sm-2">
                <label class="text"> legajo      </label>
                <input type="int" v-model="buscar.legajo"    class="form-control badge-secondary" id="legajo" name='legajo'>
            </div>
            <div class="col-sm-2">
                <label class="text"> DNI         </label>
                <input type="int" v-model="buscar.documento" class="form-control badge-secondary" id="legajo" name='legajo'>
            </div>
            <div class="col-sm-2">
                <label class="text"> nombre      </label>
                <input type="text" v-model="buscar.nombre"   class="form-control badge-secondary" id="nombre" name='nombre'>
            </div>
            <hr>
            <hr>
            <div class="col-sm-6">
                <label class="text">TOTAL DE AGENTES:</label>
                <P>  {{}}</P>
            </div>
        </div>
        <form v-on:submit.prevent="ingresarFirma" method="post">
            <div class="modal fade" id="modificar" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header badge-dark">
                        <h5 class="Nuevo Agente" id="nuevo">Nuevo Agente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body badge-dark">
                        <p>{{vacaciones}}</p>
                        <hr>
                        <div class="form-group row">
                            <label for="legajo"    class="col-sm-4 col-form-label text-center">LEGAJO   </label>
                            <div class="col-sm-8">
                                <input disabled type="text" class="form-control text-danger badge-secondary" v-model="vacaciones.agente_id" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="horario"   class="col-sm-4 col-form-label text-center ">NOMBRE   </label>
                            <div class="col-sm-8">
                                <input disabled type="text" class="form-control text-danger badge-secondary" :value="listaModificar.NOMBRE">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="documento" class="col-sm-4 col-form-label text-center ">AÑO      </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control badge-secondary"   v-model="vacaciones.anio">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="documento" class="col-sm-4 col-form-label text-center ">FECHA DE INICIO</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control badge-secondary"   v-model="vacaciones.fecha_inicio">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="documento" class="col-sm-4 col-form-label text-center ">FECHA FIN</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control badge-secondary" v-model="vacaciones.fecha_fin">
                            </div>
                        </div>
                        <span v-for="error in errors" :key="error" class="text-danger">{{error}}</span>
                    </div>
                    <div class="modal-footer badge-secondary">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" @click="$emit('speak')">Agregar Vacaciones</button>
                    </div>
                    </div>
                </div>
            </div>
        </form>
        <table class="table table-striped table-dark table-bordered table-hover">
            <thead>
                <tr>
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
                
            </tbody>
        </table>
        
    </div>
</template>
<script>
export default {
    data(){
        return{
            buscar:{
                legajo:     '',
                documento:  '',
                nombre:     '',
            },
            firma:{
                agente_id:  '',
                hospital_id:'',
                added_on:   '',
            }
            
        }
    },
    methods:{
        ingresarFirma(){

        }
    }
}
</script>