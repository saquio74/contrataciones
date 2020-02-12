<template>
    <div class="panel panel-default   col-sm-12">

        <h1 class="text-center">Listado General de agentes</h1>
        <div class="form-group row badge-dark">
            <hr>
            <hr>

            <button v-on:click="getAgentes" class="btn btn-primary" v-if="!agentes.length">Listar</button>
            <div class="col-sm-6">
            <input type="text" v-model="legajo" v-if="agentes.length" class="form-control badge-secondary" id="legajo" name='legajo'>
            </div>
            <div class="com-sm-2">
                
                <p v-if="!LEGAJO">para filtrar por legajo escribe aqui</p>
                <p v-else>puedes elegir por donde filtrar</p>
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
                <tr  v-for="agente in agentes" :key="agente.LEGAJO" >
                    <th>
                        {{agente.LEGAJO}}
                    </th>
                    <th>
                        {{agente.NOMBRE}}
                    </th>
                    <th>
                        {{agente.HOSPITAL}}
                    </th>
                    <th>
                        {{agente.SERVICIO}}
                    </th>
                    <th>
                        {{agente.SECTOR}}
                    </th >
                    <th>
                        Activo
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
            }
        },
        
        methods:{
            getAgentes: function(){
                var urlAgentes ='agente';
                axios.get(urlAgentes).then(Response => {
                    this.agentes = Response.data
                });
            }
        },
        computed:{
            filtroAgentes(){
                if(this.legajo){
                    return this.legajo.toLowerCase().split(' ').every(v => agente.NOMBRE.toLowerCase().includes(v))
                }else{
                    return this.agentes;
                }
            }
        }
    }
    
</script>
