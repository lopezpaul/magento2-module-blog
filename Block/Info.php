<?php

declare(strict_types=1);

/**
 * Copyright © 2023 LopezPaul. All rights reserved.
 *
 * @package  Lopezpaul_Blog
 * @author   Paul Lopez <paul.lopezm@gmail.com>
 * @license  See LICENSE.txt for license details.
 * @link     https://github.com/lopezpaul/magento2-modules
 */

namespace Lopezpaul\Blog\Block;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class Info extends Field
{
    /**
     * Add message on top of Data Grid
     *
     * @param AbstractElement $element
     * @return string
     */
    public function render(AbstractElement $element)
    {
        $linkText = __("LopezPaul Magento modules")->getText();
        return '<a href="https://github.com/lopezpaul/magento2-modules"
                target="_blank" title="Github">' . $linkText . '</a>';
    }
}
