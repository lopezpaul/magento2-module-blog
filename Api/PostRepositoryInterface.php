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

namespace Lopezpaul\Blog\Api;

use Lopezpaul\Blog\Api\Data\PostInterface;

/**
 * @api
 */
interface PostRepositoryInterface
{
    /**
     * Save Post
     *
     * @param PostInterface $post
     * @param bool $saveOptions
     * @return PostInterface|null
     */
    public function save(PostInterface $post, bool $saveOptions = false): ?PostInterface;

    /**
     * Retrieve Post by id
     *
     * @param mixed $id
     * @return PostInterface
     */
    public function get(mixed $id): PostInterface;

    /**
     * Retrieve all post
     *
     * @param bool $forceReload
     * @return array
     */
    public function getAll(bool $forceReload = false): array;

    /**
     * Delete post
     *
     * @param PostInterface $post
     * @return bool
     */
    public function delete(PostInterface $post): bool;

    /**
     * Remove post by id
     *
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id): bool;
}
