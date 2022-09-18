<?php

/*
  Copy an image to a destination file. The destination
  image size will be $w X $h pixels
 */

class ImageUploadComponent extends Component {

    function copyImage($srcFile, $destFile, $w, $h, $quality = 500) {
        $tmpSrc = pathinfo(strtolower($srcFile));
        $tmpDest = pathinfo(strtolower($destFile));
        $size = getimagesize($srcFile);

        if ($tmpDest['extension'] == "gif" || $tmpDest['extension'] == "jpg") {
            $destFile = substr_replace($destFile, 'jpg', -3);
            $dest = imagecreatetruecolor($w, $h);
            //imageantialias($dest, TRUE);
        } elseif ($tmpDest['extension'] == "png") {
            $dest = imagecreatetruecolor($w, $h);
            //imageantialias($dest, TRUE);
        } else {
            return false;
        }

        switch ($size[2]) {
            case 1:       //GIF
                $src = imagecreatefromgif($srcFile);
                break;
            case 2:       //JPEG
                $src = imagecreatefromjpeg($srcFile);
                break;
            case 3:       //PNG
                $src = imagecreatefrompng($srcFile);
                break;
            default:
                return false;
                break;
        }

        imagecopyresampled($dest, $src, 0, 0, 0, 0, $w, $h, $size[0], $size[1]);

        switch ($size[2]) {
            case 1:
            case 2:
                imagejpeg($dest, $destFile, $quality);
                break;
            case 3:
                imagepng($dest, $destFile);
        }
        return $destFile;
    }

    /*
      Create a thumbnail of $srcFile and save it to $destFile.
      The thumbnail will be $width pixels.
     */

    function createThumbnail($srcFile, $destFile, $width, $quality = 500) {
        $thumbnail = '';

        if (file_exists($srcFile) && isset($destFile)) {
            $size = getimagesize($srcFile);
            $w = number_format($width, 0, ',', '');
            $h = number_format(($size[1] / $size[0]) * $width, 0, ',', '');

            $thumbnail = $this->copyImage($srcFile, $destFile, $w, $h, $quality);
        }

        // return the thumbnail file name on sucess or blank on fail
        return basename($thumbnail);
    }

    function uploadImage($inputName, $uploadDir, $isCakeVar = false) { //added $isCakeVar by REZA;

        $image = $isCakeVar ? $inputName : $_FILES[$inputName];
        //print_r($image);
        $imagePath = '';
        $thumbnailPath = '';

        // if a file is given
        if (trim($image['tmp_name']) != '') {
            $ext = substr(strrchr($image['name'], "."), 1);

            // generate a random new file name to avoid name conflict
            // then save the image under the new file name
            $imagePath = md5(rand() * time()) . ".$ext";
            $result = move_uploaded_file($image['tmp_name'], $uploadDir . $imagePath);

            if ($result) {
                // create thumbnail
                $thumbnailPath = md5(rand() * time()) . ".$ext";

                $result = $this->createThumbnail($uploadDir . $imagePath, $uploadDir . 'thumbnail/' . $thumbnailPath, 200);

                // create thumbnail failed, delete the image
                unlink($uploadDir . $imagePath);
                if (!$result) {
                    unlink($uploadDir . $imagePath);
                    $imagePath = $thumbnailPath = '';
                } else {
                    $thumbnailPath = $result;
                }
            } else {
                // the image cannot be uploaded
                $imagePath = $thumbnailPath = '';
            }
        }
        return array('image' => $imagePath, 'thumbnail' => $thumbnailPath);
    }
    function uploadEmployeeImage($inputName, $uploadDir, $isCakeVar = false) { //added $isCakeVar by REZA;

        $image = $isCakeVar ? $inputName : $_FILES[$inputName];
        //print_r($image);
        $imagePath = '';
        $thumbnailPath = '';

        // if a file is given
        if (trim($image['tmp_name']) != '') {
            $ext = substr(strrchr($image['name'], "."), 1);

            // generate a random new file name to avoid name conflict
            // then save the image under the new file name
            $imagePath = md5(rand() * time()) . ".$ext";
            $result = move_uploaded_file($image['tmp_name'], $uploadDir . $imagePath);

            if ($result) {
                // create thumbnail
                $thumbnailPath = md5(rand() * time()) . ".$ext";

                $result = $this->createThumbnail($uploadDir . $imagePath, $uploadDir . 'thumbnail/' . $thumbnailPath, 135);
                $this->createThumbnail($uploadDir . $imagePath, $uploadDir . 'large/' . $imagePath, 200);
                // create thumbnail failed, delete the image
                unlink($uploadDir . $imagePath);
                if (!$result) {
                    unlink($uploadDir . $imagePath);
                    $imagePath = $thumbnailPath = '';
                } else {
                    $thumbnailPath = $result;
                }
            } else {
                // the image cannot be uploaded
                $imagePath = $thumbnailPath = '';
            }
        }
        return array('image' => $imagePath, 'thumbnail' => $thumbnailPath);
    }
      function uploadGalleryImage($inputName, $uploadDir, $isCakeVar = false) { //added $isCakeVar by REZA;

        $image = $isCakeVar ? $inputName : $_FILES[$inputName];
        //print_r($image);
        $imagePath = '';
        $thumbnailPath = '';

        // if a file is given
        if (trim($image['tmp_name']) != '') {
            $ext = substr(strrchr($image['name'], "."), 1);

            // generate a random new file name to avoid name conflict
            // then save the image under the new file name
            $imagePath = md5(rand() * time()) . ".$ext";
            $result = move_uploaded_file($image['tmp_name'], $uploadDir . $imagePath);

            if ($result) {
                // create thumbnail
                $thumbnailPath = md5(rand() * time()) . ".$ext";

                $result = $this->createThumbnail($uploadDir . $imagePath, $uploadDir . 'thumbnail/' . $thumbnailPath, 135);
                $this->createThumbnail($uploadDir . $imagePath, $uploadDir . 'large/' . $imagePath, 1014);
                // create thumbnail failed, delete the image
                unlink($uploadDir . $imagePath);
                if (!$result) {
                    unlink($uploadDir . $imagePath);
                    $imagePath = $thumbnailPath = '';
                } else {
                    $thumbnailPath = $result;
                }
            } else {
                // the image cannot be uploaded
                $imagePath = $thumbnailPath = '';
            }
        }
        return array('image' => $imagePath, 'thumbnail' => $thumbnailPath);
    }

}

?>