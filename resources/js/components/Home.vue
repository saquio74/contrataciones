<template>
        <div>
            <div class="col-sm-4">
                <login></login>
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