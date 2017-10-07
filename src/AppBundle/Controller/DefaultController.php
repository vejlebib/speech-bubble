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

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'bubbles' => $bubbles,
        ]);
    }

    /**
     * @Route("/bubble/add", name="bubble_add")
     */
    public function bubbleAddAction(Request $request, EntityManagerInterface $em)
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
