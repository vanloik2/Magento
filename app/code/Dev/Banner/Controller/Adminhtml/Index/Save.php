<?php

namespace Dev\Banner\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\ResultInterface;

/**
 * Save CMS page action.
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Save extends Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Dev_Banner::save';

    /**
     * @var PostDataProcessor
     */
    protected $dataProcessor;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;


    /**
     * @param Action\Context $context
     * @param PostDataProcessor $dataProcessor
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(
        Action\Context $context,
        PostDataProcessor $dataProcessor,
        DataPersistorInterface $dataPersistor
    ) {
        $this->dataProcessor = $dataProcessor;
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data) {

            if (empty($data['banner_id'])) {
                $data['banner_id'] = null;
            }
            if (empty($data['images'])) {
                $data['images'] = null;
            }else{
                if(isset($data['images'][0]['name'])){
                    $data['image'] = $data['images'][0]['name'];
                }
            }

            // Lấy dl từ dynamic row ra -> json

            if(isset($data['dynamic_row'])){
               $data['size'] = json_encode($data['dynamic_row']);
            }

            // Lấy dl cho cột test_insert_listing dưới dạng json

            if(isset($data['insert_listing_example'])){
                $data['test_insert_listing'] = json_encode($data['insert_listing_example']);
            }

            $model = $this->_objectManager->create('Dev\Banner\Model\Banner');

            $model->setData($data);

            try {

                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the page.'));

            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Something went wrong while saving the page.'));
            }

        }
        return $resultRedirect->setPath('*/*/');
    }
}
