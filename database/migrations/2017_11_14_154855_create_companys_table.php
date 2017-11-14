<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companys', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('company_name')->unique();
            $table->string('email')->nullable();
            $table->string('landline_number')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('website_url')->nullable();
            $table->string('product_services')->nullable();
            $table->string('company_type')->nullable();
            $table->string('registration_no')->nullable();
            $table->string('vat_registered')->nullable();
            $table->string('years_operated')->nullable();
            $table->string('physical_address')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('companys');
    }
}
