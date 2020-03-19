<?php

namespace App\Controller;

use App\Entity\EtsouService;
use App\Entity\User;
use App\Form\RegistrationType;
use App\Repository\EtsouServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{

    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;
    /**
     * @var EtsouServiceRepository
     */
    private $repository;
    /**
     * @var Request
     */
    private $request;

    public function __construct( EtsouServiceRepository $repository, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder )
    {
        $this->em = $em;
        $this->encoder = $encoder;
        $this->repository = $repository;

    }

    /**
     * @Route("/inscription", name="security_registration")
     */
    public function registration(Request $request, AuthenticationUtils $utils)
    {
        $user = new User();
        $service = $this->repository->findService();
        $ets = $this->repository->findEts();

        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $hash = $this->encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);

            $this->em->persist($user);
            $this->em->flush();
            $this->addFlash('success', "Enregistrement éfféctué avec succes !");
            return $this->redirectToRoute('security_login');
        }

        return $this->render('security/registration.html.twig', [
            'form' => $form->createView(),
            'services' => $service,
            'ets' => $ets
        ]);
    }

    /**
     * @Route("/login", name="security_login")
     *
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername  = $authenticationUtils->getLastUsername();

        $service = $this->repository->findService();
        $ets = $this->repository->findEts();

        return $this->render('security/login.html.twig',[
            'last_username' => $lastUsername,
            'error' => $error,
            'services' => $service,
            'ets' => $ets
        ]);
    }

    /**
     * @Route("/deconnexion", name="security_logout")
     */
    public function logout()
    {

    }
}
