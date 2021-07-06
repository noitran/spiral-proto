<?php

namespace Migration;

use Spiral\Migrations\Migration;

class OrmDefault2440feb14ca63601af6a4f0b0c6672ae extends Migration
{
    protected const DATABASE = 'default';

    public function up(): void
    {
        $this->table('currency_pairs')
            ->addColumn('incremental_id', 'primary', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('id', 'uuid', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('base_currency', 'string', [
                'nullable' => false,
                'default'  => null,
                'size'     => 8
            ])
            ->addColumn('quote_currency', 'string', [
                'nullable' => false,
                'default'  => null,
                'size'     => 8
            ])
            ->addColumn('created_at', 'datetime', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('created_by', 'json', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('updated_at', 'datetime', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('updated_by', 'json', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('deleted_at', 'datetime', [
                'nullable' => true,
                'default'  => null
            ])
            ->addColumn('deleted_by', 'json', [
                'nullable' => true,
                'default'  => null
            ])
            ->setPrimaryKeys(["incremental_id"])
            ->create();
        
        $this->table('rates')
            ->addColumn('incremental_id', 'primary', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('id', 'uuid', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('base_currency', 'string', [
                'nullable' => false,
                'default'  => null,
                'size'     => 8
            ])
            ->addColumn('quote_currency', 'string', [
                'nullable' => false,
                'default'  => null,
                'size'     => 8
            ])
            ->addColumn('avg_rate', 'decimal', [
                'nullable'  => false,
                'default'   => null,
                'scale'     => 14,
                'precision' => 28
            ])
            ->addColumn('ask_rate', 'decimal', [
                'nullable'  => false,
                'default'   => null,
                'scale'     => 14,
                'precision' => 28
            ])
            ->addColumn('bid_rate', 'decimal', [
                'nullable'  => false,
                'default'   => null,
                'scale'     => 14,
                'precision' => 28
            ])
            ->addColumn('service', 'string', [
                'nullable' => true,
                'default'  => null,
                'size'     => 64
            ])
            ->addColumn('provider', 'string', [
                'nullable' => false,
                'default'  => null,
                'size'     => 64
            ])
            ->addColumn('date', 'date', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('created_at', 'datetime', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('created_by', 'json', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('updated_at', 'datetime', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('updated_by', 'json', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('deleted_at', 'datetime', [
                'nullable' => true,
                'default'  => null
            ])
            ->addColumn('deleted_by', 'json', [
                'nullable' => true,
                'default'  => null
            ])
            ->setPrimaryKeys(["incremental_id"])
            ->create();
        
        $this->table('currencies')
            ->addColumn('incremental_id', 'primary', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('id', 'uuid', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('code', 'string', [
                'nullable' => false,
                'default'  => null,
                'size'     => 8
            ])
            ->addColumn('symbol', 'string', [
                'nullable' => false,
                'default'  => null,
                'size'     => 32
            ])
            ->addColumn('name', 'string', [
                'nullable' => false,
                'default'  => null,
                'size'     => 128
            ])
            ->addColumn('decimal_digits', 'tinyInteger', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('created_at', 'datetime', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('created_by', 'json', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('updated_at', 'datetime', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('updated_by', 'json', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('deleted_at', 'datetime', [
                'nullable' => true,
                'default'  => null
            ])
            ->addColumn('deleted_by', 'json', [
                'nullable' => true,
                'default'  => null
            ])
            ->setPrimaryKeys(["incremental_id"])
            ->create();
    }

    public function down(): void
    {
        $this->table('currencies')->drop();
        
        $this->table('rates')->drop();
        
        $this->table('currency_pairs')->drop();
    }
}
