<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Criteria;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    User::create([
      'name'     => 'Administrator',
      'username' => 'admin1',
      'email'    => 'admin@mail.com',
      'password' => bcrypt('adm123'),
      'level'    => 'SUPERADMIN'
    ]);

    //DB::table('criterias')->insert($criterias);
    $criterias = [
      ['id' => 1, 'name' => 'Sharp Ratio', 'attribute' => 'BENEFIT', 'weight' => '25'],
      ['id' => 2, 'name' => 'AUM', 'attribute' => 'BENEFIT', 'weight' => '50'],
      ['id' => 3, 'name' => 'Deviden', 'attribute' => 'BENEFIT', 'weight' => '25'],
    ];
    Criteria::insert($criterias);
  }
}
