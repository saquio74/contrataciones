<template>
    <form>
        <div class="form-group col-sm-12 col-md-6 col-lg-4">
            {{user}}
            <button @click="me">obtener usuario</button>
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
axios.defaults.withCredentials = true;
    
    export default {
        data(){
            return{
                datos:{

                    email:'truenity52@hotmail.com',
                    password:'71947194',
                },
                user:{},
                actualUser:{

                },
            }
        },
        methods:{
            login(){
                axios.get('sanctum/csrf-cookie').then(response => {
                    
                    const url = 'login'
                    axios.post(url,this.datos).then(Response=>{
                        this.user = Response.data
                    }).catch(e=>{
                        console.log(e)
                    })
                });
            },
            me(){
                const url = 'api/user';
                axios.get(url).then(Res =>{
                    console.log(Res.data)
                })
            }

        }
    }
</script>