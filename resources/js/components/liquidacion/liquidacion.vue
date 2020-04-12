<template>
    <div class="panel panel-default col-sm-12">
        <form v-on:submit.prevent="getAgentes" method="post">
            <input type="hidden" v-model="datos.hospitalId">
            <input type="hidden" v-model="datos.servicioId">
            <input type="hidden" v-model="datos.sectorId">
            <button type="button" class="button btn btn-primary" v-on:click="getAgentes()">Buscar</button>
        </form>
        <h2 class="text-dark text-center">LIQUIDACION M.T. {{periodo.mes}} de {{periodo.anio}}</h2>

        <p class="text-dark">
            Cantidad de incisos a liquidar: {{agentes.length}}
        </p>  
        
        <table class="table table-sm table-striped table-dark table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col-sm-2" >LEGAJO</th>
                    <th scope="col-sm-2" >INC</th>
                    <th scope="col-sm-2" >NOMBRE</th>
                    <th scope="col-sm-6" >LIQUIDACION</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="agente in agentes" :key="agente.LEGAJO">

                    <th>
                        {{agente.IDAGENTE}}
                    </th>
                    <th>
                        {{agente.INCISO}}
                    </th>
                    <th >
                        {{agente.NOMBRE.toUpperCase()}}
                    </th>
                    <horas-ingresar @speak="agentes()" :datosAgente="agente" :periodo="periodo" :auxiliar="auxiliar" />
                </tr>
            </tbody>
        </table>

        <button type="button" class="button btn btn-primary" v-on:click="auxiliar++">liquidar {{auxiliar}}</button>
    </div>
</template>

<script>
    import toastr from 'toastr'
    import moment from 'moment'
    import axios  from 'axios'
    import jquery from 'jquery'

    
    
    export default {
        props:{
            hospitalId:{
            },
            servicioId:{
            },
            sectorId:{
            },

        },
        data(){
            return {
                agentes:     [],
                agenfac:     [],
                periodo:{
                    mes:     '',
                    anio:    '',
                },
                datos:{
                    hospitalId: '',
                    servicioId: '',
                    sectorId:   '',
                },
                meses:[
                'ENERO',
                'FEBRERO',
                'MARZO',
                'ABRIL',
                'MAYO',
                'JUNIO',
                'JULIO',
                'AGOSTO',
                'SEPTIEMBRE',
                'OCTUBRE',
                'NOVIEMBRE',
                'DICIEMBRE',
                ],
                auxiliar: 0,
            }
        },
        created:function(){
            this.getFecha();
        },
        methods:{
            getAgentes: function(){
                if (this.hospitalId) {
                    this.datos.hospitalId   = this.hospitalId
                    this.datos.servicioId   = this.servicioId
                    this.datos.sectorId     = this.sectorId
                    
                    var urlAgentes ='/contrataciones-1/public/agenincs/hosp';
                    axios.post(urlAgentes, this.datos).then(Response => {
                        this.agentes = Response.data
                        toastr.success('contenido cargado satisfactoriamente');
                        
                    });
                }
            },
            getFecha:function(){
                if(moment().month()===0){
                    this.periodo.anio = moment().year() - 1 
                    this.periodo.mes = this.meses[12]
                }else{
                    this.periodo.mes = this.meses[moment().month()-1]
                    this.periodo.anio = moment().year()
                }
            },

        },
    }
    
</script>
