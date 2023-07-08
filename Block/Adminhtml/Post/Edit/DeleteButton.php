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
 * Class DeleteButton Generates button with functionality to remove Post
 */
class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * Delete button details
     *
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        if ($this->getId()) {
            $data = [
                'label' => __('Delete Post'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\''
                    . __('Are you sure you want to delete this Post?')
                    . '\', \'' . $this->getDeleteUrl() . '\')',
                'sort_order' => 20,
            ];
        }
        return $data;
    }

    /**
     * URL for delete Post
     *
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('lopezpaul_blog/post/delete', ['id' => $this->getId()]);
    }
}
