<?php 

use \Hcode\Page;
use \Hcode\PageAdmin;
use \Hcode\Model\User;

$app->get('/', function() {
    
	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("index");

});

$app->get('/admin', function() {
    
	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("index");

});

$app->get("/admin/profile", function(){

	User::verifyLogin();

	$user = User::getFromSession();

	$page = new PageAdmin();

	$page->setTpl("/admin/profile", [
		'user'=>$user->getValues(),
		'profileMsg'=>User::getSuccess(),
		'profileError'=>User::getError()
	]);

});

$app->post("/admin/profile", function(){

	User::verifyLogin();

	if (!isset($_POST['nome']) || $_POST['nome'] === '') {
		User::setError("Preencha o seu nome.");
		header('Location: /admin/profile');
		exit;
	}

	if (!isset($_POST['email']) || $_POST['email'] === '') {
		User::setError("Preencha o seu e-mail.");
		header('Location: /admin/profile');
		exit;
	}

	$user = User::getFromSession();

	if ($_POST['email'] !== $user->getemail()) {

		if (User::checkLoginExist($_POST['email']) === true) {

			User::setError("Este endereço de e-mail já está cadastrado.");
			header('Location: /admin/profile');
			exit;

		}
	}

	$_POST['inadmin'] = $user->getinadmin();
	$_POST['despassword'] = $user->getdespassword();
	$_POST['deslogin'] = $_POST['deslogin'];

	$user->setData($_POST);

	$user->update();

	User::setSuccess("Dados alterados com sucesso!");

	header('Location: /admin/profile');
	exit;

});

$app->get("/admin/password", function(){

	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("/admin/password", [
		'changePassError'=>User::getError(),
		'changePassSuccess'=>User::getSuccess()
	]);

});

$app->post("/admin/password", function(){

	User::verifyLogin();

	if (!isset($_POST['current_pass']) || $_POST['current_pass'] === '') {

		User::setError("Digite a senha atual.");
		header("Location: /admin/password");
		exit;

	}

	if (!isset($_POST['new_pass']) || $_POST['new_pass'] === '') {

		User::setError("Digite a nova senha.");
		header("Location: /admin/password");
		exit;

	}

	if (!isset($_POST['new_pass_confirm']) || $_POST['new_pass_confirm'] === '') {

		User::setError("Confirme a nova senha.");
		header("Location: /admin/password");
		exit;

	}

	if ($_POST['current_pass'] === $_POST['new_pass']) {

		User::setError("A sua nova senha deve ser diferente da atual.");
		header("Location: /admin/password");
		exit;		

	}

	$user = User::getFromSession();

	if (!password_verify($_POST['current_pass'], $user->getdespassword())) {

		User::setError("A senha está inválida.");
		header("Location: /admin/password");
		exit;			

	}

	$user->setdespassword($_POST['new_pass']);

	$user->update();

	User::setSuccess("Senha alterada com sucesso.");

	header("Location: /admin/password");
	exit;

});

$app->get("/admin/Funcionario", function() {
    
	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("Funcionario", [
		'error'=>User::getError()
	]);

});

$app->post("/admin/Funcionario", function() {
    
	try {

		User::login($_POST["login"], $_POST["password"]);

	} catch(Exception $e){

		User::setError($e->getMessage());

	}
		
	header("Location: /admin");
	exit;

});

$app->get("/admin/logout", function(){
	
	User::logout();

	header("Location: /admin/Funcionario");
	exit;

});

$app->get("/admin/forgot", function() {
	
	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("forgot");

});

 ?>