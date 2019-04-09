<?php

namespace Seguridad\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Encoder\Pbkdf2PasswordEncoder;

/**
 * Users
 *
 * @ORM\Table(name="users", uniqueConstraints={@ORM\UniqueConstraint(name="users_username_key", columns={"username"}), @ORM\UniqueConstraint(name="users_trabajador_id_key", columns={"trabajador_id"})})
 * @ORM\Entity(repositoryClass="\Seguridad\AdminBundle\Entity\UsersRepository")
 */
class Users implements UserInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=25, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=64, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="correo", type="string", length=50, nullable=true)
     */
    private $correo;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_last_login", type="date", nullable=true)
     */
    private $dateLastLogin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time_last_login", type="time", nullable=true)
     */
    private $timeLastLogin;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=true)
     */
    private $isActive;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Roles", inversedBy="user")
     * @ORM\JoinTable(name="user_role",
     *   joinColumns={
     *     @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     *   }
     * )
     */
    private $role;

    /**
     * @var integer
     *
     * @ORM\Column(name="trabajador_id", type="integer", nullable=false)
     */    
    private $trabajador_id;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->role = new \Doctrine\Common\Collections\ArrayCollection();
    }

#------------------------------------------------------------------------------#
    public function getUsername()
    {
        return $this->username;
    }
    
    public function getPassword()
    {
        return $this->password;
    }   
    
    public function eraseCredentials()
    {        
    }

    public function getRoles()
    {
        $array_roles = array();
        
        foreach ($this->role as $role)
        {
            $array_roles[] = $role->getRole();
        }
        
        return $array_roles;
    }

    public function getSalt()
    {
        return \FALSE;
    }    
#------------------------------------------------------------------------------#
    
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
     * Set username
     *
     * @param string $username
     * @return Users
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }
    
    /**
     * Set password
     *
     * @param string $password
     * @return Users
     */
    public function setPassword($password)
    {
        $pbkdf2 = new Pbkdf2PasswordEncoder();
        
        $this->password = $pbkdf2->encodePassword($password, $this->getSalt());
        
        return $this;
    }
    
    /**
     * Set email
     *
     * @param string $email
     * @return Users
     */
    public function setEmail($email)
    {
        $this->correo = $email;

        return $this;
    }
    
    /**
     * Set dateLastLogin
     *
     * @param \DateTime $dateLastLogin
     * @return Users
     */
    public function setDateLastLogin($dateLastLogin)
    {
        $this->dateLastLogin = $dateLastLogin;

        return $this;
    }

    /**
     * Set timeLastLogin
     *
     * @param \DateTime $timeLastLogin
     * @return Users
     */
    public function setTimeLastLogin($timeLastLogin)
    {
        $this->timeLastLogin = $timeLastLogin;

        return $this;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Users
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Set trabajador_id
     *
     * @param integer $trabajadorId
     * @return Users
     */
    public function setTrabajadorId($trabajadorId)
    {
        $this->trabajador_id = $trabajadorId;

        return $this;
    }
    
    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->correo;
    }    
    
    /**
     * Get dateLastLogin
     *
     * @return \DateTime 
     */
    public function getDateLastLogin()
    {
        return $this->dateLastLogin;
    }
    
    /**
     * Get timeLastLogin
     *
     * @return \DateTime 
     */
    public function getTimeLastLogin()
    {
        return $this->timeLastLogin;
    }
    
    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
    
    /**
     * Get trabajador_id
     *
     * @return integer 
     */
    public function getTrabajadorId()
    {
        return $this->trabajador_id;
    }
    
    /**
     * Add role
     *
     * @param \Seguridad\AdminBundle\Entity\Roles $role
     * @return Users
     */
    public function addRole(\Seguridad\AdminBundle\Entity\Roles $role)
    {
        $this->role[] = $role;

        return $this;
    }

    /**
     * Remove role
     *
     * @param \Seguridad\AdminBundle\Entity\Roles $role
     */
    public function removeRole(\Seguridad\AdminBundle\Entity\Roles $role)
    {
        $this->role->removeElement($role);
    }
    
    /**
     * Get roles como cadena
     *
     * @return string 
     */   
    public function getStringRoles()
    {
        $string_roles = '';
        
        foreach ($this->role as $role)
        {
            $string_roles .= $role->getRole() .', ';
        }
        
        if($string_roles === '')
        {
            return 'Sin asignar.';
        }
        
        return rtrim($string_roles, ', ') .'.';
    }
}
