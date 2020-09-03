<template>
    <div class="container-fluid row">
        <div class="col-md-4 col-sm-4 offset-md-8">
            <usuario></usuario>
        </div>
        <div class="col-md-2">
            <nav class="navbar navbar-expand-md navbar-dark bg-dark">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse secondary" id="navbarToggleExternalContent">
                    <ul class="nav column">
                        <li class="nav-item active">
                            <button type="submit" class="btn btn-outline-primary">
                            <router-link class="nav-link" :to="{name: 'login'}"> INICIO <span class="sr-only">(current)</span></router-link>
                            </button>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Certificar</a>
                        </li>
                        <li class="nav-item active">
                            <router-link class="nav-link" :to="{name: 'Foo'}"> Altas y Bajas       </router-link>
                        </li>
                        <li class="nav-item active">
                            <router-link class="nav-link" :to="{name: 'Bar'}"> Vacaciones          </router-link>
                        </li>
                        <li class="nav-item active">
                            <router-link class="nav-link" :to="{name: 'paraLiquidar'}"> Liquidar   </router-link>
                        </li>
                        <li class="nav-item active">
                            <router-link class="nav-link" :to="{name: 'contratos'}"> Contratados</router-link>
                        </li>
                        <li class="nav-item active">
                            <router-link class="nav-link" :to="{name: 'contaduria'}"> contaduria</router-link>
                        </li>
                        <li class="nav-item active">
                            <router-link class="nav-link" :to="{name: 'complementaria'}"> complementaria</router-link>
                        </li>
                        
                        <li class="nav-item active">
                            <router-link class="nav-link" :to="{name: 'inciso'}"> incisos</router-link>
                        </li>
                        <li class="nav-item active">
                            <router-link class="nav-link" :to="{name: 'roles'}"> Roles</router-link>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="col-sm-10">
            <div class="col-sm-12 bg-secondary" v-if="userConfirm">
                <router-view></router-view>
            </div>
            <div class="col-sm-12 bg-secondary" v-else>
                <login></login>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            
        }
    },
    created:function()  {
        window.onbeforeunload = function(e){
            this.$router.go('/login')
        } 
    },
    methods:{
        
        
    },
    computed:{
        hospitales(){
            return this.$store.state.hospitales
        },
        agentes(){
            return this.$store.state.agentes
        },
        userConfirm(){
            return this.$store.state.user
        },
        
    }
}
</script>