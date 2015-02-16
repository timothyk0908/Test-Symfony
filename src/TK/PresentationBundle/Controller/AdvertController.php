<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace TK\PresentationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
    // Ici, on récupérera l'annonce correspondante à l'id $id

    return $this->render('PresentationBundle:Advert:view.html.twig', array(
      'id' => $id
    ));
  }

  public function addAction(Request $request)
  {

    if ($request->isMethod('POST')) {

      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

      return $this->redirect($this->generateUrl('presentation_view', array('id' => 5)));
    }

    // Si on n'est pas en POST, alors on affiche le formulaire
    return $this->render('PresentationBundle:Advert:add.html.twig');
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