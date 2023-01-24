<?php 

use \Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\Model\Clientes;

$app->get("/admin/clientes", function(){

	User::verifyLogin();

	$clientes = Clientes::listAll();
	
	$page = new PageAdmin();

	$page->setTpl("clientes", [
		'clientes'=>$clientes
	]);

});

$app->get("/admin/clientes/create", function(){

	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("clientes-create");

});

$app->post("/admin/clientes/create", function(){

	User::verifyLogin();

	$clientes = new Clientes();

	$clientes->setData($_POST);

	$clientes->save();

	header('Location: /admin/clientes');
	exit;

});

$app->get("/admin/clientes/:idclient", function($idclient){
	
	User::verifyLogin();

	$clientes = new Clientes();

	$clientes->get((int)$idclient);

	$page = new PageAdmin();

	$page->setTpl("clientes-update",[
	'clientes'=>$clientes->getValues()
	]);

});

$app->post("/admin/clientes/:idclient", function($idclient){
	
	User::verifyLogin();

	$clientes = new Clientes();

	$clientes->get((int)$idclient);
	
	$clientes->setData($_POST);
	
	$clientes->update();
	
	header("Location: /admin/clientes");
	exit;	

});


$app->get("/admin/clientes/:idclient/delete", function($idclient){
	
	User::verifyLogin();

	$clientes = new Clientes();

	$clientes->get((int)$idclient);

	$clientes->delete();

	header("Location: /admin/clientes");
	exit;

});

 ?>