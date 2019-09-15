<?php

namespace Mazeapi\VatPrice\Block\Catalog\Product\View;

use Magento\Catalog\Model\Product;

class VatPrice extends \Magento\Framework\View\Element\Template
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @var \Mazeapi\VatPrice\Helper\Data
     */
    protected $_vatHelper;

    /**
     * @var \Magento\Framework\Pricing\Helper\Data
     */
    protected $_priceHelper;

    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $_customerSession;

    /**
     * VatPrice constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     * @param \Mazeapi\VatPrice\Helper\Data $vatHelper
     * @param \Magento\Framework\Pricing\Helper\Data $priceHelper
     * @param \Magento\Customer\Model\Session $customerSession
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = [],
        \Mazeapi\VatPrice\Helper\Data $vatHelper,
        \Magento\Framework\Pricing\Helper\Data $priceHelper,
        \Magento\Customer\Model\Session $customerSession
    )
    {
        $this->_coreRegistry = $registry;
        $this->_vatHelper = $vatHelper;
        $this->_priceHelper = $priceHelper;
        $this->_customerSession = $customerSession;
        parent::__construct($context, $data);
    }

    public function getIncludeText()
    {
        return '<span class="vat-info-text">' . __('(Incl. Moms)') . '</span>';
    }

    public function getExcludeText()
    {
        return '<span class="vat-info-text">' . __('(Excl. Moms)') . '</span>';
    }

    /**
     * @return  array|float
     */
    public function getProductPrice()
    {
        /** @var Product $product */
        $product = $this->_coreRegistry->registry('product');
        return $product->getFinalPrice();
    }

    public function getVatAmount()
    {
        return $this->_vatHelper->getVatAmount();
    }

    public function getProductFinalPrice()
    {
        if ($this->_customerSession->isLoggedIn()) {
            $customerGroupId = $this->_customerSession->getCustomerGroupId();
            if (in_array($customerGroupId, explode(',',$this->_vatHelper->getCustomerGroup()))) {
                $price = $this->getProductPrice() + $this->getVatAmount();
            } else {
                $price = $this->getProductPrice();
            }
        } else {
            $price = $this->getProductPrice();
        }
        return $price;
    }

    public function getProductFormattedPrice()
    {
        if ($this->_customerSession->isLoggedIn()) {
            $customerGroupId = $this->_customerSession->getCustomerGroupId();
            if (in_array($customerGroupId, explode(',',$this->_vatHelper->getCustomerGroup()))) {
                $price = $this->getProductPrice() + $this->getVatAmount();
                $price = $this->_priceHelper->currency($price, true, false);
                return $price.$this->getIncludeText();
            } else {
                $price = $this->getProductPrice();
                $price = $this->_priceHelper->currency($price, true, false);
            }
        } else {
            $price = $this->getProductPrice();
            $price = $this->_priceHelper->currency($price, true, false);
        }
        return $price.$this->getExcludeText();
    }

    public function getPriceIncludeVat()
    {
        return ($this->getProductFormattedPrice()) . ' <span class="vat-info-text">' . __('(Incl. Moms)') . '</span>';
    }
}