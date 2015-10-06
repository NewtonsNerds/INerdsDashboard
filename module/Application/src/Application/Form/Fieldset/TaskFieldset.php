<?php
namespace Application\Form\Fieldset;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use INerdsBase\Form\BaseFieldset;

class TaskFieldset extends BaseFieldset implements InputFilterProviderInterface
{
    
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('task');
        
        $this->setHydrator(new DoctrineHydrator($objectManager))->setObject(new \Application\Entity\Task());
        
        $this->add(array(
            'type' => 'Text',
            'name' => 'title',
            'options' => array(
                'label' => 'Title'
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        ));
        
        $this->add(array(
            'type' => 'Textarea',
            'name' => 'details',
            'options' => array(
                'label' => 'Details'
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        ));
        
        $now = new \DateTime();
        $this->add(array(
            'type' => 'Datetime',
            'name' => 'startOn',
            'options' => array(
                'label' => 'Start On',
                'value' => date("Y-m-d"),
            ),
            'attributes' => array(
                'class' => 'form-control',
                
            )
        ));
        
        $this->add(array(
            'type' => 'Hidden',
            'name' => 'project',
            'options' => array(
                'label' => 'Project'
            ),
        ));
    }

    public function getInputFilterSpecification()
    {
        return array(
            'title' => $this->getStringInputFilter(),
        );
    }
}
