<?php 

use \Hcode\PageAdminProjetos;
use \Hcode\Model\User;
use \Hcode\Model\Clientes;
use \Hcode\Model\Projetos;

$app->get("/admin/Projetos/projetos", function(){

	User::verifyLogin();

	$page = new PageAdminProjetos();

	$page->setTpl("projetos", [
		'projetos'=>Projetos::listAll()
	]);

});

$app->get("/admin/Projetos/projeto/create", function(){

	User::verifyLogin();

	$page = new PageAdminProjetos();

	$page->setTpl("projeto-create", [
		'cliente'=>Clientes::listAll(),
		'funcionario'=>User::listAll()
	]);

});

$app->post("/admin/Projetos/projeto/create", function(){

	User::verifyLogin();

	$projetos = new Projetos();

	$projetos->setData($_POST);

	$projetos->save();

	header('Location: /admin/Projetos/projetos');
	exit;

});

$app->get("/admin/projetos/:id_product", function($id_product){
	
	User::verifyLogin();

	$projetos = new Projetos();

	$projetos->get((int)$id_product);

	$page = new PageAdminProjetos();

	$page->setTpl("projetos-update",[
	'projetos'=>$projetos->getValues()
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


$app->get("/admin/Projetos/projetos/:id_projeto/delete", function($id_projeto){
	
	User::verifyLogin();

	$projetos = new Projetos();

	$projetos->get((int)$id_projeto);

	$projetos->delete();

	header("Location: /admin/Projetos/projetos");
	exit;

});

 ?>