<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<meta name="description" content="Responsive Admin Template"/>
	<meta name="author" content="RedstarHospital" />
	<title>Forbidden</title>
	<!-- icons -->
	<link href="/assets/asset_principal/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="/assets/asset_principal/plugins/iconic/css/material-design-iconic-font.min.css">
	<!-- bootstrap -->
	<link href="/assets/asset_principal/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<!-- style -->
	<link rel="stylesheet" href="/assets/asset_principal/css/pages/extra_pages.css">
	<!-- favicon -->
	<link rel="shortcut icon" href="/assets/asset_principal/img/favicon.ico" />
</head>

<body>
	<div class="limiter">
		<div class="container-login100 page-background">
			<div class="wrap-login100">
				<form class="form-404">
					<span class="login100-form-logo">
						<img alt="" src="/assets/asset_principal/img_sweat_alert/alert3.jpg">
					</span>
					<span class="form404-title p-b-34 p-t-27">
						Attention
					</span>
					<p class="content-404">
                        Vous n'avez pas le privilège d'effectuer cette action.
                    </p>
					<div class="container-login100-form-btn">
						<a href="{{ route('home') }}" class="login100-form-btn">
							Aller à la page d'accueil
                        </a>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- start js include path -->
	<script src="/assets/asset_principal/plugins/jquery/jquery.min.js"></script>
	<!-- bootstrap -->
	<script src="/assets/asset_principal/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="/assets/asset_principal/js/pages/extra-pages/pages.js"></script>
	<!-- end js include path -->
</body>
</html>
