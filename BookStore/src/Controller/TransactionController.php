<?php

namespace App\Controller;

use App\Entity\Transaction;
use App\Entity\Book;
use App\Form\TransactionType;
use App\Repository\TransactionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/transaction")
 */
class TransactionController extends AbstractController
{
    /**
     * @Route("/", name="transaction_index", methods={"GET"})
     */
    public function index(TransactionRepository $transactionRepository): Response
    {
        $book = $this->getDoctrine()
            ->getRepository(Book::class)
            ->findAll();
        return $this->render('transaction/index.html.twig', [
            'transactions' => $transactionRepository->findAll(),
            'books' => $book,
        ]);
    }

    /**
     * @Route("/select", name="transaction_sell", methods={"GET"})
     */
    public function sell(TransactionRepository $transactionRepository, Request $request): Response
    {
        $bookId = $request->attributes->get('book');
        $book = $this->getDoctrine()
            ->getRepository(Book::class)
            ->find($bookId);
        //$choice = new Choice();
        return $this->render('transaction/sell.html.twig', [
            'transactions' => $transactionRepository->findBy(array('Book' => $bookId )),
            'book' => $book,
        ]);
    }

    /**
     * @Route("/", name="transaction_history", methods={"GET"})
     */
    public function history(TransactionRepository $transactionRepository): Response
    {
        return $this->render('transaction/index.html.twig', [
            'transactions' => $transactionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{book}/new", name="transaction_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $bookId = $request->attributes->get('book');
        $book = $this->getDoctrine()
            ->getRepository(Book::class)
            ->find($bookId);

        $user = $this->getUser()->getUsername();
        //$user = $request->getUserInfo();
        $transaction = new Transaction();
        $form = $this->createForm(TransactionType::class, $transaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $transaction->setBook($book);
            $transaction->setBuyer($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($transaction);
            $entityManager->flush();

            return $this->redirectToRoute('book_buy');
        }

        return $this->render('transaction/new.html.twig', [
            'transaction' => $transaction,
            'book' => $book,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="transaction_show", methods={"GET"})
     */
    public function show(Transaction $transaction): Response
    {
        return $this->render('transaction/show.html.twig', [
            'transaction' => $transaction,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="transaction_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Transaction $transaction): Response
    {
        $form = $this->createForm(TransactionType::class, $transaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('transaction_index', [
                'id' => $transaction->getId(),
            ]);
        }

        return $this->render('transaction/edit.html.twig', [
            'transaction' => $transaction,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="transaction_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Transaction $transaction): Response
    {
        if ($this->isCsrfTokenValid('delete'.$transaction->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($transaction);
            $entityManager->flush();
        }

        return $this->redirectToRoute('transaction_index');
    }
}
