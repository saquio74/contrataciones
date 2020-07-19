<template>
    <form>

        
        <div v-if="!userConfirm" class="form-group col-sm-12 col-md-6 col-lg-4">

            <label for="exampleInputEmail1">Usuario</label>
            <input type="email" class="form-control" placeholder="Enter email" v-model="datos.email">
            <label for="exampleInputPassword1">contraseña</label>
            <input type="password" class="form-control" placeholder="Password" v-model="datos.password">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
            
            <button type="button" @click="login" class="btn btn-primary">Entrar</button>
        </div>
        <div v-else class="form-group col-sm-12 col-md-6 col-lg-4 text-center">
            <h4 class="display-4"> Bienvenido usuario {{userConfirm.name}}</h4>
        </div>
    </form>
</template>
<script>
import axios from 'axios'
axios.defaults.withCredentials = true;
    export default {
        data(){
            return{
                datos:{

                    email:'truenity52@hotmail.com',
                    password:'71947194',
                },
                user:{},
            }
        },
        methods:{
            async login(){
                await this.$store.dispatch("login", this.datos)
            },
            
        },
        computed:{
            userConfirm(){
                return this.$store.state.user
            }
    }
    }
</script>