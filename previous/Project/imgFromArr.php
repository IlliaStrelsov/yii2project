<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
$w = 800;
$h = 600;


$img = imagecreatetruecolor($w,$h);
imagesavealpha($img,true);
imagealphablending($img,false);

for($y=0;$y<$h;$y++){
    for($x=0;$x<$w;$x++){
        $r = round(255*$y/$h);
        $g = round(255*$x/$h);
        if($r > 255) { $r = 255; }
        if($g > 255) { $g = 255; }
        if($r < 0) { $r = 0; }
        if($g < 0) { $g = 0; }
        $b = 0;
        $alpha = 0;
        $color = imagecolorallocatealpha($img,$r,$g,$b,$alpha);
        imagesetpixel($img,$x,$y,$color);
    }
}

//header('Content-Type: image/png');
imagepng($img);




$resource = "/uploads/mario.png";
$wd = imagesx($resource);
