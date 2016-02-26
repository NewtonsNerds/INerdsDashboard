<?php

namespace DoctrineORMModule\Proxy\__CG__\Application\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class CalendarWorkItem extends \Application\Entity\CalendarWorkItem implements \Doctrine\ORM\Proxy\Proxy
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
            return array('__isInitialized__', '' . "\0" . 'Application\\Entity\\CalendarWorkItem' . "\0" . 'name', '' . "\0" . 'Application\\Entity\\CalendarWorkItem' . "\0" . 'startAt', '' . "\0" . 'Application\\Entity\\CalendarWorkItem' . "\0" . 'commitEndAt', '' . "\0" . 'Application\\Entity\\CalendarWorkItem' . "\0" . 'endAt', '' . "\0" . 'Application\\Entity\\CalendarWorkItem' . "\0" . 'calendar', '' . "\0" . 'Application\\Entity\\CalendarWorkItem' . "\0" . 'user', '' . "\0" . 'Application\\Entity\\CalendarWorkItem' . "\0" . 'id', 'timeDeleted', '' . "\0" . 'Application\\Entity\\CalendarWorkItem' . "\0" . 'createdBy', '' . "\0" . 'Application\\Entity\\CalendarWorkItem' . "\0" . 'updatedBy', '' . "\0" . 'Application\\Entity\\CalendarWorkItem' . "\0" . 'createdAt', '' . "\0" . 'Application\\Entity\\CalendarWorkItem' . "\0" . 'updatedAt');
        }

        return array('__isInitialized__', '' . "\0" . 'Application\\Entity\\CalendarWorkItem' . "\0" . 'name', '' . "\0" . 'Application\\Entity\\CalendarWorkItem' . "\0" . 'startAt', '' . "\0" . 'Application\\Entity\\CalendarWorkItem' . "\0" . 'commitEndAt', '' . "\0" . 'Application\\Entity\\CalendarWorkItem' . "\0" . 'endAt', '' . "\0" . 'Application\\Entity\\CalendarWorkItem' . "\0" . 'calendar', '' . "\0" . 'Application\\Entity\\CalendarWorkItem' . "\0" . 'user', '' . "\0" . 'Application\\Entity\\CalendarWorkItem' . "\0" . 'id', 'timeDeleted', '' . "\0" . 'Application\\Entity\\CalendarWorkItem' . "\0" . 'createdBy', '' . "\0" . 'Application\\Entity\\CalendarWorkItem' . "\0" . 'updatedBy', '' . "\0" . 'Application\\Entity\\CalendarWorkItem' . "\0" . 'createdAt', '' . "\0" . 'Application\\Entity\\CalendarWorkItem' . "\0" . 'updatedAt');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (CalendarWorkItem $proxy) {
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
    public function setName($name)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setName', array($name));

        return parent::setName($name);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getName', array());

        return parent::getName();
    }

    /**
     * {@inheritDoc}
     */
    public function setStartAt($startAt)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setStartAt', array($startAt));

        return parent::setStartAt($startAt);
    }

    /**
     * {@inheritDoc}
     */
    public function getStartAt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getStartAt', array());

        return parent::getStartAt();
    }

    /**
     * {@inheritDoc}
     */
    public function setEndAt($endAt)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEndAt', array($endAt));

        return parent::setEndAt($endAt);
    }

    /**
     * {@inheritDoc}
     */
    public function getEndAt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEndAt', array());

        return parent::getEndAt();
    }

    /**
     * {@inheritDoc}
     */
    public function setCalendar(\Application\Entity\Calendar $calendar = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCalendar', array($calendar));

        return parent::setCalendar($calendar);
    }

    /**
     * {@inheritDoc}
     */
    public function getCalendar()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCalendar', array());

        return parent::getCalendar();
    }

    /**
     * {@inheritDoc}
     */
    public function setUser(\Application\Entity\User $user = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUser', array($user));

        return parent::setUser($user);
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
    public function setCommitEndAt($commitEndAt)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCommitEndAt', array($commitEndAt));

        return parent::setCommitEndAt($commitEndAt);
    }

    /**
     * {@inheritDoc}
     */
    public function getCommitEndAt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCommitEndAt', array());

        return parent::getCommitEndAt();
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