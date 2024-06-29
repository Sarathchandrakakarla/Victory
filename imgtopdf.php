<?php
// Create image resource
$image = imagecreatefromjpeg("Images/VHST02674.jpg");

// Allocate colors
$white = imagecolorallocate($image, 255, 255, 255);
$black = imagecolorallocate($image, 0, 0, 0);

// Add text to image
imagestring($image, 55, 100, 100, "Hello Worl!", $black);

// Output image
header("Content-type: image/jpeg");
imagejpeg($image,'edited.jpg');

// Free up memory
imagedestroy($image);
?>