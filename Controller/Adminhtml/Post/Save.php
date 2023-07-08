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
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Stdlib\DateTime\DateTime;

class Save extends Action
{
    public const ADMIN_RESOURCE = 'Lopezpaul_Blog::update';
    /**
     * @param Context $context
     * @param PostRepositoryInterface $postRepository
     * @param DateTime $datetime
     */
    public function __construct(
        Context $context,
        private PostRepositoryInterface $postRepository,
        private readonly DateTime $datetime
    ) {
        parent::__construct($context);
    }

    /**
     * Save Post
     *
     * @return Redirect|ResponseInterface|ResultInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            try {
                $id = $this->getRequest()->getParam('id');
                if (empty($id)) {
                    $data['id'] = null;
                }
                if (empty(trim($data['title']))) {
                    throw new LocalizedException(__('Please enter the title.'));
                }
                if (empty(trim($data['content']))) {
                    throw new LocalizedException(__('Please enter content for your post.'));
                }
                if (empty($data['publish_at'])) {
                    $data['publish_at'] = $this->datetime->gmtDate();
                }
                $model = $this->postRepository->get($id);
                $model->setData($data);
                $this->postRepository->save($model);
                $this->messageManager->addSuccess(__('You saved the Post.'));
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('lopezpaul_blog/post/edit', ['id' => $model->getId()]);
                }
                return $resultRedirect->setPath('lopezpaul_blog/post/index');
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the Post.'));
            }

            $pathParams = ['id' => $this->getRequest()->getParam('id')];
            return $resultRedirect->setPath('lopezpaul_blog/post/edit', $pathParams);
        }
        return $resultRedirect->setPath('lopezpaul_blog/post/index');
    }
}
