<template >
    <form v-on:submit.prevent="crearAgente" method="post">
        <div class="modal fade" id="cargarVacaciones" tabindex="-1" role="dialog"  aria-hidden="true">
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
                    <p>{{vacaciones}}</p>
                    
                    
                    
                    <div class="form-group row">
                        
                        <label for="legajo"    class="col-sm-4 col-form-label text-center">LEGAJO   </label>
                        <div class="col-sm-8">
                        <select  class="form-control badge-secondary" v-model="vacaciones.legajo" id="legajo" name='legajo'>
                                <option v-for="agente in agentes" :value="agente.LEGAJO" :key="agente.LEGAJO">{{agente.LEGAJO}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        
                        <label for="horario"   class="col-sm-4 col-form-label text-center ">NOMBRE   </label>
                        <div class="col-sm-8">
                            <input disabled type="text" class="form-control badge-secondary" >
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
    import axios  from 'axios'
    export default {
        data(){
            return{
                vacaciones:{
                    legajo:         '',
                    anio:            0,
                    fecha_inicio:   '',
                    fecha_fin:      '',
                },
                agentes:[],
                errors:[],
            }
        },
        created:function(){
            this.getAgentes();
        },
        methods:{
            getAgentes:function(){
                var url = '/contrataciones-1/public/agente/agente';
                axios.get(url).then(Response=>{
                    this.agentes = Response.data
                })
            }
        }
    }
</script>