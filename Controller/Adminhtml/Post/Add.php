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

namespace Lopezpaul\Blog\Controller\Adminhtml\Post;

use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

class Add extends Action
{
    public const ADMIN_RESOURCE = 'Lopezpaul_Blog::add';
    /**
     * @param Context $context
     * @param ForwardFactory $resultForwardFactory
     */
    public function __construct(
        Context $context,
        private ForwardFactory $resultForwardFactory
    ) {
        parent::__construct($context);
    }

    /**
     * Redirect to edit
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        return $this->resultForwardFactory->create()->forward('edit');
    }
}
