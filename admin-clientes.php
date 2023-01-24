<?php 

use \Hcode\PageAdminClientes;
use \Hcode\Model\User;
use \Hcode\Model\Clientes;

$app->get("/admin/Clientes/clientes", function(){

	User::verifyLogin();

	$clientes = Clientes::listAll();
	
	$page = new PageAdminClientes();

	$page->setTpl("clientes", [
		'clientes'=>$clientes
	]);

});

$app->get("/admin/Clientes/clientes/create", function(){

	User::verifyLogin();

	$page = new PageAdminClientes();

	$page->setTpl("clientes-create");

});

$app->post("/admin/Clientes/clientes/create", function(){

	User::verifyLogin();

	$clientes = new Clientes();

	$clientes->setData($_POST);

	$clientes->save();

	header('Location: /admin/Clientes/clientes');
	exit;

});

$app->get("/admin/Clientes/clientes/:idclient", function($idclient){
	
	User::verifyLogin();

	$clientes = new Clientes();

	$clientes->get((int)$idclient);

	$page = new PageAdminClientes();

	$page->setTpl("clientes-update",[
	'clientes'=>$clientes->getValues()
	]);

});

$app->post("/admin/Clientes/clientes/:idclient", function($idclient){
	
	User::verifyLogin();

	$clientes = new Clientes();

	$clientes->get((int)$idclient);
	
	$clientes->setData($_POST);
	
	$clientes->update();
	
	header("Location: /admin/Clientes/clientes");
	exit;	

});


$app->get("/admin/Clientes/clientes/:idclient/delete", function($idclient){
	
	User::verifyLogin();

	$clientes = new Clientes();

	$clientes->get((int)$idclient);

	$clientes->delete();

	header("Location: /admin/Clientes/clientes");
	exit;

});

 ?>