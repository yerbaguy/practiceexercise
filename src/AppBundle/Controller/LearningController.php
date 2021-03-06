<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Word;
use AppBundle\Entity\RandEng;
use AppBundle\Entity\RandPl;
use AppBundle\Entity\WordRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class LearningController extends Controller
{

    /**
     * @Route("/learning", name="user_learning")
     */
    public function learningAction(Request $request)
    {

        $request = $this->getRequest();

        //var_dump($word = new Word());
        $word = new Word();


        $formBuilderOne = $this->container
                       ->get('form.factory')
                       ->createNamedBuilder('formOne', 'form', NULL, array('validation_groups' => array()))
                       ->add('pulltheword', 'submit');

        $formOne = $formBuilderOne
                ->getForm()
                ->handleRequest($request);


        $formBuilderTwo = $this->container
                ->get('form.factory')
                ->createNamedBuilder('formTwo', 'form', NULL, array('validation_groups' => array()))
                ->add('engWord', 'text')
                ->add('submit', 'submit');

        $formTwo = $formBuilderTwo
                ->getForm()
                ->handleRequest($request);


        $formBuilderThree = $this->container
                         ->get('form.factory')
                         ->createNamedBuilder('formThree', 'form', NULL, array('validation_groups' => array()))
                         ->add('support', 'submit');
        $formThree = $formBuilderThree
                  ->getForm()
                  ->handleRequest($request);


         if ($formOne->isSubmitted() && $formOne->isValid()) {

             $data = $request->request->all();
             json_encode($randengword = $data['formOne']['pulltheword']);
             if ($formOne->get('pulltheword')->isClicked()) {
                 //var_dump($count = $this->countingRows());
                          $count = $this->countingRows();
                 $random = random_int(1, $count);
                 json_encode($pulltheword = $this->pulltheword($random));
                 echo "pulltheword:".$pulltheword[0]['plWord']."</br>";
                     $randpltable = $this->ifThereIsAnythingInTheRandPlTable();
                     if ($randpltable == null) {
                         $this->insertRandomPlIntoDb($random);
                     }
                     else
                     {
                         $this->updateRandomPlIntoDb($random);
                     }

             }




         }


         if ($formTwo->isSubmitted() && $formTwo->isValid()) {
            $engwordfromdb[0] = isset($engwordfromdb[0]) ? $engwordfromdb[0] : null;
            $random[0] = isset($random[0]) ? $random[0] : null;


             $data = $request->request->all();
             $engWord_typed = $data['formTwo']['engWord'];
              echo $engWord_typed."</br>";
             $engWord = $engWord_typed;
             if (!$engwordfromdb = $this->takeTheWord($engWord))
                 echo "The wanted word wasn't found in the database."."</br>";



             json_encode($engwordfromdb = $this->takeTheWord($engWord));
             $random = $this->ifThereIsAnythingInTheRandPlTable();


             if ($engwordfromdb['0']['id'] == $random['0']['randPlWord']) {
                 echo "Correct.";
             }
             else
             {
                 echo "Wrong.";

             }
           }


           if ($formThree->isSubmitted() && $formThree->isValid()) {
             $random = $this->ifThereIsAnythingInTheRandPlTable();
             $random_ = $random['0']['randPlWord']."</br>";
             $supporteng = $this->supportEng($random_);
             echo "The english required word is:"."</br>";
             echo $supporteng['0']['engWord']."</br>";
           }


        return $this->render('learning/learning.html.twig', array(
                       'formOne' => $formOne->createView(),
                       'formTwo' => $formTwo->createView(),
                       'formThree' => $formThree->createView()

                       ));

    }


    public function countingRows()
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Word');
        return $count = $repository->count();
    }

    public function pullTheWord($random)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Word');
        $pull = $repository->pullTheWord($random);
        return $ppull = $pull->getArrayResult();
    }

    public function ifThereIsAnythingInTheRandEngTable()
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:RandEng');
        $ifanything = $repository->isAnything();
        return $ifthereisanything = $ifanything->getArrayResult();
    }

    public function ifThereIsAnythingInTheRandPlTable()
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:RandPl');
        $ifanything = $repository->isAnything();
        return $ifthereisanything = $ifanything->getArrayResult();
    }

    public function insertRandomEngIntoDb($random)
    {
        $randEng = new RandEng();

        $em = $this->getDoctrine()->getEntityManager();
        $randEng->setEngWord($random);
        $em->persist($randEng);
        $em->flush();

    }

    public function insertRandomPlIntoDb($random)
    {
        $randPl = new RandPl();

        $em = $this->getDoctrine()->getEntityManager();
        $randPl->setRandPlWord($random);
        $em->persist($randPl);
        $em->flush();
    }

    public function updateRandomEngIntoDb($random)
    {


         $em = $this->getDoctrine()->getManager();
         $query = $em->createQuery(
               'UPDATE AppBundle:RandEng u WHERE u.randEngWord = :random'
               )->setParameter('random', $random);

         return $randengword = $query->getResult();


    }

    public function updateRandomPlIntoDb($random)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
              'UPDATE AppBundle:RandPl u WHERE u.randPlWord = :random'
              )->setParameter('random', $random);
        return $randplword = $query->getResult();
    }

    public function takeTheWord($engWord)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Word');
        $taketheword = $repository->takeOut($engWord);
        return $iftakentheword = $taketheword->getArrayResult();
    }

    public function supportEng($random)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Word');
        $supporteng = $repository->supportEng($random);
        return $usesupporteng = $supporteng->getArrayResult();
    }












  //  /**
  //   * @Route("/", name="homepage")
  //   */
  //  public function indexAction(Request $request)
  //  {
  //      // replace this example code with whatever you need
  //      return $this->render('default/index.html.twig', array(
  //          'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
  //      ));
  //  }
}
