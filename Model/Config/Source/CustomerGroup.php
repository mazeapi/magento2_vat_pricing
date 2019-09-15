<?php

namespace Mazeapi\VatPrice\Model\Config\Source;

class CustomerGroup
{
    protected $_customerGroup;

    public function __construct(
        \Magento\Customer\Model\ResourceModel\Group\Collection $customerGroup
    )
    {
        $this->_customerGroup = $customerGroup;
    }

    public function toOptionArray()
    {
        $customerGroups = $this->_customerGroup->toOptionArray();
        return $customerGroups;
    }
}