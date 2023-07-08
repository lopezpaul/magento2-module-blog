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

namespace Lopezpaul\Blog\Api\Data;

interface PostInterface
{
    public const ID = 'id';
    public const TITLE = 'title';
    public const CONTENT = 'content';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';
    public const PUBLISH_AT = 'publish_at';
    public const PERSISTENT_DATA_KEY = 'post_model_data';

    /**
     * Retrieve id field
     *
     * @return int|null
     */
    public function getId();

    /**
     * Store id
     *
     * @param int|mixed $id
     * @return $this
     */
    public function setId(mixed $id);

    /**
     * Retrieve title field
     *
     * @return string
     */
    public function getTitle();

    /**
     * Store title
     *
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title);

    /**
     * Retrieve content field
     *
     * @return string
     */
    public function getContent();

    /**
     * Store content
     *
     * @param string $content
     * @return $this
     */
    public function setContent(string $content);

    /**
     * Retrieve publish_at field
     *
     * @return string
     */
    public function getPublishAt();

    /**
     * Store publish_at
     *
     * @param string $date
     * @return $this
     */
    public function setPublishAt(string $date);
}
