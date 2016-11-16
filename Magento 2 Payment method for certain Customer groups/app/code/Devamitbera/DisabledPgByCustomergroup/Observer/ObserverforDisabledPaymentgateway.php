<?php
namespace Devamitbera\DisabledPgByCustomergroup\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ObjectManager;

class ObserverforDisabledPaymentgateway implements ObserverInterface
{
	public function __construct() {}

	/**
	 *
	 * @param \Magento\Framework\Event\Observer $observer
	 * @return void
	 */
	public function execute(\Magento\Framework\Event\Observer $observer)
	{
	  $result = $observer->getEvent()->getResult();
	  $method_instance = $observer->getEvent()->getMethodInstance();
	  $quote = $observer->getEvent()->getQuote();
	  /* If Cusomer  group is match then work */
	  if(null !== $quote &&  $quote->getCustomerGroupId() =='YOUR_CUSTOMER_GROUP_ID'  ){
		  /* Disable All payment gateway  exclude Your payment Gateway*/
		  if($method_instance->getCode() !='YOUR_PAYMENT_METHOD_CODE'){
			   $result->isAvailable = false;
		  }
	  }

	}

}

