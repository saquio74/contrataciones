<!DOCTYPE html>
    <html>
    <head>
        <title>Home</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body style="font-size:14px" class="bg-dark" >
        <div class="header">
            <div class="row col-sm-12">
                <div class="span4 col-md-2">
                    <img src="{{asset('img\logo.png')}}">
                </div>
                <div class="span8 col-md-8">
                    <h1 class="text-center text-light">Sistema Gral de contrataciones</h1>
                </div>
            </div>
        </div>
        <div class="container col-sm-12">
            <div class="col-sm-6 offset-3">
                <h2 class="text-center text-light">Menu General</h2>    
            </div>
                
        </div>
        
            
            
        <div class="container">
            <div class="container bg-secondary">
                <div class="row col-sm-12">
                    <div class="panel panel-default   col-sm-12">
                        @yield('contenido')    
                    </div> 
                </div>
            </div>
        </div>
        @yield('script')
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>