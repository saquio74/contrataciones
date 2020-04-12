<template>
    <th>
        <div class="row">
            <div class="col-sm-3">
                bonificacion
                <select class="form-control badge-secondary" v-model="agenteIngresar.BONIFICACION">
                    <option value='0'>0</option>
                    <option value='20'>20</option>
                    <option value='30'>30</option>
                </select>
            </div>
            <div class="col-sm-3">
                horas
            <input type="text" class="form-control badge-secondary" v-model="agenteIngresar.HORAS" v-on:keyup="liquidar()" >
            </div>
            
            <div class="col-sm-2">
                subtotal: {{agenteIngresar.SUBTOT.toFixed(2)}}
            </div>
            <div class="col-sm-2">
                bonif: {{agenteIngresar.BONVALOR.toFixed(2)}}
            </div>
            <div class="col-sm-2">
                Total: {{agenteIngresar.TOTAL.toFixed(2)}}
            </div>
        </div>
    </th>
</template>
<script>
    import Axios  from 'axios';
    import toastr from 'toastr';
    export default {
        props:{
            datosAgente:{

            },
            periodo:{

            },
            auxiliar:{

            }
        },
        data(){
            return{
                agenteIngresar:{
                    LEG:            '',
                    PERIODO:        '',
                    ANIO:           '',
                    INC:            '',
                    VALOR:          '',
                    HORAS:          '',
                    BONIFICACION:   20,
                    SUBTOT:          0,
                    BONVALOR:        0,
                    TOTAL:           0,
                    HOSPITAL:       '',
                },
                agenteAux:{
                    leg:        0,
                    periodo:    0,
                    anio:       0,
                },
                agenfac:[],
                cambiar: 0,
                
            }
        },
        created:function(){
            this.pasarDatos();
        },
        methods:{
            liquidar:function(){//calcula los valores a ingresar
                
                this.agenteIngresar.SUBTOT      = this.agenteIngresar.HORAS    *    this.datosAgente.VALOR
                this.agenteIngresar.BONVALOR    = this.agenteIngresar.SUBTOT   *    this.agenteIngresar.BONIFICACION/100
                this.agenteIngresar.TOTAL       = this.agenteIngresar.SUBTOT   +    this.agenteIngresar.BONVALOR
            },
            pasarDatos:function(){//set datos pasados por prop a objeto a ingresar
                this.agenteIngresar.LEG         = this.datosAgente.IDAGENTE
                this.agenteIngresar.PERIODO     = this.periodo.mes
                this.agenteIngresar.ANIO        = this.periodo.anio
                this.agenteIngresar.INC         = this.datosAgente.ID
                this.agenteIngresar.VALOR       = this.datosAgente.VALOR
                this.agenteIngresar.HOSPITAL    = this.datosAgente.IDHOSP
            },
            guardarDatos:function(){//ingresa los datos
                var urlAgeninc = '/contrataciones-1/public/agenfac/store'
                Axios.post(urlAgeninc,this.agenteIngresar).then(Response => {
                    toastr.success('contenido cargado satisfactoriamente');
                    this.agenteIngresar.HORAS       =   0
                    this.agenteIngresar.SUBTOT      =   0
                    this.agenteIngresar.BONVALOR    =   0
                    this.agenteIngresar.TOTAL       =   0
                })     
            },
            buscarLiquidacion:function(){
                var urlLiquidacion      = '/contrataciones-1/public/agenfac/verificar';
                this.agenteAux.leg      = this.agenteIngresar.LEG
                this.agenteAux.periodo  = this.agenteIngresar.PERIODO
                this.agenteAux.anio     = this.agenteIngresar.ANIO 
                Axios.post(urlLiquidacion,this.agenteAux).then(Response=>{
                    this.agenfac = Response.data
                    toastr.warning('agente existe')
                })
            }
        },
        watch:{
            auxiliar:{
                handler:function(){
                    if(this.auxiliar === 1 && this.agenteIngresar.TOTAL){
                        this.buscarLiquidacion()
                        this.guardarDatos()
                        
                    }
                }
            }
        }
    

    

    
}
</script>