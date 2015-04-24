<!-- Writed By Saleh animatorsaleh@gmail.com-->
<?php session_start();
?>
<html>
	<head> 
		<title>Captcha Usage Example</title>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	</head>
	<body >
		<?php
			if (!(extension_loaded('gd') && function_exists('gd_info'))) {
				echo "PHP GD library is NOT installed on your web server";   
				die();
				gd_info();
			}
		?>
		<script>
			function showUser(str) {
				document.getElementById("captcha").src = "./captcha.php";
			}
		</script>
		Fill the form Please
		<form method="POST">
			<input type="text" name="captcha_user"/><br><br>			
			<img src="./captcha.php" id="captcha" onclick="showUser();"></img><i>Click on captcha pick to ReCaptcha!</i><br><br>
			<input type="submit" name="submit" />
		</form>
		<?php
			
			if (isset($_POST["captcha_user"])){
				if (strtolower($_POST["captcha_user"]) == strtolower($_SESSION['cap'])){
					echo "<span style='color:#11a'>You are a human! You Entred Correct Captcha! </span>";				
				}else{
					echo "<span style='color:#d11'>You Entered Wrong Captcha! please try again! </span>";
				}
			} 
		?>
	</body>
</html>
