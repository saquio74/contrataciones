<template>
    
        
        <div v-if="!userConfirm" class="form-group col-sm-12 ">
            <button class="btn btn-outline-dark" @click="auxChange(-1)">entrar</button>
            <button class="btn btn-outline-dark" @click="auxChange(1)">registrarse</button>
            <div v-if="auxiliar==0" class="form-group col-sm-12 col-md-6">
                <form v-on:submit.prevent>

                    <label for="exampleInputEmail1">Usuario</label>
                    <input type="email" class="form-control" placeholder="Enter email" v-model="datos.email">
                    <label for="exampleInputPassword1">contraseña</label>
                    <input type="password" class="form-control" placeholder="Password" v-model="datos.password">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    
                    <button type="submit" @click="login" class="btn btn-primary">Entrar</button>
                    {{error}}
                </form>
            </div>
            <div v-else>
                <nUsuario></nUsuario>
            </div>
        </div>
        <div v-else class="form-group col-sm-12 col-md-6 text-center">
            <h4 class="display-4"> Bienvenido usuario {{userConfirm.name}}</h4>
            <div  v-if="userRol">

                <h5 class="display-5">su rol es {{userRol.name}} </h5>
                <h5 class="display-5">tu puedes: {{userRol.description}}</h5>
                <h4 class="display-5" v-for="permiso in permisos" :key="permiso.id">{{permiso.name}}</h4>
            </div>
            <div v-else>

                <h5 class="display-5" >Todavia no tienes Rol asignado</h5>
            </div>
        </div>
    
</template>
<script>
import axios from 'axios'
axios.defaults.withCredentials = true;
    export default {
        data(){
            return{
                datos:{
                    email:'',
                    password:'',
                },
                user:{},
                auxiliar:0,
                error: '',
            }
        },
        methods:{
            async login(){
                try{
                    await this.$store.dispatch("login", this.datos)
                    
                }catch(e){
                    //console.log(e)
                    this.error = e
                }
            },
            auxChange(cambio){
                if(this.auxiliar==1 && cambio ==1)return
                if(this.auxiliar==0 && cambio == -1) return
                if(this.auxiliar==0 && cambio ==1)this.auxiliar++
                if(this.auxiliar==1 && cambio ==-1) this.auxiliar--
            },
        },
        computed:{
            userConfirm(){
                return this.$store.state.user
            },
            userRol(){
                return this.$store.state.rol
            },
            permisos(){
                return this.$store.state.permisos
            }
        }
    }
</script>