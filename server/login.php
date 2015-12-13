<?php 
include "model.php";
$username=$model->security$_POST['username']); 
$password=$model->security$_POST['password']); 
$model = new model();
$result = $model->login($username,$password);
if($result=="success"){
	session_start();
	$_SESSION['username']=$username;
}
echo $result;
?>