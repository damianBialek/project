<?php
namespace Model;


class QuestionsModel extends MainModel
{
    protected $tableName = 'questions';

    public function getAll()
    {
        $stmt = $this->db->query("SELECT $this->tableName.*, users.name as userName FROM $this->tableName, users WHERE $this->tableName.id_user = users.id");
        $result = $stmt->fetchAll();

        return $result;
    }
}