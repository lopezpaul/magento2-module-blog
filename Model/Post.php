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
use Lopezpaul\Blog\Model\ResourceModel\Post as PostResourceModel;
use Magento\Framework\Api\AttributeValueFactory;
use Magento\Framework\Api\ExtensionAttributesFactory;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractExtensibleModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use Magento\Store\Model\StoreManagerInterface;

class Post extends AbstractExtensibleModel implements PostInterface, IdentityInterface
{
    /** @var string */
    public const CACHE_KEY = 'lopezpaul_blog_post';
    /** @var StoreManagerInterface */
    public StoreManagerInterface $storeManager;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param ExtensionAttributesFactory $extensionFactory
     * @param AttributeValueFactory $customAttributeFactory
     * @param StoreManagerInterface $storeManager
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource|null $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        ExtensionAttributesFactory $extensionFactory,
        AttributeValueFactory $customAttributeFactory,
        StoreManagerInterface $storeManager,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        $this->storeManager = $storeManager;
        $this->_eventPrefix = self::CACHE_KEY;
        $this->_cacheTag = self::CACHE_KEY;
        parent::__construct(
            $context,
            $registry,
            $extensionFactory,
            $customAttributeFactory,
            $resource,
            $resourceCollection
        );
    }

    /**
     * @inheritdoc
     */
    public function getIdentities()
    {
        return [$this->_cacheTag . '_' . $this->getId()];
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * @inheritdoc
     */
    public function setId(
        mixed $id
    ) {
        return $this->setData(self::ID, $id);
    }

    /**
     * @inheritdoc
     */
    public function setTitle(
        string $title
    ) {
        return $this->setData(self::TITLE, trim($title));
    }

    /**
     * @inheritdoc
     */
    public function getTitle(): string
    {
        return $this->getData(self::TITLE) ?? '';
    }

    /**
     * @inheritdoc
     */
    public function setContent(
        $content
    ) {
        return $this->setData(self::CONTENT, trim($content));
    }

    /**
     * @inheritdoc
     */
    public function getContent(): string
    {
        return $this->getData(self::CONTENT) ?? '';
    }

    /**
     * @inheritdoc
     */
    public function setCreatedAt(
        $createdAt
    ) {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * @inheritdoc
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @inheritdoc
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * @inheritdoc
     */
    public function setUpdatedAt(
        $updatedAt
    ) {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }

    /**
     * @inheritdoc
     */
    public function getPublishAt()
    {
        return $this->getData(self::PUBLISH_AT);
    }

    /**
     * @inheritdoc
     */
    public function setPublishAt(
        string $date
    ) {
        return $this->setData(self::PUBLISH_AT, $date);
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(PostResourceModel::class);
    }
}
