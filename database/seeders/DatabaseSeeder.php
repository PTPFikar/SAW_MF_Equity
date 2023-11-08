<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Criteria;
use App\Models\Risks;
use Illuminate\Database\Seeder;

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

    $criterias = [
      ['id' => 1, 'name' => 'sharpeRatio', 'criteriaName' => 'sharpe Ratio', 'attribute' => 'BENEFIT', 'weight' => '25'],
      ['id' => 2, 'name' => 'AUM', 'criteriaName' => 'AUM', 'attribute' => 'BENEFIT', 'weight' => '50'],
      ['id' => 3, 'name' => 'deviden', 'criteriaName' => 'Deviden', 'attribute' => 'BENEFIT', 'weight' => '25'],
    ];
    Criteria::insert($criterias);

    Risks::create([
      'risk'     => '0.03615'
    ]);
  }
}
