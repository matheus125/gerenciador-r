<?php

namespace Hcode\Model;

use \Hcode\DB\Sql;
use \Hcode\Model;

class Projetos extends Model
{

	public static function listAll()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_product ORDER BY bar_code");
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

	public function get($id_product)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_product WHERE id_product = :id_product", [
			':id_product' => $id_product
		]);

		$this->setData($results[0]);
	}

	public function delete()
	{

		$sql = new Sql();

		$sql->query("CALL sp_delete_product(:id_product)", array(
			":id_product" => $this->getid_product()
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
