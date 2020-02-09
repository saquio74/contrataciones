<template>
    <div class="panel panel-default   col-sm-12">

        <h1 class="text-center">Listado General de agentes</h1>
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
                <tr  v-for="agente in agentes" >
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
                
                
            }
        }
    }
    
</script>
