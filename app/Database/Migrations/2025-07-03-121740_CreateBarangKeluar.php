<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBarangKeluar extends Migration
{
public function up()
{
    $this->forge->addField([
        'id'          => ['type' => 'INT', 'auto_increment' => true],
        'barang_id'   => ['type' => 'INT'],
        'jumlah'      => ['type' => 'INT'],
        'tanggal'     => ['type' => 'DATE'],
        'created_at'  => ['type' => 'DATETIME', 'null' => true],
    ]);

    $this->forge->addKey('id', true);
    $this->forge->createTable('barang_keluar');
}

    public function down()
    {
        //
    }
}
