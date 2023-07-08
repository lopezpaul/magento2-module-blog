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
 * Class SaveAndContinueButton Generate button to save information
 * and reload the page to keep editing the same record
 */
class SaveAndContinueButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * Save and continue button details
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save and Continue Edit'),
            'class' => 'save',
            'data_attribute' => [
                'mage-init' => [
                    'button' => ['event' => 'saveAndContinueEdit'],
                ],
            ],
            'sort_order' => 80,
        ];
    }
}
