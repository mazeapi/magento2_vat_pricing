<?php
/**
 * Mazeapi Software.
 *
 * @author    Mazeapi
 * @author    Iftakharul Alam <bappa2du@gmail.com>
 * @license   https://mazeapi.com/license.html
 */

namespace Mazeapi\VatPrice\Model\Config\Source;

class ProductPriceType
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'included', 'label' => __('Included VAT')], ['value' => 'excluded', 'label' => __('Excluded VAT')]
        ];
    }
}