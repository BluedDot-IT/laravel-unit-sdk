<?php

namespace BluedotDev\Unit\Models;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $guarded = [];
    protected $casts = [
        'account' => 'object'
    ];
    public static function feeOption(array $response): self
    {
        $attributes = $response["data"]['attributes'];
        $relationships = $response["data"]['relationships'];
        return new self([
            'id' => $response["data"]['id'],
            'type' => $response["data"]['type'],
            'amount' => $attributes['amount'],
            'description' => $attributes['description'],
            "account" => [
                "id" => $relationships["account"]["data"]["id"],
                "type" => $relationships["account"]["data"]["type"]
            ]
        ]);
    }
}
