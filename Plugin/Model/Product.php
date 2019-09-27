<?php

namespace Mazeapi\VatPrice\Plugin\Model;

use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Mazeapi\VatPrice\Helper\Data;

class Product
{
    protected $customerSession;
    protected $scopeConfig;
    protected $vatHelper;

    /**
     * Product constructor.
     * @param CustomerSession $customerSession
     * @param Data $vatHelper
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        CustomerSession $customerSession,
        Data $vatHelper,
        ScopeConfigInterface $scopeConfig
    )
    {
        $this->customerSession = $customerSession;
        $this->vatHelper = $vatHelper;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @param \Magento\Catalog\Model\Product $subject
     * @param $result
     * @return float
     */
    public function afterGetPrice(\Magento\Catalog\Model\Product $subject, $result)
    {
        $isModuleEnables = $this->vatHelper->isVatPricingEnable();
        if ($isModuleEnables) {

            $isAuthUser = $this->customerSession->isLoggedIn();
            $vatAmount = $this->vatHelper->getVatAmount();

            if ($isAuthUser) {
                if (in_array($this->customerSession->getCustomerGroupId(), $this->vatHelper->getCustomerGroup())) {
                    return $result;
                }
            } else {
                $vatAmount = $vatAmount??0;
                $addedPrice = (($result * $vatAmount) / 100);
                return ($result + $addedPrice);
            }
            return $result;
        }
        return $result;

    }

    /**
     * @param \Magento\Catalog\Model\Product $subject
     * @param $result
     * @return float
     */
    public function afterGetSpecialPrice(\Magento\Catalog\Model\Product $subject, $result)
    {
        $isModuleEnables = $this->vatHelper->isVatPricingEnable();
        if ($isModuleEnables && $result !== null) {
            $isAuthUser = $this->customerSession->isLoggedIn();
            $vatAmount = $this->vatHelper->getVatAmount();

            if ($isAuthUser) {
                if (in_array($this->customerSession->getCustomerGroupId(), $this->vatHelper->getCustomerGroup())) {
                    return $result;
                }
            } else {
                $vatAmount = $vatAmount??0;
                $addedPrice = (($result * $vatAmount) / 100);
                return ($result + $addedPrice);
            }
        }
        return $result;
    }
}