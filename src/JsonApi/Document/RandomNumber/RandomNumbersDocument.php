<?php

namespace App\JsonApi\Document\RandomNumber;

use WoohooLabs\Yin\JsonApi\Schema\Document\AbstractCollectionDocument;
use WoohooLabs\Yin\JsonApi\Schema\JsonApiObject;
use WoohooLabs\Yin\JsonApi\Schema\Link\DocumentLinks;

class RandomNumbersDocument extends AbstractCollectionDocument
{
    /**
     * {@inheritdoc}
     */
    public function getJsonApi(): ?JsonApiObject
    {
        return new JsonApiObject('1.0');
    }

    /**
     * {@inheritdoc}
     */
    public function getMeta(): array
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getLinks(): ?DocumentLinks
    {
        return DocumentLinks::createWithoutBaseUri()
            ->setPagination('/random-number/', $this->object);
    }
}
