<?php

namespace ToDO\Model;

/**
 * @Entity @Table(name="todo_list")
 **/
class Works
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;
    /** @Column(type="string") **/
    protected $name;
    /** @Column(type="string") **/
    protected $description;
    /** @Column(type="datetime") **/
    protected $added_time;
    /** @Column(type="datetime", nullable=true) **/
    protected $done_time;
    /** @Column(type="boolean") **/
    protected $done = false;

    public function __construct()
    {
        $this->added_time = new \DateTime();
    }

    public function getDone()
    {
        return $this->done;
    }

    public function setDone($done)
    {
        $this->done = $done;
    }

    public function setAddedTime($added_time)
    {
        $this->added_time = $added_time;
    }

    public function setDoneTime($done_time)
    {
        $this->done_time = $done_time;
    }

    public function getAddedTime()
    {
        return $this->added_time;
    }

    public function getDoneTime()
    {
        return $this->done_time;
    }

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