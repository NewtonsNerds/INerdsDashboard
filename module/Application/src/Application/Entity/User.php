<?php
namespace Application\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use BjyAuthorize\Provider\Role\ProviderInterface;
use Doctrine\ORM\Mapping as ORM;
use ZfcUser\Entity\UserInterface;
use INerdsBase\Entity\Traits\IdTrait;
use INerdsBase\Entity\Traits\SoftDeletableTrait;
use INerdsBase\Entity\Traits\BlameableTrait;
use INerdsBase\Entity\Traits\TimestampableTrait;
use Doctrine\Common\Collections\Criteria;

/**
 * User
 * 
 * @author Siwei Mu <Siwei@newtonsnerds.com>
 *
 * @Gedmo\SoftDeleteable(fieldName="timeDeleted", timeAware=false)
 * @ORM\Table(name="user", uniqueConstraints={@ORM\UniqueConstraint(name="username", columns={"username"}), @ORM\UniqueConstraint(name="email", columns={"email"})})
 * @ORM\Entity(repositoryClass="Application\Entity\Repository\UserRepository")
 */
class User implements UserInterface, ProviderInterface
{
    use IdTrait;
    use SoftDeletableTrait;
    use BlameableTrait;
    use TimestampableTrait;
    
    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, nullable=true, unique=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="displayName", type="string", length=255, nullable=true, unique=false)
     */
    private $displayName;
    
    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=255, nullable=true, unique=false)
     */
    private $company;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=50, nullable=true, unique=false)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=50, nullable=true, unique=false)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=50, nullable=true, unique=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="mobile", type="string", length=50, nullable=true, unique=false)
     */
    private $mobile;
    
    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=50, nullable=true, unique=false)
     */
    private $telephone;
    
    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=128, nullable=false, unique=false)
     */
    private $password;

    /**
     * @var \Application\Entity\Locale
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Locale", inversedBy="users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="localeId", referencedColumnName="id", nullable=true)
     * })
     */
    private $locale;
    
    /**
     * @var \Application\Entity\Timezone
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Timezone", inversedBy="users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="timezoneId", referencedColumnName="id", nullable=true)
     * })
     */
    private $timezone;

    /**
     * @var integer
     *
     * @ORM\Column(name="state", type="smallint", nullable=true, unique=false)
     */
    private $state;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Application\Entity\Role", inversedBy="users", fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="user_role_linker",
     *   joinColumns={
     *     @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="role_id", referencedColumnName="id", nullable=true)
     *   }
     * )
     */
    private $roles;
    
    /**
     * @ORM\ManyToMany(targetEntity="Application\Entity\Task", inversedBy="users")
     * @ORM\JoinTable(name="user_task_linker")
     **/
    private $tasks;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Application\Entity\Attendance", mappedBy="user", fetch="EXTRA_LAZY")
     */
    private $attendances;
    
    /**
     * @ORM\OneToOne(targetEntity="Application\Entity\Calendar", mappedBy="user")
     */
    private $calendar;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Application\Entity\CalendarWorkItem", mappedBy="user", fetch="EXTRA_LAZY")
     */
    private $workItems;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->roles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tasks = new \Doctrine\Common\Collections\ArrayCollection();
        $this->attendances = new \Doctrine\Common\Collections\ArrayCollection();
        $this->workItems = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set displayName
     *
     * @param string $displayName
     * @return User
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;

        return $this;
    }

    /**
     * Get displayName
     *
     * @return string 
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }
    
    /**
     * Set firstName
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return User
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
     * Set mobile
     *
     * @param string $mobile
     * @return User
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string 
     */
    public function getTelephone()
    {
        return $this->telephone;
    }
    
    /**
     * Set telephone
     *
     * @param string $mobile
     * @return User
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    
        return $this;
    }
    
    /**
     * Get fax
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }
    
    /**
     * Set fax
     *
     * @param string $fax
     * @return User
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    
        return $this;
    }
    
    /**
     * Get mobile
     *
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set locale
     *
     * @param string $locale
     * @return User
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return string 
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set state
     *
     * @param integer $state
     * @return User
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return integer 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Add role
     *
     * @param \Application\Entity\Role $role
     * @return User
     */
    public function addRole(\Application\Entity\Role $role)
    {
        $this->roles[] = $role;

        return $this;
    }

    /**
     * Remove role
     *
     * @param \Application\Entity\Role $role
     */
    public function removeRole(\Application\Entity\Role $role)
    {
        $this->roles->removeElement($role);
    }

    /**
     * Get role
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Set timezone
     *
     * @param \Application\Entity\Timezone $timezone
     * @return User
     */
    public function setTimezone(\Application\Entity\Timezone $timezone = null)
    {
        $this->timezone = $timezone;

        return $this;
    }

    /**
     * Get timezone
     *
     * @return \Application\Entity\Timezone 
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * Set company
     *
     * @param string $company
     *
     * @return User
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Add task
     *
     * @param \Application\Entity\Task $task
     *
     * @return User
     */
    public function addTask(\Application\Entity\Task $task)
    {
        $this->tasks[] = $task;

        return $this;
    }

    /**
     * Remove task
     *
     * @param \Application\Entity\Task $task
     */
    public function removeTask(\Application\Entity\Task $task)
    {
        $this->tasks->removeElement($task);
    }

    /**
     * Get tasks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTasks()
    {
        return $this->tasks;
    }

    /**
     * Add attendance
     *
     * @param \Application\Entity\Attendance $attendance
     *
     * @return User
     */
    public function addAttendance(\Application\Entity\Attendance $attendance)
    {
        $this->attendances[] = $attendance;

        return $this;
    }

    /**
     * Remove attendance
     *
     * @param \Application\Entity\Attendance $attendance
     */
    public function removeAttendance(\Application\Entity\Attendance $attendance)
    {
        $this->attendances->removeElement($attendance);
    }

    /**
     * Get attendances
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAttendances()
    {
        return $this->attendances;
    }
    
    public function isPunchedInToday(){
//         $collection = $this->getAttendances();

//         $date = new \DateTime();
//         $today = $date->format('Y-m-d');
//         $date->add(new \DateInterval('P1D'));
//         $date = new \DateTime();
//         $tomorrow = $date->format('Y-m-d');
        
//         $criteria = Criteria::create()
//             ->where(Criteria::expr()->gte("timeIn", $today))
//             ->where(Criteria::expr()->lte("timeIn", $tomorrow))
//             ->andWhere(Criteria::expr()->eq('id', $this->getId()))
//         ->setMaxResults(1);
        
//         return count($collection->matching($criteria));
    }
    
    public function isPunchedOutToday(){
//         $collection = $this->getAttendances();
    
//         $date = new \DateTime();
//         $today = $date->format('Y-m-d');
//         $date->add(new \DateInterval('P1D'));
//        $tomorrow = $date->format('Y-m-d');
    
//         $criteria = Criteria::create()
//         ->where(Criteria::expr()->gte("timeOut", $today))
//         ->where(Criteria::expr()->lte("timeOut", $tomorrow))
//         ->andWhere(Criteria::expr()->eq('id', $this->getId()))
//         ->setMaxResults(1);
    
//         return count($collection->matching($criteria));
    }

    /**
     * Set calendar
     *
     * @param \Application\Entity\Calendar $calendar
     *
     * @return User
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
     * Add workItem
     *
     * @param \Application\Entity\CalendarWorkItem $workItem
     *
     * @return User
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
}
