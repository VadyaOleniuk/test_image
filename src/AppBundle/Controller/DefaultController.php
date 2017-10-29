<?php

namespace AppBundle\Controller;

use AppBundle\Model\BuilderImage;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Gregwar\Image\Image;


class DefaultController extends Controller
{
    private $labelDescr1 = array
    (
        "TopMargin" => 0.5,
        "BottomMargin" => 0.5,
        "LeftMargin" => 0.1875,
        "RightMargin" => 0.1875,

        "HorizSpacing" => 0.125,
        "VertSpacing" => 0,

        "LabelSize" => array
        (
            "Width"=>2.625,
            "Height"=>1,
        ),

        "PaperSize" => array
        (
            "Width"=>8.5,
            "Height"=>11,
        ),

        "LabelTableSize" => array
        (
            "Width"=>3,
            "Height"=>10,
        ),
        'name'=>'test1'
    );
    private $labelDescr2 = array
    (
        "TopMargin" => 25.4,
        "BottomMargin" => 25.4,
        "LeftMargin" => 31.75,
        "RightMargin" => 31.75,

        "HorizSpacing" => 0,
        "VertSpacing" => 25.4,

        "LabelSize" => array
        (
            "Width"=>152.4,
            "Height"=>101.6,
        ),

        "PaperSize" => array
        (
            "Width"=>215.9,
            "Height"=>279.4,
        ),

        "LabelTableSize" => array
        (
            "Width"=>1,
            "Height"=>2,
        ),
        'name'=>'test2'
    );

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $img_1 = new BuilderImage($this->labelDescr1);
        $img_2 = new BuilderImage($this->labelDescr2);
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'img_1' => $img_1->getParams(200),
            'img_2' => $img_2->getParams(200)
        ]);
    }
}
