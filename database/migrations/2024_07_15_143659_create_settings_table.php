<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// dsd
return new class extends Migration
{
    /**
     * Run the migrations.
     */
 // In the migration file for the settings table
public function up()
{
    if (!Schema::hasTable('settings')) {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('website_name');
            $table->string('slogan')->nullable();
            $table->string('logo');
            $table->string('favicon');
            $table->string('header_logo')->nullable();
            $table->string('footer_logo')->nullable();
            $table->bigInteger('phone_no');
            $table->bigInteger('opt_phone_no')->nullable();
            $table->bigInteger('mobile_no');
            $table->string('email');
            $table->string('opt_email')->nullable();
            $table->text('address');
            $table->string('google_map_link')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('youtube_link')->nullable();
            $table->text('about_website')->nullable();
            $table->text('opening_hours');
            $table->boolean('status')->default(false);
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
