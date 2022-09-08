<?php

namespace Dev\Catalog\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\ResultInterface;

    const ADMIN_RESOURCE = 'Dev_Catalog::save';

/**
 * Save CMS page action.
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Save extends Action implements HttpPostActionInterface
{

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

            if (empty($data['id'])) {
                $data['id'] = null;
            }else{
                $data['updated_at'] = date('Y-m-d H:i:s');
            }

            $model = $this->_objectManager->create('Dev\Catalog\Model\Expert');

            $model->setData($data);

            try {

                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the expert.'));

            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Something went wrong while saving the expert.'));
            }

        }
        return $resultRedirect->setPath('*/*/');
    }
}
