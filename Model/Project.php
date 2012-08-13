<?php

namespace WG\GitlabBundle\Model;

class Project extends BaseModel
{
    protected $id;
    protected $code;
    protected $name;
    protected $description;
    protected $path;
    protected $defaultBranch;
    protected $owner;
    protected $private;
    protected $issuesEnabled;
    protected $mergeRequestsEnabled;
    protected $wallEnabled;
    protected $wikiEnabled;
    protected $createdAt;
    
    public function getId()
    {
        return $this->id;
    }

    public function setId( $id )
    {
        $this->id = $id;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setCode( $code )
    {
        $this->code = $code;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName( $name )
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription( $description )
    {
        $this->description = $description;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setPath( $path )
    {
        $this->path = $path;
    }

    public function getDefaultBranch()
    {
        return $this->defaultBranch;
    }

    public function setDefaultBranch( $defaultBranch )
    {
        $this->defaultBranch = $defaultBranch;
    }

    public function getOwner()
    {
        return $this->owner;
    }

    public function setOwner( $owner )
    {
        $this->owner = $owner;
    }

    public function getPrivate()
    {
        return $this->private;
    }

    public function setPrivate( $private )
    {
        $this->private = $private;
    }

    public function getIssuesEnabled()
    {
        return $this->issuesEnabled;
    }

    public function setIssuesEnabled( $issuesEnabled )
    {
        $this->issuesEnabled = $issuesEnabled;
    }

    public function getMergeRequestsEnabled()
    {
        return $this->mergeRequestsEnabled;
    }

    public function setMergeRequestsEnabled( $mergeRequestsEnabled )
    {
        $this->mergeRequestsEnabled = $mergeRequestsEnabled;
    }

    public function getWallEnabled()
    {
        return $this->wallEnabled;
    }

    public function setWallEnabled( $wallEnabled )
    {
        $this->wallEnabled = $wallEnabled;
    }

    public function getWikiEnabled()
    {
        return $this->wikiEnabled;
    }

    public function setWikiEnabled( $wikiEnabled )
    {
        $this->wikiEnabled = $wikiEnabled;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt( $createdAt )
    {
        $this->createdAt = $createdAt;
    }
    
    static public function map( array $data, Project $project = null )
    {
        if ( null === $project ) $project = new Project();
        if ( isset( $data['id']                     ) ) $project->setId                  ( $data['id'] );
        if ( isset( $data['code']                   ) ) $project->setCode                ( $data['code'] );
        if ( isset( $data['name']                   ) ) $project->setName                ( $data['name'] );
        if ( isset( $data['description']            ) ) $project->setDescription         ( $data['description'] );
        if ( isset( $data['path']                   ) ) $project->setPath                ( $data['path'] );
        if ( isset( $data['default_branch']         ) ) $project->setDefaultBranch       ( $data['default_branch'] );
        if ( isset( $data['owner']                  ) ) $project->setOwner               ( User::map( $data['owner'] ) );
        if ( isset( $data['private']                ) ) $project->setPrivate             ( $data['private'] );
        if ( isset( $data['issues_enabled']         ) ) $project->setIssuesEnabled       ( $data['issues_enabled'] );
        if ( isset( $data['merge_requests_enabled'] ) ) $project->setMergeRequestsEnabled( $data['merge_requests_enabled'] );
        if ( isset( $data['wall_enabled']           ) ) $project->setWallEnabled         ( $data['wall_enabled'] );
        if ( isset( $data['wiki_enabled']           ) ) $project->setWikiEnabled         ( $data['wiki_enabled'] );
        if ( isset( $data['created_at']             ) ) $project->setCreatedAt           ( $data['created_at'] );
        return $project;
    }
}
