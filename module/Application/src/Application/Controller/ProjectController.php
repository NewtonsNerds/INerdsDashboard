<?php
namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use INerdsBase\Controller\BaseController;

/**
 * ProjectController
 *
 * @author Siwei Mu <Siwei@newtonsnerds.com>
 */
class ProjectController extends BaseController
{
    
    public function indexAction(){
        
        if($this->_isXmlHttpRequestViaPost()){
            $em = $this->getEntityManager();
        
            $result = $em->getRepository('Application\Entity\Project')->getAll();
        
            return new JsonModel($result);
        }
        
        return new ViewModel();
    }

    public function addAction()
    {
        return $this->_getFormProcessor()->quickAdd($this->getRequest(), 'Project');
    }
    
    public function updateAction()
    {
        return $this->_getFormProcessor()->quickUpdate($this->getRequest(), 'Project');
    }
    
    public function deleteAction()
    {
        return $this->_getFormProcessor()->quickDelete('Project');
    }
}