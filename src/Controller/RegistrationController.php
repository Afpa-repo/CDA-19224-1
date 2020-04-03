<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\LoginFormAuthenticator;
use DateTime;
use Exception;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     *
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param GuardAuthenticatorHandler $guardHandler
     * @param LoginFormAuthenticator $authenticator
     * @param MailerInterface $mailer
     * @return Response
     * @throws TransportExceptionInterface
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $authenticator, MailerInterface $mailer): Response
    {
        // Add history routes to the response return
        $Routes = [
            'Accueil' => '/',
            'Connexion' => '/login',
            'Inscription' => '/register',
        ];
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();


            // Use Mailer interface to send a template email
            // Pass the user_id and user_token to the mail
            $email = (new TemplatedEmail())
                ->from(new Address('no_reply@diagon_alley.com', 'Diagon Alley - No Reply'))
                ->to($user->getEmail())
                ->embedFromPath('http://127.0.0.1:8000/build/images/logo.668427f7.png', 'logo')
                ->priority(Email::PRIORITY_HIGH)
                ->subject('Confirmation d\'Email')
                ->htmlTemplate('emails/signup.html.twig')
                ->context([
                    'token' => $user->getUserToken(),
                    'id' => $user->getId(),
                ])
            ;
            // Send email
            $mailer->send($email);

            // Authentication after registration
            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'history_routes' => $Routes,
        ]);
    }

    /**
     * @Route("/confirmation/{id}/{user_token}", name="confimation.email", methods="GET|POST")
     *
     * @param User $user
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function confirm_email(User $user, Request $request): Response
    {
        // Recover the time stamp
        $time = new DateTime();
        $stamp = $time->getTimestamp();
        // Recover the token content in the mail
        $mailToken = $request->attributes->get('user_token');

        // User token from database
        $userToken = $user->getUserToken();

        // Checking the token contained in the email with the one in the database
        if ($userToken == $mailToken) {
            // Recovering the timestamp length
            $len = strlen($userToken) - 32;
            // Recovering the timestamp in the user_token
            $time_key = intval(substr($userToken, 16, $len));
            // Difference between the two values
            $stamp_diff = $stamp - $time_key;

            // If the email was send less than one hour ago
            if ($stamp_diff < 3600) {
                // Then we change role in table
                $user->setRolesValid();
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
            }
        }

        return $this->redirectToRoute('home');
    }
}
