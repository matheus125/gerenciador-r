<?php

use \Hcode\Model\Clientes;
use \Hcode\Model\Projetos;
use \Hcode\Model\User;
use \Hcode\PageAdminProjetos;

$app->get("/admin/Projetos/projetos", function () {

    User::verifyLogin();

    $page = new PageAdminProjetos();

    $page->setTpl("projetos", [
        'projetos' => Projetos::listAll(),
    ]);

});

$app->get("/admin/Projetos/projeto/create", function () {

    User::verifyLogin();

    $page = new PageAdminProjetos();

    $page->setTpl("projeto-create", [
        'cliente' => Clientes::listAll(),
        'funcionario' => User::listAll(),
    ]);

});

$app->post("/admin/Projetos/projeto/create", function () {

    User::verifyLogin();

    $projetos = new Projetos();

    $projetos->setData($_POST);

    $projetos->save();

    header('Location: /admin/Projetos/projetos');
    exit;

});

$app->get("/admin/Projetos/projetos/:id_projeto", function ($id_projeto) {

    User::verifyLogin();

    $projetos = new Projetos();

    $projetos->get((int) $id_projeto);

    $page = new PageAdminProjetos();

    $page->setTpl("projeto-update", [
        'projetos' => $projetos->getValues(),
    ]);
});

$app->post("/admin/Projetos/projetos/:id_projeto", function ($id_projeto) {

    User::verifyLogin();

    $projetos = new Projetos();

    $projetos->get((int) $id_projeto);

    $projetos->setData($_POST);

    $projetos->update();

    header("Location: /admin/Projetos/projetos");
    exit;

});

$app->get("/admin/Projetos/projetos/:id_projeto/delete", function ($id_projeto) {

    User::verifyLogin();

    $projetos = new Projetos();

    $projetos->get((int) $id_projeto);

    $projetos->delete();

    header("Location: /admin/Projetos/projetos");
    exit;

});

$app->get("/admin/Projetos/projetos/projeto/detalhe/:id_projeto", function ($id_projeto) {

    User::verifyLogin();

    $projetos = new Projetos();
    $tarefa = new Projetos();

    $projetos->get((int) $id_projeto);
    $tarefa->getid((int) $id_projeto);

    $page = new PageAdminProjetos();

    $page->setTpl("projeto-detalhe", [
        'projetos' => $projetos->getValues(),
        'tarefa' => $tarefa->getValues(),
    ]);
});

$app->get("/admin/Projetos/tarefas/create/:id_projeto", function ($id_projeto) {

    User::verifyLogin();

    $projetos = new Projetos();

    $projetos->get((int) $id_projeto);

    $page = new PageAdminProjetos();

    $page->setTpl("tarefas-create", [
        'funcionario' => User::listAll(),
        'projetos' => $projetos->getValues(),
    ]);
});

$app->post("/admin/Projetos/tarefas/create", function () {

    User::verifyLogin();

    $projetos = new Projetos();

    $projetos->setData($_POST);

    $projetos->saveTarefas();

    header('Location: /admin/Projetos/projetos');
    exit;

});