<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\Author;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    #[Route('/author/{id}', name: 'author', methods: 'GET|POST')]
    public function author(EntityManagerInterface $em, int $id): Response
    {
        $author = $em->getRepository(Author::class)->find($id);


        if (!$author) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        dd($author->getTags());
        return $this->render('base.html.twig');
    }
}