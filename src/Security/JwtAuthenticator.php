<?php

namespace App\Security;

use App\Repository\UsuarioRepository;
use Firebase\JWT\JWT;
use Symfony\Component\HttpFoundation\{
    JsonResponse,
    Request,
    Response
};
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\{UserInterface, UserProviderInterface};
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

/**
 * Class JwtAuthenticator
 * @package App\Security
 */
class JwtAuthenticator extends AbstractGuardAuthenticator
{

    /**
     * @var UsuarioRepository
     */
    private UsuarioRepository $usuarioRepository;

    /**
     * JwtAuthenticator constructor.
     * @param UsuarioRepository $usuarioRepository
     */
    public function __construct(UsuarioRepository $usuarioRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
    }

    /**
     * @param Request $request
     * @param AuthenticationException|null $authException
     * @return Response
     */
    public function start(Request $request, AuthenticationException $authException = null): Response
    {
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function supports(Request $request): bool
    {
        return !in_array($request->getPathInfo(), ["/login", "/"]);
    }

    /**
     * @param Request $request
     * @return mixed|object|null
     */
    public function getCredentials(Request $request)
    {
        $token = str_replace(
            "Bearer ",
            "",
            $request->headers->get("Authorization")
        );

        try {
            return JWT::decode($token, "chave", ['HS256']);
        } catch (\Exception $exp) {
            return false;
        }
    }

    /**
     * @param mixed $credentials
     * @param UserProviderInterface $userProvider
     * @return UserInterface|null
     */
    public function getUser($credentials, UserProviderInterface $userProvider): ?UserInterface
    {
        if (!is_object($credentials) || !property_exists($credentials, "username")) {
            return null;
        }

        return $this->usuarioRepository->findOneBy(["username" => $credentials->username]);
    }

    /**
     * @param mixed $credentials
     * @param UserInterface $user
     * @return bool
     */
    public function checkCredentials($credentials, UserInterface $user): bool
    {
        if (is_object($credentials) && property_exists($credentials, "username")) {
            return true;
        }
    }

    /**
     * @param Request $request
     * @param AuthenticationException $exception
     * @return JsonResponse
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): JsonResponse
    {
        return new JsonResponse(
            ["erro" => "Falha na autenticação"],
            JsonResponse::HTTP_UNAUTHORIZED
        );
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @param string $providerKey
     * @return JsonResponse|null
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey): ?JsonResponse
    {
        return null;
    }

    /**
     * @return bool
     */
    public function supportsRememberMe(): bool
    {
        return false;
    }
}
