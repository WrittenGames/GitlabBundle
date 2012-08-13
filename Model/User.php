<?php

namespace WG\GitlabBundle\Model;

class User extends BaseModel
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
    
    public function getBlocked()
    {
        return $this->blocked;
    }
    
    public function setBlocked( $blocked )
    {
        $this->blocked = $blocked;
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
    
    static public function map( array $data, User $user = null )
    {
        if ( null === $user ) $user = new User();
        if ( isset( $data['id']         ) ) $user->setId       ( $data['id']         );
        if ( isset( $data['email']      ) ) $user->setEmail    ( $data['email']      );
        if ( isset( $data['name']       ) ) $user->setName     ( $data['name']       );
        if ( isset( $data['blocked']    ) ) $user->setBlocked  ( $data['blocked']    );
        if ( isset( $data['created_at'] ) ) $user->setCreatedAt( $data['created_at'] );
        return $user;
    }
}
