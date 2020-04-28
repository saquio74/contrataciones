<template>
    <div class="col-sm-12">
        <h1 class="text-center">Listado General de Contratados</h1>
        <div class="badge-black row col-sm-12">
            <button v-on:click="ver=0" type="submit" class="btn btn-outline-dark">ACTIVOS</button>
            <button v-on:click="ver=1"   type="submit" class="btn btn-outline-dark">NO ACTIVOS</button>
        </div>
        <div class="form-group row badge-dark col-sm-12">
            <hr>
            <hr>
            
            <div class="col-sm-2">
                <label class="text"> proveedor      </label>
                <input type="int" class="form-control badge-secondary" id="legajo" name='legajo'>
            </div>
            <div class="col-sm-2">
                <label class="text"> DNI         </label>
                <input type="int" class="form-control badge-secondary" id="legajo" name='legajo'>
            </div>
            <div class="col-sm-2">
                <label class="text"> nombre      </label>
                <input type="text" class="form-control badge-secondary" id="nombre" name='nombre'>
            </div>
            <!--
            <div class="col-sm-2">
                <label class="text"> hospital    </label>
                <select class="form-control badge-secondary" id="hospital" name='hospital'>
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
            <div class="col-sm-6">
                <label class="text">TOTAL DE AGENTES:</label>
                <P>  {{searchAgentes.length}}</P>
            </div>-->
        </div>
        <div class="form-group row badge-dark col-sm-12">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cargar">
                Nuevo contratado
            </button>
            <p>
                total de proveedores activos {{contratosActivos.length}}
            </p>

            <p>
                / total de proveedores inactivos {{contratosBajas.length}}
            </p>
        </div>

        <table class="table table-striped table-dark table-bordered table-hover">
            <thead v-if="ver===0">
                <tr>
                    <th scope="col" v-if="auxiliar===0" v-on:click="ordenadosDesc('PROVEEDOR');auxiliar++"  >PROV</th>
                    <th scope="col" v-else v-on:click="ordenadosAsc('PROVEEDOR');auxiliar--" >PROV</th>
                    <th scope="col" v-if="auxiliar===0" v-on:click="ordenadosDesc('DOCUMENTO');auxiliar++"  >DNI</th>
                    <th scope="col" v-else v-on:click="ordenadosAsc('DOCUMENTO');auxiliar--" >DNI</th>
                    <th scope="col" v-if="auxiliar===0" v-on:click="ordenadosDesc('NOMBRE');auxiliar++"  >NOMBRE</th>
                    <th scope="col" v-else v-on:click="ordenadosAsc('NOMBRE');auxiliar--" >NOMBRE</th>
                    <th scope="col" v-if="auxiliar===0" v-on:click="ordenadosDesc('APELLIDO');auxiliar++"  >APELLIDO</th>
                    <th scope="col" v-else v-on:click="ordenadosAsc('APELLIDO');auxiliar--" >APELLIDO</th>
                    <th scope="col" v-if="auxiliar===0" v-on:click="ordenadosDesc('CONTRATO');auxiliar++"  >CONTRATO</th>
                    <th scope="col" v-else v-on:click="ordenadosAsc('CONTRATO');auxiliar--" >CONTRATO</th>
                    <th scope="col" v-if="auxiliar===0" v-on:click="ordenadosDesc('ESPECIALIDAD');auxiliar++"  >ESPECIALIDAD</th>
                    <th scope="col" v-else v-on:click="ordenadosAsc('ESPECIALIDAD');auxiliar--" >ESPECIALIDAD</th>
                </tr>
            </thead>
            <thead v-else>
                <th scope="col" v-if="auxiliar===0" v-on:click="ordenadosDesc('PROVEEDOR');auxiliar++"  >PROV</th>
                    <th scope="col" v-else v-on:click="ordenadosAsc('PROVEEDOR');auxiliar--" >PROV</th>
                    <th scope="col" v-if="auxiliar===0" v-on:click="ordenadosDesc('DOCUMENTO');auxiliar++"  >DNI</th>
                    <th scope="col" v-else v-on:click="ordenadosAsc('DOCUMENTO');auxiliar--" >DNI</th>
                    <th scope="col" v-if="auxiliar===0" v-on:click="ordenadosDesc('NOMBRE');auxiliar++"  >NOMBRE</th>
                    <th scope="col" v-else v-on:click="ordenadosAsc('NOMBRE');auxiliar--" >NOMBRE</th>
                    <th scope="col" v-if="auxiliar===0" v-on:click="ordenadosDesc('APELLIDO');auxiliar++"  >APELLIDO</th>
                    <th scope="col" v-else v-on:click="ordenadosAsc('APELLIDO');auxiliar--" >APELLIDO</th>
            </thead>
            <tbody v-if="ver===0">
                <tr  v-for="contratado in contratosActivos" :key="contratado.id" >
                    <th>
                        {{contratado.proveedor}}
                    </th>
                    <th>
                        {{contratado.dni}}
                    </th>
                    <th>
                        {{contratado.nombre.toUpperCase()}}
                    </th>
                    <th>
                        {{contratado.apellido.toUpperCase()}}
                    </th>
                    <th>
                        {{contratado.contrato}}
                    </th>
                    <th>
                        {{contratado.especialidad.toUpperCase()}}
                    </th >
                    
                    <th width="10px">
                        
                        <a href="#" class="btn btn-primary btn-small">Datos</a>
                    </th>
                </tr>
            </tbody>
            <tbody v-else>
                <tr v-for="contratado in contratosBajas" :key="contratado.id">
                    <th>
                        {{contratado.proveedor}}
                    </th>
                    <th>
                        {{contratado.dni}}
                    </th>
                    <th>
                        {{contratado.nombre.toUpperCase()}}
                    </th>
                    <th>
                        {{contratado.apellido.toUpperCase()}}
                    </th>
                    <th width="10px">
                        
                        <a href="#" class="btn btn-primary btn-small">Datos</a>
                    </th>
                </tr>
            </tbody>
        </table>
        <nuevo-proveedor></nuevo-proveedor>
    </div>
</template>
<script>
export default {
    data(){
        return{
            auxiliar:   0,
            ver:        0,
        }
    },
    created:function()  {
        this.hosp();
        this.cont();
        this.contBajas();
        //this.onFileChange();
    },
    methods:{
        hosp(){
            return this.$store.dispatch('getHospitales')
        },
        cont(){
            return this.$store.dispatch('getContratos')
        },
        contBajas(){
            return this.$store.dispatch('getContratosBajas')
        },
        ordenadosAsc: function(prop) {
            if(this.ver===0){
                this.contratosActivos.sort(function(a,b){
                    if(prop === 'PROVEEDOR'){
                        return (a.proveedor - b.proveedor)
                    }
                    if(prop === 'DNI'){
                        return (a.dni - b.dni)
                    }
                    if(prop ==='NOMBRE'){
                        return (a.nombre.localeCompare(b.nombre))
                    }
                    if(prop ==='APELLIDO'){
                        return (a.apellido.localeCompare(b.apellido))
                    }
                    if(prop ==='CONTRATO'){
                        return (a.contrato - b.contrato)
                    }
                    if(prop ==='ESPECIALIDAD'){
                        return (a.especialidad.localeCompare(b.especialidad))
                    }
                });
            }else{
                this.contratosBajas.sort(function(a,b){
                    if(prop === 'PROVEEDOR'){
                        return (a.proveedor - b.proveedor)
                    }
                    if(prop === 'DNI'){
                        return (a.dni - b.dni)
                    }
                    if(prop ==='NOMBRE'){
                        return (a.nombre.localeCompare(b.nombre))
                    }
                    if(prop ==='APELLIDO'){
                        return (a.apellido.localeCompare(b.apellido))
                    }
                    if(prop ==='CONTRATO'){
                        return (a.contrato - b.contrato)
                    }
                    if(prop ==='ESPECIALIDAD'){
                        return (a.especialidad.localeCompare(b.especialidad))
                    }
                });
            }
        },
        ordenadosDesc:function(prop){
            this.ordenadosAsc(prop);
            if(this.ver===0){
                this.contratosActivos.reverse();
            }else{
                this.contratosBajas.reverse();
            }
        }
    },
    computed:{
        hospitales(){
            return this.$store.state.hospitales
        },
        contratosActivos(){
            return this.$store.state.contratos
        },
        contratosBajas(){
            return this.$store.state.contratosBajas
        },
    }
}
</script>