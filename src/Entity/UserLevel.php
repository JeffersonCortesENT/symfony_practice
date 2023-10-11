<?php

namespace App\Entity;

use App\Repository\UserLevelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserLevelRepository::class)
 */
class UserLevel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="user_level")
     */
    private $users;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $level_code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserId(): Collection
    {
        return $this->users;
    }

    public function addUserId(User $userId): self
    {
        if (!$this->users->contains($userId)) {
            $this->users[] = $userId;
            $userId->setUserLevel($this);
        }

        return $this;
    }

    public function removeUserId(User $userId): self
    {
        if ($this->users->removeElement($userId)) {
            // set the owning side to null (unless already changed)
            if ($userId->getUserLevel() === $this) {
                $userId->setUserLevel(null);
            }
        }

        return $this;
    }

    public function getLevelCode(): ?string
    {
        return $this->level_code;
    }

    public function setLevelCode(string $level_code): self
    {
        $this->level_code = $level_code;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
