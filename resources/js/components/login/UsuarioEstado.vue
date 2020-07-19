<template>
    <div class="login">
        
        <div v-if="user" class="row justify-content-center">

            <h3  class="btn btn-small btn-danger">
                {{this.user.name}}
                
            </h3>
            <button @click="logout" class="btn btn-small btn-danger"> salir </button>
        </div>
        <h3 v-else  class="btn btn-outline-primary">
            no logueado
        </h3>

        
    </div>
</template>
<script>
export default {
    methods:{
        async logout(){
            await this.$store.dispatch("logout")
        }
    },
    computed:{
        user(){
            return this.$store.state.user
        }
    }
}
</script>