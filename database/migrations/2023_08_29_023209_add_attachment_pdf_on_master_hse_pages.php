<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttachmentPdfOnMasterHsePages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_hse_pages', function (Blueprint $table) {
            $table->string('attachmentPDF');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_hse_pages', function (Blueprint $table) {
          $table->dropColumn('attachmentPDF');
        });
    }
}
