<?php

namespace App\Security;

use App\Security\User as AppUser;
use App\Exception\AccountDeletedException;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccountExpiredException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;

class UserChecker implements UserCheckerInterface
{
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function checkPreAuth(UserInterface $user)
    {
        // utilisateur vérifié ? aVerifier contient une string à entrer pour confirmer inscription, est stockée pour pouvoir comparer jusqu'à ce que l'utilisateur soit vérifié. Si L'utilisateur est vérifié, c'est mit à null (plus rien à vérifier)
        if ($user->getAVerifier() != null) {
            // renvoyer un mail ?

            // return $this->router->generate("verification_mail");
            throw new \Exception("Utilisateur non vérifié. Regardez vos mails.");
        }

        if (!$user instanceof AppUser) {
            return;
        }

        // user is deleted, show a generic Account Not Found message.
        if ($user->isDeleted()) {
            throw new AccountDeletedException();
        }
    }

    public function checkPostAuth(UserInterface $user)
    {
        if (!$user instanceof AppUser) {
            return;
        }

        // user account is expired, the user may be notified
        if ($user->isExpired()) {
            throw new AccountExpiredException('...');
        }
    }
}
