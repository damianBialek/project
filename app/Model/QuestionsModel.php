<?php
namespace Model;


class QuestionsModel extends MainModel
{
    const TABLENAME = 'questions';

    public function getAll()
    {
        $stmt = $this->db->query("SELECT ".self::TABLENAME.".*, ".UserModel::TABLENAME.".name as userName FROM ".self::TABLENAME.", ".UserModel::TABLENAME." WHERE ".self::TABLENAME.".id_user = ".UserModel::TABLENAME.".id");
        $result = $stmt->fetchAll();

        return $result;
    }
}