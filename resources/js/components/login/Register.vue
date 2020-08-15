<template>
    <form v-on:submit.prevent="register">
        <div class="form-group row col-sm-12 col-md-8 mt-1">
            <label class="col-sm-3 mt-1 ">nombre</label>
            <input type="text" class="form-control inputVerificar col-sm-9 mt-1" placeholder="Usuario" v-model="reg.name">
        </div>
        <div class="form-group row col-sm-12 col-md-8 mt-1">
            <label class="col-sm-3 mt-1" >E-mail</label>
            <input type="email" class="form-control inputVerificar  col-sm-9 mt-1" id="mail" placeholder="mail" v-model="reg.email" @keyup="verificar()">
            <label class="col-sm-12 mt-1 text-danger" v-if="MailError">{{MailError}}</label>
        </div>
        <div class="form-group row col-sm-12 col-md-8 mt-1" v-show="reg.email">
            <label class="col-sm-3 mt-1">verificar E-mail</label>
            <input type="email" class="form-control inputVerificar col-sm-9 mt-1" @keyup="verificar()" placeholder="confirmar mail" onpaste="return false;" v-model="confirm" id="confirmarMail"  >
            <label class="col-sm-12 mt-1 text-danger" v-if="errors">{{errors}}</label>
        </div>
        <div class="form-group row col-sm-12 col-md-8 ">
            <label class="col-sm-3 mt-1">password</label>
            <input type="password" id="password" class="form-control inputVerificar col-sm-9 mt-1" @keyup="verificarPass()" placeholder="contraseña" v-model="reg.password">
            <label class="col-sm-12 mt-1 text-danger" v-if="passError">{{passError}}</label>
        </div>
        <div class="form-group row col-sm-12 col-md-8 mt-1" v-show="reg.password">
            <label class="col-sm-3 mt-1">Confirmar password</label>
            <input type="password" id="passConf" class="form-control inputVerificar col-sm-9 mt-1" @keyup="verificarPass()" placeholder="Confirmar contraseña" v-model="reg.password_confirmation">
            <label class="col-sm-12 mt-1 text-danger" v-if="passConfError">{{passConfError}}</label>
        </div>
        <p class="text-danger" v-for="(value, index) in errores" :key="index">{{value[0]}}</p>
        <button type="submit" @click="register()" class="btn btn-primary">Registrarse</button>
    </form>
</template>
<script>
    import axios from 'axios'
    import toastr from 'toastr'
    axios.defaults.withCredentials = true;
    export default {
        data(){
            return{
                reg:{
                    name:                   '',
                    email:                  '',
                    password:               '',
                    password_confirmation:  ''
                },
                confirm:        '',
                errors:         '',
                MailError:      '',
                passError:      '',
                passConfError:  '',
                errores:        '',
            }
        },
        methods:{
            verificar(){   
                if(!this.reg.email){
                    document.getElementById('mail').className = "form-control inputVerificarError col-sm-9 mt-1"
                    this.MailError = 'este campo no puede quedar vacio'
                }else{
                    document.getElementById('mail').className = "form-control inputVerificar col-sm-9 mt-1"
                    this.MailError = ''
                }
                if(this.confirm==this.reg.email){
                    document.getElementById('confirmarMail').className = "form-control inputVerificar col-sm-9 mt-1"
                    this.errors = ''
                }else{
                    document.getElementById('confirmarMail').className = "form-control inputVerificarError col-sm-9 mt-1"
                    this.errors = 'las direcciones de Email no coinciden'
                }
            },
            verificarPass(){
                if(!this.reg.password){
                    document.getElementById('password').className = "form-control inputVerificarError col-sm-9 mt-1"
                    this.passError = 'este campo no puede quedar vacio'
                }else{
                    document.getElementById('password').className = "form-control inputVerificar col-sm-9 mt-1"
                    this.passError = ''
                }
                if(this.reg.password_confirmation==this.reg.password){
                    document.getElementById('passConf').className = "form-control inputVerificar col-sm-9 mt-1"
                    this.passConfError = ''
                }else{
                    document.getElementById('passConf').className = "form-control inputVerificarError col-sm-9 mt-1"
                    this.passConfError= 'las contraseñas no coinciden'
                }
            },
            async register(){
                let url = 'register'
                if(this.errors){
                    toastr.error(this.errors)
                    return
                }
                await axios.post(url,this.reg).then(Response=>{
                    toastr.success('usuario registrado')
                    this.reg.name                   =   ''
                    this.reg.email                  =   ''
                    this.reg.password               =   ''
                    this.reg.password_confirmation  =   ''
                    this.confirm                    =   ''

                    
                }).catch(e=>{
                    this.errores = e.response.data
                    this.errores = this.errores.errors
                    
                    for(let msj in this.errores){
                        
                        toastr.error(this.errores[msj])
                        
                    }
                    
                    
                })
            }
        }
    }
</script>