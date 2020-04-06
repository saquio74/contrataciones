<template>
    <div class="form-group row badge-dark col-sm-12">
            <hr>
            <hr>
            <br>
            <div class="col-sm-2">
                <label class="text"> hospital    </label>
                <select class="form-control badge-secondary" v-model="hospital" id="hospital" name='hospital'>
                    <option value=''>seleccione</option>
                    <option v-for="hosp in hospitales" :key="hosp.ID" :value="hosp" >{{hosp.HOSPITAL}}</option>
                </select>
            </div>
            <div class="col-sm-2">
                <label class="text"> servicio    </label>
                <select class="form-control badge-secondary" v-model="servicio" id="servicio" name='servicio'>
                    <option value=''>seleccione</option>
                    <option v-for="serv in servicios" :value="serv.SERVICIO" :key="serv.ID">{{serv.SERVICIO}}</option>
                </select>
            </div>
            <div class="col-sm-2">
                <label class="text"> sectores    </label>
                <select class="form-control badge-secondary" v-model="sector" id="servicio" name='servicio'>
                    <option value=''>seleccione</option>
                    <option v-for="sect in sectores" :value="sect.SECTOR" :key="sect.SECTOR">{{sect.SECTOR}}</option>

                </select>
            </div>
            <hr>
            <hr>
        </div>
</template>
<script>
    import toastr from 'toastr'
    import moment from 'moment'
    import axios  from 'axios'
    import jquery from 'jquery'
    
    
    export default{
        
        data(){
            return {
                hospital:   '',
                servicio:   '',
                sector:     '',
                hospitales: [],
                servicios:  [],
                sectores:   [],
            }
        },
        created: function(){
            this.getHospitales();
            this.getServicios();
            this.getSectores();
        },
        methods:{
            getHospitales:function(){
                var urlHospitales = '/contrataciones-1/public/hospitales';
                axios.get(urlHospitales).then(Response=>{
                    this.hospitales = Response.data
                });
            },
            getServicios:function(){
                var urlServicios = '/contrataciones-1/public/servicios';
                axios.get(urlServicios).then(Response=>{
                    this.servicios = Response.data
                });
            },
            getSectores:function(){
                var urlSectores = '/contrataciones-1/public/sectores';
                axios.get(urlSectores).then(Response=>{
                    this.sectores = Response.data
                });
            },
        },
    }
</script>