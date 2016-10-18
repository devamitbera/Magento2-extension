<?php
namespace Devamitbera\DisabledFrontend\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ObjectManager;

class ObserverforDisabledFrontend implements ObserverInterface
{


    /**
     * @var \Magento\Framework\App\ActionFlag
     */
    protected $_actionFlag;

    /**
     * @var \Magento\Framework\Message\ManagerInterface
     */
    protected $messageManager;

    /**
     * @var \Magento\Framework\App\Response\RedirectInterface
     */
    protected $redirect;


    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @param \Magento\Captcha\Helper\Data $helper
     * @param \Magento\Framework\App\ActionFlag $actionFlag
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     * @param \Magento\Framework\App\Response\RedirectInterface $redirect
     * @param CaptchaStringResolver $captchaStringResolver
     */
    public function __construct(
        \Magento\Framework\App\ActionFlag $actionFlag,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Framework\App\Response\RedirectInterface $redirect
    ) {
        $this->_actionFlag = $actionFlag;
        $this->messageManager = $messageManager;
        $this->redirect = $redirect;
    }

    /**
     * Check CAPTCHA on Contact Us page
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
		/** @var \Magento\Framework\App\Action\Action $controller */
		$controller = $observer->getControllerAction();
		$this->_actionFlag->set('', \Magento\Framework\App\Action\Action::FLAG_NO_DISPATCH, true);
		/*$this->redirect->redirect($controller->getResponse(),
		 'https://www.google.co.in/?gfe_rd=cr&ei=OHoGWLzeIqnT8geDpr3wDQ');*/
		 
		 $this->redirect->redirect($controller->getResponse(),'admin');

    }

}
