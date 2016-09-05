<?php

namespace QuackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use QuackBundle\Entity\User;
use QuackBundle\Entity\Status;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;


class StatusController extends Controller
{
    /**
     * @Route("/postStatus", name="postStatus")
     * @Method({"POST"})
     */
    public function postStatusAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $userId = $request->request->get('user-id');
        $user = $this->getDoctrine()->getRepository('QuackBundle:User')->findOneById($userId);

        $newStatus = new Status;
        $newStatus->setContent($request->request->get('post-status'));
        $newStatus->setUser($user);

        $em->persist($newStatus);
        $em->flush();

        return new RedirectResponse($this->generateUrl('userById', ['username' => $user->getUsername()]));

    }


}
