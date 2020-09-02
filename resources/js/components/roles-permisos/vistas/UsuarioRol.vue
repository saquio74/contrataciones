<template>
    <form @submit.prevent="guardar">
        <div class="row col-sm-12 mt-3">

            <div class="col-sm-6 ">
                <label class="text-white"> Usuario    </label>
                <select class="form-control badge-secondary" v-model="user" @change="getRol">
                    <option value=''>seleccione</option>
                    <option v-for="user in users" :value="user" :key="user.id">{{user.name}}</option>
                </select>
            </div>
            <div class="col-sm-6">
                Rol actual: {{rolUser.name}}
            </div>
            <div class="col-sm-8 mt-3">
                <label for="" class="text-white">Roles</label>
            </div>
            <div class="row col-sm-8">
                <div class="col-sm-8">
                    <select class="form-control badge-secondary" v-model="role" @change="getPermisos">
                    <option v-for="rol in roles" :value="rol" :key="rol.id">{{rol.name}}</option>       
                    </select>
                </div>
            </div>
            <div class="row col-sm-12" v-if="role.special==='no-access'">
                <div class="col-sm-4" v-for="permiso in permisos" :key="permiso.id">
                    Permiso: {{permiso.name}}
                </div>
            </div>
            <div class="row col-sm-12" v-if="role.special==='all-access'">
                <div class="col-sm-4">
                    Permiso: Acceso total
                </div>
            </div>
            <div class="col-sm-8">

                <button type="submit" class="btn btn-primary">agregar</button>
            </div>
        </div>
    </form>
</template>
<script>
import axios from 'axios'
import toastr from 'toastr'
export default {
    data(){
        return{
            users:[],
            roles:[],
            user:'',
            role:'',
            rolUser:'',
            permisos:[]
        }
    },
    created(){
        this.getUsers()
        this.getRoles()
    },
    methods:{
        async getUsers(){
            try {
                let response = await axios.get('user')
                this.users = response.data[0]
                
            } catch (error) {
                toastr.error(error)
            }
        },
        async getRoles(){
            try {
                let data = await axios.get('roles')  
                this.roles = data.data
                
            } catch (error) {
                toastr.error(error)
            }
        },
        getRol(){
            this.rolUser = this.roles.find(rol=>{
                if(rol.id === this.user.rol_id){
                    return rol
                }
            })
        },
        async getPermisos(){
            try {
                console.log(this.role.id)
                let data = await axios.get(`permisos/${this.role.id}`)
                this.permisos = data.data
                console.log(this.permisos)
            } catch (error) {
                toastr.error(error)
            }
        },
        async guardar(){
            let datos = {
                user: this.user.id,
                rol: this.role.id,
            }
            try {
                console.log(datos)
                await axios.put('updateUser',datos)
                
            } catch (error) {
                toastr.error(error)
            }
        }
    }
}
</script>