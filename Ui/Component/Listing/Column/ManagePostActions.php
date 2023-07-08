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


namespace Lopezpaul\Blog\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Lopezpaul\Blog\Api\PostRepositoryInterfaceFactory;

/**
 * Class ManagePiActions it's to add links to edit and remove records
 * in actions column from listing page
 */
class ManagePostActions extends Column
{
    /**
     * Edit shipping configuration route.
     */
    private const ROUTE_EDIT = 'lopezpaul_blog/post/edit';
    private const ROUTE_DELETE = 'lopezpaul_blog/post/delete';

    /** @var UrlInterface */
    protected UrlInterface $urlBuilder;

    /** @var PostRepositoryInterface */
    protected $postRepositoryFactory;

    /**
     * Constructor class
     *
     * @param ContextInterface $context Context
     * @param UiComponentFactory $uiComponentFactory UiComponentFactory
     * @param UrlInterface $urlBuilder urlBuilder
     * @param PostRepositoryInterfaceFactory $postRepositoryFactory PostRepositoryInterfaceFactory
     * @param array $components components
     * @param array $data data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        PostRepositoryInterfaceFactory $postRepositoryFactory,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->postRepositoryFactory = $postRepositoryFactory;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare items for dataSource
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                if (isset($item['id'])) {
                    $postId = (int)$item['id'];
                    $title = ($item['title'] . ' ' ?? '');
                    $params = ['id' => $postId];

                    $dataName = $this->getData('name');
                    $item[$dataName]['edit'] = [
                        'href' => $this->urlBuilder->getUrl(self::ROUTE_EDIT, $params),
                        'label' => __('Edit'),
                    ];
                    $message = 'Are you sure you wan\'t to delete %1?';
                    $item[$dataName]['delete'] = [
                        'href' => $this->urlBuilder->getUrl(self::ROUTE_DELETE, $params),
                        'label' => __('Delete'),
                        'confirm' => [
                            'title' => __('Delete Post #%1', $postId)->render(),
                            'message' => __($message, $title)->render()
                        ]
                    ];
                }
            }
        }
        return $dataSource;
    }
}
