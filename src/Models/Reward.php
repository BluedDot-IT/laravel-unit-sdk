<?php

namespace BluedotDev\Unit\Models;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    protected $guarded = [];
    protected $casts = [
        "relationships" => 'object',
        'tags' => 'object'
    ];

    public static function createReward(array $response): Reward
    {
        $data = $response['data'];
        $attributes = $data['attributes'];
        $relationships = $data['relationships'];

        return new self([
            'id' => $data['id'],
            'type' => $data['type'],
            'created_at' => $attributes['createdAt'],
            'amount' => $attributes['amount'],
            'description' => $attributes['description'],
            'status' => $attributes['status'],
            'tags' => $attributes['tags'],
            'relationships' => self::parseRelationships($relationships),
        ]);
    }
    public static function parseRelationships(array $relationships): array
    {
        return [
            'receiving_account_id' => $relationships['receivingAccount']['data']['id'],
            'funding_account_id' => $relationships['fundingAccount']['data']['id'],
            'customer_id' => $relationships['customer']['data']['id'],
            'transaction_id' => $relationships['transaction']['data']['id'],
        ];
    }
}
