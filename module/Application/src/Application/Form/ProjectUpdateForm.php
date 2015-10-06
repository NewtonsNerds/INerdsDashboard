<?php
namespace Application\Form;

use Zend\Form\Form;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Application\Form\Fieldset\ProjectFieldset;

class ProjectUpdateForm extends Form
{

    public function __construct(ObjectManager $objectManager)
    {
        // we want to ignore the name passed
        parent::__construct('project-update-form');
        
        // The form will hydrate an object
        $this->setHydrator(new DoctrineHydrator($objectManager));
        
        // Add the user fieldset, and set it as the base fieldset
        $projectFieldset = new ProjectFieldset($objectManager);
        $projectFieldset->setUseAsBaseFieldset(true);
        $this->add($projectFieldset);
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf',
            'options' => array(
                'csrf_options' => array(
                    'timeout' => 600
                )
            )
        ));
        
        $this->add(array(
            'name' => 'button-submit',
            'type' => 'button',
            'attributes' => array(
                'type' => 'submit'
            ),
        ));
    }
}