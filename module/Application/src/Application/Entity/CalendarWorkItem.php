<?php
namespace Application\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use INerdsBase\Entity\Traits\IdTrait;
use INerdsBase\Entity\Traits\SoftDeletableTrait;
use INerdsBase\Entity\Traits\BlameableTrait;
use INerdsBase\Entity\Traits\TimestampableTrait;

/**
 * Calendar Work Item
 *
 * @Gedmo\SoftDeleteable(fieldName="timeDeleted", timeAware=false)
 * @ORM\Table(name="calendar_work_item")
 * @ORM\Entity(repositoryClass="Application\Entity\Repository\CalendarWorkItemRepository")
 */
class CalendarWorkItem
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
     * @ORM\Column(name="startAt", type="datetime", nullable=true)
     */
    private $startAt;
    
    /**
     * @ORM\Column(name="commitEndAt", type="datetime", nullable=true)
     */
    private $commitEndAt;
    
    /**
     * @ORM\Column(name="endAt", type="datetime", nullable=true)
     */
    private $endAt;
    
    /**
     * @var \Application\Entity\Calendar
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Calendar", inversedBy="workItems")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="calendarId", referencedColumnName="id", nullable=true)
     * })
     */
    private $calendar;
    
    /**
     * @var \Application\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\User", inversedBy="workItems")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="userId", referencedColumnName="id", nullable=true)
     * })
     */
    private $user;

    /**
     * Set name
     *
     * @param string $name
     *
     * @return CalendarWorkItem
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
     * Set startAt
     *
     * @param \DateTime $startAt
     *
     * @return CalendarWorkItem
     */
    public function setStartAt($startAt)
    {
        $this->startAt = $startAt;

        return $this;
    }

    /**
     * Get startAt
     *
     * @return \DateTime
     */
    public function getStartAt()
    {
        return $this->startAt;
    }

    /**
     * Set endAt
     *
     * @param \DateTime $endAt
     *
     * @return CalendarWorkItem
     */
    public function setEndAt($endAt)
    {
        $this->endAt = $endAt;

        return $this;
    }

    /**
     * Get endAt
     *
     * @return \DateTime
     */
    public function getEndAt()
    {
        return $this->endAt;
    }

    /**
     * Set calendar
     *
     * @param \Application\Entity\Calendar $calendar
     *
     * @return CalendarWorkItem
     */
    public function setCalendar(\Application\Entity\Calendar $calendar = null)
    {
        $this->calendar = $calendar;

        return $this;
    }

    /**
     * Get calendar
     *
     * @return \Application\Entity\Calendar
     */
    public function getCalendar()
    {
        return $this->calendar;
    }

    /**
     * Set user
     *
     * @param \Application\Entity\User $user
     *
     * @return CalendarWorkItem
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

    /**
     * Set commitEndAt
     *
     * @param \DateTime $commitEndAt
     *
     * @return CalendarWorkItem
     */
    public function setCommitEndAt($commitEndAt)
    {
        $this->commitEndAt = $commitEndAt;

        return $this;
    }

    /**
     * Get commitEndAt
     *
     * @return \DateTime
     */
    public function getCommitEndAt()
    {
        return $this->commitEndAt;
    }
}
