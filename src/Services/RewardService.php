<?php

namespace BluedotDev\Unit\Services;

use BluedotDev\Unit\Contracts\RewardServiceInterface;
use BluedotDev\Unit\Exceptions\MethodNotAllowed;
use BluedotDev\Unit\Exceptions\MissingParameter;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RewardService extends Service implements RewardServiceInterface
{
    public const PROCESS_TYPE_IS_DEPOSIT = "depositAccount";
    public const PROCESS_TYPE_IS_FUNDING = "fundingAccount";
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param array $data
     * @param string $processType
     * @return mixed
     * @throws GuzzleException
     * @throws MethodNotAllowed
     * @throws MissingParameter
     */
    public function createReward(array $data, string $processType = 'depositAccount'): RewardServiceInterface {

        $rules = [
            "amount" => "required|int",
            "description" => "required|string",
            "accountId" => "required|string",
            "idempotencyKey" => "required",
        ];

        $validate = Validator::make($data, $rules);
        if ( $validate->failed() ){
            throw new MissingParameter($validate->errors());
        }

        $payload = [
            'data' => [
                'type' => 'reward',
                'attributes' => [
                    'amount' => $data["amount"],
                    'description' => $data["description"],
                    'idempotencyKey' => $data['idempotencyKey'],
                ],
                'relationships' => [
                    'receivingAccount' => [
                        'data' => [
                            'type' => "depositAccount",
                            'id' => $data["accountId"]
                        ]
                    ]
                ]
            ]
        ];

        if ( $processType == self::PROCESS_TYPE_IS_FUNDING ) {
            $payload["data"]["relationships"] = [
                "fundingAccount" => [
                    "type" => self::PROCESS_TYPE_IS_FUNDING,
                    "id" => $data["fundingAccountId"]
                ]
            ];
        }

        $this->requester->prepare(
            url: '/rewards',
            method: Request::METHOD_POST,
            requestBody: $payload
        );

        $response = $this->requester->sendRequest();
        $this->results->parse($response, "createReward");

        return $this;
    }
}
