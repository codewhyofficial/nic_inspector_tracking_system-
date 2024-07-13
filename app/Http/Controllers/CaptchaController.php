<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class CaptchaController extends Controller
{
    public function generateCaptcha()
    {
        $image_width = 120;
        $image_height = 40;
        $characters_on_image = 6;
        $font = public_path('monofont.ttf'); // path to monofont.ttf in public directory

        $possible_characters_upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $possible_characters_lower = 'abcdefghijklmnopqrstuvwxyz';
        $possible_characters_numbers = '23456789';

        $random_dots = 0;
        $random_lines = 20;
        $captcha_text_color = "0x142864";
        $captcha_noice_color = "0x142864";

        // Generate random CAPTCHA code
        $code = '';
        $code .= $possible_characters_upper[mt_rand(0, strlen($possible_characters_upper) - 1)];
        $code .= $possible_characters_lower[mt_rand(0, strlen($possible_characters_lower) - 1)];
        $code .= $possible_characters_numbers[mt_rand(0, strlen($possible_characters_numbers) - 1)];

        $characters_on_image = $characters_on_image - 3; // Subtract 3 for the characters already generated
        for ($i = 0; $i < $characters_on_image; $i++) {
            $possible_characters = $possible_characters_upper . $possible_characters_lower . $possible_characters_numbers;
            $code .= $possible_characters[mt_rand(0, strlen($possible_characters) - 1)];
        }

        $code = str_shuffle($code);

        // Create image instance
        $image = @imagecreate($image_width, $image_height);

        // Set colors
        $background_color = imagecolorallocate($image, 255, 255, 255);
        $arr_text_color = $this->hexrgb($captcha_text_color); // Update function call to use $this->hexrgb()
        $text_color = imagecolorallocate($image, $arr_text_color['red'], $arr_text_color['green'], $arr_text_color['blue']);
        $arr_noice_color = $this->hexrgb($captcha_noice_color); // Update function call to use $this->hexrgb()
        $image_noise_color = imagecolorallocate($image, $arr_noice_color['red'], $arr_noice_color['green'], $arr_noice_color['blue']);

        // Add noise to background
        for ($i = 0; $i < $random_dots; $i++) {
            imagefilledellipse($image, mt_rand(0, $image_width), mt_rand(0, $image_height), 2, 3, $image_noise_color);
        }

        for ($i = 0; $i < $random_lines; $i++) {
            imageline($image, mt_rand(0, $image_width), mt_rand(0, $image_height), mt_rand(0, $image_width), mt_rand(0, $image_height), $image_noise_color);
        }

        // Add CAPTCHA text
        $font_size = $image_height * 0.75;
        $textbox = imagettfbbox($font_size, 0, $font, $code);
        $x = ($image_width - $textbox[4]) / 2;
        $y = ($image_height - $textbox[5]) / 2;
        imagettftext($image, $font_size, 0, $x, $y, $text_color, $font, $code);

        // Output image
        ob_start();
        imagejpeg($image);
        $image_data = ob_get_clean();
        imagedestroy($image);

        // Store CAPTCHA code in session
        Session::put('captcha_code', $code);

        // Return response as image/jpeg
        return response($image_data)->header('Content-Type', 'image/jpeg');
    }

    // Function to convert hex to rgb color
    private function hexrgb($hexstr)
    {
        $int = hexdec($hexstr);

        return [
            "red" => 0xFF & ($int >> 0x10),
            "green" => 0xFF & ($int >> 0x8),
            "blue" => 0xFF & $int
        ];
    }
}
