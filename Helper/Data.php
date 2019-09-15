<?php

/**
 * Mazeapi Software.
 *
 * @package   Mazeapi_ForceLogin
 * @author    Mazeapi
 * @author    Iftakharul Alam <bappa2du@gmail.com>
 * @license   https://mazeapi.com/license.html
 */

namespace Mazeapi\VatPrice\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

    protected $_adminSettings;

    /**
     * Data constructor.
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context
    )
    {
        parent::__construct($context);
        $this->_adminSettings = $this->scopeConfig->getValue('mazeapi_core_settings', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return string
     */
    public function isVatPricingEnable()
    {
        return trim($this->_adminSettings['product_vat_pricing']['enable']);
    }

    /**
     * @return string
     */
    public function getVatAmount()
    {
        return trim($this->_adminSettings['product_vat_pricing']['vat_amount']);
    }

    public function getCustomerGroup()
    {
        return $this->_adminSettings['product_vat_pricing']['customer_group'];
    }
}