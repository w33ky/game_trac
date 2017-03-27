<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Game;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $new_game = new Game();

        $formbuilder = $this->createFormBuilder($new_game);
        $formbuilder->add('name', TextType::class, array('label' => false));
        $formbuilder->add('platform', TextType::class, array('label' => false));
        $formbuilder->add('save', SubmitType::class, array('label' => 'hinzufügen'));
        $form = $formbuilder->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $new_game->setLastPlayed(new \DateTime());
            $new_game->setIsFinished(false);
            $new_game->setIsDropped(false);

            $em->persist($new_game);
            $em->flush();
        }

        $existing_games = $em->getRepository('AppBundle:Game')->findAll();
        return $this->render('default/list.html.twig', ['form' => $form->createView(), 'games' => $existing_games]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var Game $game */
        $game = $em->getRepository('AppBundle:Game')->findOneBy(['id' => $id]);
        $em->remove($game);
        $em->flush();

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/playedtoday/{id}", name="playedtoday")
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function playedTodayAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var Game $game */
        $game = $em->getRepository('AppBundle:Game')->findOneBy(['id' => $id]);
        $game->setLastPlayed(new \DateTime());
        $em->flush();

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/finish/{id}", name="finish")
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function finishAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var Game $game */
        $game = $em->getRepository('AppBundle:Game')->findOneBy(['id' => $id]);
        if ($game->getIsFinished()) $game->setIsFinished(false);
        else $game->setIsFinished(true);
        $em->flush();

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/drop/{id}", name="drop")
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function dropAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var Game $game */
        $game = $em->getRepository('AppBundle:Game')->findOneBy(['id' => $id]);
        if ($game->getIsDropped()) $game->setIsDropped(false);
        else $game->setIsDropped(true);
        $em->flush();

        return $this->redirectToRoute('homepage');
    }
}
