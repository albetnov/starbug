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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId("id_category")->constrained('categories', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->string("name");
            $table->text("description");
            $table->string("photo");
            $table->bigInteger("price");
            $table->enum("status", ["production", "discontinued"]);
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
        Schema::dropIfExists('menus');
    }
};