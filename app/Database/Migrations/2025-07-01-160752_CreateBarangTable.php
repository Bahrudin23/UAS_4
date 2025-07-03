<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBarangTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'kode'       => ['type' => 'VARCHAR', 'constraint' => 100],
            'nama'       => ['type' => 'VARCHAR', 'constraint' => 100],
            'foto'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'jumlah'     => ['type' => 'INT'],
            'deskripsi'  => ['type' => 'TEXT'],
            'tgl_masuk'  => ['type' => 'DATE'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('barang');
    }

    public function down()
    {
        $this->forge->dropTable('barang');
    }
}
