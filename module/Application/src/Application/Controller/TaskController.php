<?php
namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use INerdsBase\Controller\BaseController;

/**
 * TaskController
 *
 * @author Siwei Mu <Siwei@newtonsnerds.com>
 */
class TaskController extends BaseController
{
    
    public function indexAction(){
        $projectId = $this->params()->fromRoute('projectId');
        
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

    public function addAction()
    {
        $projectId = $this->params()->fromRoute('projectId');
        
        $em = $this->getEntityManager();
        
        $entity = new \Application\Entity\Task();
        
        $formProcessor = $this->_getFormProcessor();
        $form = $formProcessor->add($this->getRequest(), new \Application\Form\TaskAddForm($em), $entity);
        
        if($formProcessor->getIsValidForm()){
            $this->_showMessage('Task added successfully.');
            $this->_goTo("task/update", array("taskId" => $entity->getId()));
        }
        
        if($projectId){
            $form->getBaseFieldset()->get('project')->setValue($projectId);
        }
        
        return array(
            'projectId' => $projectId,
            'form' => $form,
        );
    }
    
    public function updateAction()
    {
        $em = $this->getEntityManager();
        $id = $this->params()->fromRoute('taskId');
        $entity = $em->find('Application\Entity\Task', $id);

        if(!$entity){
            $this->_showMessage('Task not found.');
            $this->_goTo('project/task', array('projectId' => $projectId));
        }
        
        // Remove schematic before updating it.
        if($this->getRequest()->isPost()){
            
            $em->persist($entity);
            $em->flush();
        }
        
        $formProcessor = $this->_getFormProcessor();
        $form = $formProcessor->update($this->getRequest(), new \Application\Form\TaskUpdateForm($em), $entity);
        
        if($formProcessor->isValidForm()){
            $this->_showMessage('Task has been updated successfully.');
            $this->_goTo('task/update', array('taskId' => $id));
        }
        
        return new ViewModel(array(
            'projectId' => $projectId,
            'taskId' => $id,
            'form' => $form
        ));
    }
    
    public function deleteAction()
    {
        return $this->_getFormProcessor()->quickDelete('Task');
    }
}