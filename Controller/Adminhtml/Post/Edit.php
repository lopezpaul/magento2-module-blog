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

use Lopezpaul\Blog\Api\PostRepositoryInterface;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Edit extends \Magento\Backend\App\Action
{
    public const ADMIN_RESOURCE = 'Lopezpaul_Blog::edit';
    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(
        Context $context,
        private PageFactory $resultPageFactory,
        private PostRepositoryInterface $postRepository
    ) {
        parent::__construct($context);
    }

    /**
     * Edit
     *
     * @return Redirect|ResponseInterface|ResultInterface|Page
     * @throws NoSuchEntityException
     */
    public function execute()
    {
        $postId = (int)$this->getRequest()->getParam('id');
        $postModel = $this->postRepository->get($postId);
        if ($postId && (!$postModel->getId())) {
            $this->messageManager->addError(__('This Post no longer exists.'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('lopezpaul_blog/post/index');
        }
        $resultPage = $this->resultPageFactory->create();
        $title = $postId ? __('Edit Post') : __('New Post');
        $resultPage->addBreadcrumb($title, $title);
        $resultPage->getConfig()->getTitle()->prepend(
            $postModel->getId() ? $postModel->getTitle() : __('New Post')
        );
        return $resultPage;
    }
}
