<template>
    <form>
        <div class="form-group col-sm-12 col-md-6 col-lg-4">
            {{datos}}
            <label for="exampleInputEmail1">Usuario</label>
            <input type="email" class="form-control" placeholder="Enter email" v-model="datos.email">
        </div>
        <div class="form-group col-sm-12 col-md-6 col-lg-4">
            <label for="exampleInputPassword1">contraseña</label>
            <input type="password" class="form-control" placeholder="Password" v-model="datos.password">
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="button" @click="login" class="btn btn-primary">Entrar</button>
    </form>
</template>
<script>
import axios from 'axios'
    
    export default {
        data(){
            return{
                datos:{

                    email:'truenity52@hotmail.com',
                    password:'71947194',
                },
            }
        },
        methods:{
            login(){
                const url = 'login'
                
                axios.post(url,this.datos).then(Response=>{
                    console.log('hola')
                }).catch(e=>{
                    console.log(e)
                })
                
            }
        }
    }
</script>