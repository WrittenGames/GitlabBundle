<?php

namespace WG\GitlabBundle\Model;

class Issue extends BaseModel
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
    
    public function getLabels()
    {
        return $this->labels;
    }

    public function setLabels( $labels )
    {
        $this->labels = $labels;
    }

    public function addLabel( $label )
    {
        $this->labels[] = $label;
    }

    public function getMilestone()
    {
        return $this->milestone;
    }

    public function setMilestone( $milestone )
    {
        $this->milestone = $milestone;
    }

    public function getAssignee()
    {
        return $this->assignee;
    }

    public function setAssignee( $assignee )
    {
        $this->assignee = $assignee;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor( $author )
    {
        $this->author = $author;
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
