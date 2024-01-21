<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;

class LogoutSuccessHandler implements LogoutSuccessHandlerInterface
{
    public function __construct(private readonly RouterInterface $router)
    {
    }

    #[\Override]
    public function onLogoutSuccess(Request $request)
    {
        return new RedirectResponse($this->router->generate('home'));
    }
}
