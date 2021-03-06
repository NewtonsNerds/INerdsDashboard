<?php

namespace DoctrineORMModule\Proxy\__CG__\Application\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Role extends \Application\Entity\Role implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array();



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return array('__isInitialized__', '' . "\0" . 'Application\\Entity\\Role' . "\0" . 'roleid', '' . "\0" . 'Application\\Entity\\Role' . "\0" . 'isDefault', '' . "\0" . 'Application\\Entity\\Role' . "\0" . 'children', '' . "\0" . 'Application\\Entity\\Role' . "\0" . 'parent', '' . "\0" . 'Application\\Entity\\Role' . "\0" . 'users', '' . "\0" . 'Application\\Entity\\Role' . "\0" . 'id', 'timeDeleted', '' . "\0" . 'Application\\Entity\\Role' . "\0" . 'createdBy', '' . "\0" . 'Application\\Entity\\Role' . "\0" . 'updatedBy', '' . "\0" . 'Application\\Entity\\Role' . "\0" . 'createdAt', '' . "\0" . 'Application\\Entity\\Role' . "\0" . 'updatedAt');
        }

        return array('__isInitialized__', '' . "\0" . 'Application\\Entity\\Role' . "\0" . 'roleid', '' . "\0" . 'Application\\Entity\\Role' . "\0" . 'isDefault', '' . "\0" . 'Application\\Entity\\Role' . "\0" . 'children', '' . "\0" . 'Application\\Entity\\Role' . "\0" . 'parent', '' . "\0" . 'Application\\Entity\\Role' . "\0" . 'users', '' . "\0" . 'Application\\Entity\\Role' . "\0" . 'id', 'timeDeleted', '' . "\0" . 'Application\\Entity\\Role' . "\0" . 'createdBy', '' . "\0" . 'Application\\Entity\\Role' . "\0" . 'updatedBy', '' . "\0" . 'Application\\Entity\\Role' . "\0" . 'createdAt', '' . "\0" . 'Application\\Entity\\Role' . "\0" . 'updatedAt');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Role $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', array());
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', array());
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function setRoleId($roleid)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRoleId', array($roleid));

        return parent::setRoleId($roleid);
    }

    /**
     * {@inheritDoc}
     */
    public function getRoleId()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRoleId', array());

        return parent::getRoleId();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsDefault($isDefault)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsDefault', array($isDefault));

        return parent::setIsDefault($isDefault);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsDefault()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsDefault', array());

        return parent::getIsDefault();
    }

    /**
     * {@inheritDoc}
     */
    public function setParent(\Application\Entity\Role $parent = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setParent', array($parent));

        return parent::setParent($parent);
    }

    /**
     * {@inheritDoc}
     */
    public function getParent()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getParent', array());

        return parent::getParent();
    }

    /**
     * {@inheritDoc}
     */
    public function addUser(\Application\Entity\User $user)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addUser', array($user));

        return parent::addUser($user);
    }

    /**
     * {@inheritDoc}
     */
    public function removeUser(\Application\Entity\User $user)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeUser', array($user));

        return parent::removeUser($user);
    }

    /**
     * {@inheritDoc}
     */
    public function getUser()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUser', array());

        return parent::getUser();
    }

    /**
     * {@inheritDoc}
     */
    public function addChild(\Application\Entity\Role $children)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addChild', array($children));

        return parent::addChild($children);
    }

    /**
     * {@inheritDoc}
     */
    public function removeChild(\Application\Entity\Role $children)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeChild', array($children));

        return parent::removeChild($children);
    }

    /**
     * {@inheritDoc}
     */
    public function getChildren()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getChildren', array());

        return parent::getChildren();
    }

    /**
     * {@inheritDoc}
     */
    public function getUsers()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUsers', array());

        return parent::getUsers();
    }

    /**
     * {@inheritDoc}
     */
    public function getId()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', array());

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function setId($id)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setId', array($id));

        return parent::setId($id);
    }

    /**
     * {@inheritDoc}
     */
    public function setTimeDeleted($timeDeleted)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTimeDeleted', array($timeDeleted));

        return parent::setTimeDeleted($timeDeleted);
    }

    /**
     * {@inheritDoc}
     */
    public function getTimeDeleted()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTimeDeleted', array());

        return parent::getTimeDeleted();
    }

    /**
     * {@inheritDoc}
     */
    public function setCreatedBy(\Application\Entity\User $createdBy = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreatedBy', array($createdBy));

        return parent::setCreatedBy($createdBy);
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedBy()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreatedBy', array());

        return parent::getCreatedBy();
    }

    /**
     * {@inheritDoc}
     */
    public function setUpdatedBy(\Application\Entity\User $updatedBy = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUpdatedBy', array($updatedBy));

        return parent::setUpdatedBy($updatedBy);
    }

    /**
     * {@inheritDoc}
     */
    public function getUpdatedBy()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUpdatedBy', array());

        return parent::getUpdatedBy();
    }

    /**
     * {@inheritDoc}
     */
    public function setCreatedAt(\DateTime $createdAt)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreatedAt', array($createdAt));

        return parent::setCreatedAt($createdAt);
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedAt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreatedAt', array());

        return parent::getCreatedAt();
    }

    /**
     * {@inheritDoc}
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUpdatedAt', array($updatedAt));

        return parent::setUpdatedAt($updatedAt);
    }

    /**
     * {@inheritDoc}
     */
    public function getUpdatedAt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUpdatedAt', array());

        return parent::getUpdatedAt();
    }

}
