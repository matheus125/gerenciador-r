<?php 

use \Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\Model\Cliente;

$app->get("/admin/clientes", function(){

	User::verifyLogin();

	$clientes = Cliente::listAll();
	
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

	$clientes = new Cliente();

	$clientes->setData($_POST);

	$clientes->save();

	header('Location: /admin/clientes');
	exit;

});

$app->get("/admin/clientes/:id", function($id){
	
	User::verifyLogin();

	$clientes = new Cliente();

	$clientes->get((int)$id);

	$page = new PageAdmin();

	$page->setTpl("clientes-update",[
	'clientes'=>$clientes->getValues()
	]);

});

$app->post("/admin/clientes/:id", function($id){
	
	User::verifyLogin();

	$clientes = new Cliente();

	$clientes->get((int)$id);
	
	$clientes->setData($_POST);
	
	$clientes->update();
	
	header("Location: /admin/clientes");
	exit;	

});


$app->get("/admin/clientes/:id/delete", function($id){
	
	User::verifyLogin();

	$clientes = new Cliente();

	$clientes->get((int)$id);

	$clientes->delete();

	header("Location: /admin/clientes");
	exit;

});

 ?>