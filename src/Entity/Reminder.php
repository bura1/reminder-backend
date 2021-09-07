<?php

namespace App\Entity;

use App\Repository\ReminderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReminderRepository::class)
 */
class Reminder
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_on_date;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="reminders")
     */
    private $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getCreatedOnDate(): ?\DateTimeInterface
    {
        return $this->created_on_date;
    }

    public function setCreatedOnDate(\DateTimeInterface $created_on_date): self
    {
        $this->created_on_date = $created_on_date;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
