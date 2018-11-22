<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 21.11.2018
 * Time: 16:19
 */

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends FOSRestController
{
    /**
     * Lists all Users.
     * @FOSRest\Get("/users")
     *
     * @return View
     */
    public function getUserAction()
    {
        $repository = $this->getDoctrine()->getRepository(User::class);

        $users = $repository->findall();

        return $this->view($users, Response::HTTP_OK, []);
    }

    /**
     * Create User.
     * @FOSRest\Post("/users")
     *
     * @param Request $request
     * @return User
     * @throws HttpException
     */
    public function postUserAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $user;
        }

        throw new HttpException(400, "Invalid data");
    }

    /**
     * Get User info.
     * @FOSRest\Get("/users/{id}")
     *
     * @param $id
     * @return User|View
     */
    public function getUserInfoAction($id)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);

        $user = $repository->findOneBy(['id' => $id]);

        if ($user == null) {
            return $this->view(['code' => 404, 'error' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        return $user;
    }

    /**
     * Edit User info.
     * @FOSRest\Put("/users/{id}")
     *
     * @param Request $request
     * @param $id
     * @return User|View
     * @throws HttpException
     */
    public function editUserAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($id);

        if ($user == null) {
            return $this->view(['code' => 404, 'error' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(UserType::class, $user, ['method' => 'PUT']);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($user);
            $em->flush();

            return $user;
        }

        throw new HttpException(400, "Invalid data");
    }
}
