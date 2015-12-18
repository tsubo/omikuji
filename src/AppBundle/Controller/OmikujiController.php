<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Unsei;
use AppBundle\Repository\UnseiRepository;

class OmikujiController extends Controller
{
    /**
     * おみくじ運勢を表示する
     *
     * @Route("/omikuji/{yourname}", defaults={"yourname" = "YOU"}, name="omikuji")
     *
     * @param Request $request
     * @return Response
     */
    public function omikujiAction(Request $request, $yourname)
    {
//         $omikuji = ['大吉', '中吉', '小吉', '末吉', '凶'];

        /** @var UnseiRepository */
        $repository = $this->getDoctrine()->getRepository(Unsei::class);
        $omikuji = $repository->findAll();

        $number = rand(0, count($omikuji) - 1);

//         return new Response(
//             "<html><body>{$yourname}さんの運勢は $omikuji[$number] です。</body></html>"
//         );
        return $this->render('omikuji/omikuji.html.twig', [
            'name' => $yourname,
            'unsei' => $omikuji[$number],
        ]);
    }
}
