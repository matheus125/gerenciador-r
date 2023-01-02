<?php 

use \Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\Model\Produtos;

$app->get("/admin/produtos", function(){

	User::verifyLogin();

	$produtos = Produtos::listAll();
	
	$page = new PageAdmin();

	$page->setTpl("produtos", [
		'produtos'=>$produtos
	]);

});

$app->get("/admin/produtos/create", function(){

	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("produtos-create");

});

$app->post("/admin/produtos/create", function(){

	User::verifyLogin();

	$produtos = new Produtos();

	$produtos->setData($_POST);

	$produtos->save();

	header('Location: /admin/produtos');
	exit;

});

$app->get("/admin/produtos/:id_product", function($id_product){
	
	User::verifyLogin();

	$produtos = new Produtos();

	$produtos->get((int)$id_product);

	$page = new PageAdmin();

	$page->setTpl("produtos-update",[
	'produtos'=>$produtos->getValues()
	]);

});

$app->post("/admin/produtos/:id_product", function($id_product){
	
	User::verifyLogin();

	$produtos = new Produtos();

	$produtos->get((int)$id_product);
	
	$produtos->setData($_POST);
	
	$produtos->update();
	
	header("Location: /admin/produtos");
	exit;	

});


$app->get("/admin/produtos/:id_product/delete", function($id_product){
	
	User::verifyLogin();

	$produtos = new Produtos();

	$produtos->get((int)$id_product);

	$produtos->delete();

	header("Location: /admin/produtos");
	exit;

});

 ?>