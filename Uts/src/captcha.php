<?php
session_start();

// Generate random string for CAPTCHA
$captcha_string = '';
$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
$characters_length = strlen($characters);
$captcha_length = 6; // Adjust the length of CAPTCHA as needed

for ($i = 0; $i < $captcha_length; $i++) {
    $captcha_string .= $characters[rand(0, $characters_length - 1)];
}

$_SESSION['captcha'] = $captcha_string;

// Set header to generate image
header('Content-type: image/jpeg');

// Create image
$image = imagecreatetruecolor(200, 50);

// Set background color
$bg_color = imagecolorallocate($image, 255, 255, 255);
imagefill($image, 0, 0, $bg_color);

// Set text color
$text_color = imagecolorallocate($image, 0, 0, 0);

// Set font path
$font_path = 'arial.ttf'; // Adjust the path to your Arial font file

// Add text to image
imagettftext($image, 30, 0, 10, 40, $text_color, $font_path, $captcha_string);

// Output image
imagejpeg($image);

// Clean up
imagedestroy($image);
?>