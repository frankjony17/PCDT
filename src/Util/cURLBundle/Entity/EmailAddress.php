<?php

namespace Util\cURLBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmailAddress
 *
 * @ORM\Table(name="email_address", uniqueConstraints={@ORM\UniqueConstraint(name="email_address_address_key", columns={"address"}), @ORM\UniqueConstraint(name="email_address_email_modulo_id_unidad_organizativa_id_key", columns={"email_modulo_id", "unidad_organizativa_id"})}, indexes={@ORM\Index(name="IDX_B08E074ECF74CADE", columns={"email_modulo_id"}), @ORM\Index(name="IDX_B08E074E7373B779", columns={"unidad_organizativa_id"})})
 * @ORM\Entity(repositoryClass="\Util\cURLBundle\Entity\EmailAddressRepository")
 */
class EmailAddress
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="email_address_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=50, nullable=false)
     */
    private $address;

    /**
     * @var \EmailModulo
     *
     * @ORM\ManyToOne(targetEntity="EmailModulo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="email_modulo_id", referencedColumnName="id")
     * })
     */
    private $emailModulo;

    /**
     * @var \UnidadOrganizativa
     *
     * @ORM\ManyToOne(targetEntity="\Otros\NomencladorBundle\Entity\UnidadOrganizativa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="unidad_organizativa_id", referencedColumnName="id")
     * })
     */
    private $unidadOrganizativa;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="\Seguridad\AdminBundle\Entity\Users")
     * @ORM\JoinTable(name="email_users",
     *      joinColumns={@ORM\JoinColumn(name="email_address_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="users_id", referencedColumnName="id")}
     * )
     */
    private $users;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return EmailAddress
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Get emailModulo
     *
     * @return \Util\cURLBundle\Entity\EmailModulo 
     */
    public function getEmailModulo()
    {
        return $this->emailModulo;
    }

    /**
     * Get unidadOrganizativa
     *
     * @return \Otros\NomencladorBundle\Entity\UnidadOrganizativa 
     */
    public function getUnidadOrganizativa()
    {
        return $this->unidadOrganizativa;
    }

    /**
     * Add users
     *
     * @param \Seguridad\AdminBundle\Entity\Users $users
     * @return EmailAddress
     */
    public function addUser(\Seguridad\AdminBundle\Entity\Users $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \Seguridad\AdminBundle\Entity\Users $users
     */
    public function removeUser(\Seguridad\AdminBundle\Entity\Users $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Set emailModulo
     *
     * @param \Util\cURLBundle\Entity\EmailModulo $emailModulo
     * @return EmailAddress
     */
    public function setEmailModulo(\Util\cURLBundle\Entity\EmailModulo $emailModulo = null)
    {
        $this->emailModulo = $emailModulo;

        return $this;
    }

    /**
     * Set unidadOrganizativa
     *
     * @param \Otros\NomencladorBundle\Entity\UnidadOrganizativa $unidadOrganizativa
     * @return EmailAddress
     */
    public function setUnidadOrganizativa(\Otros\NomencladorBundle\Entity\UnidadOrganizativa $unidadOrganizativa = null)
    {
        $this->unidadOrganizativa = $unidadOrganizativa;

        return $this;
    }
}
