<?php

namespace GoalioRememberMe\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RememberMe
 *
 * @ORM\Table(name="user_remember_me", uniqueConstraints={@ORM\UniqueConstraint(name="user_remember_me", columns={"sid", "token", "user_id"})})
 * @ORM\MappedSuperclass
 */
class RememberMe
{
    /**
     * @var string
     *
     * @ORM\Column(name="sid", type="string")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $sid;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $token;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $user_id;


    /**
     * Set sid
     *
     * @param string $sid
     *
     * @return RememberMe
     */
    public function setSid($sid)
    {
        $this->sid = $sid;

        return $this;
    }

    /**
     * Get sid
     *
     * @return string
     */
    public function getSid()
    {
        return $this->sid;
    }

    /**
     * Set token
     *
     * @param string $token
     *
     * @return RememberMe
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return RememberMe
     */
    public function setUserId($userId)
    {
        $this->user_id = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }
}
