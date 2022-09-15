<?php

namespace Dev\Catalog\Block\Adminhtml\Grid\Helper\Form\Gallery;

use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Backend\Block\Media\Uploader;
use Magento\Framework\View\Element\AbstractBlock;
use Magento\Framework\App\Filesystem\DirectoryList;

class Content extends \Magento\Catalog\Block\Adminhtml\Product\Helper\Form\Gallery\Content
{


    protected function _prepareLayout()
    {
        $this->addChild('uploader', 'Magento\Backend\Block\Media\Uploader');

        $a = $this->getUploader()->getConfig()->setUrl(
            $this->_urlBuilder->addSessionParam()->getUrl('[vendor]/grid_gallery/upload')/* here set you upload Controller */
        )->setFileField(
            'image'
        )->setFilters(
            [
                'images' => [
                    'label' => __('Images (.gif, .jpg, .png)'),
                    'files' => ['*.gif', '*.jpg', '*.jpeg', '*.png'],
                ],
            ]
        );

    }

    public function getImageTypes(): string
    {
        return '[]';
    }

    public function getMediaAttributes(): string
    {
        return '[]';
    }

}
