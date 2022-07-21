<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    #[Route('/wishes', name: 'wish_list')]
    public function list(WishRepository $wishRepository): Response
    {
        $wishes=$wishRepository->findBy(['isPublished' => true], ['dateCreated' => 'DESC']);

        return $this->render('wish/list.html.twig', [
            "wishes"=>$wishes
        ]);
    }

    #[Route('/wish_details/{id}', name: 'wish_details')]
    public function details(int $id, WishRepository $wishRepository): Response
    {
        $wish = $wishRepository->find($id);

        if (!$wish){
            throw $this->createNotFoundException('This wish do not exists');
        }

        return $this->render('wish/details.html.twig', [
            "wish"=>$wish
        ]);
    }

    #[Route('/wish_demo', name: 'wish_demo')]
    public function testInsert(EntityManagerInterface $entityManager): Response
    {
        $wish = new Wish();
        $wish->setTitle('Tatoo\'d Lady');
        $wish->setDateCreated(new \DateTime());
        $wish->setAuthor('Buj');
        $wish->setDescription('Solo');
        $wish->setIsPublished(1);

        dump($wish);

        $entityManager->persist($wish);
        $entityManager->flush();

        return $this->render('wish/details.html.twig', [

        ]);
    }

}
