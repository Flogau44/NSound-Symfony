<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\RememberMeBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\SecurityRequestAttributes;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class AdminAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'admin_login';

    // Constructeur de la classe AdminAuthenticator
    public function __construct(
        private UrlGeneratorInterface $urlGenerator,
        private AuthorizationCheckerInterface $authChecker,
        private RequestStack $requestStack,
        private TokenStorageInterface $tokenStorage
    ) {}

    // Méthode pour authentifier un utilisateur
    public function authenticate(Request $request): Passport
    {
        // Récupère l'email de la requête
        $email = $request->request->get('_username');
        // Enregistre l'email dans la session
        $request->getSession()->set(SecurityRequestAttributes::LAST_USERNAME, $email);

        // Crée un passeport avec les informations d'authentification
        return new Passport(
            new UserBadge($email),
            new PasswordCredentials($request->request->get('_password')),
            [
                new CsrfTokenBadge('authenticate', $request->request->get('_csrf_token')),
                new RememberMeBadge(),
            ]
        );
    }

    // Méthode appelée après une authentification réussie
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        // Vérifie si l'utilisateur est admin
        if (!$this->authChecker->isGranted('ROLE_ADMIN')) {
            // Déconnecter l'utilisateur
            $request->getSession()->invalidate();
            $this->tokenStorage->setToken(null);
            // Redirige vers la page principale
            return new RedirectResponse($this->urlGenerator->generate('app_app', ['route' => '']));
        }

        // Redirige vers la page cible après une authentification réussie
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            return new RedirectResponse($targetPath);
        }
        return new RedirectResponse($this->urlGenerator->generate('admin'));
    }

    // Méthode pour obtenir l'URL de la page de connexion
    protected function getLoginUrl(Request $request): string
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}
