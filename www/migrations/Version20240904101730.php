<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\SchemaException;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240904101730 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'init good table';
    }

    /**
     * @param Schema $schema
     * @return void
     * @throws SchemaException
     */
    public function up(Schema $schema): void
    {
        if (!$schema->hasTable('good')) {
            $table = $schema->createTable('good');

            $table->addColumn('good_id', 'integer', ['autoincrement' => true, 'notnull' => true]);
            $table->addColumn('name', 'string', ['notnull' => true, 'length' => 255]);
            $table->addColumn('price', 'integer', ['notnull' => true]);
            $table->addColumn('description', 'string', ['notnull' => true, 'length' => 255]);
            $table->addColumn('is_active', 'boolean', ['notnull' => true, 'length' => 255]);

            $table->setPrimaryKey(['good_id'] , 'good_id');
            $table->addOption('engine', 'InnoDB');
            $table->addOption('comment', 'Table for store goods');
        }
    }

    /**
     * @param Schema $schema
     * @return void
     * @throws SchemaException
     */
    public function down(Schema $schema): void
    {
        if ($schema->hasTable('good')) {
            $schema->dropTable('good');
        }
    }
}
