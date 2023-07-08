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

namespace Lopezpaul\Blog\Model\ResourceModel\Post;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Lopezpaul\Blog\Model\Post as PostModel;
use Lopezpaul\Blog\Model\ResourceModel\Post as PostResourceModel;

class Collection extends AbstractCollection
{
    /** @var string */
    protected $_idFieldName = 'id';

    /** @var string */
    protected $_eventPrefix = 'lopezpaul_blog_post_collection';

    /** @var string */
    protected $_eventObject = 'post_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(PostModel::class, PostResourceModel::class);
    }
}
