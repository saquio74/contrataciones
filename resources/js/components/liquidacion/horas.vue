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
    import Axios from 'axios';
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
                cambiar: 0,
                
            }
        },
        created:function(){
            //this.pasarDatos();
        },
        methods:{
            liquidar:function(){
                this.agenteIngresar.LEG         = this.datosAgente.IDAGENTE
                this.agenteIngresar.PERIODO     = this.periodo.mes
                this.agenteIngresar.ANIO        = this.periodo.anio
                this.agenteIngresar.INC         = this.datosAgente.ID
                this.agenteIngresar.VALOR       = this.datosAgente.VALOR
                this.agenteIngresar.HOSPITAL    = this.datosAgente.IDHOSP
                this.agenteIngresar.SUBTOT      = this.agenteIngresar.HORAS    *    this.datosAgente.VALOR
                this.agenteIngresar.BONVALOR    = this.agenteIngresar.SUBTOT   *    this.agenteIngresar.BONIFICACION/100
                this.agenteIngresar.TOTAL       = this.agenteIngresar.SUBTOT   +    this.agenteIngresar.BONVALOR
            },
            pasarDatos:function(){
                
            },
            guardarDatos:function(){
                var urlAgeninc = '/contrataciones-1/public/agenfac/store'
                Axios.post(urlAgeninc,this.agenteIngresar).then(Response => {
                    toastr.success('contenido cargado satisfactoriamente');
                })     
            }
        },
        watch:{
            auxiliar:{
                handler:function(){
                    //console.log(this.datosAgente)
                    console.log(this.agenteIngresar)
                    if(this.auxiliar === 1){
                        this.guardarDatos()
                    }
                }
            }
        }
    

    

    
}
</script>