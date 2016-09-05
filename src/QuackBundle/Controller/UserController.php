<?php

namespace QuackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use QuackBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;


class UserController extends Controller
{
    /**
     * @Route("/users", name="users")
     */
    public function getUsersAction()
    {
        $users = $this->getDoctrine()
            ->getRepository('QuackBundle:User')
            ->findAll();

        if (!$users) {
            throw $this->createNotFoundException(
                'No users found.'
            );
        }

        return $this->render('QuackBundle:User:getUsers.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * @Route("/user/{username}", name="userById")
     */
    public function getUserByIdAction($username)
    {
        $user = $this->getDoctrine()
            ->getRepository('QuackBundle:User')
            ->findOneBy(array('username' => $username));

        if (!$user) {
            throw $this->createNotFoundException(
                'No user found.'
            );
        }

        return $this->render('QuackBundle:User:getUserById.html.twig', array(
            'user' => $user,
        ));
    }

    /**
     * @Route("/followers/{id}", name="user")
     */
    public function getFollowers($id) {

        $em = $this->getDoctrine()->getEntityManager();
        $connection = $em->getConnection();
        $statement = $connection->prepare("
            SELECT u.username, f.user_id, f.friend_user_id
            FROM user as u
            JOIN friends as f
            ON u.id=f.user_id
            WHERE id = :id
            ");
        $statement->bindValue('id', $id);
        $statement->execute();
        $results = $statement->fetchAll();

        if (!$results) {
            throw $this->createNotFoundException(
                'No product found.'
            );
        }

        $serializer = $this->container->get('serializer');

        $response = new Response($serializer->serialize($results, 'json'));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

}
