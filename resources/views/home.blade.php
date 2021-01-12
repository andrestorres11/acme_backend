<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Login | {{ env( 'APP_NAME' ) }}</title>

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
    <link href="{{ asset( 'css/bootstrap.min.css' ) }}" rel="stylesheet">
    <link href="{{ asset( 'css/nifty.min.css' ) }}" rel="stylesheet">
    <link href="{{ asset( 'css/demo/nifty-demo-icons.min.css' ) }}" rel="stylesheet">
    <link href="{{ asset( 'plugins/pace/pace.min.css' ) }}" rel="stylesheet">
    <script src="{{ asset( 'plugins/pace/pace.min.js' ) }}"></script>
    <link href="{{ asset( 'css/demo/nifty-demo.min.css' ) }}" rel="stylesheet">
</head>
<body>
    <div id="container" class="cls-container">
        
		<div id="bg-overlay" class="bg-img" style="background-image: url( {{ asset( 'img/background.jpg' ) }} );"></div>

		<div class="cls-content">
		    <div class="cls-content-sm panel">
		        <div class="panel-body">
		            <div class="mar-ver pad-btm">
		                <h1 class="h3">Login - {{ env( 'APP_NAME' ) }}</h1>
		                <p>Iniciar Sesion</p>
		            </div>
		            <form action="index.html">
		                <div class="form-group">
		                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" autofocus>
		                </div>
		                <div class="form-group">
		                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
		                </div>
		                {{--
		                <div class="checkbox pad-btm text-left">
		                    <input id="demo-form-checkbox" class="magic-checkbox" type="checkbox">
		                    <label for="demo-form-checkbox">Remember me</label>
		                </div>--}}
		                <button class="btn btn-primary btn-lg btn-block" type="submit">ENTRAR</button>
		            </form>
		        </div>
		    </div>
		</div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/nifty.js"></script>
    <script src="js/demo/bg-images.js"></script>
</body>
</html>