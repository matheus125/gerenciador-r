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

		return $sql->select("SELECT * FROM tb_client ORDER BY company_name");
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

		$results = $sql->select("CALL sp_client_save(:idperfil, :company_name, :cnpj, :phone, :email, :deslogin, :despassword)", array(
			":idperfil" => Perfil::Cliente,
			":company_name" => utf8_decode($this->getcompany_name()),
			":cnpj" => $this->getcnpj(),
			":phone" => $this->getphone(),
			":email" => $this->getemail(),
			":deslogin" => $this->getdeslogin(),
			":despassword" => User::getPasswordHash($this->getpassword())
		));

		// die(var_dump($this->getcompany_name(), $this->getemail(), $this->getphone(), Perfil::Cliente,
        // $this->getlogin(), $this->getpassword()));

		//  $this->setData($results[0]);

		//Clientes::updateFile();
	}

	public function get($idclient)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_client
			WHERE idclient = :idclient", [
			':idclient' => $idclient
		]);

		$this->setData($results[0]);
	}

	public function delete()
	{

		$sql = new Sql();

		$sql->query("CALL sp_delete_client(:idclient)", array(
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

		$results = $sql->select("CALL sp_client_update(:idperson, :company_name, :email, :phone, :idperfil, :deslogin, :despassword)", array(
			":idperson"=> $this->getidperson(),
			":company_name" => $this->getcompany_name(),
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