<template>
    <div class="row col-sm-12">
        
        <div class="col-sm-12">

            <getPDF :seleccionar="verificador"></getPDF>
        </div>
        
    </div>
</template>
<script>
export default {
    data(){
        return{
            verificador:0,
        }
    },
    methods:{
        verficar(valor){
            this.verificador = valor
            //console.log(this.verificador)
        }
    }
}
</script>