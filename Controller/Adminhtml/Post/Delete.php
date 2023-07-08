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
use Lopezpaul\Blog\Api\PostRepositoryInterfaceFactory;
use Psr\Log\LoggerInterface as Logger;

class Delete extends Action
{
    public const ADMIN_RESOURCE = 'Lopezpaul_Blog::delete';
    /**
     * @param Action\Context $context
     * @param PostRepositoryInterfaceFactory $postRepositoryFactory
     * @param Logger $logger
     */
    public function __construct(
        private Action\Context $context,
        private PostRepositoryInterfaceFactory $postRepositoryFactory,
        private Logger $logger
    ) {
        parent::__construct($context);
    }

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $postId = (int)$this->getRequest()->getParam('id');
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($postId) {
            $postRepository = $this->postRepositoryFactory->create();
            try {
                $message = __('The Post has been deleted.');
                $postRepository->deleteById($postId);
                $this->messageManager->addSuccessMessage($message);
            } catch (\Exception $e) {
                $this->logger->error($e->getMessage());
                $this->messageManager->addErrorMessage($e->getMessage());
            }
        }
        return $resultRedirect->setPath('lopezpaul_blog/post/index');
    }
}
