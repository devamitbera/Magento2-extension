````
<?php
if (PHP_SAPI !== 'cli') {
    echo 'Script must be run as a CLI application';
    exit(1);
}
try {
    require __DIR__ . '/../app/bootstrap.php';
} catch (\Exception $e) {
    echo 'Autoload error: ' . $e->getMessage();
    exit(1);
}


    $params = $_SERVER;
    $bootstrap = \Magento\Framework\App\Bootstrap::create(BP, $params);
    $objectManager = $bootstrap->getObjectManager();
    $state = $objectManager->get(\Magento\Framework\App\State::class);
    $state->setAreaCode('adminhtml');
    $objectManager->get('Magento\Store\Model\StoreManagerInterface')->setCurrentStore('admin');
    $storeRepository = $objectManager->get(Magento\Store\Api\StoreRepositoryInterface::class);
    $sku = 'Test-Lucid';
    $storeId = 2;
    //Product load is exits
    try {
        $productObject = $objectManager->create(\Magento\Catalog\Api\ProductRepositoryInterface::class)->get(
            $sku,
            true,
            $storeId
        );
    } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
        $productObject = $objectManager->create(\Magento\Catalog\Api\Data\ProductInterface::class);
    }
    echo 'Onload';
    echo '<pre>';
    print_r($productObject->debug());
    echo PHP_EOL;

    $dataObjectHelper = $objectManager->create(\Magento\Framework\Api\DataObjectHelper::class);
    $requestData = [
      //'sku' => 'ABC'  ,
        'name' => 'My Name is Balta'
    ];
    $dataObjectHelper->populateWithArray(
        $productObject,
        $requestData,
        \Magento\Catalog\Api\Data\ProductInterface::class
    );
    echo '<pre>';
    print_r($productObject->debug());

$objectManager->create(\Magento\Catalog\Api\ProductRepositoryInterface::class)->save($productObject);
````
