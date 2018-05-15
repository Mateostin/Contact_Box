<?php

namespace ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * address
 *
 * @ORM\Table(name="address")
 * @ORM\Entity(repositoryClass="ContactBundle\Repository\addressRepository")
 */
class Address
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
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=255)
     */
    private $street;

    /**
     * @var string
     *
     * @ORM\Column(name="streetnumber", type="string", length=255)
     */
    private $streetnumber;

    /**
     * @var int
     *
     * @ORM\Column(name="housenumber", type="integer")
     */
    private $housenumber;

    /**
     *	@ORM\ManyToOne(targetEntity="ContactBundle\Entity\Person",	inversedBy="addresses")
     *	@ORM\JoinColumn(name="person_id", referencedColumnName="id")
     */
    private	$person;


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
     * Set city
     *
     * @param string $city
     *
     * @return address
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set street
     *
     * @param string $street
     *
     * @return address
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set streetnumber
     *
     * @param integer $streetnumber
     *
     * @return address
     */
    public function setStreetnumber($streetnumber)
    {
        $this->streetnumber = $streetnumber;

        return $this;
    }

    /**
     * Get streetnumber
     *
     * @return int
     */
    public function getStreetnumber()
    {
        return $this->streetnumber;
    }

    /**
     * Set housenumber
     *
     * @param integer $housenumber
     *
     * @return address
     */
    public function setHousenumber($housenumber)
    {
        $this->housenumber = $housenumber;

        return $this;
    }

    /**
     * Get housenumber
     *
     * @return int
     */
    public function getHousenumber()
    {
        return $this->housenumber;
    }

    /**
     * Set person
     *
     * @param \ContactBundle\Entity\Person $person
     *
     * @return Address
     */
    public function setPerson(\ContactBundle\Entity\Person $person = null)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return \ContactBundle\Entity\Person
     */
    public function getPerson()
    {
        return $this->person;
    }
}
