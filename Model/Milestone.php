<?php

namespace WG\GitlabBundle\Model;

class Milestone extends BaseModel
{
    protected $id;
    protected $title;
    protected $description;
    protected $dueDate;
    protected $closed;
    protected $updatedAt;
    protected $createdAt;
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setId( $id )
    {
        $this->id = $id;
    }
    
    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle( $title )
    {
        $this->title = $title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription( $description )
    {
        $this->description = $description;
    }

    public function getDueDate()
    {
        return $this->dueDate;
    }

    public function setDueDate( $dueDate )
    {
        $this->dueDate = $dueDate;
    }

    public function getClosed()
    {
        return $this->closed;
    }

    public function setClosed( $closed )
    {
        $this->closed = $closed;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt( $updatedAt )
    {
        $this->updatedAt = $updatedAt;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt( $createdAt )
    {
        $this->createdAt = $createdAt;
    }
}
