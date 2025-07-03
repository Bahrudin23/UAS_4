<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'name'     => 'Administrator',
            'username' => 'admin',
            'password' => password_hash('admin', PASSWORD_DEFAULT),
            'whatsapp' => '0',
            'role'     => 'admin',
        ];

        $this->db->table('users')->insert($data);
    }
}
