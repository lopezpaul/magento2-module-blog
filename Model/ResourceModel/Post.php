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

namespace Lopezpaul\Blog\Model\ResourceModel;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Framework\Stdlib\DateTime\DateTime;

/**
 * Post Records mysql resource
 */
class Post extends AbstractDb
{
    /**
     * Constructor
     *
     * @param Context $context
     * @param DateTime $datetime
     * @param string|null $resourcePrefix
     */
    public function __construct(
        Context $context,
        private DateTime $datetime,
        string $resourcePrefix = null
    ) {
        parent::__construct($context, $resourcePrefix);
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('lopezpaul_blog_post', 'id');
    }

    /**
     * Process post data before saving
     *
     * @param AbstractModel $object
     * @return Post
     */
    protected function _beforeSave(AbstractModel $object)
    {
        $storeTime = $this->datetime->gmtDate();
        if ($object->isObjectNew() && !$object->hasCreatedAt()) {
            $object->setCreatedAt($storeTime);
        }
        $object->setUpdatedAt($storeTime);
        return parent::_beforeSave($object);
    }
}
