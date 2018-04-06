<?php

namespace Model;

class UserModel extends MainModel
{
    const TABLENAME = 'users';

    public function login($data = [])
    {
        $stmt = $this->db->prepare('SELECT * FROM '.self::TABLENAME.' WHERE email=:email');
        $stmt->bindParam(':email', $data['email'], \PDO::PARAM_STR);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $result = $stmt->fetch();

            if(!password_verify($data['passwd'], $result['password']))
                return false;

            return $result;
        }

        return false;
    }

    public function insertNewUser($data)
    {
        $stmt = $this->db->prepare("INSERT INTO ".self::TABLENAME." SET email=:email, name=:name, surname=:surname, password=:password");
        $stmt->bindParam(':email', $data['email'], \PDO::PARAM_STR);
        $stmt->bindParam(':name', $data['name'], \PDO::PARAM_STR);
        $stmt->bindParam(':surname', $data['surname'], \PDO::PARAM_STR);
        $stmt->bindParam(':password', password_hash($data['password'], PASSWORD_BCRYPT), \PDO::PARAM_STR);
        $stmt->execute();

        if($stmt->rowCount() > 0)
            return $this->db->lastInsertId();

        return false;
    }

    public function getUser($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM '.self::TABLENAME.' WHERE id=:id');
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $result = $stmt->fetch();
            return $result;
        }

        return false;
    }

    public function userExist($data = [])
    {
        $stmt = $this->db->prepare('SELECT * FROM '.self::TABLENAME.' WHERE email=:email');
        $stmt->bindParam(':email', $data['email'], \PDO::PARAM_STR);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return true;
        }

        return false;
    }
}