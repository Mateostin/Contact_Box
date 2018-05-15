<?php

namespace ContactBundle\Controller;

use ContactBundle\Entity\Person;
use ContactBundle\Entity\Email;
use ContactBundle\Entity\Phone;
use ContactBundle\Entity\Address;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Route("/person")
 */
class PersonController extends Controller
{
    /**
     * @Route("/new", methods={"GET"})
     */
    public function newGetAction()
    {
        return $this->render('ContactBundle/new.html.twig', array());
    }

    /**
     * @Route("/new", methods={"POST"}, name="postNew")
     * @param Request $request
     */
    public function newPostAction(Request $request)
    {
        // NEW OBJECTS OF ENTITY
        $person = new Person();
        $address = new Address();
        $email = new Email();
        $phone = new Phone();

        // SET PERSON VALUE
        $person->setName($request->get('name'));
        $person->setSurname($request->get('surname'));
        $person->setDescription($request->get('description'));

        // SET ADDRESS VALUE
        $address->setCity($request->get('city'));
        $address->setStreet($request->get('street'));
        $address->setStreetnumber($request->get('streetnumber'));
        $address->setHousenumber($request->get('housenumber'));
        $address->setPerson($person);

        // SET PHONE VALUE
        $phone->setPhoneNumber($request->get('phone'));
        $phone->setType($request->get('phonetype'));
        $phone->setPerson($person);

        // SET EMAIL VALUE
        $email->setEmailAddress($request->get('email'));
        $email->setType($request->get('emailtype'));
        $email->setPerson($person);

        // ~~~ SAVE PERSON ~~~
        $emPerson = $this->getDoctrine()->getManager();
        $emPerson->persist($person);
        $emPerson->flush();

        // ~~~ SAVE ADDRESS ~~~
        $emAddress = $this->getDoctrine()->getManager();
        $emAddress->persist($address);
        $emAddress->flush();

        // ~~~ SAVE PHONE ~~~
        $emPhone = $this->getDoctrine()->getManager();
        $emPhone->persist($phone);
        $emPhone->flush();

        // ~~~ SAVE Email ~~~
        $emEmail = $this->getDoctrine()->getManager();
        $emEmail->persist($email);
        $emEmail->flush();

        return new Response('New post - id:'
            . $person->getId());
    }

    /**
     * @Route("/{id}/modify", methods={"GET"})
     */
    public function modifyGetAction($id)
    {
        $person = $this->getDoctrine()->getRepository(Person::class)->findBy(['id' => $id]);

        $addressArray = $person[0]->getAddresses();
        $phoneArray = $person[0]->getPhones();
        $emailArray = $person[0]->getEmails();

        return $this->render('ContactBundle/modify.html.twig', array(
            "id" => $person[0]->getId(),
            "name" => $person[0]->getName(),
            "surname" => $person[0]->getSurname(),
            "description" => $person[0]->getDescription(),
            "city" => $addressArray[0]->getCity(),
            "street" => $addressArray[0]->getStreet(),
            "streetnumber" => $addressArray[0]->getStreetnumber(),
            "housenumber" => $addressArray[0]->getHousenumber(),
            "phone" => $phoneArray[0]->getPhoneNumber(),
            "phonetype" => $phoneArray[0]->getType(),
            "email" => $emailArray[0]->getEmailAddress(),
            "emailtype" => $emailArray[0]->getType(),
        ));
    }

    /**
     * @Route("/{id}/modify", methods={"POST"}, name="modifyPost")
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function modifyPostAction(Request $request, $id)
    {
        // NEW OBJECTS OF ENTITY
        $person = $this->getDoctrine()->getRepository(Person::class)->findBy(['id' => $id]);
        $addressArray = $person[0]->getAddresses();
        $phoneArray = $person[0]->getPhones();
        $emailArray = $person[0]->getEmails();

        // SET PERSON VALUE
        $person[0]->setName($request->get('name'));
        $person[0]->setSurname($request->get('surname'));
        $person[0]->setDescription($request->get('description'));

        // SET ADDRESS VALUE
        $addressArray[0]->setCity($request->get('city'));
        $addressArray[0]->setStreet($request->get('street'));
        $addressArray[0]->setStreetnumber($request->get('streetnumber'));
        $addressArray[0]->setHousenumber($request->get('housenumber'));

        // SET PHONE VALUE
        $phoneArray[0]->setPhoneNumber($request->get('phone'));
        $phoneArray[0]->setType($request->get('phonetype'));

        // SET EMAIL VALUE
        $emailArray[0]->setEmailAddress($request->get('email'));
        $emailArray[0]->setType($request->get('emailtype'));

        // ~~~ SAVE PERSON ~~~
        $emPerson = $this->getDoctrine()->getManager();
        $emPerson->persist($person[0]);
        $emPerson->flush();

        // ~~~ SAVE ADDRESS ~~~
        $emAddress = $this->getDoctrine()->getManager();
        $emAddress->persist($addressArray[0]);
        $emAddress->flush();

        // ~~~ SAVE PHONE ~~~
        $emPhone = $this->getDoctrine()->getManager();
        $emPhone->persist($phoneArray[0]);
        $emPhone->flush();

        // ~~~ SAVE Email ~~~
        $emEmail = $this->getDoctrine()->getManager();
        $emEmail->persist($emailArray[0]);
        $emEmail->flush();

        return new Response('Edycja przebiegła pomyślnie');
    }

    /**
     * @Route("/{id}/delete", methods={"GET"}, name="delete")
     */
    public function DeleteAction()
    {
        return $this->render('ContactBundle/new.html.twig', array(// ...
        ));
    }

    /**
     * @Route("/{id}", methods={"GET"})
     */
    public function oneEntityAction($id)
    {
        $person = $this->getDoctrine()
            ->getRepository(Person::class)
            ->findOneBy(['id' => $id]);

        return $this->render('ContactBundle/contact.html.twig', array(
            'contact' => $person
        ));
    }

    /**
     * @Route("/", methods={"GET"})
     */
    public function AllEntityAction()
    {

        $persons = $this->getDoctrine()
            ->getRepository(Person::class)
            ->findBy([], ['name' => 'ASC']);

        $letters = [];
        foreach ($persons as $person) {

            $firstLetter = substr($person->getName(), 0, 1);
            $letters[$firstLetter][] = [
                'id' => $person->getId(),
                'name' => $person->getName(),
                'surname' => $person->getSurname(),
                'address' => $person->getAddresses()];
        }

        return $this->render('ContactBundle/allEntity.html.twig', array(
            'letters' => $letters
        ));
    }

    /**
     * @Route("/search/", methods={"GET"}, name="search")
     */
    public function searchAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === "GET") {
            if ($_GET['search'] && isset($_GET['search'])) {

                $persons = $this->getDoctrine()->getRepository(Person::class)->createQueryBuilder('contact_searcher')
                    ->where('contact_searcher.name LIKE :name OR contact_searcher.surname LIKE :surname')
                    ->setParameter('name', "%$_GET[search]%")
                    ->setParameter('surname', "%$_GET[search]%")
                    ->getQuery()
                    ->getResult();

                $letters = [];
                foreach ($persons as $person) {

                    $firstLetter = substr($person->getName(), 0, 1);
                    $letters[$firstLetter][] = [
                        'id' => $person->getId(),
                        'name' => $person->getName(),
                        'surname' => $person->getSurname(),
                        'address' => $person->getAddresses()];
                }

                return $this->render('ContactBundle/allEntity.html.twig', array(
                    'letters' => $letters
                ));
            }
        }
    }
}
