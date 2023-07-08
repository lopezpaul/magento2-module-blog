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
    public function save(PostInterface $post, bool $saveOptions = false);

    /**
     * Retrieve Post by id
     *
     * @param mixed $id
     * @return mixed
     */
    public function get(mixed $id):mixed;

    /**
     * Retrieve all post
     *
     * @param bool $forceReload
     * @return mixed
     */
    public function getAll(bool $forceReload = false):mixed;

    /**
     * Delete post
     *
     * @param PostInterface $post
     * @return mixed
     */
    public function delete(PostInterface $post);

    /**
     * Remove post by id
     *
     * @param int $id
     * @return mixed
     */
    public function deleteById(int $id);
}
