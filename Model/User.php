<?php

namespace WG\GitlabBundle\Entity;

class User
{
    protected $id;
    protected $email;
    protected $name;
    protected $blocked;
    protected $createdAt;
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setId( $id )
    {
        $this->id = $id;
    }
    
    public function getEmail()
    {
        return $this->email;
    }
    
    public function setEmail( $email )
    {
        $this->email = $email;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setName( $name )
    {
        $this->name = $name;
    }
    
    public function isBlocked( $block = null )
    {
        if ( null !== $block ) $this->blocked = $block;
        return $this->blocked;
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
