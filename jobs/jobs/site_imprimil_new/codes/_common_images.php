<?php

	function resizeImageFile($file, $path_to_save, $max_width, $max_height) {
		
		$source_pic = $file;
		list($width, $height, $image_type) = getimagesize($file);
		
		switch ($image_type) {
			case 1:
				$src = imagecreatefromgif($file);
				break;
			case 2:
				$src = imagecreatefromjpeg($file);
				break;
			case 3:
				$src = imagecreatefrompng($file);
				break;
			default:
				return '';
				break;
		}
		
		$x_ratio = $max_width / $width;
		$y_ratio = $max_height / $height;
		
		if (($width <= $max_width) && ($height <= $max_height)) {
			$tn_width  = $width;
			$tn_height = $height;
		} elseif (($x_ratio * $height) < $max_height) {
			$tn_height = ceil($x_ratio * $height);
			$tn_width  = $max_width;
		} else {
			$tn_width  = ceil($y_ratio * $width);
			$tn_height = $max_height;
		}
		
		$tmp = imagecreatetruecolor($tn_width, $tn_height);
		if (($image_type == 1) OR ($image_type == 3)) {
			imagealphablending($tmp, false);
			imagesavealpha($tmp, true);
			$transparent = imagecolorallocatealpha($tmp, 255, 255, 255, 127);
			imagefilledrectangle($tmp, 0, 0, $tn_width, $tn_height, $transparent);
		}
		imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tn_width, $tn_height, $width, $height);
		
		switch ($image_type) {
			case 1:
				imagegif($tmp);
				break;
			case 2:
				imagejpeg($tmp, $path_to_save, 75);
				break;
			case 3:
				imagepng($tmp, $path_to_save, 0);
				break;
			default:
				echo '';
				break;
		}
		
		return $tmp;
	}
?>