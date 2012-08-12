<?php

namespace WG\GitlabBundle\Entity;

class Issue
{
    protected $id;
    protected $projectId;
    protected $title;
    protected $description;
    protected $labels;
    protected $milestone;
    protected $assignee;
    protected $author;
    protected $closed;
    protected $updatedAt;
    protected $createdAt;
    
    public function __construct( $projectId = null, $title = null )
    {
        $this->projectId = $projectId;
        $this->title = $title;
        $this->labels = array();
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setId( $id )
    {
        $this->id = $id;
    }
    
    public function getProjectId()
    {
        return $this->projectId;
    }
    
    public function setProjectId( $projectId )
    {
        $this->projectId = $projectId;
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
}
