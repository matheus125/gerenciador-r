<?php

namespace Hcode\Model;

use \Hcode\DB\Sql;
use \Hcode\Model;

class Cliente extends Model
{

	public static function listAll()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_client ORDER BY id");
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

		$results = $sql->select("CALL sp_save_product(:color, :category_name, :brand, :size, :description, :bar_code, :price, :qtdproduct)", array(
			":color" => $this->getcolor(),
			":category_name" => $this->getcategory_name(),
			":brand" => $this->getbrand(),
			":size" => $this->getsize(),
			":description" => $this->getdescription(),
			":bar_code" => $this->getbar_code(),
			":price" => $this->getprice(),
			":qtdproduct" => $this->getqtdproduct()
		));

		// die(var_dump($this->getnamecourses(), $this->getdesurl(), $this->getdscription()));

		// $this->setData($results[0]);
	}

	public function get($id)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_client WHERE id = :id", [
			':id' => $id
		]);

		$this->setData($results[0]);
	}

	public function delete()
	{

		$sql = new Sql();

		$sql->query("CALL sp_delete_client(:id)", array(
			":id" => $this->getid()
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
			":qtdproduct" => $this->getqtdproduct()
		));

		// $this->setData($results[0]);
	}
	
}
