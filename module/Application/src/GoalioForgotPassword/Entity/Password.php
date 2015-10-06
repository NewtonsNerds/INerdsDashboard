<?php

namespace GoalioForgotPassword\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Password
 *
 * @ORM\Table(name="user_password_reset")
 * @ORM\MappedSuperclass
 */
class Password
{
    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", unique=true)
     */
    private $user_id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="request_time", type="datetime")
     */
    private $requestTime;

    /**
     * @var string
     *
     * @ORM\Column(name="request_key", type="string", length=32)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $requestKey;


    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return Password
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

    /**
     * Set requestTime
     *
     * @param \DateTime $requestTime
     *
     * @return Password
     */
    public function setRequestTime($requestTime)
    {
        $this->requestTime = $requestTime;

        return $this;
    }

    /**
     * Get requestTime
     *
     * @return \DateTime
     */
    public function getRequestTime()
    {
        return $this->requestTime;
    }

    /**
     * Set requestKey
     *
     * @param string $requestKey
     *
     * @return Password
     */
    public function setRequestKey($requestKey)
    {
        $this->requestKey = $requestKey;

        return $this;
    }

    /**
     * Get requestKey
     *
     * @return string
     */
    public function getRequestKey()
    {
        return $this->requestKey;
    }
}
