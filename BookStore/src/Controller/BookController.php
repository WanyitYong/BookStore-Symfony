<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Transaction;
use App\Entity\Comment;
use App\Form\BookType;
use App\Form\CommentType;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/book")
 */
class BookController extends AbstractController
{
    /**
     * @Route("/buy", name="book_buy", methods={"GET"})
     */
    public function index(BookRepository $bookRepository): Response
    {
        return $this->render('book/index.html.twig', [
            'books' => $bookRepository->findAll(),
        ]);
    }

    /**
     * @Route("/sell", name="book_sell", methods={"GET"})
     * * @IsGranted("ROLE_USER")
     */
    public function sell(BookRepository $bookRepository): Response
    {
        return $this->render('book/sell.html.twig', [
            'books' => $bookRepository->findAll(),
        ]);
    }

    /**
     * @Route("/confirm/{id}", name="book_confirm", methods={"GET","POST"})
     * * @IsGranted("ROLE_USER")
     */
    public function confirm(BookRepository $bookRepository, Request $request): Response
    {
        $transactionId = $request->attributes->get('id');
        $transaction = $this->getDoctrine()->getRepository(Transaction::class)->find($transactionId);
        $bookId = $transaction->getBook();
        $book = $this->getDoctrine()->getRepository(Book::class)->find($bookId);
        $book->setStatus(true);
        $book->setTransaction($transaction);
        $this->getDoctrine()->getManager()->flush();
        return $this->render('book/sell.html.twig', [
            'books' => $bookRepository->findAll(),
            'id'=>$transactionId,
        ]);
    }

    /**
     * @Route("/{user}/new", name="book_new", methods={"GET","POST"})
     * * @IsGranted("ROLE_USER")
     */
    public function new(Request $request): Response
    {
        $seller = $this->getUser()->getUsername();

        $book = new Book();
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $book->setSeller($seller);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($book);
            $entityManager->flush();

            return $this->redirectToRoute('book_sell');
        }

        return $this->render('book/new.html.twig', [
            'book' => $book,
            'user' => $seller,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="book_show2", methods={"GET"})
     */
    public function show2(Book $book): Response
    {
        $commentPrev = $this->getDoctrine()->getRepository(Comment::class)->findBy(array('book'=>$book));
        return $this->render('book/show2.html.twig', [
            'book' => $book,
            'comments' => $commentPrev,
        ]);
    }

    /**
     * @Route("/{id}", name="book_show", methods={"GET","POST"})
     */
    public function show(Book $book, Request $request): Response
    {
        $user = $this->getUser()->getUsername();
        $transaction = $this->getDoctrine()->getRepository(Transaction::class)->findBy(array('Book'=>$book));
        $commentPrev = $this->getDoctrine()->getRepository(Comment::class)->findBy(array('book'=>$book));

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setBuyer($user);
            $comment->setBook($book);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->render('book/show.html.twig', [
                'book' => $book,
                'transactions' => $transaction,
                'comments' => $commentPrev,
                'comment' => $comment,
                'form' => $form->createView(),
            ]);
        }

        return $this->render('book/show.html.twig', [
            'book' => $book,
            'transactions' => $transaction,
            'comment' => $comment,
            'comments' => $commentPrev,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="book_edit", methods={"GET","POST"})
     * * @IsGranted("ROLE_USER")
     */
    public function edit(Request $request, Book $book): Response
    {
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('book_sell', [
                'id' => $book->getId(),
            ]);
        }

        return $this->render('book/edit.html.twig', [
            'book' => $book,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="book_delete", methods={"DELETE"})
     * * @IsGranted("ROLE_USER")
     */
    public function delete(Request $request, Book $book): Response
    {
        if ($this->isCsrfTokenValid('delete'.$book->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($book);
            $entityManager->flush();
        }

        return $this->redirectToRoute('book_sell');
    }
}
