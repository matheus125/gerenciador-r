<?php

namespace Hcode\Model;

use \Hcode\DB\Sql;
use \Hcode\Model;

class Projetos extends Model
{

    public static function listAll()
    {

        $sql = new Sql();

        return $sql->select("SELECT p.id_projeto, p.nome_projeto, c.idclient, c.company_name, e.employees_name, 
		p.descricao_projeto, p.estado, p.orcamento_projeto, p.data_inicio_projeto, p.data_fim_projeto 
		FROM tb_projetos as p inner join tb_client as c on p.idclient = c.idclient 
		join tb_employees as e on p.id_employees = e.id_employees order by p.nome_projeto");
    }

    public static function checkList($list)
    {

        foreach ($list as &$row) {

            $p = new Produtos();
            $p->setData($row);
            $row = $p->getValues();
        }

        return $list;
    }

    public function save()
    {

        $sql = new Sql();

        $results = $sql->select("CALL sp_save_projetos(:nome_projeto, :idclient, :id_employees, :descricao_projeto, 
        :estado, :orcamento_projeto, :data_inicio_projeto, :data_fim_projeto)", array(
            ":nome_projeto" => $this->getnome_projeto(),
            ":idclient" => $this->getidclient(),
            ":id_employees" => $this->getid_employees(),
            ":descricao_projeto" => $this->getdescricao_projeto(),
            ":estado" => $this->getestado(),
            ":orcamento_projeto" => $this->getorcamento_projeto(),
            ":data_inicio_projeto" => $this->getdata_inicio_projeto(),
            ":data_fim_projeto" => $this->getdata_fim_projeto(),
        ));

        // die(var_dump($this->getnamecourses(), $this->getdesurl(), $this->getdscription()));

        // $this->setData($results[0]);
    }

    public function get($id_projeto)
    {

        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_projetos WHERE id_projeto = :id_projeto", [
            ':id_projeto' => $id_projeto,
        ]);

        $this->setData($results[0]);
    }

    public function delete()
    {

        $sql = new Sql();

        $sql->query("CALL sp_delete_projeto(:id_projeto)", array(
            ":id_projeto" => $this->getid_projeto(),
        ));
    }

    public function update()
    {

        $sql = new Sql();

        $results = $sql->select("CALL sp_update_product(:id_product, :color, :category_name, :brand, :size, :description, :bar_code, :price, :qtdproduct)", array(
            ":id_product" => $this->getid_product(),
            ":color" => $this->getcolor(),
            ":category_name" => $this->getcategory_name(),
            ":brand" => $this->getbrand(),
            ":size" => $this->getsize(),
            ":description" => $this->getdescription(),
            ":bar_code" => $this->getbar_code(),
            ":price" => $this->getprice(),
            ":qtdproduct" => $this->getqtdproduct(),
        ));

        // $this->setData($results[0]);
    }
}
