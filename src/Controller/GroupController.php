<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 21.11.2018
 * Time: 17:19
 */

namespace App\Controller;

use App\Entity\Group;
use App\Form\GroupType;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GroupController extends FOSRestController
{
    /**
     * Lists all Groups.
     * @FOSRest\Get("/groups")
     *
     * @return View
     */
    public function getGroupAction()
    {
        $repository = $this->getDoctrine()->getRepository(Group::class);

        $groups = $repository->findall();

        return $this->view($groups, Response::HTTP_OK, []);
    }

    /**
     * Create Group.
     * @FOSRest\Post("/groups")
     *
     * @param Request $request
     * @return Group
     * @throws HttpException
     */
    public function postGroupAction(Request $request)
    {
        $group = new Group();
        $form = $this->createForm(GroupType::class, $group);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($group);
            $em->flush();

            return $group;
        }

        throw new HttpException(400, "Invalid data");
    }

    /**
     * Group info.
     * @FOSRest\Get("/groups/{id}")
     *
     * @param $id
     * @return Group|View
     */
    public function getGroupInfoAction($id)
    {
        $repository = $this->getDoctrine()->getRepository(Group::class);

        $group = $repository->findOneBy(['id' => $id]);

        if ($group == null) {
            return $this->view(['code' => 404, 'error' => 'Group not found'], Response::HTTP_NOT_FOUND);
        }

        return $group;
    }

    /**
     * Edit Group.
     * @FOSRest\Put("/groups/{id}")
     *
     * @param Request $request
     * @param $id
     * @return Group|View
     * @throws HttpException
     */
    public function editGroupAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $group = $em->getRepository(Group::class)->find($id);

        if ($group == null) {
            return $this->view(['code' => 404, 'error' => 'Group not found'], Response::HTTP_NOT_FOUND);
        }

        $form = $this->createForm(GroupType::class, $group, ['method' => 'PUT']);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($group);
            $em->flush();

            return $group;
        }

        throw new HttpException(400, "Invalid data");
    }
}
