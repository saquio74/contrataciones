<!DOCTYPE html>
    <html>
    <head>
        <title>Home</title>
        
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        
    </head>
    <body style="font-size:14px" class="bg-dark" >
        @include('header')
        <div class="container col-sm-12">
            <div class="col-sm-6 offset-3">
                <h2 class="text-center text-light">Menu General</h2>    
            </div>
            
        </div>
        <div class="container-fluid">
            <div class="row" id='app'>
                <div class="col-sm-2">
                    <nav class="navbar navbar-expand-md navbar-dark bg-dark col-sm-4">
                        <div class="collapse navbar-collapse secondary" id="navbarCollapse">
                            <ul class="nav column">
                                <li class="nav-item active">
                                    <button type="submit" class="btn btn-outline-primary">
                                        
                                    <router-link class="nav-link" :to="{name: 'Home'}"> INICIO <span class="sr-only">(current)</span></router-link>
                                    </button>
                                    
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link" href="#">Certificar</a>
                                </li>
                                <li class="nav-item">
                                    <router-link class="nav-link" :to="{name: 'Foo'}"> Altas y Bajas       </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link class="nav-link" :to="{name: 'Bar'}"> Vacaciones          </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link class="nav-link" :to="{name: 'paraLiquidar'}"> Liquidar   </router-link>
                                </li>
                                
                            </ul>
                        </div>
                    </nav>
                </div>
                
                <div class="col-sm-10">
                    <div class="bg-secondary">
                        <div class="col-sm-12">
                            <div>
                            
                            
                            
                                    
                        
                            <router-view></router-view>
                            <br>
                                @yield('contenido')    
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <!--<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>
        -->        

        <script src="{{asset('js/app.js')}}"></script>
    </body>
</html>