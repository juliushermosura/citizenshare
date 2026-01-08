<?php
 
include "face-detect/FaceDetector.php";
 
$face_detect = new Face_Detector('face-detect/detection.dat');
$face_detect->face_detect('face-detect/sample-image1.jpg');
$face_detect->cropFace();
 
?>
