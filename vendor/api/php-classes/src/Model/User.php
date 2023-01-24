<?php

namespace Hcode\Model;

use \Hcode\DB\Sql;
use \Hcode\Model;

class User extends Model
{

    const SESSION = "User";
    const SECRET = "HcodePhp7_Secret";
    const SECRET_IV = "HcodePhp7_Secret_IV";
    const ERROR = "UserError";
    const ERROR_REGISTER = "UserErrorRegister";
    const SUCCESS = "UserSucesss";

    public static function getFromSession()
    {

        $user = new User();

        if (isset($_SESSION[User::SESSION]) && (int) $_SESSION[User::SESSION]['iduser'] > 0) {

            $user->setData($_SESSION[User::SESSION]);
        }

        return $user;
    }

    public static function checkLogin($perfil = Perfil::Administrador)
    {

        if (
            !isset($_SESSION[User::SESSION])
            ||
            !$_SESSION[User::SESSION]
            ||
            !(int) $_SESSION[User::SESSION]["iduser"] > 0
        ) {
            //Não está logado
            return false;
        } else {

            if ($perfil == Perfil::Administrador && $_SESSION[User::SESSION]['id_profile'] == Perfil::Administrador) {

                return true;
            } else if ($perfil == Perfil::Administrador) {

                return true;
            } else {

                return false;
            }
        }
    }

    public static function login($login, $password)
    {

        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_user a INNER JOIN tb_employees b ON a.id_employees = b.id_employees WHERE a.deslogin = :LOGIN", array(
            ":LOGIN" => $login,
        ));

        if (count($results) === 0) {
            throw new \Exception("Usuário inexistente ou senha inválida.");
        }

        $data = $results[0];

        if (password_verify($password, $data["despassword"]) === true) {

            $user = new User();

            $data['employees_name'] = utf8_encode($data['employees_name']);

            $user->setData($data);

            $_SESSION[User::SESSION] = $user->getValues();

            return $user;
        } else {
            throw new \Exception("Usuário inexistente ou senha inválida.");
        }
    }

    public static function verifyLogin2($inadmin = true)
    {

        if (!User::checkLogin2($inadmin)) {

            if ($inadmin) {
                header("Location: /admin/Funcionario");
            } else {
                header("Location: /login");
            }
            exit;
        }
    }

    public static function verifyLogin($perfil = Perfil::Administrador)
    {

        if (!User::checkLogin($perfil)) {

            if ($perfil == Perfil::Administrador) {
                header("Location: /admin/Funcionario");
            } else {
                header("Location: /Funcionario");
            }
            exit;
        }
    }

    public static function verifyLoginAluno($inadmin = true)
    {

        if (!User::checkLoginAluno($inadmin)) {

            if ($inadmin) {
                header("Location: /aluno/Aluno");
            } else {
                header("Location: /Aluno");
            }
            exit;
        }
    }

    public static function logout()
    {

        $_SESSION[User::SESSION] = null;
    }

    public static function listAll()
    {

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_user a INNER JOIN tb_employees b USING(id_employees) ORDER BY b.employees_name");
    }

    public function save()
    {

        $sql = new Sql();

        $results = $sql->select("CALL sp_save_employees (:employees_name, :employees_function, :id_profile, :deslogin, :despassword, :inadmin)", array(
            ":employees_name" => utf8_decode($this->getemployees_name()),
            ":employees_function" => $this->getemployees_function(),
            ":id_profile" => Perfil::Administrador,
            ":deslogin" => $this->getdeslogin(),
            ":despassword" => User::getPasswordHash($this->getdespassword()),
            ":inadmin" => $this->getinadmin(),
        ));

        //  die(var_dump($this->getemployees_name(), $this->getemployees_function(),Perfil::Administrador, $this->getdeslogin(),$this->getdespassword(),$this->getinadmin()));
        //  exit();

        // $this->setData($results[0]);
    }

    public function get($id_employees)
    {

        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_user a INNER JOIN tb_employees b USING(id_employees) WHERE a.id_employees = :id_employees", array(
            ":id_employees" => $id_employees,
        ));

        $data = $results[0];

        $data['employees_name'] = utf8_encode($data['employees_name']);

        $this->setData($data);
    }

    public function update()
    {

        $sql = new Sql();

        $results = $sql->select("CALL sp_update_employees(:id_employees, :employees_name,
		:employees_function, :deslogin)", array(
            ":id_employees" => $this->getid_employees(),
            ":employees_name" => utf8_decode($this->getemployees_name()),
            ":employees_function" => $this->getemployees_function(),
            ":deslogin" => $this->getdeslogin()
           
        ));

        // $this->setData($results[0]);
    }

    public function delete()
    {

        $sql = new Sql();

        $sql->query("CALL sp_delet_employees(:id_employees)", array(
            ":id_employees" => $this->getid_employees(),
        ));
    }

    public function setPassword($password)
    {

        $sql = new Sql();

        $sql->query("UPDATE tb_user SET despassword = :password WHERE iduser = :iduser", array(
            ":password" => $password,
            ":iduser" => $this->getiduser(),
        ));
    }

    public static function setError($msg)
    {

        $_SESSION[User::ERROR] = $msg;
    }

    public static function getError()
    {

        $msg = (isset($_SESSION[User::ERROR]) && $_SESSION[User::ERROR]) ? $_SESSION[User::ERROR] : '';

        User::clearError();

        return $msg;
    }

    public static function clearError()
    {

        $_SESSION[User::ERROR] = null;
    }

    public static function setSuccess($msg)
    {
        $_SESSION[User::SUCCESS] = $msg;
    }

    public static function getSuccess()
    {

        $msg = (isset($_SESSION[User::SUCCESS]) && $_SESSION[User::SUCCESS]) ? $_SESSION[User::SUCCESS] : '';

        User::clearSuccess();

        return $msg;
    }

    public static function clearSuccess()
    {

        $_SESSION[User::SUCCESS] = null;
    }

    public static function setErrorRegister($msg)
    {

        $_SESSION[User::ERROR_REGISTER] = $msg;
    }

    public static function getErrorRegister()
    {

        $msg = (isset($_SESSION[User::ERROR_REGISTER]) && $_SESSION[User::ERROR_REGISTER]) ? $_SESSION[User::ERROR_REGISTER] : '';

        User::clearErrorRegister();

        return $msg;
    }

    public static function clearErrorRegister()
    {

        $_SESSION[User::ERROR_REGISTER] = null;
    }

    public static function checkLoginExist($login)
    {

        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_user WHERE deslogin = :deslogin", [
            ':deslogin' => $login,
        ]);

        return (count($results) > 0);
    }

    public static function getPasswordHash($password)
    {

        return password_hash($password, PASSWORD_DEFAULT, [
            'cost' => 12,
        ]);
    }
}
