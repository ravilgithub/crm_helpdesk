<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table( 'messages', function ( Blueprint $table ) {
            $table->foreign( 'ticket_id' )->references( 'id' )->on( 'tickets' )->onUpdate( 'cascade' )->onDelete( 'restrict' );
            $table->foreign( 'user_id' )->references( 'id' )->on( 'users' )->onUpdate( 'cascade' )->onDelete( 'restrict' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table( 'messages', function ( Blueprint $table ) {
            $table->dropForeign( 'messages_ticket_id_foreign' );
            $table->dropForeign( 'messages_user_id_foreign' );
        });
    }
}
