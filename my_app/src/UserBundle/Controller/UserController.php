<?php
/**
 * User controller.
 */

namespace UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserController.
 *
 * @package UserBundle\Controller
 *
 * @Route("/user")
 */
class UserController extends Controller
{
    /**
     * Index action.
     *
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/",
     *     name="user_index",
     * )
     * @Method("GET")
     */
    public function indexAction()
    {
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();

        return $this->render(
            'user/index.html.twig',
            ['users' => $users]
        );
    }

    /**
     * Delete action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request  HTTP Request
     * @param string                                    $username Username
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/{username}/delete",
     *     name="user_delete",
     * )
     * @Method({"GET", "POST"})
     */
    public function deleteAction(Request $request, $username)
    {
        $userManager = $this->get('fos_user.user_manager');

        $user = $userManager->findUserByUsername($username);
        $users = $userManager->findUsers();
        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for username '.$username
            );
        } else {
            if (count($users) > 1) {
                $form = $this->createForm(FormType::class, $user);
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    $userManager->deleteUser($user);
                    $this->addFlash('success', 'message.deleted_successfully');

                    return $this->redirectToRoute('user_index');
                }

                return $this->render(
                    'user/delete.html.twig',
                    [
                        'user' => $user,
                        'form' => $form->createView(),
                    ]
                );
            } else {
                $this->addFlash('warning', 'message.cant_delete');

                return $this->redirectToRoute('user_index');
            }
        }
    }
}
