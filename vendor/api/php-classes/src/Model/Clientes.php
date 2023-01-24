<?php

namespace Hcode\Model;

use \Hcode\DB\Sql;
use \Hcode\Model;
use Hcode\Model\Clientes as ModelClientes;

class Clientes extends Model

{

	const ERROR = "ClienteError";
	const ERROR_REGISTER = "ClienteErrorRegister";
	const SUCCESS = "ClienteSucesss";

	public static function listAll()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_persons p INNER JOIN tb_client c ON c.idperson = p.idperson");
	}

	public static function listCertifi($idclient)
	{
		$sql = new Sql();

		return $sql->select("CALL sp_certificates_list(:idclient)",  array(
			":idclient"=> $idclient
		));

		
	}
	
	public static function checkList($list)
	{

		foreach ($list as &$row) {

			$p = new Clientes();

			$p->setData($row);

			$row = $p->getValues();
		}

		return $list;
	}

	public function save()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_client_save(:nome, :email, :phone, :idperfil, :deslogin, :despassword)", array(
			":nome" => utf8_decode($this->getnome()),
			":email" => $this->getemail(),
			":phone" => $this->getphone(),
			":idperfil" => Perfil::Cliente,
			":deslogin" => $this->getlogin(),
			":despassword" => User::getPasswordHash($this->getpassword())
		));

		// die(var_dump($this->getnome(), $this->getemail(), $this->getphone(), Perfil::Cliente,
        // $this->getlogin(), $this->getpassword()));


		$this->setData($results[0]);

		//Clientes::updateFile();
	}

	public function get($idclient)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_client c 
			INNER JOIN tb_persons p ON c.idperson = p.idperson
			INNER JOIN tb_users u ON u.idperson = p.idperson
			WHERE c.idclient = :idclient", [
			':idclient' => $idclient
		]);

		$this->setData($results[0]);
	}

	public function delete()
	{

		$sql = new Sql();

		$sql->query("CALL sp_cliente_delete(:idclient)", array(
			":idclient" => $this->getidclient()
		));

	}

	public function deletecertificado()
	{

		$sql = new Sql();

		$sql->query("CALL sp_clientCertificado_delete(:idCertificates)", [
			':idCertificates' => $this->getidCertificates()
		]);

	}

	public function getCert($idCertificates)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_certificates c 
			WHERE c.idCertificates = :idCertificates", [
			':idCertificates' => $idCertificates
		]);

		$this->setData($results[0]);
	}

	public function update()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_client_update(:idperson, :nome, :email, :phone, :idperfil, :deslogin, :despassword)", array(
			":idperson"=> $this->getidperson(),
			":nome" => $this->getnome(),
			":email" => $this->getemail(),
			":phone" => $this->getphone(),
			":idperfil" => $this->getidperfil(),
			":deslogin" => $this->getdeslogin(),
			":despassword" => $this->getdespassword()
		));

		$this->setData($results[0]);		

	}

	public static function setError($msg)
	{

		$_SESSION[Clientes::ERROR] = $msg;
	}

	public static function getError()
	{

		$msg = (isset($_SESSION[Clientes::ERROR]) && $_SESSION[Clientes::ERROR]) ? $_SESSION[Clientes::ERROR] : '';

		Clientes::clearError();

		return $msg;
	}

	public static function clearError()
	{

		$_SESSION[Clientes::ERROR] = NULL;
	}

	public static function setSuccess($msg)
	{
		$_SESSION[Clientes::SUCCESS] = $msg;
	}

	public static function getSuccess()
	{

		$msg = (isset($_SESSION[Clientes::SUCCESS]) && $_SESSION[Clientes::SUCCESS]) ? $_SESSION[Clientes::SUCCESS] : '';

		Clientes::clearSuccess();

		return $msg;
	}

	public static function clearSuccess()
	{

		$_SESSION[Clientes::SUCCESS] = NULL;
	}

	public static function setErrorRegister($msg)
	{

		$_SESSION[Clientes::ERROR_REGISTER] = $msg;
	}

	public static function getErrorRegister()
	{

		$msg = (isset($_SESSION[Clientes::ERROR_REGISTER]) && $_SESSION[Clientes::ERROR_REGISTER]) ? $_SESSION[Clientes::ERROR_REGISTER] : '';

		Clientes::clearErrorRegister();

		return $msg;
	}

	public static function clearErrorRegister()
	{

		$_SESSION[Clientes::ERROR_REGISTER] = NULL;
	}
	

}