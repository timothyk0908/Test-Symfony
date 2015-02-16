<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace TK\PresentationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use TK\PresentationBundle\Entity\Advert;
use TK\PresentationBundle\Entity\Image;

class AdvertController extends Controller
{


  public function indexAction($page)
  {

  	  $listAdverts = array(
      array(
        'title'   => 'Recherche développpeur Symfony2',
        'id'      => 1,
        'author'  => 'Alexandre',
        'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…',
        'date'    => new \Datetime()),
      array(
        'title'   => 'Mission de webmaster',
        'id'      => 2,
        'author'  => 'Hugo',
        'content' => 'Nous recherchons un webmaster capable de maintenir notre site internet. Blabla…',
        'date'    => new \Datetime()),
      array(
        'title'   => 'Offre de stage webdesigner',
        'id'      => 3,
        'author'  => 'Mathieu',
        'content' => 'Nous proposons un poste pour webdesigner. Blabla…',
        'date'    => new \Datetime())
    );


    return $this->render('PresentationBundle:Advert:index.html.twig', array(
    'listAdverts' => $listAdverts
  ));

  }

   public function menuAction($limit)
  {
    // On fixe en dur une liste ici, bien entendu par la suite
    // on la récupérera depuis la BDD !
    $listAdverts = array(
      array('id' => 2, 'title' => 'Recherche développeur Symfony2'),
      array('id' => 5, 'title' => 'Mission de webmaster'),
      array('id' => 9, 'title' => 'Offre de stage webdesigner')
    );

    return $this->render('PresentationBundle:Advert:menu.html.twig', array(
      'listAdverts' => $listAdverts
    ));
  }

  public function viewAction($id)
  {
    {
    // On récupère le repository
     $advert = $this->getDoctrine()
      ->getManager()
      ->find('PresentationBundle:Advert', $id);

    // $advert est donc une instance de OC\PlatformBundle\Entity\Advert
    // ou null si l'id $id  n'existe pas, d'où ce if :
    if (null === $advert) {
      throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
    }

    // Le render ne change pas, on passait avant un tableau, maintenant un objet
    return $this->render('PresentationBundle:Advert:view.html.twig', array(
      'advert' => $advert,
      'id' => $id
    ));
  }
  }

  public function addAction(Request $request)
  {
    $advert = new Advert();
    $advert->setTitle('Recherche développeur Symfony2.');
    $advert->setAuthor('Timothy Khoury');
    $advert->setContent("Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…");

    // Création de l'entité Image
    $image = new Image();
    $image->setUrl('http://sdz-upload.s3.amazonaws.com/prod/upload/job-de-reve.jpg');
    $image->setAlt('Job de rêve');

    $advert->setImage($image);

    $em = $this->getDoctrine()->getManager();

    $em->persist($advert);

    $em->flush();

    return $this->render('PresentationBundle:Advert:view.html.twig',array(
      'advert' => $advert
      ));

  }

  public function editAction($id, Request $request)
  {
    // Ici, on récupérera l'annonce correspondante à $id

    // Même mécanisme que pour l'ajout
    if ($request->isMethod('POST')) {
      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');

      return $this->redirect($this->generateUrl('presentation_view', array('id' => $id)));
    }

    return $this->render('PresentationBundle:Advert:edit.html.twig');
  }

  public function deleteAction($id)
  {

    return $this->render('PresentationBundle:Advert:delete.html.twig',array('id' => $id));
  }
}