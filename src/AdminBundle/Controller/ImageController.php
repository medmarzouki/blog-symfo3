<?php
namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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


    /**
     * @Route("/create", name="image_create")
     * @Method({"GET"})
     */
    public function create()
    {
        $image = new Image();

        $form = $this->createFormBuilder($image)
                     ->add('src', TextType::class)
                     ->add("alt", TextType::class)
                     ->add("width", TextType::class)
                     ->add("height", TextType::class)
                     ->add("save", SubmitType::class, ["label" => "Enregistrer"])
                     ->getForm();

        return $this->render("AdminBundle:Image:create.html.twig", [
                    "form" => $form->createView()
                ]);
    }
}