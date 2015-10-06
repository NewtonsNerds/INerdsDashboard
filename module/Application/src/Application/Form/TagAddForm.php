<?php
namespace Application\Form;

use Zend\Form\Form;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Application\Form\Fieldset\TagFieldset;

class TagAddForm extends Form
{

    public function __construct(ObjectManager $objectManager)
    {
        // we want to ignore the name passed
        parent::__construct('tag-add-form');
        
        // The form will hydrate an object
        $this->setHydrator(new DoctrineHydrator($objectManager));
        
        // Set as base fieldset
        $tagFieldset = new TagFieldset($objectManager);
        $tagFieldset->setUseAsBaseFieldset(true);
        $this->add($tagFieldset);
        
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