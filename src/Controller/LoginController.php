<?php

namespace App\Controller;

use App\Repository\UsuarioRepository;
use Firebase\JWT\JWT;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class LoginController
 * @package App\Controller
 */
class LoginController extends AbstractController
{

    /**
     * @var UsuarioRepository
     */
    private UsuarioRepository $usuarioRepository;
    /**
     * @var UserPasswordEncoderInterface
     */
    private UserPasswordEncoderInterface $passwordEncoder;

    /**
     * LoginController constructor.
     * @param UsuarioRepository $usuarioRepository
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(
        UsuarioRepository $usuarioRepository,
        UserPasswordEncoderInterface $passwordEncoder
    ) {
        $this->usuarioRepository = $usuarioRepository;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param Request $request
     * @Route("/login", name="login")
     */
    public function login(Request $request)
    {
        $json = json_decode($request->getContent());

        if (empty($json->username)) {
            return new JsonResponse(
                ["erro" => "Favor enviar usuário e senha"],
                JsonResponse::HTTP_BAD_REQUEST
            );
        }

        $usuario = $this->usuarioRepository->findOneBy(["username" => $json->username]);

        if (!$this->passwordEncoder->isPasswordValid($usuario, $json->password)) {
            return new JsonResponse(
                ["erro" => "Usuário ou senha inválidos"],
                JsonResponse::HTTP_UNAUTHORIZED
            );
        }

        $token = JWT::encode(["username" => $usuario->getUsername()], "chave");

        return new JsonResponse(["access_token" => $token]);
    }
}
