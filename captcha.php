<?php
session_start();

// Generate a random CAPTCHA code if it's not already generated
if (!isset($_SESSION['captcha_code'])) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $captcha_code = '';
    for ($i = 0; $i < 6; $i++) {
        $captcha_code .= $characters[rand(0, strlen($characters) - 1)];
    }
    $_SESSION['captcha_code'] = $captcha_code;
}

// Set the content type to image/png
header('Content-Type: image/png');

// Create the image canvas
$image = imagecreate(150, 50);

// Define colors
$background_color = imagecolorallocate($image, 255, 255, 255); // white
$text_color = imagecolorallocate($image, 0, 0, 0); // black

// Fill the background
imagefilledrectangle($image, 0, 0, 150, 50, $background_color);

// Add the CAPTCHA text to the image
$font = 'arial.ttf'; // Make sure to set the correct font path (e.g. arial.ttf)
$font_size = 20;
$x = 20;
$y = 35;
imagettftext($image, $font_size, 0, $x, $y, $text_color, $font, $_SESSION['captcha_code']);

// Output the image to the browser
imagepng($image);

// Destroy the image to free memory
imagedestroy($image);
?>
