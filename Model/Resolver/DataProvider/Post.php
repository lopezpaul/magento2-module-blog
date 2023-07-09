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

namespace Lopezpaul\Blog\Model\Resolver\DataProvider;

use Lopezpaul\Blog\Api\Data\PostInterface;
use Lopezpaul\Blog\Api\PostRepositoryInterface;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Psr\Log\LoggerInterface;

class Post
{
    /**
     * @param PostRepositoryInterface $postRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        private PostRepositoryInterface $postRepository,
        private readonly LoggerInterface $logger
    ) {
    }

    /**
     * Retrieve Posts
     *
     * @return array|void
     */
    public function getAllPosts()
    {
        try {
            $posts = $this->postRepository->getAll();
            $postData = [];
            foreach ($posts as $post) {
                $postData[] = $this->formatPostData($post);
            }
            return $postData;
        } catch (GraphQlNoSuchEntityException $e) {
            $this->logger->error($e->getMessage());
        }
    }

    /**
     * Get only post data
     *
     * @param PostInterface $post
     * @return array
     */
    private function formatPostData(PostInterface $post)
    {
        return [
            PostInterface::ID ?? 'id' => (int)$post->getId(),
            PostInterface::TITLE ?? 'title' => $post->getTitle(),
            PostInterface::CONTENT ?? 'content' => $post->getContent(),
            PostInterface::IS_DRAFT ?? 'is_draft' => (bool)$post->getIsDraft(),
            PostInterface::CREATED_AT ?? 'created_at' => $post->getCreatedAt(),
            PostInterface::UPDATED_AT ?? 'updated_at' => $post->getUpdatedAt(),
            PostInterface::PUBLISH_AT ?? 'publish_at' => $post->getPublishAt(),
        ];
    }
}
