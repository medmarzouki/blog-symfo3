<?php

namespace ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/portfolio", name="portfolio")
 * Class PortfolioController
 * @package ClientBundle\Controller
 */
class PortfolioController extends Controller
{
    /**
     * @Route("/", name="portfolio.index")
     * @Method({"GET"})
     */
    public function indexAction()
    {
        return $this->render('ClientBundle:Portfolio:index.html.twig', array());
    }

    /**
     * @Route("/{id}/edit")
     * @Method({"GET", "POST"})
     */
    public function editAction($id)
    {
        return $this->render('ClientBundle:Portfolio:edit.html.twig', array());
    }

    /**
     * @Route("/create")
     * @Method({"GET", "POST"})
     */
    public function createAction()
    {
        return $this->render('ClientBundle:Portfolio:create.html.twig', array());
    }

    /**
     * @Route("/{id}/delete")
     * @Method({"DELETE"})
     */
    public function deleteAction($id)
    {
        return $this->render('ClientBundle:Portfolio:delete.html.twig', array());
    }

    /**
     * @Route("/{id}/show")
     * @Method({"GET"})
     */
    public function showAction($id)
    {
        return $this->render('ClientBundle:Portfolio:show.html.twig', array());
    }

}
