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
            <div class="row">

                <div class="col-sm-2">
                    
                    @include('menu')
                </div>
                
                <div class="col-sm-10">
                    <div class="bg-secondary">
                        <div class="col-sm-12">
                            <div id='app' >
                                
                                
                                @yield('contenido')    
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        @yield('script')
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        
        
        <script src="{{asset('js/app.js')}}"></script>
    </body>
</html>