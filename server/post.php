<?php 
include "model.php";
$model = new model();
$title = $model->security($_POST['title']);
$value = $model->security($_POST['value-articles']);
session_start();
$auth = $_SESSION['username'];
echo $model->post($title,$value,$auth);
 ?>