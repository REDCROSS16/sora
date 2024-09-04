<?php declare(strict_types=1);

namespace App\Entity;

use App\Repository\AuthorTagRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuthorTagRepository::class)]
#[ORM\Index(name: 'author_id', columns: ['author_id'])]
#[ORM\Index(name: 'tag_id', columns: ['tag_id'])]
#[ORM\HasLifecycleCallbacks()]
#[ORM\Table('author_tag')]
class AuthorTag
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Author::class)]
    #[ORM\JoinColumn(name: 'author_id', referencedColumnName: 'author_id', nullable: false)]
    private Author $author;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Tag::class)]
    #[ORM\JoinColumn(name: 'tag_id', referencedColumnName: 'tag_id', nullable: false)]
    private Tag $tag;

    public function getAuthor(): Author
    {
        return $this->author;
    }

    public function setAuthor(Author $author): void
    {
        $this->author = $author;
    }

    public function getTag(): Tag
    {
        return $this->tag;
    }

    public function setTag(Tag $tag): void
    {
        $this->tag = $tag;
    }
}