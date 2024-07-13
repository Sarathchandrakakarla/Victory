<?php
// Create image resource
$image = imagecreatefromjpeg("Images/Academic Report.jpg");

// Allocate colors
$white = imagecolorallocate($image, 255, 255, 255);
$black = imagecolorallocate($image, 0, 0, 0);

// Add text to image
//imagestring($image, 2200, 500, 480, "Hello Worl!", $black);
imagettftext($image,30,0,530,495,$black,"fonts/timesbd.ttf","KAKARLA SARATHCHANDRA REDDY");
imagettftext($image,30,0,1600,495,$black,"fonts/timesbd.ttf","10 CLASS D");
imagettftext($image,30,0,530,600,$black,"fonts/timesbd.ttf","VHST02674");
imagettftext($image,30,0,1950,595,$black,"fonts/timesbd.ttf","ASSIGNMENT-1");

//Subjects

imagettftext($image,30,0,250,750,$black,"fonts/times.ttf","TELUGU");
imagettftext($image,30,0,250,810,$black,"fonts/times.ttf","HINDI");
imagettftext($image,30,0,250,870,$black,"fonts/times.ttf","ENGLISH");
imagettftext($image,30,0,250,930,$black,"fonts/times.ttf","MATHEMATICS");
imagettftext($image,30,0,250,990,$black,"fonts/times.ttf","PHYSICAL SCIENCE");
imagettftext($image,30,0,250,1050,$black,"fonts/times.ttf","NATURAL SCIENCE");
imagettftext($image,30,0,250,1110,$black,"fonts/times.ttf","SOCIAL STUDIES");
imagettftext($image,30,0,250,1170,$black,"fonts/times.ttf","SPOKEN ENGLISH");
imagettftext($image,30,0,250,1230,$black,"fonts/times.ttf","DRAWING");
imagettftext($image,30,0,250,1290,$black,"fonts/times.ttf","ABACUS");
imagettftext($image,30,0,250,1350,$black,"fonts/times.ttf","IIT");

//Max Marks

imagettftext($image,30,0,1100,750,$black,"fonts/times.ttf","100");
imagettftext($image,30,0,1100,810,$black,"fonts/times.ttf","100");
imagettftext($image,30,0,1100,870,$black,"fonts/times.ttf","100");
imagettftext($image,30,0,1100,930,$black,"fonts/times.ttf","100");
imagettftext($image,30,0,1100,990,$black,"fonts/times.ttf","100");
imagettftext($image,30,0,1100,1050,$black,"fonts/times.ttf","100");
imagettftext($image,30,0,1100,1110,$black,"fonts/times.ttf","100");
imagettftext($image,30,0,1100,1170,$black,"fonts/times.ttf","100");
imagettftext($image,30,0,1100,1230,$black,"fonts/times.ttf","100");
imagettftext($image,30,0,1100,1290,$black,"fonts/times.ttf","100");
imagettftext($image,30,0,1100,1350,$black,"fonts/times.ttf","100");

//Max Marks

imagettftext($image,30,0,1900,750,$black,"fonts/times.ttf","100");
imagettftext($image,30,0,1900,810,$black,"fonts/times.ttf","100");
imagettftext($image,30,0,1900,870,$black,"fonts/times.ttf","100");
imagettftext($image,30,0,1900,930,$black,"fonts/times.ttf","100");
imagettftext($image,30,0,1900,990,$black,"fonts/times.ttf","100");
imagettftext($image,30,0,1900,1050,$black,"fonts/times.ttf","100");
imagettftext($image,30,0,1900,1110,$black,"fonts/times.ttf","100");
imagettftext($image,30,0,1900,1170,$black,"fonts/times.ttf","100");
imagettftext($image,30,0,1900,1230,$black,"fonts/times.ttf","100");
imagettftext($image,30,0,1900,1290,$black,"fonts/times.ttf","100");
imagettftext($image,30,0,1900,1350,$black,"fonts/times.ttf","100");

//Overall Headings

imagettftext($image,30,0,200,1430,$black,"fonts/timesbd.ttf","Total:");
imagettftext($image,30,0,200,1490,$black,"fonts/timesbd.ttf","Percentage:");
imagettftext($image,30,0,200,1550,$black,"fonts/timesbd.ttf","Grade:");

//Overall Values

imagettftext($image,30,0,450,1430,$black,"fonts/timesbd.ttf","400/500");
imagettftext($image,30,0,450,1490,$black,"fonts/timesbd.ttf","100%");
imagettftext($image,30,0,450,1550,$black,"fonts/timesbd.ttf","Excellent");

// Output image
header("Content-type: image/jpeg");
imagejpeg($image, 'edited.jpg');
//imagepng($image, 'edited.png');

// Free up memory
imagedestroy($image);
