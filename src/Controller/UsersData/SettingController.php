<?php

namespace App\Controller\UsersData;

use App\Form\SettingsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SettingController extends AbstractController
{
    /**
     * @Route("/settings", name="settings")
     *
     * @return Response
     */
    public function editData(Request $request, UserPasswordEncoderInterface $passwordEncoder): RedirectResponse|Response
    {
        if ((isset($_SESSION['display_settings']) && $_SESSION['display_settings'] === true) || ! empty($request->request->all())) {
            unset($_SESSION['display_settings']);
            $user = $this->getUser();
            $settingsForm = $this->createForm(SettingsType::class);
            $settingsForm->createView();
            $settingsForm->handleRequest($request);
            if ($settingsForm->isSubmitted() && $settingsForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $settingsFields = $request->request->get('settings');
                $user = $this->UpdateUserData($settingsFields, $passwordEncoder);
                $em->persist($user);
                $em->flush();

                return $this->redirectToRoute('home');
            }

            return $this->render('settings/index.html.twig', [
                'controller_name' => 'SettingController',
                'firstName' => $user->getFirstName(),
                'lastName' => $user->getLastName(),
                'email' => $user->getEmail(),
                'settingsForm' => $settingsForm,
            ]);
        }

        return $this->redirectToRoute('auth');
    }

    private function UpdateUserData(array $fields, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = $this->getUser();
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

        if ($fields['password']['first'] != null) {
            $user->setPassword($passwordEncoder->encodePassword(
                $user,
                $fields['password']['first']
            ));
        }

        return $user;
    }
}
