<?php

namespace App\Controller\UsersData;

use App\Entity\User;
use App\Form\SettingsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class SettingController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly UserPasswordHasherInterface $passwordHasher,
    ) {
    }

    #[Route(path: '/settings', name: 'settings')]
    public function editData(Request $request): Response
    {
        $session = $request->getSession();

        $displaySettings = $session->get('display_settings', false);
        \assert(\is_bool($displaySettings));

        if ($displaySettings || \count($request->request->all()) > 0) {
            $session->remove('display_settings');
            $user = $this->getUser();
            $settingsForm = $this->createForm(SettingsType::class);
            $settingsForm->createView();
            $settingsForm->handleRequest($request);
            if ($settingsForm->isSubmitted() && $settingsForm->isValid()) {
                $settingsFields = $request->request->get('settings');
                $user = $this->UpdateUserData($settingsFields);
                $this->entityManager->persist($user);
                $this->entityManager->flush();

                return $this->redirectToRoute('home');
            }

            return $this->render('settings/index.html.twig', [
                'controller_name' => 'SettingController',
                'firstName' => $user->getFirstName(),
                'lastName' => $user->getLastName(),
                'email' => $user->getEmail(),
                'settingsForm' => $settingsForm,
            ]);
        } else {
            return $this->redirectToRoute('auth');
        }
    }

    private function UpdateUserData($fields)
    {
        $user = $this->getUser();
        \assert($user instanceof User);

        $firstNameField = $fields['firstName'];
        if ($firstNameField != $user->getFirstName()) {
            $user->setFirstName($firstNameField);
        }
        $lastNameField = $fields['lastName'];
        if ($lastNameField != $user->getLastName()) {
            $user->setLastName($lastNameField);
        }
        $emailField = $fields['email'];
        if ($emailField != $user->getEmail()) {
            $user->setEmail($emailField);
        }
        if (null != $fields['password']['first']) {
            $user->setPassword($this->passwordHasher->hashPassword($user, $fields['password']['first']));
        }

        return $user;
    }
}
