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

namespace Lopezpaul\Blog\Model\Resolver\Post;

use Lopezpaul\Blog\Api\Data\PostInterface;
use Magento\Framework\GraphQl\Query\Resolver\IdentityInterface;

class Identity implements IdentityInterface
{
    /**
     * Get d
     *
     * @param array $resolvedData
     * @return array|string[]
     */
    public function getIdentities(array $resolvedData): array
    {
        $ids = [];
        foreach ($resolvedData as $postData) {
            if (isset($postData['id'])) {
                $ids[] = PostInterface::PERSISTENT_DATA_KEY . '_' . $postData['id'];
            }
        }
        return $ids;
    }
}
