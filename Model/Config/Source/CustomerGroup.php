<?php
/**
 * Mazeapi Software.
 *
 * @author    Mazeapi
 * @author    Iftakharul Alam <bappa2du@gmail.com>
 * @license   https://mazeapi.com/license.html
 */

namespace Mazeapi\VatPrice\Model\Config\Source;

use Magento\Customer\Model\ResourceModel\Group\Collection;

class CustomerGroup
{
    /**
     * @var Collection
     */
    protected $_customerGroup;

    /**
     * CustomerGroup constructor.
     * @param Collection $customerGroup
     */
    public function __construct(
        Collection $customerGroup
    )
    {
        $this->_customerGroup = $customerGroup;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $customerGroups = $this->_customerGroup->toOptionArray();
        return $customerGroups;
    }
}