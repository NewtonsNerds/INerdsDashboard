<?php
namespace Application\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use INerdsBase\Entity\Traits\IdTrait;
use INerdsBase\Entity\Traits\SoftDeletableTrait;
use INerdsBase\Entity\Traits\BlameableTrait;
use INerdsBase\Entity\Traits\TimestampableTrait;

/**
 * Locale
 *
 * @Gedmo\SoftDeleteable(fieldName="timeDeleted", timeAware=false)
 * @ORM\Table(name="locale")
 * @ORM\Entity
 */
class Locale
{
    use IdTrait;
    use SoftDeletableTrait;
    use BlameableTrait;
    use TimestampableTrait;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $code;
    
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $name;
    
    /**
     * @var string
     *
     * @ORM\Column(name="local_name", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $localName;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Application\Entity\User", mappedBy="locale", fetch="EXTRA_LAZY")
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
     * Set code
     *
     * @param string $code
     * @return Locale
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Locale
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
     * Set localName
     *
     * @param string $localName
     * @return Locale
     */
    public function setLocalName($localName)
    {
        $this->localName = $localName;

        return $this;
    }

    /**
     * Get localName
     *
     * @return string 
     */
    public function getLocalName()
    {
        return $this->localName;
    }

    /**
     * Add users
     *
     * @param \Application\Entity\User $users
     * @return Locale
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
