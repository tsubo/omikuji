<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Unsei;

/**
 * @Route("/unsei")  // ①
 */
class UnseiController extends Controller
{
    /**
     * @Route("/validate/{name}", defaults={"name" = ""}) // ②
     */
    public function validateAction($name)
    {
        $unsei = new Unsei();   // ③
        $unsei->setName($name);

        $validator = $this->get('validator');    // ④
        $errors = $validator->validate($unsei);  // ⑤

        if (count($errors) > 0) {
            return $this->render('unsei/validate.html.twig', [ // ⑥
                'errors' => $errors,
            ]);
        }

        return new Response("「{$name}」は正しい運勢です！"); // ⑦
    }
}