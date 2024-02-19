<?php

namespace App\Controller;

use App\Entity\Newsletter;
use App\Form\NewsletterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/newsletter", name="newsletter_")
 */
class NewsletterController extends AbstractController
{
    public function renderForm(Request $request, ValidatorInterface $validator)
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

    /**
     * @Route("/signup", name="signup")
     *
     * @return RedirectResponse
     */
    public function signUp(Request $request)
    {
        if ($request->request->get('newsletter')) {
            $formData = $request->request->get('newsletter');
            $email = $formData['email'];
            if (! $this->getDoctrine()->getRepository(Newsletter::class)->findOneBy([
                'email' => $email,
            ])) {
                $em = $this->getDoctrine()->getManager();
                $newsletterSubscription = new Newsletter();
                $newsletterSubscription->setEmail($email);
                $em->persist($newsletterSubscription);
                $em->flush();
                $this->addFlash('notice', 'Thank you! You will now receive information about changes in our offer.');
            } else {
                $this->addFlash('notice', 'Thank you! You are already a newsletter subscriber.');
            }
        }
        $referer = $request->headers->get('referer');

        return $this->redirect($referer);
    }
}
