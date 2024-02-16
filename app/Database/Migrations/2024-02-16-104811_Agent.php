<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Agent extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_agent' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_agent' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'alamat' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'contact_person' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'telepon' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id_agent', true);
        $this->forge->createTable('agents');
    }

    public function down()
    {
        $this->forge->dropTable('agents');
    }
}
