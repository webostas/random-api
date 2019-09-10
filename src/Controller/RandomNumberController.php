<?php

namespace App\Controller;

use App\Entity\RandomNumber;
use App\JsonApi\Document\RandomNumber\RandomNumberDocument;
use App\JsonApi\Document\RandomNumber\RandomNumbersDocument;
use App\JsonApi\Hydrator\RandomNumber\CreateRandomNumberHydrator;
use App\JsonApi\Hydrator\RandomNumber\UpdateRandomNumberHydrator;
use App\JsonApi\Transformer\RandomNumberResourceTransformer;
use App\Repository\RandomNumberRepository;
use Paknahad\JsonApiBundle\Controller\Controller;
use Paknahad\JsonApiBundle\Helper\ResourceCollection;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use WoohooLabs\Yin\JsonApi\Exception\DefaultExceptionFactory;

/**
 * @Route("/random-number")
 */
class RandomNumberController extends Controller
{
    /**
     * @Route("/", name="random_numbers_index", methods="GET")
     */
    public function index(RandomNumberRepository $randomNumberRepository, ResourceCollection $resourceCollection): ResponseInterface
    {
        $resourceCollection->setRepository($randomNumberRepository);

        $resourceCollection->handleIndexRequest();

        return $this->jsonApi()->respond()->ok(
            new RandomNumbersDocument(new RandomNumberResourceTransformer()),
            $resourceCollection
        );
    }

    /**
     * @Route("/", name="random_numbers_new", methods="POST")
     */
    public function new(ValidatorInterface $validator, DefaultExceptionFactory $exceptionFactory): ResponseInterface
    {
        $entityManager = $this->getDoctrine()->getManager();

        $randomNumberEntity = new RandomNumber();
        $randomNumberEntity->setValue(rand());

        $randomNumber = $this->jsonApi()->hydrate(new CreateRandomNumberHydrator($entityManager, $exceptionFactory), $randomNumberEntity);

        /** @var ConstraintViolationList $errors */
        $errors = $validator->validate($randomNumber);
        if ($errors->count() > 0) {
            return $this->validationErrorResponse($errors);
        }

        $entityManager->persist($randomNumber);
        $entityManager->flush();

        return $this->jsonApi()->respond()->ok(
            new RandomNumberDocument(new RandomNumberResourceTransformer()),
            $randomNumber
        );
    }

    /**
     * @Route("/{id}", name="random_numbers_show", methods="GET")
     */
    public function show(RandomNumber $randomNumber): ResponseInterface
    {
        return $this->jsonApi()->respond()->ok(
            new RandomNumberDocument(new RandomNumberResourceTransformer()),
            $randomNumber
        );
    }

    /**
     * @Route("/{id}", name="random_numbers_delete", methods="DELETE")
     */
    public function delete(Request $request, RandomNumber $randomNumber): ResponseInterface
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($randomNumber);
        $entityManager->flush();

        return $this->jsonApi()->respond()->genericSuccess(204);
    }
}
