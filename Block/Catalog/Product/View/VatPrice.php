<?php

namespace Mazeapi\VatPrice\Catalog\Product\View;

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
    protected $_data;

    /**
     * VatPrice constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     * @param Mazeapi\VatPrice\Helper\Data $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = [],
        \Mazeapi\VatPrice\Helper\Data $data
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
        $this->_data = $data;
    }

    /**
     * @return  array|float
     */
    public function getPrice()
    {
        /** @var Product $product */
        $product = $this->_coreRegistry->registry('product');
        return $product->getFormattedPrice();
    }

    public function getVatAmount()
    {
        return $this->_data->getVatAmount();
    }
}