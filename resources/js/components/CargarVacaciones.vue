<template >
    <form v-on:submit.prevent="crearVacaciones" method="post">
        <div class="modal fade" id="cargar" tabindex="-1" role="dialog"  aria-hidden="true">
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
                        <select  class="form-control badge-secondary" v-model="agenteAux" @change="mostrarDatos()"  id="legajo" name='legajo'>
                                <option v-for="agente in agentes" :value="agente" :key="agente.LEGAJO" >{{agente.LEGAJO}}</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        
                        <label for="horario"   class="col-sm-4 col-form-label text-center ">NOMBRE   </label>
                        <div class="col-sm-8">
                            <input disabled type="text" class="form-control text-danger badge-secondary" :value="agenteAux.NOMBRE" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="documento" class="col-sm-4 col-form-label text-center ">AÑO      </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control badge-secondary" v-model="vacaciones.anio"  value=''>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="documento" class="col-sm-4 col-form-label text-center ">FECHA DE INICIO</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control badge-secondary" v-model="vacaciones.fecha_inicio"  value=''>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="documento" class="col-sm-4 col-form-label text-center ">FECHA FIN</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control badge-secondary" v-model="vacaciones.fecha_fin"  value=''>
                        </div>
                    </div>
                    <span v-for="error in errors" :key="error" class="text-danger">{{error}}</span>
                    
                </div>
                <div class="modal-footer badge-secondary">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Agregar Vacaciones</button>
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
                    agente_id:      '',
                    anio:            0,
                    fecha_inicio:   '',
                    fecha_fin:      '',
                },
                
                agenteAux:[],
                errors:[],
            }
        },
        created:function(){
            this.getAgentes();
        },
        methods:{
            async getAgentes(){
                await this.$store.dispatch('getAgentes')
            },
            mostrarDatos:function(){
                this.vacaciones.agente_id = this.agenteAux.LEGAJO

            },
            crearVacaciones:async function(){
                const url = '/contrataciones-1/public/vacaciones/store'
                try{
                    
                    await axios.post(url,this.vacaciones)
                    await this.$store.dispatch('getVacaciones')
                    $('#cargar').modal('hide');
                    this.vacaciones.agente_id     = '';
                    this.vacaciones.anio          = 0 ;
                    this.vacaciones.fecha_inicio  = '';
                    this.vacaciones.fecha_fin     = '';
                    toastr.success('vacaciones cargaradas correctamente');

                }catch(errors){
                    this.errors = errors.response.data
                    this.vacaciones.agente_id     = '';
                    this.vacaciones.anio          = 0 ;
                    this.vacaciones.fecha_inicio  = '';
                    this.vacaciones.fecha_fin     = '';
                    toastr.error('error');
                }
            },
        },
        computed:{
            agentes(){
                
                return this.$store.state.agentes
            }
        }
    }
</script>