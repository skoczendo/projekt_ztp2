<?php
// src/UserBundle/Form/Handler/RegistrationFormHandler.php
/**
 * Custom form handler for FOSUserBundle
 */
namespace UserBundle\Form\Handler;

use FOS\UserBundle\Form\Handler\RegistrationFormHandler as BaseHandler;
use FOS\UserBundle\Model\UserInterface;

/**
 * Class RegistrationFormHandler.
 *
 * @package UserBundle\Form\Handler
 */
class RegistrationFormHandler extends BaseHandler
{
    protected function onSuccess(UserInterface $user, $confirmation)
    {
        $user->setRoles(['ROLE_ADMIN']);
        parent::onSuccess($user, $confirmation);
    }
}
