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


namespace Lopezpaul\Blog\Block\Adminhtml\Post\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class SaveButton Generate button to save information in database
 */
class SaveButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * Save button details
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save Post'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 90,
        ];
    }
}
