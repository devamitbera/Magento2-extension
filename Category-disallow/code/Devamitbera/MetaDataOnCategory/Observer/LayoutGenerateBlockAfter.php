<?php
namespace Devamitbera\MetaDataOnCategory\Observer;

use Magento\Catalog\Model\Layer;
use Magento\Catalog\Model\Layer\Resolver;
use Magento\Framework\Event\Observer;
use Magento\Framework\View\Page\Config;
use Magento\Framework\Event\ObserverInterface;

class LayoutGenerateBlockAfter implements ObserverInterface
{
    /**
     * @var Config
     */
    private $pageConfig;
    /**
     * @var Layer
     */
    private $layerResolver;

    /**
     * @param Config $pageConfig
     * @param Resolver $layerResolver
     */
    public function __construct(
        Config $pageConfig,
        Resolver $layerResolver
    ) {
        $this->pageConfig = $pageConfig;
        $this->layerResolver = $layerResolver->get();
    }
    /**
     * @inheritDoc
     */
    public function execute(Observer $observer)
    {

        $fullActionName = $observer->getFullActionName();
        if ($fullActionName !== "catalog_category_view"){
            return;
        }
        $filters = $this->layerResolver->getState()->getFilters();
        if (!is_array($filters)){
            $filters = [];
        }
        if (!empty($filters)){
            $this->pageConfig->setRobots('NOINDEX,NOFOLLOW');
        }
    }
}
