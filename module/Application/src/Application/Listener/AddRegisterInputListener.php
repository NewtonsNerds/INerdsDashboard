<?php
namespace Application\Listener;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;

/**
 * Hook into zfcuser registration to add extra fields and field validations
 *
 * @author Siwei Mu <Siwei@newtonsnerds.com>
 */
class AddRegisterInputListener implements ListenerAggregateInterface
{

    /**
     *
     * @var \Zend\Stdlib\CallbackHandler[]
     */
    protected $listeners = array();

    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events)
    {
        $sharedEvents = $events->getSharedManager();
        $this->listeners[] = $sharedEvents->attach('ZfcUser\Form\Register', 'init', array(
            $this,
            'onInitRegisterForm'
        ));
        $this->listeners[] = $sharedEvents->attach('ZfcUser\Form\RegisterFilter', 'init', array(
            $this,
            'onInitRegisterFormFilter'
        ));
    }

    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    public function onInitRegisterForm($e)
    {
        
        /* @var $form \ZfcUser\Form\Register */
        $form = $e->getTarget();
        
        $form->add(array(
            'name' => 'firstName',
            'type' => 'text',
            'options' => array(
                'label' => 'First Name'
            )
        ));
        
        $form->add(array(
            'name' => 'lastName',
            'type' => 'text',
            'options' => array(
                'label' => 'Last Name'
            )
        ));
        
        $form->add(array(
            'name' => 'title',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'options' => array(
                    'Mr.' => 'Mr.',
                    'Mrs.' => 'Mrs.',
                    'Ms.' => 'Ms.'
                )
            ),
            'options' => array(
                'label' => 'Title'
            )
        ));
        
        $form->add(array(
            'name' => 'mobile',
            'type' => 'text',
            'options' => array(
                'label' => 'Mobile'
            )
        ));
        
        $form->add(array(
            'name' => 'telephone',
            'type' => 'text',
            'options' => array(
                'label' => 'Phone'
            )
        ));
        
        $form->add(array(
            'name' => 'fax',
            'type' => 'text',
            'options' => array(
                'label' => 'Fax'
            )
        ));
        
        $form->add(array(
            'name' => 'company',
            'type' => 'text',
            'options' => array(
                'label' => 'Company'
            )
        ));
    }

    public function onInitRegisterFormFilter($e)
    {
        $filter = $e->getTarget();
        
        $filter->add(array(
            'name' => 'firstName',
            'required' => true,
            'allowEmpty' => false,
            'filters' => array(
                array(
                    'name' => 'StringTrim'
                )
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty'
                )
            )
        ));
        
        $filter->add(array(
            'name' => 'lastName',
            'required' => true,
            'allowEmpty' => false,
            'filters' => array(
                array(
                    'name' => 'StringTrim'
                )
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty'
                )
            )
        ));
    }
}