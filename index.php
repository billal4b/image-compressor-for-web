<?php
 
if($_SERVER['REQUEST_METHOD'] == "POST"){

    $file_name = $_FILES["image_file"]["name"];
    $file_type = $_FILES["image_file"]["type"];
    $temp_name = $_FILES["image_file"]["tmp_name"];
    $file_size = $_FILES["image_file"]["size"];
    $error = $_FILES["image_file"]["error"];


   // $filename = 'filename.html';
    $without_extension_fileName = pathinfo($file_name, PATHINFO_FILENAME); 

    if(!$temp_name){
        echo "ERROR: Please browse for file before uploading";
        exit();
    }
   
     // print_r($without_extension); exit();     

    function compress_image($source_url, $destination_url, $quality) {
        $info = getimagesize($source_url);
        if ($info['mime'] == 'image/jpeg')
            $image = imagecreatefromjpeg($source_url);
        elseif ($info['mime'] == 'image/gif')
            $image = imagecreatefromgif($source_url);
        elseif ($info['mime'] == 'image/png')
            $image = imagecreatefrompng($source_url);

        //imagejpeg($image, $destination_url, $quality);
        imagepalettetotruecolor($image);
        imagealphablending($image, true);
        imagesavealpha($image, true);
        imagewebp($image, $destination_url, $quality);
        imagedestroy($image);

        echo "<script>alert (\"Image uploaded successfully.\")</script>";

        //echo "Image uploaded successfully.";

    }
//$ImgBeforeLocation = "img.jpg";
//$ImgAfterLocation = "img.webp";
// $img = imagecreatefromjpeg($ImgBeforeLocation);
// $img = imagecreatefrompng($ImgBeforeLocation);
// $img = imagecreatefromgif($ImgBeforeLocation);
// imagepalettetotruecolor($image);
// imagealphablending($image, true);
// imagesavealpha($image, true);
// imagewebp($image, $ImgAfterLocation, 100);

    if ($error > 0) {
        echo $error;
    } else if (($file_type == "image/gif") || ($file_type == "image/jpeg") || ($file_type == "image/png") || ($file_type == "image/pjpeg")) {
        $filename = compress_image($temp_name, "uploads/".'compress_'.$without_extension_fileName.'.webp', 80);
    }else {
        echo "Uploaded image should be jpg or gif or png.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Image Compress</title>
 <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<style>
    /*
*
* ==========================================
* CUSTOM UTIL CLASSES
* ==========================================
*
*/
#upload {
    opacity: 0;
}

#upload-label {
    position: absolute;
    top: 50%;
    left: 1rem;
    transform: translateY(-50%);
}

.image-area {
    border: 2px dashed rgba(255, 255, 255, 0.7);
    padding: 1rem;
    position: relative;
}

.image-area::before {
    content: 'Uploaded image result';
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 0.8rem;
    z-index: 1;
}

.image-area img {
    z-index: 2;
    position: relative;
}

/*
*
* ==========================================
* FOR DEMO PURPOSES
* ==========================================
*
*/
body {
    min-height: 100vh;
    background-color: #757f9a;
    background-image: linear-gradient(147deg, #757f9a 0%, #d7dde8 100%);
}

/*
</style>
</head>

<body>
<div class="container py-5">

    <!-- For demo purpose -->
    <header class="text-white text-center">
        <h1 class="display-4">Image Compress</h1>
        <p class="lead mb-0">Build a simple image compress system using PHP</p>
        <p class="mb-5 font-weight-light">Snippet by
            <a href="https://github.com/billal4b" class="text-white">
                <u>Pi Alpha</u>
            </a>
        </p>
        <img src="https://res.cloudinary.com/mhmd/image/upload/v1564991372/image_pxlho1.svg" alt="" width="150" class="mb-4">
    </header>


    <div class="row py-4">
        <div class="col-lg-6 mx-auto">

            <!-- Upload image input-->
            <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                 <form action='' method='POST' enctype='multipart/form-data'>
                    <input name="image_file" type="file" accept="image/*" class="form-control border-0">
                    <div class="input-group-append">
                        <button type="submit"  class="btn btn-light m-0 rounded-pill px-4"><small class="text-uppercase font-weight-bold text-muted">SUBMIT</small></button>
                    </div>
                </form>              
            </div>
                        <!-- Uploaded image area-->
            <p class="font-italic text-white text-center">Uploaded Image size is : <?php echo ($file_size/1024);?></p>        </div>
    </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script>
  
</script>
</html>
