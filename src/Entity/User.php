<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min=1,
     *      max=100,
     *      minMessage="Minimum character count not met!",
     *      maxMessage="Exceeded maximum characters!"
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min=8,
     *      max=30,
     *      minMessage="Minimum character count not met!",
     *      maxMessage="Exceeded maximum characters!"
     * )
     */
    private $user_name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min=8,
     *      max=20,
     *      minMessage="Minimum character count not met!",
     *      maxMessage="Exceeded maximum characters!"
     * )
     */
    private $password;

    /**
     * @ORM\ManyToOne(targetEntity=UserLevel::class, inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank()
     */
    private $user_level;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUserName(): ?string
    {
        return $this->user_name;
    }

    public function setUserName(string $user_name): self
    {
        $this->user_name = $user_name;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getUserLevel(): ?UserLevel
    {
        return $this->user_level;
    }

    public function setUserLevel(?UserLevel $user_level): self
    {
        $this->user_level = $user_level;

        return $this;
    }
}
