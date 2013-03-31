<?php  /*  * This file is part of the Ladensia Shop System.  *  * (c) Patric Gutersohn <p.gutersohn@gmx.de>  *  * For the full copyright and license information, please view the license.txt  * file that was distributed with this source code.  */

/**
 * ImageService.php
 *
 * @category            Ladensia
 * @package             CoreBundle
 * @subpackage          Service
 */

namespace Ladensia\CoreBundle\Services;

use Ladensia\CoreBundle\Services\library\PhpThumbFactory;

class ImageService {

    /**
     * Creates thumbnail
     *
     * @param string $image, $uuid, $type
     * @return Thumbnail filename on sucess or blank on fail
     */
    function createThumbnail($image, $uuid, $type) {
        
        $quality = 100;
        $thumbnail = '';
        $thumbs_dir = 'uploads/thumbnails/';
        $width = '170';
        
        $this->thumbs_dir = $thumbs_dir;

        if (file_exists($image) && isset($thumbs_dir)) {
            $size = getimagesize($image);
            $w = number_format($width, 0, ',', '');
            $h = number_format(($size[1] / $size[0]) * $width, 0, ',', '');

            $thumbnail = $this->copyImage($image, $thumbs_dir, $uuid, $w, $h, $quality, $type);
        }

        return $thumbnail;
    }

    /**
     * Copies a image
     *
     * @param string $image, $thumbs_dir, $uuid, $w, $h, $quality, $type
     * @return Destination filename
     */
    public function copyImage($image, $thumbs_dir, $uuid, $w, $h, $quality, $type) {
        
        $tmp_image = pathinfo(strtolower($image));
        $tmp_thumbnail = pathinfo(strtolower($thumbs_dir . $uuid . '.' . $type));
       
        $size = getimagesize($image);

        if ($tmp_thumbnail['extension'] == "jpg") {
            $thumbnail = $tmp_thumbnail['basename'];
            $dest = imagecreatetruecolor($w, $h);
            imageantialias($dest, TRUE);
        } else if($tmp_thumbnail['extension'] == "gif" || $tmp_thumbnail['extension'] == "png") {
            $thumbnail = $tmp_thumbnail['basename'];
            $dest = imagecreatetruecolor($w, $h);
            imagecolortransparent($dest, imagecolorallocatealpha($dest, 0, 0, 0, 127));
            imagealphablending($dest, false);
            imagesavealpha($dest, true);
            imageantialias($dest, TRUE);
            
        } else {
            return false;
        }

        switch ($size[2]) {
            case 1:       //GIF
                $src = imagecreatefromgif($image);
                break;
            case 2:       //JPEG
                $src = imagecreatefromjpeg($image);
                break;
            case 3:       //PNG
                $src = imagecreatefrompng($image);
                break;
            default:
                return false;
                break;
        }

        imagecopyresampled($dest, $src, 0, 0, 0, 0, $w, $h, $size[0], $size[1]);

        
        switch ($size[2]) {
            case 1:
                imagegif($dest, $thumbs_dir . $thumbnail, $quality);
            case 2:
                imagejpeg($dest, $thumbs_dir . $thumbnail, $quality);
                break;
            case 3:
                imagepng($dest, $thumbs_dir . $thumbnail);
        }
        
        return $thumbnail;
    }

}
