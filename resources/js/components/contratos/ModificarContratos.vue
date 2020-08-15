<template>
    <form v-on:submit.prevent="actualizarVacaciones" method="post">
        <div class="modal fade" id="modificar" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header badge-dark">
                    <h5 class="Nuevo Agente" id="nuevo">Modificar proveedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body badge-dark">
                    <p>{{proveedor}}</p>
                    <hr>
                    <div class="form-group row">
                        <label for="legajo"    class="col-sm-4 col-form-label text-center">PROVEEDOR   </label>
                        <div class="col-sm-8">
                            <input disabled type="text" class="form-control text-danger badge-secondary">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="horario"   class="col-sm-4 col-form-label text-center ">NOMBRE     </label>
                        <div class="col-sm-8">
                            <input disabled type="text" class="form-control text-danger badge-secondary">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="documento" class="col-sm-4 col-form-label text-center ">APELLIDO   </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control badge-secondary">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="documento" class="col-sm-4 col-form-label text-center ">FECHA DE INICIO</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control badge-secondary">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="documento" class="col-sm-4 col-form-label text-center ">FECHA FIN</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control badge-secondary" >
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
export default {
    data(){
        return{
            proveedor:{

            },
            error:'',
        }
    }
}
</script>