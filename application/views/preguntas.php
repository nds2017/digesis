<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Preguntas - Encuesta</title>
		<link href="<?=base_url()?>encuesta/css/style.css" rel="stylesheet" type="text/css">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<script src="<?=base_url()?>encuesta/js/jquery-1.9.1.min.js"></script>
		<script src="<?=base_url()?>encuesta/js/jquery-ui.js"></script>
		<script src="<?=base_url()?>encuesta/js/ui-front.js" type="text/javascript"></script>

		<script>
			function selectrow(value) {
				$("#respuesta").val(value);
				$("#siguiente").prop('disabled', false);
			}
		</script>
	</head>

	<body>
		<div class="wrapper">
			<header>
				 <img src="<?=base_url()?>encuesta/img/logo.png"/>
			</header>
			<div class="body_w">
				<form method="post">
					<div class="indications questions">
						<p><span><?=$npregunta->n?></span><?=$npregunta->pregunta?></p>
						<ul>
							<li onclick="selectrow(0);" class="l0"><a href="">0</a></li>
							<li onclick="selectrow(1);" class="l1"><a href="">1</a></li>
							<li onclick="selectrow(2);" class="l2"><a href="">2</a></li>
							<li onclick="selectrow(3);" class="l3"><a href="">3</a></li>
							<li onclick="selectrow(4);" class="l4"><a href="">4</a></li>
							<li onclick="selectrow(5);" class="l5"><a href="">5</a></li>
							<li onclick="selectrow(6);" class="l6"><a href="">6</a></li>
							<li onclick="selectrow(7);" class="l7"><a href="">7</a></li>
							<li onclick="selectrow(8);" class="l8"><a href="">8</a></li>
							<li onclick="selectrow(9);" class="l9"><a href="">9</a></li>
						</ul>
						<div class="cont-btn">
							<input type="hidden" name="respuesta" value="0" id="respuesta" />
							<input type="hidden" name="npregunta" value="<?=$npregunta->n?>" />
							<!--<input type="button" value="SIGUIENTE" onclick="window.location='<?=base_url()?>index.php/encuestas/preguntafinal';">-->
							<input disabled id="siguiente" type="submit" value="SIGUIENTE" />
						</div>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>
