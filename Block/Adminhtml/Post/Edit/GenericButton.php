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

namespace Lopezpaul\Blog\Block\Adminhtml\Post\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\UrlInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Lopezpaul\Blog\Api\Data\PostInterface;

/**
 * Class GenericButton It's used for another classes as parent class
 */
class GenericButton
{
    /** @var \Magento\Framework\UrlInterface */
    private UrlInterface $urlBuilder;

    /**
     * Constructor
     *
     * @param Context $context
     * @param DataPersistorInterface $persistor
     */
    public function __construct(
        Context $context,
        private DataPersistorInterface $persistor
    ) {
        $this->urlBuilder = $context->getUrlBuilder();
    }

    /**
     * Return the ID of the Post model.
     *
     * @return mixed
     */
    public function getId(): mixed
    {
        $model = $this->persistor->get(PostInterface::PERSISTENT_DATA_KEY);
        return $model?->getId();
    }

    /**
     * Generate url by route and parameters
     *
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl(string $route = '', array $params = [])
    {
        return $this->urlBuilder->getUrl($route, $params);
    }
}
