<?php

namespace ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Person
 *
 * @ORM\Table(name="person")
 * @ORM\Entity(repositoryClass="ContactBundle\Repository\PersonRepository")
 */
class Person
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=255)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     *	@ORM\OneToMany(targetEntity="ContactBundle\Entity\Address",	mappedBy="person")
     */
    private	$addresses;

    /**
     *	@ORM\OneToMany(targetEntity="ContactBundle\Entity\Phone",	mappedBy="person")
     */
    private	$phones;

    /**
     *	@ORM\OneToMany(targetEntity="ContactBundle\Entity\Email",	mappedBy="person")
     */
    private	$emails;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Person
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     *
     * @return Person
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Person
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->addresses = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add address
     *
     * @param \ContactBundle\Entity\Address $address
     *
     * @return Person
     */
    public function addAddress(\ContactBundle\Entity\Address $address)
    {
        $this->addresses[] = $address;

        return $this;
    }

    /**
     * Remove address
     *
     * @param \ContactBundle\Entity\Address $address
     */
    public function removeAddress(\ContactBundle\Entity\Address $address)
    {
        $this->addresses->removeElement($address);
    }

    /**
     * Get addresses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * Add phone
     *
     * @param \ContactBundle\Entity\Phone $phone
     *
     * @return Person
     */
    public function addPhone(\ContactBundle\Entity\Phone $phone)
    {
        $this->phones[] = $phone;

        return $this;
    }

    /**
     * Remove phone
     *
     * @param \ContactBundle\Entity\Phone $phone
     */
    public function removePhone(\ContactBundle\Entity\Phone $phone)
    {
        $this->phones->removeElement($phone);
    }

    /**
     * Get phones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhones()
    {
        return $this->phones;
    }

    /**
     * Add email
     *
     * @param \ContactBundle\Entity\Email $email
     *
     * @return Person
     */
    public function addEmail(\ContactBundle\Entity\Email $email)
    {
        $this->emails[] = $email;

        return $this;
    }

    /**
     * Remove email
     *
     * @param \ContactBundle\Entity\Email $email
     */
    public function removeEmail(\ContactBundle\Entity\Email $email)
    {
        $this->emails->removeElement($email);
    }

    /**
     * Get emails
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmails()
    {
        return $this->emails;
    }
}
