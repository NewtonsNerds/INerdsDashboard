<?php
namespace Application\Form\Fieldset;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use INerdsBase\Form\BaseFieldset;

class ProjectFieldset extends BaseFieldset implements InputFilterProviderInterface
{
    
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('project');
        
        $this->setHydrator(new DoctrineHydrator($objectManager))->setObject(new \Application\Entity\Project());
        
        $this->add(array(
            'type' => 'Text',
            'name' => 'name',
            'options' => array(
                'label' => 'Name'
            ),
            'attributes' => array(
                'class' => 'form-control'
            )
        ));
    }

    public function getInputFilterSpecification()
    {
        return array(
            'name' => $this->getStringInputFilter(),
        );
    }
}
