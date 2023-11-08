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
    Schema::create('products', function (Blueprint $table) {
      $table->id();
      $table->string('ISIN');
      $table->string('productName');
      $table->decimal('expectReturn', 10, 4);
      $table->decimal('standardDeviation', 10, 4);
      $table->decimal('sharpeRatio', 10, 4);
      $table->bigInteger('AUM');
      $table->boolean('deviden');
      $table->date('date');
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
    Schema::dropIfExists('products');
  }
};
