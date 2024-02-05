<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AuthType;
use App\Form\RegistrationType;
use App\Security\LoginFormAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class SecurityController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('home');
        }

        return $this->render('security/login.html.twig', [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError(),
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \RuntimeException('Action forbidden');
    }

    #[Route(path: '/register', name: 'app_register')]
    public function register(
        Request $request,
        LoginFormAuthenticator $authenticator,
        UserPasswordHasherInterface $passwordHasher,
        UserAuthenticatorInterface $userAuthenticator,
        ValidatorInterface $validator,
    ): Response {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('home');
        }

        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        $errors = $validator->validate($user);
        if ($form->isSubmitted() && $form->isValid()) {
            $formUser = $form->getData();
            $registrationFields = $request->request->get('registration');

            $formUser->setPassword($passwordHasher->hashPassword($formUser, $registrationFields['password']['first']));
            $formUser->setRegistrationDate(new \DateTime('now'));

            $this->entityManager->persist($formUser);
            $this->entityManager->flush();

            $response = $userAuthenticator->authenticateUser($user, $authenticator, $request);
            \assert($response instanceof Response);

            return $response;
        }

        return $this->render('security/register.html.twig', [
            'form' => $form->createView(),
            'errors' => $errors,
        ]);
    }

    #[Route(path: '/auth', name: 'auth')]
    public function authenticate(
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
    ): Response {
        $user = $this->getUser();
        \assert($user instanceof User);

        $form = $this->createForm(AuthType::class);
        $form->handleRequest($request);

        $errors = [];
        if ($form->isSubmitted() && $form->isValid()) {
            $authFields = $request->request->get('auth');
            if ($passwordHasher->isPasswordValid($user, $authFields['password'])) {
                $request->getSession()->set('display_settings', true);

                return $this->redirectToRoute('settings');
            }

            $errors[] = 'Incorrect password';
        }

        return $this->render('security/auth.html.twig', [
            'form' => $form->createView(),
            'errors' => $errors,
        ]);
    }
}
