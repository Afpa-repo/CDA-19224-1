<?php

namespace App\Controller;

use App\Entity\Ct404User;
use App\Form\UpdatePasswordFormType;
use App\Repository\Ct404UserRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Exception;
use LogicException;
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
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $Routes = [
            'Accueil' => '/',
            'Connexion' => '/login',
        ];

        // Get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // Last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'history_routes' => $Routes,
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Route("/forgot_password", name="app_forgot_pwd")
     *
     * @throws NonUniqueResultException
     * @throws TransportExceptionInterface
     */
    public function forgot_password(Ct404UserRepository $repository, MailerInterface $mailer, EntityManagerInterface $manager): Response
    {
        $Routes = [
            'Accueil' => '/',
            'Connexion' => '/login',
            'Mot de passe oublié' => '/forgot_password',
        ];

        if (isset($_POST['send_forgot_mail']) && !empty($_POST['forgot_pwd'])) {
            $user_exist = $repository->findOneByEmail($_POST['forgot_pwd']);

            if ($user_exist) {
                $stamp = new DateTime();
                $user_exist->setUserToken($stamp->getTimestamp());
                $manager->flush();

                $email = (new TemplatedEmail())
                    ->from(new Address('no_reply@diagon_alley.com', 'Diagon Alley - No Reply'))
                    ->to($user_exist->getEmail())
                    ->priority(Email::PRIORITY_HIGH)
                    ->subject('Modification de mot de passe')
                    ->htmlTemplate('emails/forgot_password.html.twig')
                    ->context([
                        'token' => $user_exist->getUserToken(),
                        'id' => $user_exist->getId(),
                    ])
                ;
                $mailer->send($email);
                $this->addFlash('success', 'Un email de récupération vous a été envoyé');
            }
        }

        return $this->render('security/forgot_password.html.twig', [
            'history_routes' => $Routes,
        ]);
    }

    /**
     * @Route("/new_password/{id}/{user_token}", name="app_forgot_pwd.update", methods="GET|POST")
     *
     * @throws Exception
     */
    public function update_password(Ct404User $user, Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        // Add history routes to the response return
        $Routes = [
            'Accueil' => '/',
            'Connexion' => '/login',
            'Nouveau mot de passe' => '#',
        ];

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

            // Create form
            $form = $this->createForm(UpdatePasswordFormType::class, $user);
            $form->handleRequest($request);

            // If the email was send less than one hour ago
            if ($stamp_diff < 3600) {
                if ($form->isSubmitted() && $form->isValid()) {
                    // Encode the plain password
                    $user->setPassword(
                        $passwordEncoder->encodePassword(
                            $user,
                            $form->get('plainPassword')->getData()
                        )
                    );

                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($user);
                    $entityManager->flush();
                    $this->addFlash('success', 'Votre mot de passe à bien été modifié');

                    return $this->redirectToRoute('home');
                }
            }
        }

        return $this->render('security/update_password.html.twig', [
            'form' => $form->createView(),
            'history_routes' => $Routes,
        ]);
    }
}
