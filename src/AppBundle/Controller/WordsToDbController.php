<?php

namespace AppBundle\Controller;

//use AppBundle\Form\UserType;
//use AppBundle\Entity\User;
use AppBundle\Form\WordType;
use AppBundle\Entity\Word;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class WordsToDbController extends Controller
{
    /**
     * @Route("/wordsToDb", name="user_wordstodb")
     */
    public function wordsToDbAction(Request $request)
    {

        $word = new Word();

        $form = $this->createForm(new WordType(), $word);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($word);
            $em->flush(); 
        }       

        return $this->render('wordstodb/wordstodb.html.twig', array(
                       'form' => $form->createView() 
                       ));
 


        // replace this example code with whatever you need
        //return $this->render('default/index.html.twig', array(
        //    'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        //));
    }
}
