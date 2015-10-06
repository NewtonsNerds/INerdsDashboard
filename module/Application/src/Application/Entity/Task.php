<?php
namespace Application\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use INerdsBase\Entity\Traits\IdTrait;
use INerdsBase\Entity\Traits\SoftDeletableTrait;
use INerdsBase\Entity\Traits\BlameableTrait;
use INerdsBase\Entity\Traits\TimestampableTrait;

/**
 * Project
 *
 * @Gedmo\SoftDeleteable(fieldName="timeDeleted", timeAware=false)
 * @ORM\Table(name="task")
 * @ORM\Entity(repositoryClass="Application\Entity\Repository\TaskRepository")
 */
class Task
{
    use IdTrait;
    use SoftDeletableTrait;
    use BlameableTrait;
    use TimestampableTrait;
    
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true, unique=false)
     */
    private $title;
    
    /**
     * @var text
     *
     * @ORM\Column(name="details", type="text", nullable=true, unique=false)
     */
    private $details;
    
    /**
     * @ORM\Column(name="startOn", type="datetime", nullable=true)
     */
    private $startOn;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Application\Entity\Tag", mappedBy="tasks", fetch="EXTRA_LAZY")
     */
    private $tags;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Application\Entity\User", mappedBy="tasks", fetch="EXTRA_LAZY")
     */
    private $users;
    
    /**
     * @var \Application\Entity\Locale
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Project", inversedBy="tasks")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="projectId", referencedColumnName="id", nullable=true)
     * })
     */
    private $project;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Task
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set details
     *
     * @param string $details
     *
     * @return Task
     */
    public function setDetails($details)
    {
        $this->details = $details;

        return $this;
    }

    /**
     * Get details
     *
     * @return string
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * Set startOn
     *
     * @param \DateTime $startOn
     *
     * @return Task
     */
    public function setStartOn($startOn)
    {
        $this->startOn = $startOn;

        return $this;
    }

    /**
     * Get startOn
     *
     * @return \DateTime
     */
    public function getStartOn()
    {
        return $this->startOn;
    }

    /**
     * Add user
     *
     * @param \Application\Entity\User $user
     *
     * @return Task
     */
    public function addUser(\Application\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \Application\Entity\User $user
     */
    public function removeUser(\Application\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Set project
     *
     * @param \Application\Entity\Project $project
     *
     * @return Task
     */
    public function setProject(\Application\Entity\Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \Application\Entity\Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Add tag
     *
     * @param \Application\Entity\Tag $tag
     *
     * @return Task
     */
    public function addTag(\Application\Entity\Tag $tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Remove tag
     *
     * @param \Application\Entity\Tag $tag
     */
    public function removeTag(\Application\Entity\Tag $tag)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }
}
