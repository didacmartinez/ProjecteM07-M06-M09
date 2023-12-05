<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $this->createVisibilitiesTable();
        $this->seedVisibilityTable();
        $this->addVisibilityColumnTo('posts');
        $this->addVisibilityColumnTo('places');
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        $this->removeVisibilityColumnFrom('posts');
        $this->removeVisibilityColumnFrom('places');
        $this->dropVisibilitiesTable();
    }

    /**
     * Create the 'visibilities' table.
     */
    private function createVisibilitiesTable(): void
    {
        Schema::create('visibilities', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });
    }

    /**
     * Seed the 'visibilities' table.
     */
    private function seedVisibilityTable(): void
    {
        Artisan::call('db:seed', [
            '--class' => 'VisibilitySeeder',
            '--force' => true
        ]);
    }

    /**
     * Add 'visibility_id' column to a table and set foreign key.
     *
     * @param string $tableName
     */
    private function addVisibilityColumnTo(string $tableName): void
    {
        Schema::table($tableName, function (Blueprint $table) {
            $table->unsignedBigInteger('visibility_id')->nullable();
            $table->foreign('visibility_id')->references('id')->on('visibilities');
        });
    }

    /**
     * Remove 'visibility_id' column from a table.
     *
     * @param string $tableName
     */
    private function removeVisibilityColumnFrom(string $tableName): void
    {
        Schema::table($tableName, function (Blueprint $table) {
            $table->dropForeign(['visibility_id']);
            $table->dropColumn('visibility_id');
        });
    }

    /**
     * Drop the 'visibilities' table.
     */
    private function dropVisibilitiesTable(): void
    {
        Schema::dropIfExists('visibilities');
    }
};
