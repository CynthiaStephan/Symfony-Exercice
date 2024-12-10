<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ArticleController extends AbstractController
{
    #[Route('/article', name: 'app_article')]
    public function index(ArticleRepository $articleRepository): Response
    {

        $articles = $articleRepository->findAll();
        dump($articles);

        return $this->render('article/article.html.twig', [
            'articles' => $articles,
        ]);
    }

    #[Route('/article/delete/{id}', name:'article_delete')]
    public function deleteArticle(EntityManagerInterface $entityManager, int $id): Response {
        
        $article = $entityManager->getRepository(Article::class)->find($id);
        if (!$article) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        $entityManager->remove($article);
        $entityManager->flush();

        return $this->redirectToRoute('app_article');
    }
}
