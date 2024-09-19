<?php declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GraphQl\Mutation;
use ApiPlatform\Metadata\GraphQl\Query;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\GraphQl\QueryCollection;
use ApiPlatform\Metadata\Post;
use App\Repository\AuthorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ApiResource(
    operations: [
        new Get(
            requirements: ['id' => '\d+'],
        ),
//        new Post(),
        new GetCollection()
    ],
    normalizationContext: ['groups' => ['author_read']],
    denormalizationContext: ['groups' => ['author_create', 'author_update']],
    graphQlOperations: array(
        new Query(),
        new QueryCollection(),
        new Mutation(name: 'create')
    )
)]
#[Post]
#[ORM\Entity(repositoryClass: AuthorRepository::class)]
#[ORM\Table('author')]
class Author
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[Groups(['author_read', 'author_create', 'author_update'])]
    #[ORM\Column(name: 'author_id', type: Types::INTEGER, nullable: false, options: ['unsigned' => true])]
    private ?int $id = null;

    #[Groups(['author_read', 'author_create', 'author_update'])]
    #[ORM\Column(name:'name', type: Types::STRING, length: 255, nullable: false)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'authors')]
    #[ORM\JoinTable(name: 'author_tag')]
    #[ORM\JoinColumn(name: 'author_id', referencedColumnName: 'author_id')]
    #[ORM\InverseJoinColumn(name: 'tag_id', referencedColumnName: 'tag_id')]
    private ?Collection $tags;

    #[Groups(['author_read'])]
    #[ORM\OneToMany(targetEntity: Book::class, mappedBy: 'author', cascade: ['persist'], fetch: 'EAGER', orphanRemoval: true)]
    private ?Collection $books;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->books = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    /**
     * @param Tag $tag
     * @return $this
     */
    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }

        return $this;
    }

    /**
     * @param Tag $tag
     * @return $this
     */
    public function removeTag(Tag $tag): self
    {
        if ($this->tags->removeElement($tag)) {
            $tag->removeAuthor($this);
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    /**
     * @param Book $book
     * @return $this
     */
    public function addBook(Book $book): self
    {
        if (!$this->books->contains($book)) {
            $this->books->add($book);
            $book->setAuthor($this);
        }

        return $this;
    }
}