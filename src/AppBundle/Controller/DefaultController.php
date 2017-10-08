<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Bubble;
use AppBundle\Form\BubbleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Bubble::class);

        // Get all bubbles for slide show.
        $bubbles = $repository->findBy(array(), array(
            'id' => 'DESC',
        ));

        return $this->render('default/index.html.twig', [
            'bubbles' => $bubbles,
        ]);
    }

    /**
     * @Route("/bubble/list", name="bubble_list")
     */
    public function bubbeList() {
        $repository = $this->getDoctrine()->getRepository(Bubble::class);

        // Get all bubbles for list.
        $bubbles = $repository->findBy(array(), array(
            'id' => 'DESC',
        ));

        // replace this example code with whatever you need
        return $this->render('default/bubble_list.html.twig', [
            'bubbles' => $bubbles,
        ]);
    }

    /**
     * @Route("/bubble/delete/{id}", name="bubble_delete", requirements={"id": "\d+"})
     */
    public function bubbleDeleteAction($id, Request $request) {
        $repository = $this->getDoctrine()->getRepository(Bubble::class);
        $bubble = $repository->find($id);

        // Remove it
        $em = $this->getDoctrine()->getManager();
        $em->remove($bubble);
        $em->flush();

        return $this->redirectToRoute('bubble_list');
    }

    /**
     * @Route("/bubble/add", name="bubble_add")
     */
    public function bubbleAddAction(Request $request)
    {
        $bubble = new Bubble();
        $bubble->setTitle('Demokrati er...');

        $form = $this->createForm(BubbleType::class, $bubble);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $data = $form->getData();

            // The bubble object should be validated and updated by now.
            $em->persist($bubble);

            $em->flush();

            return $this->redirectToRoute('homepage');
        }


        return $this->render('default/bubble_add.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
