<?php 
	if(session_start()){
		$_SESSION['email']="Ezezaguna";
	}
	else{
		session_start();
		$_SESSION['email']="Ezezaguna";
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Quizzes</title>
    <link rel='stylesheet' type='text/css' href='stylesPWS/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='stylesPWS/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='stylesPWS/smartphone.css' />
	<script type="text/javascript" language = "javascript">
		xhro = new XMLHttpRequest();
		xhro.onreadystatechange = function(){
		//alert(xhro.readyState);
		if ((xhro.readyState==4)){
			document.getElementById("emaitza").innerHTML= xhro.responseText;}
		}
		function credits(){
			xhro.open("GET","credits.php",true);
			xhro.send();
		}
	</script>

  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>	  
			<span class="right">Erabiltzailea: <?=$_SESSION['email']?></span>
			<span class="right"><a href=singUp.php style="color: blue;">SingUp</a> </span>
			<span class="right"><a href=logIn.php style="color: blue;">LogIn</a> </span>
	<h2>Quiz: crazy questions</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href="layout.php?q=home" style="color: blue;">Home</a></span>
		<span onclick="credits()" style="text-decoration: underline; color: blue">Credits</span>
	</nav>
    <section class="main" id="s1">
	<div id="emaitza">Erregistra zaitez edo logeatu
	<?php
		if(isset($_GET['q'])&&($_GET['q']=='home')){
			echo '<script>document.getElementById("emaitza").innerHTML="";</script>Erregistra zaitez edo logeatu';
		}
	?>
	</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://en.wikipedia.org/wiki/Quiz" target="_blank" style="color: blue;">What is a Quiz?</a></p>
		<a href='https://github.com' style="color: blue;">Link GITHUB</a>
	</footer>
</div>
</body>
</html>
