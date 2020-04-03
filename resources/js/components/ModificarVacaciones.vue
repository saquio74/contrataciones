<template >
    <form v-on:submit.prevent="crearVacaciones" method="post">
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
                    <hr>
                    <div class="form-group row">
                        <label for="legajo"    class="col-sm-4 col-form-label text-center">LEGAJO   </label>
                        <div class="col-sm-8">
                            <input disabled type="text" class="form-control text-danger badge-secondary" :value="listaModificar.agente_id" >
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
                            <input type="text" class="form-control badge-secondary"   :value="listaModificar.anio">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="documento" class="col-sm-4 col-form-label text-center ">FECHA DE INICIO</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control badge-secondary"   :value="listaModificar.fecha_inicio">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="documento" class="col-sm-4 col-form-label text-center ">FECHA FIN</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control badge-secondary" :value="listaModificar.fecha_fin">
                        </div>
                    </div>
                </div>
                <div class="modal-footer badge-secondary">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" @click="$emit('speak')">Agregar Vacaciones</button>
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
            listaModificar:{

            },
        },
        data(){
            return{
                vacaciones:{
                    id:              0,
                    agente_id:      '',
                    anio:            0,
                    fecha_inicio:   '',
                    fecha_fin:      '',
                }
            }
        },
        methods:{
            mostrarData:function(){
                console.log(this.listaModificar)
            }
        }
        
    }
</script>