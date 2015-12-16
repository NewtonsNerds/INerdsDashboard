<?php
namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use INerdsBase\Controller\BaseController;

/**
 * Calendar Controller
 *
 * @author Siwei Mu <Siwei@newtonsnerds.com>
 */
class CalendarController extends BaseController
{
    
    public function indexAction(){
        
        return new ViewModel();
    }
    
    public function switchUserCalendarAction(){
        $userId = $this->params()->fromRoute('userId');
        
        if($this->_isXmlHttpRequestViaPost()){
            $em = $this->getEntityManager();
        
            $result = $em->getRepository('Application\Entity\Task')->getAllByProject($projectId);
            return new JsonModel($result);
        }
        
        return new ViewModel(array(
            'projectId' => $projectId
        )
        );
    }
}