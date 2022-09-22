<?php
namespace Checkout\Donate\Plugin\Checkout\Model;
use Magento\Quote\Model\QuoteRepository;
use Magento\Framework\Exception\NoSuchEntityException;

class ShippingInformationManagement
{

    /**
     * @var QuoteRepository
     */
    private $quoteRepository;

    public function __construct(QuoteRepository $quoteRepository) {
        $this->quoteRepository = $quoteRepository;
    }

    /**
     * @throws NoSuchEntityException
     */
    public function beforeSaveAddressInformation(
        \Magento\Checkout\Model\ShippingInformationManagement $subject,
                                                              $cartId,
        \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
    ) {

        if(!$extAttributes = $addressInformation->getExtensionAttributes())
        {
            return;
        }

        $quote = $this->quoteRepository->getActive($cartId);
        // Add custom donate to table quote
        $vlDonate = $extAttributes->getCustomDonate();
        //Check value if $ctDonate < 0 -> $ctDonate = 0
        if ($vlDonate < 0|| !is_numeric($vlDonate)
        ) {
            $errorMessage =  __('Custom Donate is not valid.');
            throw new NoSuchEntityException(
                $errorMessage
            );
        } else{
            $quote->setCustomDonate($vlDonate);
        }
    }

}

