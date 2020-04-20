<template>
        <div>
            <div class="col-sm-4">
                <form action="">

                    <input type="file" @change="previewFiles">
                </form>
                <!--<ul v-for="hospital in hospitales" class="list-group" :key="hospital.ID">
                    <li class="list-group-item list-group-item">
                        {{hospital.HOSPITAL}}
                    </li>
                </ul>-->
            </div>
            

        </div>
    
</template>
<script>
import xlsx from 'xlsx'
import axios from 'axios';
export default {
    data(){
        return{
            
        }
    },
    created:function()  {
        this.hosp();
        this.agen();
        //this.onFileChange();
    },
    methods:{
        hosp(){
            return this.$store.dispatch('getHospitales')
        },
        agen(){
            return this.$store.dispatch('getAgentes')
        },
        previewFiles(files) {
            console.log(files.target.files);
            var url = '/contrataciones-1/public/especialidad/excelImport'
            axios.post(url,files).then(Response=>{
                console.log('hola')
            });  
        }
        
    },
    computed:{
        hospitales(){
            return this.$store.state.hospitales
        },
        agentes(){
            return this.$store.state.agentes
        }
        
        
    }
}
</script>