<?php

namespace Hcode\Model;

use \Hcode\DB\Sql;
use \Hcode\Model;

class Projetos extends Model
{

    public static function listAll()
    {

        $sql = new Sql();

        return $sql->select("SELECT p.id_projeto, p.nome_projeto, c.idclient, c.company_name, e.id_employees , e.employees_name,
		p.descricao_projeto, p.estado, p.progresso, p.orcamento_projeto, p.data_inicio_projeto, p.data_fim_projeto
		FROM tb_projetos as p inner join tb_client as c on p.idclient = c.idclient
		join tb_employees as e on p.id_employees = e.id_employees order by p.nome_projeto
        ");
    }

    
    public function getid($id_projeto)
    {

        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_atividades a
        INNER JOIN tb_projetos b ON b.id_projeto = a.id_projeto
        INNER JOIN tb_employees c ON c.id_employees = a.id_employees
        WHERE a.id_projeto = :id_projeto order by employees_name
                ", [
            ':id_projeto' => $id_projeto
        ]);
        $this->setData($results[0]);
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
        
    }

    public function saveTarefas()
    {

        $sql = new Sql();

        $results = $sql->select("CALL sp_save_tarefas(:id_projeto, :id_employees, :tarefa, :descricao,
        :data_inicio_tarefa, :data_fim_tarefa)", array(
            ":id_projeto" => $this->getid_projeto(),
            ":id_employees" => $this->getid_employees(),
            ":tarefa" => $this->gettarefa(),
            ":descricao" => $this->getdescricao(),
            ":data_inicio_tarefa" => $this->getdata_inicio_tarefa(),
            ":data_fim_tarefa" => $this->getdata_fim_tarefa(),
        ));

    }

    public function get($id_projeto)
    {

        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_projetos a
                INNER JOIN tb_client b ON b.idclient = a.idclient
                INNER JOIN tb_employees c ON c.id_employees = a.id_employees
                WHERE a.id_projeto = :id_projeto
                ", [
            ':id_projeto' => $id_projeto
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

        $results = $sql->select("CALL sp_update_projetos(:id_projeto, :nome_projeto, :idclient,
        :id_employees, :descricao_projeto, :estado, :progresso, :orcamento_projeto, :data_inicio_projeto, :data_fim_projeto)", array(
            ":id_projeto" => $this->getid_projeto(),
            ":nome_projeto" => $this->getnome_projeto(),
            ":idclient" => $this->getidclient(),
            ":id_employees" => $this->getid_employees(),
            ":descricao_projeto" => $this->getdescricao_projeto(),
            ":estado" => $this->getestado(),
            ":progresso" => $this->getprogresso(),
            ":orcamento_projeto" => $this->getorcamento_projeto(),
            ":data_inicio_projeto" => $this->getdata_inicio_projeto(),
            ":data_fim_projeto" => $this->getdata_fim_projeto(),
        ));
    }
}