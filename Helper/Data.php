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
    const XML_PATH_ENABLE            = 'mazeapi_core_settings/product_vat_pricing/enable';
    const XML_PATH_VAT_AMOUNT         = 'mazeapi_core_settings/product_vat_pricing/vat_amount';
    const XML_PATH_CUSTOMER_GROUP     = 'mazeapi_core_settings/product_vat_pricing/customer_group';
    const XML_PATH_PRODUCT_PRICE_TYPE = 'mazeapi_core_settings/product_vat_pricing/product_price_type';

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
        return $this->scopeConfig->getValue(self::XML_PATH_ENABLE);
    }

    /**
     * @return mixed
     */
    public function getVatAmount()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_VAT_AMOUNT);
    }

    /**
     * @return array
     */
    public function getCustomerGroup()
    {
        $result = $this->scopeConfig->getValue(self::XML_PATH_CUSTOMER_GROUP);
        return explode(',', $result);
    }

    /**
     * @return mixed
     */
    public function getProductPriceType()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_PRODUCT_PRICE_TYPE);
    }

}