<?php
namespace Application\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use INerdsBase\Entity\Traits\IdTrait;
use INerdsBase\Entity\Traits\SoftDeletableTrait;
use INerdsBase\Entity\Traits\BlameableTrait;
use INerdsBase\Entity\Traits\TimestampableTrait;

/**
 * Calendar
 *
 * @Gedmo\SoftDeleteable(fieldName="timeDeleted", timeAware=false)
 * @ORM\Table(name="calendar")
 * @ORM\Entity(repositoryClass="Application\Entity\Repository\CalendarRepository")
 */
class Calendar
{
    use IdTrait;
    use SoftDeletableTrait;
    use BlameableTrait;
    use TimestampableTrait;
    
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true, unique=false)
     */
    private $name;
    
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true, unique=false)
     */
    private $description;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Application\Entity\CalendarWorkItem", mappedBy="calendar", fetch="EXTRA_LAZY")
     */
    private $workItems;
    
    /**
     * @ORM\OneToOne(targetEntity="Application\Entity\User", inversedBy="calendars")
     * @ORM\JoinColumn(name="userId", referencedColumnName="id")
     */
    private $user;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->workItems = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Calendar
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Calendar
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add workItem
     *
     * @param \Application\Entity\CalendarWorkItem $workItem
     *
     * @return Calendar
     */
    public function addWorkItem(\Application\Entity\CalendarWorkItem $workItem)
    {
        $this->workItems[] = $workItem;

        return $this;
    }

    /**
     * Remove workItem
     *
     * @param \Application\Entity\CalendarWorkItem $workItem
     */
    public function removeWorkItem(\Application\Entity\CalendarWorkItem $workItem)
    {
        $this->workItems->removeElement($workItem);
    }

    /**
     * Get workItems
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWorkItems()
    {
        return $this->workItems;
    }

    /**
     * Set user
     *
     * @param \Application\Entity\User $user
     *
     * @return Calendar
     */
    public function setUser(\Application\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Application\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
