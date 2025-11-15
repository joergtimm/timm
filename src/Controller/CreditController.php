<?php

namespace App\Controller;

use App\Entity\Credit;
use App\Form\CreditType;
use App\Repository\CreditRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/credit')]
final class CreditController extends AbstractController
{
    public function __construct(
        private readonly CreditRepository $creditRepository,
        private readonly EntityManagerInterface $em,
    ) {
    }

    #[Route(name: 'app_credit_index', methods: ['GET'])]
    public function index(): Response
    {
        $credits = $this->creditRepository->findBy([], ['id' => 'DESC']);

        return $this->render('credit/index.html.twig', [
            'credits' => $credits,
        ]);
    }

    #[Route('/new', name: 'app_credit_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $credit = new Credit();
        $credit->setCreatedAt(new \DateTimeImmutable());

        $form = $this->createForm(CreditType::class, $credit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($credit);
            $this->em->flush();

            $this->addFlash('success', 'Gutschrift wurde erstellt.');
            return $this->redirectToRoute('app_credit_index');
        }

        return $this->render('credit/new.html.twig', [
            'credit' => $credit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_credit_show', methods: ['GET'])]
    public function show(Credit $credit): Response
    {
        return $this->render('credit/show.html.twig', [
            'credit' => $credit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_credit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Credit $credit): Response
    {
        $form = $this->createForm(CreditType::class, $credit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Gutschrift wurde aktualisiert.');
            return $this->redirectToRoute('app_credit_index');
        }

        return $this->render('credit/edit.html.twig', [
            'credit' => $credit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_credit_delete', methods: ['POST'])]
    public function delete(Request $request, Credit $credit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$credit->getId(), $request->getPayload()->getString('_token'))) {
            $this->em->remove($credit);
            $this->em->flush();
            $this->addFlash('success', 'Gutschrift wurde gelöscht.');
        }

        return $this->redirectToRoute('app_credit_index');
    }
}
