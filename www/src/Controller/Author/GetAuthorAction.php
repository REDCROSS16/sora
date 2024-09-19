<?php declare(strict_types=1);

namespace App\Controller\Author;

use App\Entity\Author;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/{id}', name: 'author', methods: 'GET')]
class GetAuthorAction extends AbstractController
{
    public function __invoke(EntityManagerInterface $em, int $id): Response
    {
        $author = $em->getRepository(Author::class)->find($id);

        if (!$author) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        return $this->render('base.html.twig');
    }
}