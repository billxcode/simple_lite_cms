<?php 
/**
 * model file untuk management database
 */
 class model
 {
 	private $connect;
 	function __construct()
 	{
 		$this->connect = mysqli_connect("localhost","root","","webblog") or die(mysqli_error());
 	}
 	public function security($param){
 		return htmlentities(stripslashes(htmlspecialchars($param)));
 	}
 	private function boolean_check($sql,$type){
 		if($type=="select"){
 			$row = mysqli_num_rows($sql);
 			if($row>0){
 				return "success";
 			}else{
 				return "failed";
 			}
 		}else if($type=="insert"){
 			if($sql){
 				return "success";
 			}else{
 				return "failed";
 			}
 		}
 	}
 	private function parse_data($sql){
 		$data=array();
 		if($sql){
 			while($row=mysqli_fetch_array($sql)){
 				$data[]=$row;
 			}
 			return json_encode($data);
 		}else{
 			return "failed";
 		}
 	}
 	public function login($username,$password){
 		$sql = mysqli_query($this->connect,"SELECT `username`, `password` FROM `auth` WHERE `username`='$username' and `password`='$password'") or die(mysqli_error($this->connect));
 		return $this->boolean_check($sql,"select");
 	}
 	public function post($title,$value,$auth){
 		$sql = mysqli_query($this->connect,"INSERT INTO `articles`(`title`, `value`, `date`, `auth_idauth`) VALUES ('$title','$value',current_date,(SELECT idauth FROM auth WHERE username='$auth'))") or die(mysqli_error($this->connect));
 		return $this->boolean_check($sql,"insert");
 	}
 	public function get_post(){
 		$sql = mysqli_query($this->connect,"SELECT `title`, `value`, `date`, `auth_idauth`, `username` FROM `articles`,`auth` WHERE articles.auth_idauth=auth.idauth ORDER BY idarticles DESC") or die(mysqli_error($this->connect));
 		return $this->parse_data($sql);
 	}
 	function __destruct(){
 		mysqli_close($this->connect);
 	}

 } ?>