<?php

namespace BluedotDev\Unit\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $guarded = [];
    protected $casts = [
        'limit' => 'object',
        'tags' => 'object',
    ];

    public static function accountLimit(array $response): self
    {
        $attributes = $response['data']['attributes'];

        $ach = (object) [
            'limits' => (object) $attributes['ach']['limits'],
            'totalsDaily' => (object) $attributes['ach']['totalsDaily'],
            'totalsMonthly' => (object) $attributes['ach']['totalsMonthly'],
        ];

        $card = (object) [
            'limits' => (object) $attributes['card']['limits'],
            'totalsDaily' => (object) $attributes['card']['totalsDaily'],
        ];

        $checkDeposit = (object) [
            'limits' => (object) $attributes['checkDeposit']['limits'],
            'totalsDaily' => $attributes['checkDeposit']['totalsDaily'],
            'totalsMonthly' => $attributes['checkDeposit']['totalsMonthly'],
        ];

        $limits = (object) [
            'ach' => $ach,
            'card' => $card,
            'check_deposit' => $checkDeposit,
        ];

        return new self([
            'limits' => $limits,
        ]);
    }
    public static function accountLists(array $response): self
    {
        $attributes = $response['attributes'];
        $relationships = $response['relationships'];

        return new self([
            'id' => $response['id'],
            'type' => $response['type'],
            'name' => $attributes['name'],
            'created_at' => $attributes['createdAt'],
            'routing_number' => $attributes['routingNumber'],
            'account_number' => $attributes['accountNumber'],
            'deposit_product' => $attributes['depositProduct'],
            'balance' => $attributes['balance'],
            'hold' => $attributes['hold'],
            'available' => $attributes['available'],
            'tags' => $attributes['tags'],
            'currency' => $attributes['currency'],
            'status' => $attributes['status'],
            'updated_at' => $attributes['updatedAt'],
            'customer_id' => $relationships['customer']['data']['id'],
            'org_id' => $relationships['org']['data']['id'],
            'bank_id' => $relationships['bank']['data']['id'],
        ]);
    }
    public static function accountOption(array $response): self
    {
        $attributes = $response["data"]['attributes'];
        $relationships = $response["data"]['relationships'];
        return new self([
            'id' => $response["data"]['id'],
            'type' => $response["data"]['type'],
            'name' => $attributes['name'],
            'created_at' => $attributes['createdAt'],
            'routing_number' => $attributes['routingNumber'],
            'account_number' => $attributes['accountNumber'],
            'deposit_product' => $attributes['depositProduct'],
            'balance' => $attributes['balance'],
            'hold' => $attributes['hold'],
            'available' => $attributes['available'],
            'tags' => $attributes['tags'],
            'currency' => $attributes['currency'],
            'status' => $attributes['status'],
            'freeze_reason' => $attributes['freezeReason'] ?? null,
            'updated_at' => $attributes['updatedAt'],
            'customer_id' => $relationships['customer']['data']['id'],
            'org_id' => $relationships['org']['data']['id'],
            'bank_id' => $relationships['bank']['data']['id'],
        ]);
    }
}
