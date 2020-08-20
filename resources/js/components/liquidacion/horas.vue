<template>
    <th>
        <div class="row" :class="color">
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
            <input type="text" :class="{}" class="form-control" v-model="agenteIngresar.HORAS" v-on:keyup="liquidar()" >
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
    import axios  from 'axios';
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
                agentesBuscar:  [],
                cambiar:        0,
                verificar:      0,
                
            }
        },
        created:function(){
            this.pasarDatos();
            this.buscarLiquidacion();
            
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
                axios.post(urlAgeninc,this.agenteIngresar).then(Response => {
                    toastr.success('contenido cargado satisfactoriamente');
                    this.agenteIngresar.HORAS       =   0
                    this.agenteIngresar.SUBTOT      =   0
                    this.agenteIngresar.BONVALOR    =   0
                    this.agenteIngresar.TOTAL       =   0
                    this.verificar++
                })     
            },
            buscarLiquidacion:async function(){
                this.verificar = this.liquidacion.map(result=>result.LEG).indexOf(this.datosAgente.IDAGENTE )
            },
            
        },
        computed:{
            liquidacion(){
                
                return this.$store.state.liquidacion
            },
            color(){
                return{
                    "bg-warning text-dark" : this.verificar >= 0,
                    "bg-dark"       : this.verificar<0 
                }
            }
        },

        watch:{
            auxiliar:{
                handler:function(){
                    this.buscarLiquidacion()
                    if(this.auxiliar === 1 && this.agenteIngresar.HORAS && this.verificar < 0 ){
                        this.guardarDatos()
                    }
                    if(this.verificar>=0 && this.auxiliar < 2 && this.agenteIngresar.HORAS){
                        toastr.warning('El Agente con legajo ' + 
                        this.datosAgente.IDAGENTE  + 
                        ' ya existe vuelva a presionar para liquidarlo')
                    }
                    if(this.auxiliar === 2 && this.agenteIngresar.TOTAL){
                        this.guardarDatos()
                    }
                }
            }
        }
    

    

    
}
</script>