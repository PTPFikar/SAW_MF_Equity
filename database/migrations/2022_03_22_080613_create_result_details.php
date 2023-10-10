<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('criteria_analysis_details', function (Blueprint $table) {
      $table->id();
      $table->decimal('criteria_first_value', 10, 4);
      $table->decimal('criteria_second_value', 10, 4);
      $table->decimal('criteria_third_value', 10, 4);
      $table->decimal('criteria_result', 10, 4);
      $table->integer('criteria_rank');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('criteria_analysis_details');
  }
};
