<?php

namespace BluedotDev\Unit\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];
    public static function transactionLists(array $response): self
    {
        return self::getTransaction($response);
    }
    public static function getTransaction(array $response): self
    {
        if ( isset($response['data']) )
            $response = $response['data'];

        $attributes = $response['attributes'];
        $relationships = $response['relationships'];

        return new self([
            'id' => $response['id'],
            'type' => $response['type'],
            'created_at' => $attributes['createdAt'],
            'amount' => $attributes['amount'],
            'direction' => $attributes['direction'],
            'balance' => $attributes['balance'],
            'description' => isset($attributes['description']) ? $attributes['description'] : null,
            'summary' => $attributes['summary'],
            'company_name' => isset($attributes['companyName']) ? $attributes['companyName'] : null,
            'counterparty_routing_number' => isset($attributes['counterpartyRoutingNumber']) ? $attributes['counterpartyRoutingNumber'] : null,
            'trace_number' => isset($attributes['traceNumber']) ? $attributes['traceNumber']  : null,
            'sec_code' => isset($attributes['secCode']) ? $attributes['secCode'] : null,
            'account_id' => $relationships['account']['data']['id'],
            'customer_id' => $relationships['customer']['data']['id'],
            'customers' => (object) $relationships['customers']['data'],
            'org_id' => $relationships['org']['data']['id'],
        ]);
    }

}
