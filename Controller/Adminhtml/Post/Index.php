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

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    public const ADMIN_RESOURCE = 'Lopezpaul_Blog::posts';
    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     *
     */
    public function __construct(
        Context     $context,
        private readonly PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
    }

    /**
     * Index
     *
     * @return Page
     */
    public function execute()
    {
        /**
         * @var Page $resultPage
         */
        $resultPage = $this->resultPageFactory->create();
        $this->getMessageManager()->addNotice($this->getNoticeMessage());
        $resultPage->getConfig()->getTitle()->prepend(__('Blog'));
        return $resultPage;
    }

    /**
     * Get text to show on top of the Grid
     *
     * @return string
     */
    private function getNoticeMessage(): string
    {
        return __('Blog content management system by: Paul Lopez. ')->getText();
    }
}
