<?php

/********************************************************************************
    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*********************************************************************************/

/**
 * Created on 13.04.2011
 * 
 * MultiTabCaptcha is a simple captcha for small websites (that do not have to handle OCR based attacks).
 * As opposed to mosed libraries it:
 *   - does not require a database
 *   - uses a clean session protocol
 *   - and most importantly works with multiple open browser windows and tabs
 * 
 * @author Alexander De Luca
 * @version 0.2
 */


// Firstly, we define some variables that will be used throughout the script.
// You can make changes here to manipulate the behavior of the script.
// Be careful if you are not sure about the meaning of a variable.

$mtc_password = "dh322s"; // a random string that will be used as a secret token for the hash
$mtc_get_variable_name = "mtchash"; // the name of the GET variable used for creating the image
$mtc_session_var_name = "mtcsess"; // the name of the session variable used to store some security relevant info
$mtc_session_rand_int_name = "mtcrandint"; // the name of the variable in which the random int will be stored
$mtc_session_counter_name = "mtccounter"; // the name of the variable in which the counter will be stored
$mtc_session_counter_used_name = "mtccounterused"; // the name of the variable in which used counters will be stored
$mtc_characters = array("1","2","3","4","5","6","7","8","9"); // an array of values that will be used to create the captcha
$mtcaptcha_length = 4; // the number of characters used in the captcha
$mtcaptcha_width = 150; // the width of the captcha image in pixels
$mtcaptcha_height = 50; // the height of the captcha image in pixels
$mtcaptcha_max_angle = 20; // the max angle for a character in degree
$mtcaptcha_font = "AHGBold.ttf"; // the font used for the captcha
$mtcaptcha_font_size = "20pt"; // the font size for the captcha

session_start();
// If the GET variable is set, do nothing but return the image.
if(!empty($_GET['id'])) mtcCreateImage($_GET['id']);

function mtcCreateImage($id) {
	global $mtc_session_name,$mtcaptcha_width,$mtcaptcha_height,$mtcaptcha_max_angle,
	$mtcaptcha_font_size,$mtcaptcha_font,$mtc_characters,$mtcaptcha_length;
	$x_choord = 10; // the current x coordinate
	
	$str='';
	for($j=0; $j<$mtcaptcha_length; $j++){
		$captcha_arr[$j]=$mtc_characters[rand(0,8)];
		$str.=$captcha_arr[$j];
	}

	$_SESSION[$id.$str]=$str;
	
	$image = imagecreatetruecolor($mtcaptcha_width, $mtcaptcha_height);
	$bg_color = imagecolorallocate($image, rand(220,255), rand(220,255), rand(220,255)); // asign a light color
    imagefill($image, 0, 0, $bg_color);
    
	foreach($captcha_arr as $act_char) {
		// assign a dark color for the current character
		$char_color = imagecolorallocate($image, rand(0, 150), rand(0, 150), rand(0, 150));
		
		// define a random angle for the letter
		$rand_angle = rand(0,$mtcaptcha_max_angle);
		if((bool)rand(0,1))
		   $rand_angle=-$rand_angle;
		
		$char_dimension = imagettfbbox($mtcaptcha_font_size, $rand_angle, $mtcaptcha_font, $act_char); // get the space used by the character
		$char_width = $char_dimension[2] - $char_dimension[0]; // the width is defined by the lower right - lower left corner
		$char_height = abs($char_dimension[7] - $char_dimension[1]); // the width is defined by the lower right - lower left corner
		$y_coord = rand($char_height+5,($mtcaptcha_height+$char_height)/2); // this randonly puts the character on the y axis without losing information
        
        // draw the character
		imagettftext($image, $mtcaptcha_font_size, $rand_angle, $x_choord, $y_coord, $char_color,$mtcaptcha_font, $act_char);
		$x_choord+=$char_width+10;
	}
	
	// show the image
	header("Content-Type: image/jpeg"); 
	imagejpeg($image); 
	imagedestroy($image);
	
	// delete session variable since it will not be needed anymore after this point
}

function mtcCheckCaptcha($value,$id) {
	// check if that counter was already used
	if(!isset($_SESSION[$id.$value]))
	   return false;
	
	if($_SESSION[$id.$value] == $value){
		$_SESSION[$id.$value]="";
		return true;
	}
	return false;
}
?>