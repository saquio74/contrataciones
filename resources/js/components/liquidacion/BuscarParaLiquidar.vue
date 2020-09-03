<template>
    <div>
        <div class="form-group row badge-dark col-sm-12" v-if="rol.special =='all-access' || permiso">
            <h2 class="text-center">Buscar Agentes</h2>
            <hr>
            
            <br>
            <div class="col-sm-3 " v-if="rol.special =='all-access'">
                <label class="text"> hospital    </label>
                <select class="form-control badge-secondary" v-model="hospital" id="hospital" name='hospital'>
                    <option value=''>seleccione</option>
                    <option v-for="hosp in hospitales" :key="hosp.ID" :value="hosp.ID" >{{hosp.HOSPITAL}}</option>
                </select>
            </div>
            <div class="col-sm-3 " v-else>
                <label class="text"> hospital    </label>
                <select class="form-control badge-secondary" v-model="hospital" id="hospital" name='hospital'>
                    <option value=''>seleccione</option>
                    <option v-for="hosp in hospitalesAux" :key="hosp.ID" :value="hosp.ID" >{{hosp.HOSPITAL}}</option>
                </select>
            </div>
            <div class="col-sm-3">
                <label class="text"> servicio    </label>
                <select class="form-control badge-secondary" v-model="servicio" id="servicio" name='servicio'>
                    <option value=''>seleccione</option>
                    <option v-for="serv in servicios" :value="serv.ID" :key="serv.ID">{{serv.SERVICIO}}</option>
                </select>
            </div>
            <div class="col-sm-3">
                <label class="text"> sectores    </label>
                <select class="form-control badge-secondary" v-model="sector" id="sector" name='sector'>
                    <option value=''>seleccione</option>
                    <option v-for="sect in sectores" :value="sect.ID" :key="sect.SECTOR">{{sect.SECTOR}}</option>

                </select>
                <br>
            </div>
            
            <br>
            <br>
            <div class="form-group row badge-secondary col-sm-12">

                <liquidacion @speak="speakMethod()" :hospitalId="hospital" :servicioId="servicio" :sectorId="sector" />
            </div>
        </div>
        <div v-else>
            <h2 class="display-1">
                no pose permiso para entrar aqui
            </h2>
        </div>
    </div>
</template>
<script>
    import toastr from 'toastr'
    import moment from 'moment'
 

    
    
    export default {
        
        data(){
            return {
                hospital:   '',
                servicio:   '',
                sector:     '',
                permiso:    [],
                hospitalesAux: [],
            }
        },
        created: function(){
            this.getTodo();
            this.buscarPermiso();
        },
        methods:{
            async buscarPermiso(){
                
                await this.permisos.find(valor =>{
                    let cadena = valor.name.split(" ")
                    if(cadena[0]=='Liquidar'){
                        this.permiso.push(valor.slug)
                    }
                })
                await this.hospitales.find(hospital=>{
                    this.permiso.find(perm => {
                        
                        if(perm == hospital.ID){
                            this.hospitalesAux.push(hospital)
                        }
                    })
                })
                
            },
            getTodo:async function(){
                await this.$store.dispatch('getHospitales')
                await this.$store.dispatch('getServicios')
                await this.$store.dispatch('getSectores')
            },
            
        },
        computed:{
            hospitales(){
                return this.$store.state.hospitales
            },
            servicios(){
                return this.$store.state.servicios
            },
            sectores(){
                return this.$store.state.sectores
            },
            permisos(){
                return this.$store.state.permisos
            },
            rol(){
                return this.$store.state.rol
            }
        }
    }
</script>