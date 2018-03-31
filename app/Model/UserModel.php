<?php

namespace Model;

class UserModel extends MainModel
{
    protected $tableName = 'users';

    public function getUser($data = [])
    {
        $stmt = $this->db->prepare('SELECT * FROM '.$this->tableName.' WHERE email=:email AND password =:password');
        $stmt->bindParam(':email', $data['email'], \PDO::PARAM_STR);
        $stmt->bindParam(':password', $data['password']);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $result = $stmt->fetch();

            return $result;
        }

        return false;
    }

    public function userExist($data = [])
    {
        $stmt = $this->db->prepare('SELECT * FROM '.$this->tableName.' WHERE email=:email');
        $stmt->bindParam(':email', $data['email'], \PDO::PARAM_STR);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return true;
        }

        return false;
    }
}