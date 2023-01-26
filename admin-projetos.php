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

$app->get("/admin/Projetos/projetos/:id_projeto", function($id_projeto){
	
	User::verifyLogin();

	$projetos = new Projetos();

	$projetos->get((int)$id_projeto);

	$page = new PageAdminProjetos();

	$page->setTpl("projeto-update",[
	'projetos'=>$projetos->getValues()
	]);

});

$app->post("/admin/produtos/:id_projeto", function($id_projeto){
	
	User::verifyLogin();

	$produtos = new Produtos();

	$produtos->get((int)$id_projeto);
	
	$produtos->setData($_POST);
	
	$produtos->update();
	
	header("Location: /admin/Projetos/produtos");
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