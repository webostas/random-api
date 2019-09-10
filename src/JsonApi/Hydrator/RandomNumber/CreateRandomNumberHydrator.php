<?php

namespace App\JsonApi\Hydrator\RandomNumber;

use App\Entity\RandomNumber;

/**
 * Create RandomNumber Hydrator.
 */
class CreateRandomNumberHydrator extends AbstractRandomNumberHydrator
{
    /**
     * {@inheritdoc}
     */
    protected function getAttributeHydrator($randomNumber): array
    {
        return [
            'value' => function (RandomNumber $randomNumber, $attribute, $data, $attributeName) {
                $randomNumber->setValue($attribute);
            },
        ];
    }
}
