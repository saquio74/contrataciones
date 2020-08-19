<template>
    <div class="col-sm-12">
        <h1 class="text-center">Listado General de Contratados</h1>
        <div class="badge-black row col-sm-12">
            <button v-on:click="ver=0" type="submit" class="btn btn-outline-dark">ACTIVOS</button>
            <button v-on:click="ver=1"   type="submit" class="btn btn-outline-dark">NO ACTIVOS</button>
        </div>
        
        <div class="form-group row badge-dark col-sm-12">
            <button type="button" class="button2 btn"  data-toggle="modal" data-target="#cargar">
                Nuevo contratado
            </button>
            <button type="button" class="button1 btn" data-toggle="modal" data-target="#cargarContrato">
                Nuevo contrato
            </button>
            <p>
                total de proveedores activos {{contratosActivos.length}}
            </p>

            <p>
                / total de proveedores inactivos {{contratosBajas.length}}
            </p>
        </div>
        <div class="container horizontal-scrollable">
            
            <table class="table table-striped table-dark table-bordered table-hover">
                <thead v-if="ver===0">
                    <tr>
                        <th scope="col" v-if="auxiliar===0" v-on:click="ordenadosDesc('PROVEEDOR');auxiliar++"  >PROV</th>
                        <th scope="col" v-else v-on:click="ordenadosAsc('PROVEEDOR');auxiliar--" >PROV</th>
                        <th scope="col" v-if="auxiliar===0" v-on:click="ordenadosDesc('DOCUMENTO');auxiliar++"  >DNI</th>
                        <th scope="col" v-else v-on:click="ordenadosAsc('DOCUMENTO');auxiliar--" >DNI</th>
                        <th scope="col" v-if="auxiliar===0" v-on:click="ordenadosDesc('APELLIDO');auxiliar++"  >APELLIDO</th>
                        <th scope="col" v-else v-on:click="ordenadosAsc('APELLIDO');auxiliar--" >APELLIDO</th>
                        <th scope="col" v-if="auxiliar===0" v-on:click="ordenadosDesc('CONTRATO');auxiliar++"  >CONTRATO</th>
                        <th scope="col" v-else v-on:click="ordenadosAsc('CONTRATO');auxiliar--" >CONTRATO</th>
                        <th scope="col" v-if="auxiliar===0" v-on:click="ordenadosDesc('ESPECIALIDAD');auxiliar++"  >ESPECIALIDAD</th>
                        <th scope="col" v-else v-on:click="ordenadosAsc('ESPECIALIDAD');auxiliar--" >ESPECIALIDAD</th>
                        <th scope="col">CONTRATADO</th>
                        <th scope="col">CONTRATO</th>
                    </tr>
                </thead>
                <thead v-else>
                    <th scope="col" v-if="auxiliar===0" v-on:click="ordenadosDesc('PROVEEDOR');auxiliar++"  >PROV</th>
                        <th scope="col" v-else v-on:click="ordenadosAsc('PROVEEDOR');auxiliar--" >PROV</th>
                        <th scope="col" v-if="auxiliar===0" v-on:click="ordenadosDesc('DOCUMENTO');auxiliar++"  >DNI</th>
                        <th scope="col" v-else v-on:click="ordenadosAsc('DOCUMENTO');auxiliar--" >DNI</th>
                        <th scope="col" v-if="auxiliar===0" v-on:click="ordenadosDesc('APELLIDO');auxiliar++"  >APELLIDO</th>
                        <th scope="col" v-else v-on:click="ordenadosAsc('APELLIDO');auxiliar--" >APELLIDO</th>
                        
                </thead>
                <tbody v-if="ver===0">
                    <tr  v-for="contratado in contratosActivos" :key="contratado.contrato" >
                        <th>
                            {{contratado.proveedor}}
                        </th>
                        <th>
                            {{contratado.dni}}
                        </th>
                        <th>
                            {{contratado.apellido.toUpperCase() + ' ' + contratado.nombre.toUpperCase()}}
                        </th>
                        <th>
                            {{contratado.contrato}}
                            
                        </th>
                        <th>
                            {{contratado.especialidad.toUpperCase()}}
                        </th >
                        
                        <th width="10px">
                            <button type="button" class=" btn btn-small button1" data-toggle="modal" data-target="#modificar" @click="setProveedor(contratado)">Cambiar</button>
                            <button type="button" class=" btn btn-small button2">Datos</button>
                        </th>
                        <th width="10px">
                            <button type="button" class=" btn btn-small button1" data-toggle="modal" data-target="#modificar">Cambiar</button>
                            <button type="button" v-on:click.prevent="deleteContrato(contratado.contrato_id)" class=" btn btn-small btn-danger">Borrar</button>
                            
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
                            {{contratado.apellido.toUpperCase() + ' ' + contratado.nombre.toUpperCase()}}
                        </th>
                        <th width="10px">
                            <button type="button" class=" btn btn-small button1" data-toggle="modal" data-target="#modificar" @click="setProveedor(contratado)">Cambiar</button>
                        </th>
                        <th width="10px">

                            <button type="button" class=" btn btn-small button2">Datos</button>
                        </th>
                        <th width="10px">

                            <button type="button" class=" btn btn-small button3">Borrar</button>
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
        <nuevo-proveedor></nuevo-proveedor>
        <modificar-proveedor :proveedorModificar="proveedorAux"></modificar-proveedor>
        <nuevo-contrato />
        
    </div>
</template>
<script>
import axios    from 'axios';
import toastr   from 'toastr';
export default {
    data(){
        return{
            auxiliar:   0,
            ver:        0,
            errors:      [],
            proveedorAux:  '',
        }
    },
    created:function()  {
        this.hosp();
        this.cont();
        this.contBajas();
        this.especialidades();
        this.proveedores();
        //this.onFileChange();
    },
    methods:{
        hosp(){
            $('table').on('scroll', function() {
            $("#" + this.id + " > *").width($(this).width() + $(this).scrollLeft());
            });
            return this.$store.dispatch('getHospitales')
        },
        cont(){
            return this.$store.dispatch('getContratos')
        },
        contBajas(){
            return this.$store.dispatch('getContratosBajas')
        },
        especialidades(){
            return this.$store.dispatch('getEspecialidades')
        },
        proveedores(){
            return this.$store.dispatch('getProveedores')
        },
        setProveedor(contratado){
            this.proveedorAux = contratado
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
        },
        async deleteContrato(id){
            let url = 'contrato/delete/'+ id;
            console.log(url)
            try {
                await axios.delete(url)
                await this.cont()
                await this.contBajas();
                toastr.success('eliminado satisfactoriamente');
            } catch (errors) {
                this.errors = errors.response.data
                    toastr.error('error');
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
        especialidad(){
            return this.$store.state.especialidades
        },
        proveedor(){
            return this.$store.state.proveedor
        }
    }
}
</script>
<style>
    

    
</style>