<?php

header ('Content-Type: image/png');
session_start();
$case_sensitive = false;
$length = 7;
$captcha_width= 200;
$captcha_heigh= 40;
$captcha_text_size=10; #takes range from 0 to 10 :. Saleh
$captcha_value = "";
$captcha_source = range ('a','z');
foreach (range(1,$length) as $i){
	$newchar = $captcha_source[rand (0 , count($captcha_source)-1)];
	if (rand(0,1)==0)
		$captcha_value = $captcha_value.strtoupper($newchar);
	else
		$captcha_value = $captcha_value.$newchar;
}

$im = @imagecreatetruecolor($captcha_width, $captcha_heigh)
      or die('Cannot Initialize new GD image stream');
$text_color = imagecolorallocate($im, 50, 210, 50);
$_SESSION["cap"] = $captcha_value;
imagestring($im, $captcha_text_size, 5, 10,  $captcha_value, $text_color);
# filter 1: random noise :. Saleh 

	for ($i=0;$i<=$captcha_width;$i=$i+rand(1,7)){
	    for ($j=0;$j<=$captcha_heigh;$j=$j+rand(2,7)){
		imagesetpixel($im, $i,$j,imagecolorallocate($im, rand(100,255), rand (100,250), rand(50,200)));
	    }
	}
# filter 2: random pixle shift :.saleh
	$ran = rand(0, $captcha_width);
	for ($i = $ran; $i <= $ran+10 ; $i++){
		for ($j = 0;$j <= 15;$j++){
			$rgb = imagecolorat($im,$i, $j+2);
				$r = ($rgb >> 16) & 0xFF;
				$g = ($rgb >> 8) & 0xFF;
				$b = $rgb & 0xFF;
			imagesetpixel($im, $i,$j,imagecolorallocate($im, $r, $g, $b));
		}
	}

# filter 3: random line
	$liner_pos = array($ran = floor(rand(0, $captcha_width)*(4/6)),$ran = rand(0, $captcha_heigh));
	for ($i = 1; $i <= 40 ; $i++){
		imagesetpixel($im, $liner_pos[0],$liner_pos[1],imagecolorallocate($im, 255, 255, 255));
		$liner_pos[0]=$liner_pos[0]+rand(-1,1); #Random Walk proccess :. Saleh
		$liner_pos[1]=$liner_pos[1]+rand(-1,1);
	}
	$liner_pos2 = floor(rand($captcha_heigh/2-5, $captcha_heigh/2+5));
	for ($i = 1; $i <= 140 ; $i++){
		imagesetpixel($im, $i,$liner_pos2,imagecolorallocate($im, 25, 255, 25));
		$liner_pos2=$liner_pos2+rand(-1,1); #One dimentional Random Walk proccess :. Saleh
	}
# add Your Additional filters if you want :. Saleh
##

imagepng($im);
imagedestroy($im);

?>
