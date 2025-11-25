<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->string('capital')->nullable()->after('flag');
            $table->string('currency')->nullable()->after('capital');
            $table->string('currency_name')->nullable()->after('currency');
            $table->string('currency_symbol', 10)->nullable()->after('currency_name');
            $table->string('tld', 10)->nullable()->after('currency_symbol');
            $table->string('native')->nullable()->after('tld');
            $table->string('region')->nullable()->after('native');
            $table->string('subregion')->nullable()->after('region');
            $table->text('timezones')->nullable()->after('subregion');
            $table->decimal('latitude', 10, 8)->nullable()->after('timezones');
            $table->decimal('longitude', 11, 8)->nullable()->after('latitude');
            $table->string('emoji', 10)->nullable()->after('longitude');
            $table->string('numeric_code', 10)->nullable()->after('emoji');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn([
                'capital', 'currency', 'currency_name', 'currency_symbol',
                'tld', 'native', 'region', 'subregion', 'timezones',
                'latitude', 'longitude', 'emoji', 'numeric_code'
            ]);
        });
    }
};
