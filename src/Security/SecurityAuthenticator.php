<?php

namespace App\Security;

use App\Services\RegistrationService;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;

class SecurityAuthenticator extends AbstractLoginFormAuthenticator
{
    private RegistrationService $registrationService;

    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }


    protected function getLoginUrl(Request $request): string
    {
        return void;
    }

    public function authenticate(Request $request): PassportInterface
    {
        return void;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): Response
    {
        return $this->registrationService->redirectAfterRegistration();
    }
}
