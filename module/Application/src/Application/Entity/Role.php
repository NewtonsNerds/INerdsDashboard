<?php
namespace Application\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use BjyAuthorize\Acl\HierarchicalRoleInterface;
use INerdsBase\Entity\Traits\IdTrait;
use INerdsBase\Entity\Traits\SoftDeletableTrait;
use INerdsBase\Entity\Traits\BlameableTrait;
use INerdsBase\Entity\Traits\TimestampableTrait;

/**
 * Role
 * 
 * @author Siwei Mu <Siwei@newtonsnerds.com>
 *
 * @Gedmo\SoftDeleteable(fieldName="timeDeleted", timeAware=false)
 * @ORM\Table(name="role")
 * @ORM\Entity
 */
class Role implements HierarchicalRoleInterface
{
    use IdTrait;
    use SoftDeletableTrait;
    use BlameableTrait;
    use TimestampableTrait;
    
    /**
     * @var string
     *
     * @ORM\Column(name="roleId", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $roleid;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_default", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $isDefault = 0;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Application\Entity\Role", mappedBy="parent", fetch="EXTRA_LAZY")
     */
    private $children;
    
    /**
     * @var \Application\Entity\Role
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Role", inversedBy="children")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parentId", referencedColumnName="id", nullable=true)
     * })
     */
    private $parent;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Application\Entity\User", mappedBy="roles", fetch="EXTRA_LAZY")
     */
    private $users;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set roleid
     *
     * @param string $roleid
     * @return Role
     */
    public function setRoleId($roleid)
    {
        $this->roleid = $roleid;

        return $this;
    }

    /**
     * Get roleid
     *
     * @return string 
     */
    public function getRoleId()
    {
        return $this->roleid;
    }

    /**
     * Set isDefault
     *
     * @param boolean $isDefault
     * @return Role
     */
    public function setIsDefault($isDefault)
    {
        $this->isDefault = $isDefault;

        return $this;
    }

    /**
     * Get isDefault
     *
     * @return boolean 
     */
    public function getIsDefault()
    {
        return $this->isDefault;
    }

    /**
     * Set parent
     *
     * @param \Application\Entity\Role $parent
     * @return Role
     */
    public function setParent(\Application\Entity\Role $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Application\Entity\Role 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add user
     *
     * @param \Application\Entity\User $user
     * @return Role
     */
    public function addUser(\Application\Entity\User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \Application\Entity\User $user
     */
    public function removeUser(\Application\Entity\User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add children
     *
     * @param \Application\Entity\Role $children
     * @return Role
     */
    public function addChild(\Application\Entity\Role $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param \Application\Entity\Role $children
     */
    public function removeChild(\Application\Entity\Role $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
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
