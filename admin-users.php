<?php

use \Hcode\Model\User;
use \Hcode\PageAdmin;

$app->get("/admin/users/:id_employees/password", function ($id_employees) {

    User::verifyLogin();

    $user = new User();

    $user->get((int) $id_employees);

    $page = new PageAdmin();

    $page->setTpl("users-password", [
        "user" => $user->getValues(),
        "msgError" => User::getError(),
        "msgSuccess" => User::getSuccess(),
    ]);

});

$app->post("/admin/users/:id_employees/password", function ($id_employees) {

    User::verifyLogin();

    if (!isset($_POST['despassword']) || $_POST['despassword'] === '') {

        User::setErrorRegister("Preencha a nova senha.");
        header("Location: /admin/users/$id_employees/password");
        exit;

    }

    if (!isset($_POST['despassword-confirm']) || $_POST['despassword-confirm'] === '') {

        User::setErrorRegister("Preencha a confirmação da nova senha.");
        header("Location: /admin/users/$id_employees/password");
        exit;

    }

    if ($_POST['despassword'] !== $_POST['despassword-confirm']) {

        User::setErrorRegister("Confirme corretamente as senhas.");
        header("Location: /admin/users/$id_employees/password");
        exit;

    }

    $user = new User();

    $user->get((int) $id_employees);

    $user->setPassword(User::getPasswordHash($_POST['despassword']));

    User::setSuccess("Senha alterada com sucesso.");

    header("Location: /admin/users/$id_employees/password");
    exit;

});

$app->get("/admin/users", function () {

    User::verifyLogin();

    $users = User::listAll();

    $page = new PageAdmin();

    $page->setTpl("users", array(
        "users" => $users,
    ));

});

$app->get("/admin/users/create", function () {

    User::verifyLogin();

    $user = User::getFromSession();

    $page = new PageAdmin();

    $page->setTpl("users-create", [
        'user' => $user->getValues(),
        'profileMsg' => User::getSuccess(),
        'errorRegister' => User::getErrorRegister(),
    ]);

});

$app->get("/admin/users/:id_employees/delete", function ($id_employees) {

    User::verifyLogin();

    $user = new User();

    $user->get((int) $id_employees);

    $user->delete();

    header("Location: /admin/users");
    exit;

});

$app->get("/admin/users/:id_employees", function ($id_employees) {

    User::verifyLogin();

    $user = new User();

    $user->get((int) $id_employees);

    $page = new PageAdmin();

    $page->setTpl("users-update", array(
        "user" => $user->getValues(),
    ));

});

$app->post("/admin/users/create", function () {

    User::verifyLogin();

    if (!isset($_POST['employees_name']) || $_POST['employees_name'] === '') {
        User::setErrorRegister("Preencha o seu nome.");
        header('Location: /admin/users/create');
        exit;
    }

    if (!isset($_POST['employees_function']) || $_POST['employees_function'] === '') {
        User::setErrorRegister("Preencha o seu cargo.");
        header('Location: /admin/users/create');
        exit;
    }

    if (!isset($_POST['deslogin']) || $_POST['deslogin'] === '') {
        User::setErrorRegister("Preencha o seu login.");
        header('Location: /admin/users/create');
        exit;
    }

    if (!isset($_POST['despassword']) || $_POST['despassword'] === '') {
        User::setErrorRegister("Preencha a sua senha.");
        header('Location: /admin/users/create');
        exit;
    }

    $user = User::getFromSession();

    if ($_POST['deslogin'] !== $user->getemail()) {

        if (User::checkLoginExist($_POST['deslogin']) === true) {

            User::setErrorRegister("Este login já está cadastrado, informe outro login.");
            header('Location: /admin/users/create');
            exit;

        }
    }

    $user = new User();

    $_POST["inadmin"] = (isset($_POST["inadmin"])) ? 1 : 0;

    $_POST['password'] = User::getPasswordHash($_POST["despassword"]); 

    $user->setData($_POST);

    $user->save();

    header("Location: /admin/users");

    exit;

});

$app->post("/admin/users/:id_employees", function ($id_employees) {

    User::verifyLogin();

    $user = new User();

    $_POST["inadmin"] = (isset($_POST["inadmin"])) ? 1 : 0;

    $user->get((int) $id_employees);

    $user->setData($_POST);

    $user->update();

    header("Location: /admin/users");
    exit;

});