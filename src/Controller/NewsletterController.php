<?php

namespace App\Controller;

use App\Entity\Newsletter;
use App\Form\NewsletterType;
use App\Repository\NewsletterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route(path: '/newsletter', name: 'newsletter_')]
class NewsletterController extends AbstractController
{
    public function __construct(
        private readonly NewsletterRepository $newsletterRepository,
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    public function renderNewsletterForm(Request $request, ValidatorInterface $validator): Response
    {
        $news_object = new Newsletter();
        $news_form = $this->createForm(NewsletterType::class, $news_object, [
            'action' => $this->generateUrl('newsletter_signup'),
            'method' => 'POST',
        ]);
        $news_form->handleRequest($request);
        $errors = $validator->validate($news_object);

        return $this->render('newsletter/form.html.twig', [
            'newsletterForm' => $news_form->createView(),
            'errors' => $errors,
        ]);
    }

    #[Route(path: '/signup', name: 'signup')]
    public function signUp(Request $request): RedirectResponse
    {
        if ($request->request->get('newsletter')) {
            $formData = $request->request->get('newsletter');
            $email = $formData['email'];
            if (!$this->newsletterRepository->findOneBy(['email' => $email])) {
                $newsletterSubscription = new Newsletter();
                $newsletterSubscription->setEmail($email);
                $this->entityManager->persist($newsletterSubscription);
                $this->entityManager->flush();
                $this->addFlash('notice', 'Thank you! You will now receive information about changes in our offer.');
            } else {
                $this->addFlash('notice', 'Thank you! You are already a newsletter subscriber.');
            }
        }
        $referer = $request->headers->get('referer');

        return $this->redirect($referer);
    }
}
