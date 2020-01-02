<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Person;
use App\Form\PersonDto;
use App\Form\PersonDtoType;
use App\Repository\PersonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/persons")
 */
class PersonController extends AbstractController
{
    /**
     * @Route("", name="personList")
     */
    public function home(PersonRepository $personRepository): Response
    {
        return $this->render('admin/personList.html.twig', [
            'persons' => $personRepository->findAll(),
        ]);
    }

    /**
     * @Route("/create", name="personCreate")
     */
    public function create(PersonRepository $personRepository, Request $request): Response
    {
        $personDto = PersonDto::newInstance();

        return $this->processPersonForm($personRepository, $request, $personDto, true);
    }

    /**
     * @Route("/{person}", name="personRead")
     */
    public function read(Person $person): Response
    {
        return $this->render('admin/person.html.twig', [
            'person' => $person,
        ]);
    }

    /**
     * @Route("/{person}/update", name="personUpdate")
     */
    public function update(PersonRepository $personRepository, Request $request, Person $person): Response
    {
        $personDto = PersonDto::newInstanceFromPerson($person);

        return $this->processPersonForm($personRepository, $request, $personDto, false);
    }

    /**
     * @Route("/{person}/delete", name="personDelete")
     */
    public function delete(PersonRepository $personRepository, Request $request, Person $person): Response
    {
        if ($request->isMethod('POST')) {
            if ($person->canDelete()) {
                $personRepository->delete($person);
                $this->addFlash(FlashLevels::SUCCESS, "Person {$person->getName()} has been deleted");
            } else {
                $this->addFlash(FlashLevels::DANGER, "Could not delete person {$person->getName()}");
            }

            return $this->redirectToRoute('personList');
        }

        return $this->render('admin/personDelete.html.twig', [
            'person' => $person,
        ]);
    }

    private function processPersonForm(
        PersonRepository $personRepository,
        Request $request,
        PersonDto $personDto,
        bool $isCreate
    ): Response {
        $form = $this->createForm(PersonDtoType::class, $personDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $person = $personDto->asPerson();
            $personRepository->persist($person);
            $message = "Person {$person->getName()} ".($isCreate ? 'created' : 'updated');
            $this->addFlash(FlashLevels::SUCCESS, $message);

            return $this->redirectToRoute('personList');
        }

        return $this->render('admin/personForm.html.twig', [
            'isCreate' => $isCreate,
            'form' => $form->createView(),
        ]);
    }
}
