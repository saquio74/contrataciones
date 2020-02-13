<template>
    <div class="panel panel-default   col-sm-12">

        <h1 class="text-center">Listado General de agentes</h1>
        <div class="form-group badge-black row">
            <button v-on:click="getActivos" type="submit" class="btn btn-outline-dark">ALTAS</button>
            <button v-on:click="getBajas"   type="submit" class="btn btn-outline-dark">BAJAS</button>
            <button type="submit" class="btn btn-outline-black">VACACIONES</button>
        </div>
        <div class="form-group row badge-dark">
            <hr>
            <hr>

            <button v-on:click="getAgentes" class="btn btn-primary" v-if="!agentes.length">Listar</button>
            <div class="col-sm-2">
                <label class="text"> legajo      </label>
                <input type="int" v-model="legajo"    v-if="agentes.length" class="form-control badge-secondary" id="legajo" name='legajo'>
            </div>
            <div class="col-sm-2">
                <label class="text"> nombre      </label>
                <input type="text" v-model="nombre"   v-if="agentes.length" class="form-control badge-secondary" id="nombre" name='nombre'>
            </div>
            <div class="col-sm-2">
                <label class="text"> hospital    </label>
                <input type="text" v-model="hospital" v-if="agentes.length" class="form-control badge-secondary" id="hospital" name='hospital'>
            </div>
            <div class="col-sm-2">
                <label class="text"> servicio    </label>
                <input type="text" v-model="servicio" v-if="agentes.length" class="form-control badge-secondary" id="legajo" name='legajo'>
            </div>
            <div class="col-sm-2">
                <label class="text">activo o baja</label>
                <input type="text" v-model="activo"   v-if="agentes.length" class="form-control badge-secondary" id="legajo" name='legajo'>
            </div>
            
            <hr>
            <hr>
        </div>
        <table class="table table-striped table-dark table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">LEGAJO</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">HOSPITAL</th>
                    <th scope="col">SERVICIO</th>
                    <th scope="col">SECTOR</th>
                    <th scope="col">ACTIVO</th>
                    <th scope="col">FECHA DE INGRESO</th>
                </tr>
            </thead>
                    
            <tbody>
                <tr  v-for="agente in searchAgentes" :key="agente.LEGAJO" >
                    <th>
                        {{agente.LEGAJO}}
                    </th>
                    <th>
                        {{agente.NOMBRE.toUpperCase()}}
                    </th>
                    <th>
                        {{agente.HOSPITAL.toUpperCase()}}
                    </th>
                    <th>
                        {{agente.SERVICIO}}
                    </th>
                    <th>
                        {{agente.SECTOR}}
                    </th >
                    <th v-if="agente.ACTIVO==0">
                        ACTIVO
                    </th>
                    <th v-else>
                        BAJA
                    </th>
                    <th>
                        {{agente.fecha_ingreso}}
                    </th>
                </tr>
            </tbody>
        </table>

    </div>
</template>

<script>
    export default{
        data(){
            return {
                agentes:  [],
                legajo: '',
                nombre:'',
                hospital:'',
                servicio:'',
                activo:'',
                auxiliar:[],
            }
        },
        created: function(){
            this.getAgentes();
        },
        methods:{
            getAgentes: function(){
                var urlAgentes ='agente';
                axios.get(urlAgentes).then(Response => {
                    this.agentes = Response.data
                });
            },
            getActivos: function(){
                var urlActivos ='activos';
                axios.get(urlActivos).then(Response => {
                    this.agentes = Response.data
                });
            },
            getBajas: function(){
                var urlBajas = 'bajas';
                axios.get(urlBajas).then(Response=>{
                    this.agentes = Response.data
                });
            }
        },
        computed:{
            searchAgentes: function(){
                if (this.nombre) {
                    return this.agentes.filter((agente)=>
                    agente.NOMBRE.toUpperCase().includes(this.nombre.toUpperCase())
                    )
                }else if(this.hospital){
                    return this.agentes.filter((agente)=>agente.HOSPITAL.toUpperCase().includes(this.hospital.toUpperCase()))
                }else if(this.servicio){
                    return this.agentes.filter((agente)=>agente.SERVICIO.toUpperCase().includes(this.servicio.toUpperCase()))
                }else if(this.legajo){
                    return this.agentes.filter((agente)=>agente.LEGAJO.toString().includes(this.legajo.toString()))
                }else{
                    return this.agentes
                }
                
            }
        }
    }
    
</script>
