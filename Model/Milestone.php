<?php

namespace WG\GitlabBundle\Entity;

class Milestone
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
}
