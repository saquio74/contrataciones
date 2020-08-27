<template>
    <div class="row bg-secondary col-sm-12 form-group">
        <div class="col-sm-12">
            
            <button type="button" class="btn btn-outline-success" v-on:click="vista=0">Generar Complementaria</button>
            <button type="button" class="btn btn-outline-success" v-on:click="vista=1">Generar PDF</button>
            <button type="button" class="btn btn-outline-success" v-on:click="vista=2">Borrar complementaria</button>
        </div>
        <div class="col-sm-12" v-if="vista==0">
            <generar-comple></generar-comple>
        </div>
        <div class="col-sm-12" v-if="vista==1">
            <pdf-comples></pdf-comples>
        </div>
        <div class="col-sm-12" v-if="vista==2">
            <borrar-comples></borrar-comples>
        </div>


    </div>
</template>
<script>
export default {
    data(){
        return{
            vista:0,
        }
    }
}
</script>