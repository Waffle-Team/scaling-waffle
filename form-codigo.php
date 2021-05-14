<?php
session_start();

if (!$_SESSION){
    header('location:./form-login');
    exit();

}elseif(!$_SESSION['senha']){
    $_SESSION['user_name'] = NULL;
    $_SESSION['senha'] = NULL;
    $_SESSION['2FA'] = NULL;
    header('location:../form-login');
    exit();
}

?>
<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">
	<head>
		<!-- metatags -->
		<meta charset="utf-8">
		<title>MFA</title>

		<!-- libs -->
		<script type="text/javascript" src="./front-dependencies/lib/jquery/jquery-3.6.0.min.js"></script>
		<link rel="stylesheet" href="./front-dependencies/lib/bootstrap/css/bootstrap.min.css">
		<script type="text/javascript" src="./front-dependencies/assets/js/master.js"></script>

		<!-- assets -->
		<script type="text/javascript" src="./front-dependencies/assets/js/MFA.js"></script>
		<link rel="stylesheet" href="./front-dependencies/assets/css/login-forms/codigoMFA.css">
	</head>
	<body id="form-MFA">
		<section id="formulario">
			<div class="container">
				<div class="row">
					<div class="col-12 text-center">
						<a href="./"><img src="./front-dependencies/assets/images/logoteste.svg" alt=""></a>
						<h1 id="titulo">Autenticação multifator (MFA)</h1>
					</div>
					<div class="col-12 text-center">
						<div id="form-warper">
							<p class="label-login" id="mensage">Digite o codigo de 6 digidos</p>
							<input id="input-codigo" class="login__input" type="text" placeholder="XXX - XXX" maxlength="6"/><br>
							<button id="bt_logar" class="botao-primario">Logar</button>
						</div>
					</div>
				</div>
			</div>
		</section>
	</body>
</html>
