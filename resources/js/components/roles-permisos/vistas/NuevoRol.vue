<template>
    <div>
        <div class="row col-sm-12 mt-3">
            
                <div class="col-sm-4">
                    <label for="" class="text-white">NOMBRE</label>
                    <input type="text" v-model="rol.name" class="form-control badge-secondary" placeholder="Ej: liquidador, administrativo,etc">
                </div>
                <div class="col-sm-4">
                    <label for="" class="text-white">Descripcion</label>
                    <input type="text" v-model="rol.description" class="form-control badge-secondary" placeholder="una descripcion breve de las tareas">
                </div>
                <div class="col-sm-4">
                    <br>
                    <button type="button" class="btn btn-primary" v-on:click="agregarRol()">
                        Agregar Inciso
                    </button>
                </div>
            </div>
    </div>
</template>
<script>
import axios    from 'axios'
import toastr   from 'toastr'
export default {
    data(){
        return{
            rol:{
                name:'',
                description:''
            }
        }
    },
    methods:{
        async agregarRol(){
            try {
                await axios.post('roles/create', this.rol)
                this.rol.name = ''
                this.rol.description = ''
                toastr.success('creado correctamente')

            } catch (error) {
                toastr.error('no se ha podido ingresar')
            }
            //console.log(this.rol)
        }
    }
}
</script>