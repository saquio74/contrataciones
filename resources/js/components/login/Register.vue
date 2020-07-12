<template>
    <form>
        <div class="form-group col-sm-12 col-md-6 col-lg-4">
            {{usuario}}
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" placeholder="Enter email" v-model="usuario">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group col-sm-12 col-md-6 col-lg-4">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" placeholder="Password" v-model="password">
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="button" @click="login" class="btn btn-primary">Submit</button>
    </form>
</template>
<script>
    
    export default {
        data(){
            return{
                usuario:'',
                password:'',
            }
        },
        methods:{
            login(){
                
            }
        }
    }
</script>