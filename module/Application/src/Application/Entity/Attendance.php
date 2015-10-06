<?php
namespace Application\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use INerdsBase\Entity\Traits\IdTrait;
use INerdsBase\Entity\Traits\SoftDeletableTrait;
use INerdsBase\Entity\Traits\BlameableTrait;
use INerdsBase\Entity\Traits\TimestampableTrait;

/**
 * Attendance
 *
 * @Gedmo\SoftDeleteable(fieldName="timeDeleted", timeAware=false)
 * @ORM\Table(name="Attendance")
 * @ORM\Entity(repositoryClass="Application\Entity\Repository\AttendanceRepository")
 */
class Attendance
{
    use IdTrait;
    use SoftDeletableTrait;
    use BlameableTrait;
    use TimestampableTrait;
    
    /**
     * @ORM\Column(name="timeIn", type="datetime", nullable=true)
     */
    private $timeIn;
    
        /**
     * @ORM\Column(name="timeOut", type="datetime", nullable=true)
     */
    private $timeOut;
    
    /**
     * @var \Application\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\User", inversedBy="attendances")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="userId", referencedColumnName="id", nullable=true)
     * })
     */
    private $user;

    /**
     * Set timeIn
     *
     * @param \DateTime $timeIn
     *
     * @return Attendance
     */
    public function setTimeIn($timeIn)
    {
        $this->timeIn = $timeIn;

        return $this;
    }

    /**
     * Get timeIn
     *
     * @return \DateTime
     */
    public function getTimeIn()
    {
        return $this->timeIn;
    }

    /**
     * Set timeOut
     *
     * @param \DateTime $timeOut
     *
     * @return Attendance
     */
    public function setTimeOut($timeOut)
    {
        $this->timeOut = $timeOut;

        return $this;
    }

    /**
     * Get timeOut
     *
     * @return \DateTime
     */
    public function getTimeOut()
    {
        return $this->timeOut;
    }

    /**
     * Set user
     *
     * @param \Application\Entity\User $user
     *
     * @return Attendance
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
