<?php

namespace Model;

/**
 * @Entity @Table(name="activities")
 **/
class Activities
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;
    /** @Column(type="string") **/
    protected $name;
    /** @Column(type="string") **/
    protected $description;
    /** @Column(type="datetime") **/
    protected $start_time;
    /** @Column(type="datetime") **/
    protected $end_time;
    /** @Column(type="datetime") **/
    protected $update_time;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }
}