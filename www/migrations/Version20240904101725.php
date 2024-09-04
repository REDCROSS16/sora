<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\SchemaException;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240904101725 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'init database tables';
    }

    public function up(Schema $schema): void
    {
        $this->createAuthorTable($schema);
        $this->createTagTable($schema);
        $this->createBookTable($schema);
        $this->createAuthorTagTable($schema);
    }

    public function down(Schema $schema): void
    {
    }

    /**
     * @param Schema $schema
     * @return void
     * @throws SchemaException
     */
    public function createAuthorTable(Schema $schema): void
    {
        if (!$schema->hasTable('author')) {
            $table = $schema->createTable('author');

            $table->addColumn('author_id', 'integer', ['autoincrement' => true, 'notnull' => true, 'unsigned' => true]);
            $table->addColumn('name', 'string', ['notnull' => true, 'length' => 255]);

            $table->setPrimaryKey(['author_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Table for store Authors');
        }
    }

    /**
     * @param Schema $schema
     * @return void
     * @throws SchemaException
     */
    public function createTagTable(Schema $schema): void
    {
        if (!$schema->hasTable('tag')) {
            $table = $schema->createTable('tag');

            $table->addColumn('tag_id', 'integer', ['autoincrement' => true, 'notnull' => true, 'unsigned' => true]);
            $table->addColumn('title', 'string', ['notnull' => true, 'length' => 255]);

            $table->setPrimaryKey(['tag_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Table for store Tag');
        }
    }

    /**
     * @param Schema $schema
     * @return void
     * @throws SchemaException
     */
    public function createBookTable(Schema $schema): void
    {
        if (!$schema->hasTable('book')) {
            $table = $schema->createTable('book');

            $table->addColumn('book_id', 'integer', ['autoincrement' => true, 'notnull' => true, 'unsigned' => true]);
            $table->addColumn('title', 'string', ['notnull' => true, 'length' => 255]);
            $table->addColumn('author_id', 'integer', ['unsigned' => true, 'notnull' => true]);

            $table->setPrimaryKey(['book_id']);
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Table for store Book');

            $table->addForeignKeyConstraint('author', ['author_id'], ['author_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_AUTHOR_BOOK');
        }
    }

    /**
     * @param Schema $schema
     * @return void
     * @throws SchemaException
     */
    public function createAuthorTagTable(Schema $schema): void
    {
        if (!$schema->hasTable('author_tag')) {
            $table = $schema->createTable('author_tag');

            $table->addColumn('author_id', 'integer', ['unsigned' => true, 'notnull' => true]);
            $table->addColumn('tag_id', 'integer', ['unsigned' => true, 'notnull' => true]);

            $table->setPrimaryKey(['author_id', 'tag_id'], 'author_tag_id');
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Table for store links with Authors and Tags');

            $table->addForeignKeyConstraint('author', ['author_id'], ['author_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_AUTHOR_AUTHOR_TAG');
            $table->addForeignKeyConstraint('tag', ['tag_id'], ['tag_id'], ['onDelete' => 'restrict', 'onUpdate' => 'restrict'], 'FK_TAG_AUTHOR_TAG');
        }
    }
}
