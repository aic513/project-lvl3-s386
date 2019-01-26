<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsInDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('domains', function (Blueprint $table) {
            $table->integer('content_length')
                ->after('name')
                ->comment('Content Length')
                ->nullable();
            $table->integer('response_code')
                ->after('content_length')
                ->comment('Response code')
                ->nullable();
            $table->text('page_body')
                ->after('response_code')
                ->comment('Page body')
                ->nullable();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('domains', function (Blueprint $table) {
        //
        });
    }
}
