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
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;
use Lopezpaul\Blog\Api\PostRepositoryInterfaceFactory;
use Lopezpaul\Blog\Model\ResourceModel\Post\CollectionFactory;

/**
 * Class MassDelete Actions executed when run massive delete
 */
class MassDelete extends Action
{
    public const ADMIN_RESOURCE = 'Lopezpaul_Blog::delete';
    /** @var Filter */
    private Filter $filter;

    /** @var CollectionFactory */
    private CollectionFactory $collectionFactory;

    /** @var PostRepositoryInterfaceFactory */
    private PostRepositoryInterfaceFactory $postRepositoryFactory;

    /**
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param PostRepositoryInterfaceFactory $postRepositoryFactory
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        PostRepositoryInterfaceFactory $postRepositoryFactory
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->postRepositoryFactory = $postRepositoryFactory;
        parent::__construct($context);
    }

    /**
     * Execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $collectionSize = $collection->getSize();
        $piRepository = $this->postRepositoryFactory->create();
        foreach ($collection as $piRecord) {
            $piRepository->deleteById((int)$piRecord->getId());
        }
        $this->messageManager->addSuccessMessage(
            __('A total of %1 record(s) have been deleted.', $collectionSize)
        );
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        return $resultRedirect->setPath('lopezpaul_blog/post/index');
    }
}
