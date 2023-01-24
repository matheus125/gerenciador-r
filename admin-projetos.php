<?php 

use \Hcode\PageAdminProjetos;
use \Hcode\Model\User;
use \Hcode\Model\Projetos;

$app->get("/admin/Projetos/projetos", function(){

	User::verifyLogin();

	$projetos = Projetos::listAll();
	
	$page = new PageAdminProjetos();

	$page->setTpl("projetos", [
		'projetos'=>$projetos
	]);

});

$app->get("/admin/Projetos/projetos-create", function(){

	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("projetos-create");

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