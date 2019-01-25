<?php
namespace AdminBundle\Controller;

use AdminBundle\Repository\ImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
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

        return $this->render("AdminBundle:Image:index.hmtl.twig");
    }

    /**
     * @Route("/store", name="image_store")
     * @Method({"GET", "POST"})
     */
    public function store(Request $request) {

        $form = ((object)$request->request->get("form"));
        $em = $this->getDoctrine()->getManager();

        $image = new Image();

        $image->setAlt($form->alt)
              ->setSrc($form->src)
              ->setWidth($form->width)
              ->setHeight($form->height);

        $em->merge($image);
        $image->setAlt("denbasdsqdfs");

        $em->flush();

        //dump($em->getRepository(Image::class)->findAll());


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
                     ->setAction($this->generateUrl("image_store"))
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