<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Avval maydonlar mavjudligini tekshiramiz
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->after('email')->nullable();
            }
            
            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['user', 'vendor', 'admin'])->default('user')->after('password');
            }
            
            if (!Schema::hasColumn('users', 'company')) {
                $table->string('company')->after('role')->nullable();
            }
            
            if (!Schema::hasColumn('users', 'address')) {
                $table->text('address')->after('company')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'role', 'company', 'address']);
        });
    }
};