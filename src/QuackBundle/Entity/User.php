<?php

namespace QuackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="QuackBundle\Repository\UserRepository")
 */
class User
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
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="Status", mappedBy="user")
     */
    private $statuses;

    /**
   * @ORM\ManyToMany(targetEntity="User", mappedBy="iFollow")
   */
    private $myFollowers;

    /**
    * @ORM\ManyToMany(targetEntity="User", inversedBy="myFollowers")
    * @ORM\JoinTable(name="friends",
    *      joinColumns={@ORM\JoinColumn(name="follower", referencedColumnName="id")},
    *      inverseJoinColumns={@ORM\JoinColumn(name="follows", referencedColumnName="id")}
    *      )
    */
    private $iFollow;


    public function __construct() {
        $this->statuses = new ArrayCollection();
        $this->myFollowers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->iFollow = new \Doctrine\Common\Collections\ArrayCollection();
    }


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
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Add status
     *
     * @param \QuackBundle\Entity\Status $status
     *
     * @return User
     */
    public function addStatus(\QuackBundle\Entity\Status $status)
    {
        $this->statuses[] = $status;

        return $this;
    }

    /**
     * Remove status
     *
     * @param \QuackBundle\Entity\Status $status
     */
    public function removeStatus(\QuackBundle\Entity\Status $status)
    {
        $this->statuses->removeElement($status);
    }

    /**
     * Get statuses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStatuses()
    {
        return $this->statuses;
    }

    /**
     * Add myFollower
     *
     * @param \QuackBundle\Entity\User $myFollower
     *
     * @return User
     */
    public function addMyFollower(\QuackBundle\Entity\User $myFollower)
    {
        $this->myFollowers[] = $myFollower;

        return $this;
    }

    /**
     * Remove myFollower
     *
     * @param \QuackBundle\Entity\User $myFollower
     */
    public function removeMyFollower(\QuackBundle\Entity\User $myFollower)
    {
        $this->myFollowers->removeElement($myFollower);
    }

    /**
     * Get myFollowers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMyFollowers()
    {
        return $this->myFollowers;
    }

    /**
     * Add iFollow
     *
     * @param \QuackBundle\Entity\User $iFollow
     *
     * @return User
     */
    public function addIFollow(\QuackBundle\Entity\User $iFollow)
    {
        $this->iFollow[] = $iFollow;

        return $this;
    }

    /**
     * Remove iFollow
     *
     * @param \QuackBundle\Entity\User $iFollow
     */
    public function removeIFollow(\QuackBundle\Entity\User $iFollow)
    {
        $this->iFollow->removeElement($iFollow);
    }

    /**
     * Get iFollow
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIFollow()
    {
        return $this->iFollow;
    }
}
