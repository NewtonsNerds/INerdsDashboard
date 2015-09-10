<?php
namespace Application\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use INerdsBase\Entity\Traits\IdTrait;
use INerdsBase\Entity\Traits\SoftDeletableTrait;
use INerdsBase\Entity\Traits\BlameableTrait;
use INerdsBase\Entity\Traits\TimestampableTrait;

/**
 * Timezone
 *
 * @Gedmo\SoftDeleteable(fieldName="timeDeleted", timeAware=false)
 * @ORM\Table(name="timezone")
 * @ORM\Entity
 */
class Timezone
{
    use IdTrait;
    use SoftDeletableTrait;
    use BlameableTrait;
    use TimestampableTrait;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Application\Entity\User", mappedBy="timezone", fetch="EXTRA_LAZY")
     */
    private $users;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Timezone
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
     * Add users
     *
     * @param \Application\Entity\User $users
     * @return Timezone
     */
    public function addUser(\Application\Entity\User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \Application\Entity\User $users
     */
    public function removeUser(\Application\Entity\User $users)
    {
        $this->users->removeElement($users);
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
}
