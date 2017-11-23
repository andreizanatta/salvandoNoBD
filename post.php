<?php

/*if($_REQUEST){
    echo json_encode(["msg"=>"Request"]);exit;
}*/
if($_GET){
    //var_dump($_GET);exit;
    //echo "<name>{$_GET['name']}</name>";
    //header("HTTP/1.0 404 Not Found");exit;
    echo json_encode($_GET);exit;
}
if($_POST){
	//$_POST['name'] = $_POST['name']." DB";
	//$_POST['email'] = $_POST['email']." DB";
	//$_POST['tel'] = $_POST['tel']." DB";

	$name = $_POST['name'];
	$email = $_POST['email'];
	$tel = $_POST['tel'];

	if($name == ""){
		echo json_encode(["status"=>false, "msg"=>"Preencha com um nome!"]);exit;		
	}
	if($email == ""){
		echo json_encode(["status"=>false, "msg"=>"Preencha com um email!"]);exit;		
	}
	if($tel == ""){
		echo json_encode(["status"=>false, "msg"=>"Preencha com um telefone!"]);exit;		
	}

	$id = save($_POST);
	if ($id) {
    	echo json_encode(["status"=>true, "msg"=>"Sucesso!"]);exit;
	}else{
		echo json_encode(["status"=>true, "msg"=>"Erro BD!"]);exit;
	}
}

function conexao_BD(){
	$con = new \PDO("mysql:host=localhost;dbname=ajax-jquery", "root", " ");
	return $con; 
}

function save($data){
	$db = conexao_BD();
	$query = "Insert  into 'contatos' ('name', 'email', 'tel') VALUES(:name, :email, :tel)";
	$stmt = $db->prepare($query);
	$stmt->bindValue(':name', $data['name']);
	$stmt->bindValue(':email', $data['email']);
	$stmt->bindValue(':tel', $data['tel']);
	$stmt->execute();
	return $db->lastInsertId();
}