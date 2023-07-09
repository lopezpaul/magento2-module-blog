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

namespace Lopezpaul\Blog\Model;

use Lopezpaul\Blog\Api\Data\PostInterface;
use Lopezpaul\Blog\Api\Data\PostInterfaceFactory;
use Lopezpaul\Blog\Api\PostRepositoryInterface;
use Lopezpaul\Blog\Model\ResourceModel\Post as ResourcePost;
use Lopezpaul\Blog\Model\ResourceModel\Post\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Stdlib\DateTime\DateTime;

class PostRepository implements PostRepositoryInterface
{
    private const LOADED_POSTS_KEY = 'lopezpaul_blog_posts_loaded';

    /** @var array */
    protected array $loadedPost = [];

    /**
     * @param PostInterfaceFactory $postFactory
     * @param ResourcePost $resourcePost
     * @param CollectionFactory $postCollection
     * @param DateTime $datetime
     * @param DataPersistorInterface $persistor
     */
    public function __construct(
        private PostInterfaceFactory $postFactory,
        private ResourcePost $resourcePost,
        private CollectionFactory $postCollection,
        private DateTime $datetime,
        private DataPersistorInterface $persistor
    ) {
        $records = $this->persistor->get(self::LOADED_POSTS_KEY);
        if (!empty($records)) {
            $this->loadedPost = $records;
        }
    }

    /**
     * Delete by id
     *
     * @param int $id
     * @return bool
     * @throws CouldNotDeleteException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function deleteById(int $id): bool
    {
        return $this->delete($this->get($id));
    }

    /**
     * Delete Post
     *
     * @param PostInterface $post
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(PostInterface $post): bool
    {
        try {
            $this->resourcePost->delete($post);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * Get Post by id
     *
     * @param mixed $id
     * @return PostInterface
     */
    public function get(mixed $id): PostInterface
    {
        $post = $this->postFactory->create();
        if (!empty($id)) {
            if (isset($this->loadedPost[$id])) {
                return $this->loadedPost[$id];
            }
            $modelPost = $post->load($id);
            $this->setLoadedpostRecords([$modelPost],true);
            return $this->loadedPost[$id] ?? $post;
        }
        return $post;
    }

    /**
     * Set loaded post
     *
     * @param array $postRecords
     * @param bool $merge
     * @return void
     */
    protected function setLoadedpostRecords(array $postRecords = [], bool $merge = false): void
    {
        $loadedPost = [];
        foreach ($postRecords as $postRecord) {
            $loadedPost[$postRecord?->getId()] = $postRecord;
        }
        if ($merge && is_array($this->loadedPost)) {
            $this->loadedPost = array_merge($this->loadedPost, $loadedPost);
        } else {
            $this->loadedPost = $loadedPost;
        }
    }

    /**
     * Retrieve all Post from database
     *
     * @param bool $forceReload
     * @return array
     */
    public function getAll(bool $forceReload = false): array
    {
        if (empty($this->loadedPost) || $forceReload) {
            $postRecords = $this->postCollection->create()->load();
            $tmp = [];
            foreach ($postRecords as $postRecord) {
                $tmp[$postRecord?->getId()] = $postRecord;
            }
            $this->setLoadedpostRecords($tmp);
        }
        return $this->loadedPost;
    }

    /**
     * Create Post
     *
     * @param mixed $postData
     * @return PostInterface|null
     * @throws CouldNotSaveException
     */
    public function createPost(mixed $postData): ?PostInterface
    {
        if ($postData instanceof PostInterface) {
            $postData = $postData->getData();
        }
        if (!is_array($postData) || !$this->validateStructure($postData)) {
            return null;
        }

        $postRecord = $this->createPostInterface();
        $postRecord->setTitle($postData[PostInterface::TITLE]);
        $postRecord->setContent($postData[PostInterface::CONTENT]);
        $postRecord->setIsDraft($postData[PostInterface::IS_DRAFT] ?? true);
        $postRecord->setPublishAt($postData[PostInterface::PUBLISH_AT] ?? $this->datetime->gmtDate());
        $postRecord = $this->save($postRecord);
        $this->loadedPost[$postRecord->getId()] = $postRecord;

        return $postRecord;
    }

    /**
     * If Post has all mandatory fields
     *
     * @param array $postData
     * @return bool
     */
    protected function validateStructure(array $postData): bool
    {
        if (!isset($postData[PostInterface::TITLE])) {
            return false;
        }
        if (!isset($postData[PostInterface::CONTENT])) {
            return false;
        }
        return true;
    }

    /**
     * Create Post Interface
     *
     * @return PostInterface|null
     */
    public function createPostInterface(): ?PostInterface
    {
        return $this->postFactory->create();
    }

    /**
     * Save Post
     *
     * @param PostInterface $post
     * @param bool $saveOptions
     * @return PostInterface|null
     * @throws CouldNotSaveException
     */
    public function save(PostInterface $post, bool $saveOptions = false): ?PostInterface
    {
        try {
            $this->resourcePost->save($post);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $post;
    }

    /**
     * Load the list of post in persistent data
     *
     * @param array $posts
     * @param bool $merge
     */
    protected function setLoadedPosts(array $posts = [], bool $merge = false): void
    {
        $loadedPosts = [];
        foreach ($posts as $post) {
            $loadedPosts[$post->getId()] = $post;
        }
        if ($merge && is_array($this->loadedPost)) {
            $this->loadedPost = array_merge($this->loadedPost, $loadedPosts);
        } else {
            $this->loadedPost = $loadedPosts;
        }
        $this->persistor->clear(self::LOADED_POSTS_KEY);
        $this->persistor->set(self::LOADED_POSTS_KEY, $this->loadedPost);
    }
}
