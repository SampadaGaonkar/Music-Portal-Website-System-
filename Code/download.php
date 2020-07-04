<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Download Files</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="manifest" href="site.webmanifest">
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

        <!-- CSS here -->
            <link rel="stylesheet" href="assets/css/bootstrap.min.css">
            <link rel="stylesheet" href="assets/css/owl.carousel.min.css">

            <link rel="stylesheet" href="assets/css/flaticon.css">

            <link rel="stylesheet" href="assets/css/download/slicknav.css">
            <link rel="stylesheet" href="assets/css/animate.min.css">
            <link rel="stylesheet" href="assets/css/magnific-popup.css">
            <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
            <link rel="stylesheet" href="assets/css/themify-icons.css">
            <link rel="stylesheet" href="assets/css/slick.css">
            <link rel="stylesheet" href="assets/css/nice-select.css">
            <link rel="stylesheet" href="assets/css/download/style1.css">
            <link rel="stylesheet" href="assets/css/responsive.css">
            <!-- LINEARICONS -->
            <link rel="stylesheet" href="assets/fonts/linearicons/style.css">
          <link rel="stylesheet" href="assets/css/browse/style.css">
         <link rel="stylesheet" href="assets/css/download/style.css">

             
   </head>

   <body>
       
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo/musicCraze.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->

    <header>
        <!-- Header Start -->
       <div class="header-area">
            <div class="main-header ">
                <div class="header-top top-bg d-none d-lg-block">
                   <div class="container-fluid">
                       <div class="col-xl-12">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="header-info-left">
                                    <ul>     
                                        <li><i class="fas fa-map-marker-alt"></i>6/A, 14th floor, King Lands, Pune</li>
                                        <li><i class="fas fa-envelope"></i>mcraze@consulting.com</li>
                                    </ul>
                                </div>
                                <div class="header-info-right">
                                    <ul class="header-social">    
                                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                       <li> <a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                       </div>
                   </div>
                </div>
               <div class="header-bottom  header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-2 col-lg-1 col-md-1">
                                <div class="logo">
                                  <a href="index.html"><img src="assets/img/logo/musicCraze.png" alt="" height="130"></a>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-8 col-md-8">
                                <!-- Main-menu -->
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav> 
                                          <ul id="navigation">                                                                                                                                     
                                            <li><a href="index2.html"><b>Home</b></a></li>
                                            <li><a href="browse.php"><b>Browse</b></a></li>
                                            <li><a href="upload.html"><b>Upload</b></a></li>
                                            <li><a href="download.html"><b>Download</b></a>
                                            <li><a href="#"><b>Account</b></a>  
                                                <ul class="submenu">
                                                    <li><a href="select.html"><b>Update</b></a></li>
                                                    <li><a href="delete.html"><b>Delete</b></a></li>
                                                </ul>
                                            </li>
                                            
                                        </ul>
                                    </nav>
                                </div>
                            </div>             
                            <div class="col-xl-2 col-lg-3 col-md-3">
                                <div class="header-right-btn f-right d-none d-lg-block">
                                    <a href="index.html" class="btn header-btn">Logout</a>
                                </div>
                            </div>
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
       </div>
        <!-- Header End -->
    </header>
<?php
include('database.php');
if(isset($_POST["submit"])){

$conn = mysqli_connect(dbserver, dbuser, dbpass,dbname);
$key = $_POST['key'];
$encript_key=$_POST['encript_key'];
$key = $conn->real_escape_string($key);
$encript_key = $conn->real_escape_string($encript_key);
$newClear = decrypt($encript_key, $key);
$newCle= RemoveBS( $newClear);  
$event = $conn->query("Select * from test where file_path='$newCle'") or die($conn->error);
$row = $event->fetch_assoc();
                   $image = 'Files/'.$row["file_path"];
}

function RemoveBS($Str) {  
    $StrArr = str_split($Str); $NewStr = '';
    foreach ($StrArr as $Char) {    
      $CharNo = ord($Char);
      if ($CharNo == 163) { $NewStr .= $Char; continue; } // keep £ 
      if ($CharNo > 31 && $CharNo < 127) {
        $NewStr .= $Char;    
      }
    }  
    return $NewStr;
  }
function decrypt($message, $key){
   $message = base64_decode($message);
        $nonceSize = openssl_cipher_iv_length('aes-256-ctr');
        $nonce = mb_substr($message, 0, $nonceSize, '8bit');
        $ciphertext = mb_substr($message, $nonceSize, null, '8bit');
        $plaintext= openssl_decrypt(
          $ciphertext, 
          'aes-256-ctr', 
          $key,
          OPENSSL_RAW_DATA,
          $nonce
        );
        return $plaintext;
      }




 if(isset($_POST["submit"])){

$conn = mysqli_connect(dbserver, dbuser, dbpass,dbname);
$key = $_POST['key'];
$encript_key=$_POST['encript_key2'];
$key = $conn->real_escape_string($key);
$encript_key = $conn->real_escape_string($encript_key);
$newClear = decrypt2($encript_key, $key);
$newCle= RemoveBS2( $newClear);  
$event = $conn->query("Select * from test where file_path='$newCle'") or die($conn->error);
$row = $event->fetch_assoc();
                   $doc = 'Files/'.$row["file_path"];
}

function RemoveBS2($Str) {  
    $StrArr = str_split($Str); $NewStr = '';
    foreach ($StrArr as $Char) {    
      $CharNo = ord($Char);
      if ($CharNo == 163) { $NewStr .= $Char; continue; } // keep £ 
      if ($CharNo > 31 && $CharNo < 127) {
        $NewStr .= $Char;    
      }
    }  
    return $NewStr;
  }
function decrypt2($message, $key){
   $message = base64_decode($message);
        $nonceSize = openssl_cipher_iv_length('aes-256-ctr');
        $nonce = mb_substr($message, 0, $nonceSize, '8bit');
        $ciphertext = mb_substr($message, $nonceSize, null, '8bit');
        $plaintext= openssl_decrypt(
          $ciphertext, 
          'aes-256-ctr', 
          $key,
          OPENSSL_RAW_DATA,
          $nonce
        );
        return $plaintext;
      }




       
if(isset($_POST["submit"])){

$conn = mysqli_connect(dbserver, dbuser, dbpass,dbname);
$key = $_POST['key'];
$encript_key=$_POST['encript_key3'];
$key = $conn->real_escape_string($key);
$encript_key = $conn->real_escape_string($encript_key);
$newClear = decrypt3($encript_key, $key);
$newCle= RemoveBS3( $newClear);  
$event = $conn->query("Select * from test where file_path='$newCle'") or die($conn->error);
$row = $event->fetch_assoc();
                   $video = 'Files/'.$row["file_path"];
}

function RemoveBS3($Str) {  
    $StrArr = str_split($Str); $NewStr = '';
    foreach ($StrArr as $Char) {    
      $CharNo = ord($Char);
      if ($CharNo == 163) { $NewStr .= $Char; continue; } // keep £ 
      if ($CharNo > 31 && $CharNo < 127) {
        $NewStr .= $Char;    
      }
    }  
    return $NewStr;
  }
function decrypt3($message, $key){
   $message = base64_decode($message);
        $nonceSize = openssl_cipher_iv_length('aes-256-ctr');
        $nonce = mb_substr($message, 0, $nonceSize, '8bit');
        $ciphertext = mb_substr($message, $nonceSize, null, '8bit');
        $plaintext= openssl_decrypt(
          $ciphertext, 
          'aes-256-ctr', 
          $key,
          OPENSSL_RAW_DATA,
          $nonce
        );
        return $plaintext;
      }
    

?>


<section class="razo-music-charts-area section-padding-80  bg-img jarallax" style="background : #accffe">
   
 <div class="container">

            <div class="row">
                <!-- Section Heading -->
                <div class="col-12">
                    <div class="section-heading text-center black">
                        <h2>Download Your Files</h2>
                    </div>
                </div>
            </div>
        </div>

<div class="recent-area section-paddingt">
            <div class="container">
                <!-- section tittle -->
              <br> 
                <div class="row">
                  <div class ="wrapper">
                    <img src="9.png" alt="" class="image-1" >
                    
                    <div class="col-xl-5 col-lg-5 col-md-5">

                        <div class="single-recent-cap ">
                            <div class="single-charts-portfolio mb-30">
                                <img src="<?php echo $image ?>" alt=""  >
                                <div class="overlay-content">
                            <div class="text-center">
                                <h5>Image File Download</h5>
                                <p><i class="fa fa-download"><a href="<?php echo $image ?>" Download></i> Download</a></p>
                            </div>
                        </div>
                            </div>
                            <div class="recent-cap">
                               <p align="center">
                                 <audio controls>
                                 <source src="<?php echo $video ?>" type="audio/mpeg">
                                  </audio>
                           <a href="<?php echo $video ?>" Download> <input type="submit" value="Download Video File"> <p align="center"></a> </p>
                          <a href="<?php echo $doc ?>" Download> <input type="submit" value="Download Lyric File"> <p align="center"></a> </p>
                                   </p>
                            </div>


                         </div>
                    </div>
                  </div></div></div>
                    
                           
                            
                            </div>
                        </div>
                    </div>
                </div> 	</div>
 </div></section>







         <!-- footer-bottom aera -->
       <div class="footer-bottom-area footer-bg">
           <div class="container">
               <div class="footer-border">
                    <div class="row d-flex align-items-center">
                        <div class="col-xl-12 ">
                            <div class="footer-copy-right text-center">
                                <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | MusiCraze<i class="ti-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Sampada Gaonkar</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                            </div>
                        </div>
                    </div>
               </div>
           </div>
       </div>
       <!-- Footer End-->
   </footer>

     </main>  
   
    <!-- JS here -->
    
        <!-- All JS Custom Plugins Link Here here -->
        <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
        
        <!-- Jquery, Popper, Bootstrap -->
        <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
        <script src="./assets/js/popper.min.js"></script>
        <script src="./assets/js/bootstrap.min.js"></script>
        <!-- Jquery Mobile Menu -->
        <script src="./assets/js/jquery.slicknav.min.js"></script>
        <!-- Jquery Plugins, main Jquery -->    
        <script src="./assets/js/plugins.js"></script>
        <script src="./assets/js/main.js"></script>

  
        
        
    </body>
</html>
                            </body>
                            </html>



