<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use DateTime;
use DateTimeInterface;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompanyRepository::class)
 * @Vich\Uploadable
 */
class Company
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
    private ?string $logo = 'default(';

    /**
     * @Vich\UploadableField(mapping="profile_file", fileNameProperty="logo")
     * @var File
     */
    private File $logoFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $companyName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $companyFormat;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $siret;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $siren;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $description;

    /**
     * @ORM\OneToMany(targetEntity=Offer::class, mappedBy="company")
     */
    private Collection $offers;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     */
    private User $user;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $updatedAt;

    public function __construct()
    {
        $this->offers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * @return File
     */
    public function getLogoFile(): File
    {
        return $this->logoFile;
    }

    public function setLogoFile(File $image): self
    {
        $this->logoFile = $image;
        if ($image) {
            $this->updatedAt = new DateTime('now');
        }
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(?string $companyName): self
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function getCompanyFormat(): ?string
    {
        return $this->companyFormat;
    }

    public function setCompanyFormat(?string $companyFormat): self
    {
        $this->companyFormat = $companyFormat;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(?string $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getSiren(): ?string
    {
        return $this->siren;
    }

    public function setSiren(?string $siren): self
    {
        $this->siren = $siren;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Offer[]
     */
    public function getOffers(): Collection
    {
        return $this->offers;
    }

    public function addOffer(Offer $offer): self
    {
        if (!$this->offers->contains($offer)) {
            $this->offers[] = $offer;
            $offer->setCompany($this);
        }

        return $this;
    }

    public function removeOffer(Offer $offer): self
    {
        $this->offers->removeElement($offer);

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
