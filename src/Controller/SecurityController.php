<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AuthType;
use App\Form\LoginType;
use App\Form\RegistrationType;
use App\Security\LoginFormAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
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
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        $user = new User();
        $user->setRegistrationDate(new \DateTime('now'));
        $form = $this->createForm(LoginType::class, $user);

        return $this->render('security/login.html.twig', [
            'form' => $form->createView(),
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): never
    {
        throw new \Exception('Action forbidden');
    }

    #[Route(path: '/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $formAuthenticator, ValidatorInterface $validator)
    {
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

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $formAuthenticator,
                'main'
            );
        }

        return $this->render('security/register.html.twig', [
            'form' => $form->createView(),
            'errors' => $errors,
        ]);
    }

    #[Route(path: '/auth', name: 'auth')]
    public function authenticate(Request $request, LoginFormAuthenticator $formAuthenticator): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(AuthType::class);
        $form->createView();
        $form->handleRequest($request);
        $errors = [];
        if ($form->isSubmitted() && $form->isValid()) {
            $authFields = $request->request->get('auth');
            if ($formAuthenticator->checkCredentials($authFields, $user)) {
                $request->getSession()->set('display_settings', true);

                return $this->redirectToRoute('settings');
            } else {
                $errors[] = 'Incorrect password';
            }
        }

        return $this->render('security/auth.html.twig', [
            'form' => $form,
            'errors' => $errors,
        ]);
    }
}
