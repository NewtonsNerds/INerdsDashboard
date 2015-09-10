<?php

namespace Application\Entity\Traits;

/**
 * Blameable Trait, usable with PHP >= 5.4
 *
 * @author Siwei Mu <Siwei@newtonsnerds.com>
 */
trait BlameableTrait
{
    /**
     * @var User $createdBy
     *
     * @Gedmo\Blameable(on="create")
     * @ORM\ManyToOne(targetEntity="Application\Entity\User")
     * @ORM\JoinColumn(name="createdBy", referencedColumnName="id")
     */
    private $createdBy;

    /**
     * @var User $updatedBy
     *
     * @Gedmo\Blameable(on="update")
     * @ORM\ManyToOne(targetEntity="Application\Entity\User")
     * @ORM\JoinColumn(name="updatedBy", referencedColumnName="id")
     */
    private $updatedBy;

    /**
     * Set createdBy
     *
     * @param \Application\Entity\User $createdBy
     * @return Category
     */
    public function setCreatedBy(\Application\Entity\User $createdBy = null)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return \Application\Entity\User 
     */
    public function getCreatedBy()
    {        
        return $this->createdBy;
    }

    /**
     * Set updatedBy
     *
     * @param \Application\Entity\User $updatedBy
     * @return Category
     */
    public function setUpdatedBy(\Application\Entity\User $updatedBy = null)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * Get updatedBy
     *
     * @return \Application\Entity\User 
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }
}
