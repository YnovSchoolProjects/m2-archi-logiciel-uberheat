<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\ProductConfiguration\ProductConfiguration;
use App\Repository\ResultRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ResultRepository::class)
 */
class Result
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Project::class, inversedBy="results")
     * @ORM\JoinColumn(nullable=false)
     */
    private $project;

    /**
     * @ORM\ManyToOne(targetEntity=ProductConfiguration::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $configuration;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }

    public function getConfiguration(): ?ProductConfiguration
    {
        return $this->configuration;
    }

    public function setConfiguration(?ProductConfiguration $configuration): self
    {
        $this->configuration = $configuration;

        return $this;
    }
}
