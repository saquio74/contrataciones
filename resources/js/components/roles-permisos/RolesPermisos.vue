<template>
    <div class="col-md-12" v-if="rol.special=='all-access'">
        <div class="col-sm-12">
            
            <button type="button" class="btn btn-outline-success" v-on:click="vista=0">nuevo Rol</button>
            <button type="button" class="btn btn-outline-success" v-on:click="vista=1">Asignar Permisos</button>
            <button type="button" class="btn btn-outline-success" v-on:click="vista=2">Asignar Rol</button>
        </div>
        <div class="col-sm-12" v-if="vista==0">
            <nuevo-rol></nuevo-rol>
        </div>
        <div class="col-sm-12" v-if="vista==1">
            <modificar-rol></modificar-rol>
        </div>
        <div class="col-sm-12" v-if="vista==2">
            <usuario-rol></usuario-rol>
        </div>
    </div>
    <div class="col-md-12" v-else>
        <h1 class=" display-2">
            no tiene permisos para ingresar aqui
        </h1>
    </div>
</template>
<script>
export default {
    data(){
        return{
            vista: 0,
        }
    },
    computed:{
        rol(){
            return this.$store.state.rol
        }
    }
    
}
</script>