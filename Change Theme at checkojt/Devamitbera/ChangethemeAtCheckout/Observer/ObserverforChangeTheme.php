<?php
namespace Devamitbera\ChangethemeAtCheckout\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ObjectManager;

class ObserverforChangeTheme implements ObserverInterface
{
     /**
     * Design package instance
     *
     * @var \Magento\Framework\View\DesignInterface
     */
    protected $_design;
    /**
     * Store manager
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;
	protected $request;
	protected $logger;
    public function __construct(
        \Magento\Framework\View\DesignInterface $design,
		\Magento\Store\Model\StoreManagerInterface $storeManager,	
		\Magento\Framework\App\Request\Http $request,
		\Psr\Log\LoggerInterface $logger
	) {
        $this->_design = $design;
        $this->_storeManager = $storeManager;
		 $this->request = $request;
		  $this->logger = $logger;
		}

    /**
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
		$controller = $observer->getControllerAction();
		//$this->logger->info($this->request->getFullActionName());
		if($this->request->getFullActionName() =='checkout_index_index'){
			$this->_design->setDesignTheme(1); // Theme id
		}
	}

}
