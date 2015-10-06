<?php
namespace Application\Listener;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

/**
 * Hook email events
 * 
 * @author Siwei Mu <Siwei@newtonsnerds.com>
 */
class EmailEventListener implements ListenerAggregateInterface, ServiceLocatorAwareInterface
{

    use ServiceLocatorAwareTrait;
    /**
     * @var \Zend\Stdlib\CallbackHandler[]
     */
    protected $listeners = array();
    
    private $adminEmail = 'admin@monoland.com';

    /**
     * {@inheritDoc}
     */
    public function attach( EventManagerInterface $events )
    {
        $sharedEvents = $events->getSharedManager();
        
        // Instant actions listener
        $this->listeners[] = $sharedEvents->attach( 'Client\Controller\QuoteController',
            'newRequestForQuote', array( $this, 'onNewRequestForQuote' ) );
        
        $this->listeners[] = $sharedEvents->attach( 'Client\Controller\QuoteController', 
            'quoteAccepted', array( $this, 'onQuoteAccepted' ) );
        
        $this->listeners[] = $sharedEvents->attach( 'Admin\Controller\OrderController',
            'quoteSent', array( $this, 'onQuoteSent' ) );
        
        $this->listeners[] = $sharedEvents->attach( 'Admin\Controller\OrderController',
            'dueDateCheck', array( $this, 'onDueDateCheck' ) );
    }

    public function detach( EventManagerInterface $events )
    {
        foreach( $this->listeners as $index => $listener ) {
            if( $events->detach( $listener ) ) {
                unset( $this->listeners[$index] );
            }
        }
    }
    
    public function onNewRequestForQuote( $e ){
        $params = $e->getParams();
        
        $serviceLocator = $params['serviceLocator'];
        $this->setServiceLocator($serviceLocator);
        
        $order = $params['order'];
        
        $this->_sendEmail(
            'New quote request received', 'email/template/newRequestForQuote',
            $params = array( 'order' => $order ), $recipient = $this->adminEmail);
    }
    
    public function onQuoteAccepted( $e ){
        $params = $e->getParams();
    
        $serviceLocator = $params['serviceLocator'];
        $this->setServiceLocator($serviceLocator);
    
        $order = $params['order'];
    
        $this->_sendEmail(
            'Quote Accepted', 'email/template/quoteAccepted',
            $params = array( 'order' => $order ), $recipient = $this->adminEmail);
    }
    
    public function onQuoteSent( $e ){
        $params = $e->getParams();
    
        $serviceLocator = $params['serviceLocator'];
        $this->setServiceLocator($serviceLocator);
    
        $order = $params['order'];
    
        $this->_sendEmail(
            'You have received a quote from Monoland!', 'email/template/quoteSent',
            $params = array( 'order' => $order ), $recipient = $order->getCustomer()->getEmail());
    }
    
    public function onDueDateCheck( $e ){
        $params = $e->getParams();
    
        $serviceLocator = $params['serviceLocator'];
        $this->setServiceLocator($serviceLocator);
    
        $oldDueDate = $params['oldDueDate'];
        $order = $params['order'];
        
        if($oldDueDate !== $order->getDueDate()){
            $this->_sendEmail(
                'The due date has been changed on your order', 'email/template/dueDateChanged',
                $params = array( 'oldDueDate' => $oldDueDate, 'order' => $order ), $recipient = $order->getCustomer()->getEmail());
        }
    }
    
    /**
     * Send email
     * You could customize your email from here
     *
     * @access protected
     * @param string $subject
     * @param string $template
     * @param array $params
     * @param string $recipient
     */
    protected function _sendEmail($subject, $template, $params, $recipient){
        // set content
        $mailService = $this->getServiceLocator()->get('AcMailer\Service\MailService');
        $mailService->setSubject($subject)->setTemplate($template, $params);
    
        // set recipient
        $message = $mailService->getMessage();
        $message->addTo($recipient);
    
        // send
        $result = $mailService->send();
    }
}