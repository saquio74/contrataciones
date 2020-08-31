<template>
    <div class="row col-sm-12 mt-3">
        <form @submit.prevent="guardar">

            <div class="col-sm-8 ">
            
                <label class="text-white"> Roles    </label>
                <select class="form-control badge-secondary" v-model="rol" >
                    <option value=''>seleccione</option>
                    <option v-for="rolAux in roles" :value="rolAux.id" :key="rolAux.id" >{{rolAux.name}}</option>
                </select>
            </div>
            <div class="col-sm-12">

                <label for="" class="text-white">Permisos</label>
            </div>
            <div class="row col-sm-12">
                
                <div class="col-sm-8">
                    <select multiple class="form-control badge-secondary" v-model="rolPermiso" >
                    <option v-for="permiso in permisos" :value="permiso.id" :key="permiso.id">{{permiso.name}}</option>       
                        
                                
                    </select>
                </div>
                <div class="col-sm-4">
                    <label for="" class="text-white">Utilice la tecla "ctrl + click izquierdo para seleccionar mas de uno"</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">agregar</button>
        </form>
        
    </div>
</template>
<script>
import axios    from 'axios'
import toastr   from 'toastr'
export default {
    data(){
        return{
            permisos:{

            },
            roles:{

            },
            rol:'',
            rolPermiso:[]
            
        }
    },
    created(){
        this.getPermisos()
        this.getRoles()
    },
    methods:{
        async getPermisos(){
            try {
                let data = await axios.get('permisos')
                this.permisos = data.data
                //console.log(this.permisos) 
            } catch (error) {
                
            }
        },
        async getRoles(){
            try {
                let data = await axios.get('roles')  
                console.log(data.data)
                this.roles = data.data
                
            } catch (error) {
                toastr.error(error)
            }
        },
        async guardar(){
            await this.rolPermiso.forEach(permiso=>{
                let rolesPermisos={
                    roles_id: this.rol,
                    permissions_id: permiso
                }
                try {
                    axios.post('rolesPermisos',rolesPermisos)
                    
                    toastr.success('guaradado correctamente')
                } catch (error) {
                    toastr.error(error)
                }
            })
        }
        
    }
    
}
</script>