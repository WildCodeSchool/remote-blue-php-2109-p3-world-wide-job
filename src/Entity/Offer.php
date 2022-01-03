<?php

namespace App\Entity;

use App\Repository\OfferRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OfferRepository::class)
 */
class Offer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected int $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $city;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $contractType;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $duration;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $shortDescription;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $dateOfPublication;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $longDescription;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $fieldOfActivity;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $jobPosition;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private ?\DateTimeInterface $dateIn;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $wage;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $tutor;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private ?bool $drivingLicence;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="offers")
     * @ORM\JoinColumn(nullable=false)
     */
    private Company $company;

    /**
     * @ORM\OneToMany(targetEntity=Application::class, mappedBy="offer")
     */
    private Collection $applications;

    public function __construct()
    {
        $this->applications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getContractType(): ?int
    {
        return $this->contractType;
    }

    public function setContractType(?int $contractType): self
    {
        $this->contractType = $contractType;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(?string $shortDescription): self
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    public function getDateOfPublication(): ?string
    {
        return $this->dateOfPublication->format('d-m-Y');
    }

    public function setDateOfPublication(\DateTimeInterface $dateOfPublication): self
    {
        $this->dateOfPublication = $dateOfPublication;

        return $this;
    }

    public function getLongDescription(): ?string
    {
        return $this->longDescription;
    }

    public function setLongDescription(?string $longDescription): self
    {
        $this->longDescription = $longDescription;

        return $this;
    }

    public function getFieldOfActivity(): ?int
    {
        return $this->fieldOfActivity;
    }

    public function setFieldOfActivity(?int $fieldOfActivity): self
    {
        $this->fieldOfActivity = $fieldOfActivity;

        return $this;
    }

    public function getJobPosition(): ?string
    {
        return $this->jobPosition;
    }

    public function setJobPosition(?string $jobPosition): self
    {
        $this->jobPosition = $jobPosition;

        return $this;
    }

    public function getDateIn(): ?\DateTimeInterface
    {
        return $this->dateIn;
    }

    public function setDateIn(?\DateTimeInterface $dateIn): self
    {
        $this->dateIn = $dateIn;

        return $this;
    }

    public function getWage(): ?int
    {
        return $this->wage;
    }

    public function setWage(?int $wage): self
    {
        $this->wage = $wage;

        return $this;
    }

    public function getTutor(): ?string
    {
        return $this->tutor;
    }

    public function setTutor(?string $tutor): self
    {
        $this->tutor = $tutor;

        return $this;
    }

    public function getDrivingLicence(): ?bool
    {
        return $this->drivingLicence;
    }

    public function setDrivingLicence(?bool $drivingLicence): self
    {
        $this->drivingLicence = $drivingLicence;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(Company $company): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return Collection|Application[]
     */
    public function getApplications(): Collection
    {
        return $this->applications;
    }

    public function addApplication(Application $application): self
    {
        if (!$this->applications->contains($application)) {
            $this->applications[] = $application;
            $application->setOffer($this);
        }

        return $this;
    }

    public function removeApplication(Application $application): self
    {
        $this->applications->removeElement($application);

        return $this;
    }
}
