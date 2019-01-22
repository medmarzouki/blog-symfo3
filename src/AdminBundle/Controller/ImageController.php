<?php
namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

use AdminBundle\Entity\Image;

/**
 * @Route("/image")
 * Class ImageController
 * @package AdminBundle\Controller
 */
class ImageController extends Controller
{
    private $em;

    public function __construct()
    {
    }

    /**
     * @Route("/", name="image_index")
     */
    public function index()
    {
        $images = $this->container->get("doctrine")->getManager()->getRepository(Image::class)->findAll();
        dump($images);
        return $this->render("AdminBundle:Image:index.hmtl.twig");
    }

    /**
     * @Route("/store", name="image_store")
     * @Method({"GET", "POST"})
     */
    public function store() {

        dump("test");
        $em = $this->container->get("doctrine")->getManager();

        $image = new Image();

        $image->setAlt("test hello world")
              ->setSrc("https://www.strategy-business.com/media/image/40297981_slide01.jpg")
              ->setWidth("480px")
              ->setHeight("100%");

        $em->persist($image);
        $em->flush();

        return $this->redirectToRoute("image_index");
    }
}