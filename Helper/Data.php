<?php

/**
 * Mazeapi Software.
 *
 * @author    Mazeapi
 * @author    Iftakharul Alam <bappa2du@gmail.com>
 * @license   https://mazeapi.com/license.html
 */

namespace Mazeapi\VatPrice\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;

class Data extends AbstractHelper
{

    /**
     * Config paths
     */
    const XML_PATH_ENABLED        = 'mazeapi_core_settings/product_vat_pricing/enabled';
    const XML_PATH_VAT_AMOUNT     = 'mazeapi_core_settings/product_vat_pricing/vat_amount';
    const XML_PATH_CUSTOMER_GROUP = 'mazeapi_core_settings/product_vat_pricing/customer_group';

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * Data constructor.
     * @param Context $context
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig
    )
    {
        parent::__construct($context);
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return mixed
     */
    public function isVatPricingEnable()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_ENABLED);
    }

    /**
     * @return mixed
     */
    public function getVatAmount()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_VAT_AMOUNT);
    }

    /**
     * @return mixed
     */
    public function getCustomerGroup()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_CUSTOMER_GROUP);
    }
}