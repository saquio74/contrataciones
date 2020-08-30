<template>
    <form v-on:submit.prevent="updateLiquidacion" method="post">
        <div class="modal fade" id="ModificarLiquidacion" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document" v-if="agente">
                <div class="modal-content">
                <div class="modal-header badge-dark">
                    <h5 class="Nuevo Agente" id="nuevo">Modificar Liquidacion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body badge-dark">
                   
                    <hr>
                    
                    
                    <div class="form-group row">
                        
                        <label for="legajo"    class="col-sm-4 col-form-label text-center">LEGAJO   </label>
                        <div class="col-sm-8">
                            <input type="number" disabled class="form-control text-danger badge-secondary" v-model="agente.leg">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="horario"   class="col-sm-4 col-form-label text-center ">NOMBRE   </label>
                        <div class="col-sm-8">
                            <input type="text" disabled class="form-control text-danger badge-secondary" v-model="agente.nombre">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="horario"   class="col-sm-4 col-form-label text-center ">INCISO   </label>
                        <div class="col-sm-8">
                            <input type="text" disabled class="form-control text-danger badge-secondary" v-model="agente.inciso">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="documento" class="col-sm-4 col-form-label text-center " >BONIFICACION      </label>
                        <div class="col-sm-8">
                            <select class="form-control badge-secondary" v-model="agente.bonificacion">
                                <option value="0">0</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="documento" class="col-sm-4 col-form-label text-center " >HORAS      </label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control badge-secondary" @keyup="liquidar()" v-model="agente.horas">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="documento" class="col-sm-4 col-form-label text-center ">SUBTOTAL      </label>
                        <div class="col-sm-8">
                            <input type="number" disabled class="form-control text-danger badge-secondary" v-model="agente.subtot.toFixed(2)">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="documento" class="col-sm-4 col-form-label text-center ">BONIFICCION      </label>
                        <div class="col-sm-8">
                            <input type="number" disabled class="form-control text-danger badge-secondary" v-model="agente.bonvalor.toFixed(2)">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="documento" class="col-sm-4 col-form-label text-center ">TOTAL      </label>
                        <div class="col-sm-8">
                            <input type="number" disabled class="form-control text-danger badge-secondary" v-model="agente.total.toFixed(2)">
                        </div>
                    </div>
                    
                    <span v-for="error in errors" class="text-danger">{{error}}</span>
                    
                </div>
                <div class="modal-footer badge-secondary">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Modificar Liquidacion</button>
                </div>
                </div>
            </div>
        </div>
     </form>
</template>
<script>
import axios    from 'axios'
import toastr   from 'toastr'
export default {
    props:{
        agenteData:{

        }
    },
    data(){
        return{
            agente:{

            },
            errors:{

            }
        }
    },
    methods:{
        setAgente(){
            this.agente = this.agenteData
        },
        liquidar(horas){
            this.agente.subtot      = Math.round((this.agente.horas * this.agente.valor).toFixed(2) *100)/100
            this.agente.bonvalor    = Math.round(this.agente.subtot.toFixed(2) * (this.agente.bonificacion /100) *100)/100
            this.agente.total       = Math.round(this.agente.subtot + this.agente.bonvalor *100)/100
        },
        async updateLiquidacion(){
            try {
                let response = await axios.put('agenfac/update',this.agente)
                console.log(response)
                toastr.success('modiicado correctamente')
                $('#ModificarLiquidacion').modal('hide')

            } catch (error) {
                toastr.error(error.response)
            }
            console.log(this.agente)
        }
    },
    watch:{
        agenteData:{
            handler:function(){
                this.setAgente();
            }
        }
    }
    
}
</script>