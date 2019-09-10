<?php

namespace App\JsonApi\Transformer;

use App\Entity\RandomNumber;
use WoohooLabs\Yin\JsonApi\Schema\Link\Link;
use WoohooLabs\Yin\JsonApi\Schema\Link\ResourceLinks;
use WoohooLabs\Yin\JsonApi\Schema\Resource\AbstractResource;

class RandomNumberResourceTransformer extends AbstractResource
{
    /**
     * {@inheritdoc}
     */
    public function getType($randomNumber): string
    {
        return 'random_numbers';
    }

    /**
     * {@inheritdoc}
     */
    public function getMeta($randomNumber): array
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getLinks($randomNumber): ?ResourceLinks
    {
        return ResourceLinks::createWithoutBaseUri()->setSelf(new Link('/random-number/' . $this->getId($randomNumber)));
    }

    /**
     * {@inheritdoc}
     */
    public function getId($randomNumber): string
    {
        return (string)$randomNumber->getId();
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributes($randomNumber): array
    {
        return [
            'value' => function (RandomNumber $randomNumber) {
                return $randomNumber->getValue();
            },
            'created_at' => function (RandomNumber $randomNumber) {
                return $randomNumber->getCreatedAt()->format("Y-m-d H:i:s");
            },
            'updated_at' => function (RandomNumber $randomNumber) {
                return $randomNumber->getUpdatedAt()->format("Y-m-d H:i:s");
            },
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultIncludedRelationships($randomNumber): array
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getRelationships($randomNumber): array
    {
        return [
        ];
    }
}
