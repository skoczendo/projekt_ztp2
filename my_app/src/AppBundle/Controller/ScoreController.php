<?php
/**
 * Score controller.
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Competition;
use AppBundle\Entity\Score;
use AppBundle\Form\ScoreType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ScoreController.
 *
 * @package AppBundle\Controller
 *
 * @Route("/score")
 */
class ScoreController extends Controller
{

    /**
     * Add action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP Request
     *
     * @param integer $competition_id Competition id
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/add/{competition_id}",
     *     name="score_add",
     * )
     * @Method({"GET", "POST"})
     */
    public function addAction(Request $request, $competition_id)
    {
        $competition = $this->get('app.repository.competition')->findOneById($competition_id);
        if (!$competition) {
            throw $this->createNotFoundException(
                'No competition found for id '.$competition_id
            );
        } else {
            $score = new Score();
            $score->setCompetition($competition);
            dump($score);
            $form = $this->createForm(ScoreType::class, $score);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->get('app.repository.score')->save($score);
                $this->addFlash('success', 'message.created_successfully');

                return $this->redirectToRoute('competition_view',
                    array(
                        'id' => $competition_id,
                        )
                );
            }

            return $this->render(
                'score/add.html.twig',
                [
                    'score' => $score,
                    'form' => $form->createView(),
                    'competition_id' => $competition_id,
                ]
            );
        }
    }

    /**
     * Edit action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP Request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/{id}/edit",
     *     name="score_edit",
     *     requirements={"page": "[1-9]\d*"},
     * )
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Score $score){
        $form = $this->createForm(ScoreType::class, $score);
        $form->handleRequest($request);
        $competition_id = $score->getCompetition()->getId();

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.score')->save($score);
            $this->addFlash('success', 'message.created_successfully');
            //dump($competition_id);
            return $this->redirectToRoute('competition_view',
                array(
                    'id' => $competition_id,
                )
            );
        }

        return $this->render(
            'score/edit.html.twig',
            [
                'score' => $score,
                'form' => $form->createView(),
                'competition_id' => $competition_id,
            ]
        );
    }

    /**
     * Delete action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP Request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/{id}/delete",
     *     name="score_delete",
     *     requirements={"page": "[1-9]\d*"},
     * )
     * @Method({"GET", "POST"})
     */
    public function deleteAction(Request $request,Score $score){
        $form = $this->createForm(FormType::class, $score);
        $form->handleRequest($request);
        $competition_id = $score->getCompetition()->getId();

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.score')->delete($score);
            $this->addFlash('success', 'message.deleted_successfully');

            return $this->redirectToRoute('competition_view',
                array(
                    'id' => $competition_id,
                )
            );
        }

        return $this->render(
            'score/delete.html.twig',
            [
                'score' => $score,
                'form' => $form->createView(),
                'competition_id' => $competition_id,
            ]
        );
    }
}