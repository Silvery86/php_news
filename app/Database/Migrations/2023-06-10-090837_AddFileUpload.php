<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFileUpload extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'constraint' => 255,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'filename' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'filepath' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'type' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
        ]);
 
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('fileuploads');
    }

    public function down()
    {
        $this->forge->dropTable('fileuploads');
    }
}
