<?php

namespace BluedotDev\Unit\Services;

use BluedotDev\Unit\Contracts\TransactionServiceInterface;
use BluedotDev\Unit\Exceptions\MethodNotAllowed;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class TransactionService extends Service implements TransactionServiceInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param array $filters
     * @return TransactionService
     * @throws GuzzleException
     * @throws MethodNotAllowed
     */
    public function getList(array $filters): self
    {
        $query = "?";

        foreach ($filters as $key => $value){

            if ( is_array($value) ){
                foreach ($value as $index => $item){

                    if ( !str_ends_with($query, '?') ){
                        $query .= "&filter[$index]=".$item;
                    }else{
                        $query .= "filter[$index]=".$item;
                    }
                }
            }else{
                if ( str_ends_with($query, '?') ){
                    $query .= "filter[$key]=".$value;
                }else{
                    $query .= "&filter[$key]=".$value;
                }
            }
        }

        $url = "transactions" . $query;

        $this->requester->prepare(
            url: $url,
            method: Request::METHOD_GET,
            requestBody: null
        );

        $response = $this->requester->sendRequest();
        $this->results->parse($response, "transactionLists");


        return $this;
    }

    /**
     * @param string $accountId
     * @param string $transactionId
     * @return TransactionServiceInterface
     * @throws GuzzleException
     * @throws MethodNotAllowed
     */
    public function getById(string $accountId, string $transactionId): TransactionServiceInterface
    {
        $this->requester->prepare(
            url: "accounts/$accountId/transactions/$transactionId",
            method: Request::METHOD_GET,
            requestBody: null
        );
        $response = $this->requester->sendRequest();
        $this->results->parse($response, "getTransaction");

        return $this;
    }
}
