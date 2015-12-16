<?php
namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use INerdsBase\Controller\BaseController;
use Application\Entity\CalendarWorkItem;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

/**
 * Calendar Work Item Controller
 *
 * @author Siwei Mu <Siwei@newtonsnerds.com>
 */
class CalendarWorkItemController extends BaseController
{
    
    public function indexAction(){
        
        if($this->_isXmlHttpRequestViaPost()){
            $em = $this->getEntityManager();
        
            $result = $em->getRepository('Application\Entity\CalendarWorkItem')->getAll();
        
            return new JsonModel($result);
        }
        
        return new ViewModel();
    }
    
    public function getAction(){
        
        $request = $this->getRequest();
        if ($this->_isXmlHttpRequestViaPost()) {
            $em = $this->getEntityManager();
            
            $id = $this->params()->fromRoute('calendarWorkItemId');
            $start = $this->params()->fromPost('start');
            $end = $this->params()->fromPost('end');
            
            if(empty($id)){
                $result = $em->getRepository('Application\Entity\CalendarWorkItem')->getAllForCurrentUser($start, $end, $this->getCurrentUser());
            } else {
                $result = $em->getRepository('Application\Entity\CalendarWorkItem')->getById($start, $end, $id);
            }
            
            return new JsonModel($result);
        }
    }

    public function addAction()
    {
        $request = $this->getRequest();
        if ($this->_isXmlHttpRequestViaPost()) {
            $em = $this->getEntityManager();
            $entity = new CalendarWorkItem();
            
            $start = new \DateTime();
            $start->setTimestamp(strtotime($this->params()->fromPost('start')));
            
            // Hydration
            $hydrator = new DoctrineHydrator($em);
            $hydrator->hydrate(array(
                'name' => $this->params()->fromPost('title'),
                'startAt' => $start,
                'user' => $this->getCurrentUser(),
                'calendar' => $this->getCurrentUser()->getCalendar()
            ), $entity);
            
            $em->persist($entity);
            $em->flush();
            
            return new JsonModel(array('id' => $entity->getId()));
        }
    }
    
    public function updateAction()
    {
        $request = $this->getRequest();
        if ($this->_isXmlHttpRequestViaPost()) {
            
            $em = $this->getEntityManager();
            $id = $this->params()->fromPost('eventid');
            $entity = $em->getReference('Application\Entity\CalendarWorkItem', $id);

            $result = $em->getRepository('Application\Entity\CalendarWorkItem')->updateById($this->params()->fromPost());
            
            return new JsonModel(array($result));
        }
    }

    public function deleteAction()
    {
        $request = $this->getRequest();
        if ($this->_isXmlHttpRequestViaPost()) {
            
            $em = $this->getEntityManager();
            $id = $this->params()->fromPost('eventid');
            $entity = $em->getReference('Application\Entity\CalendarWorkItem', $id);
            
            $em->remove($entity);
            $em->flush();
            
            return new JsonModel();
        }
    }
}