<?php
namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use INerdsBase\Controller\BaseController;

/**
 * TagController
 *
 * @author Siwei Mu <Siwei@newtonsnerds.com>
 */
class TagController extends BaseController
{
    
    public function indexAction(){
        
        if($this->_isXmlHttpRequestViaPost()){
            $em = $this->getEntityManager();
        
            $result = $em->getRepository('Application\Entity\Tag')->getAll();
        
            return new JsonModel($result);
        }
        
        return new ViewModel();
    }

    public function addAction()
    {
        return $this->_getFormProcessor()->quickAdd($this->getRequest(), 'Tag');
    }
    
    public function updateAction()
    {
        return $this->_getFormProcessor()->quickUpdate($this->getRequest(), 'Tag');
    }
    
    public function deleteAction()
    {
        return $this->_getFormProcessor()->quickDelete('Tag');
    }
}