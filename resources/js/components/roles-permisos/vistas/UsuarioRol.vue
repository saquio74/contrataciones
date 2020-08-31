<template>
    <div class="row col-sm-12 mt-3">
        <form @submit.prevent="guardar">

            <div class="col-sm-8 ">
            
                <label class="text-white"> Usuario    </label>
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
export default {
    
}
</script>