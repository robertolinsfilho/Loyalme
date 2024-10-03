<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Resources\PartnerSellsResource;
use App\Http\Requests\StorePartnerSellsRequest;
use App\Classes\ApiResponseClass as ResponseClass;
use App\Interfaces\PartnerSellsRepositoryInterface;

class PartnerSellsController extends Controller
{
    private PartnerSellsRepositoryInterface $partnerSellsRepositoryInterface;

    public function __construct(PartnerSellsRepositoryInterface $partnerSellsRepositoryInterface)
    {
        $this->partnerSellsRepositoryInterface = $partnerSellsRepositoryInterface;
    }
    public function verifyStatus($status)
    {
        if($status === 'APPROVED' or 'Pago'){return 'APPROVED';};
        if($status === 'CANCELED'){return 'DENIED';};

        return 'unknown status';
    }
    public function vefifyPayload($request)
    {
        try{
            $details = [];
            if(!is_null($request->id)){
                $status = $this->verifyStatus($request->commissionStatus);
                $details =[
                        'external_id' => $request->id,
                        'amount' => $request->saleAmount['amount'],
                        'comission_amount' => $request->commissionAmount['amount'],
                        'payload' => (string) $request,
                        'status' => $status,
                        'date' => $request->transactionDate,
                ];
            }elseif(!is_null($request->gmv)){
                $status = $this->verifyStatus($request->statusName);
                $details =[
                        'external_id' =>$request->site['siteId'],
                        'amount' => $request->gmv,
                        'comission_amount' => $request->events['event']['commission'],
                        'payload' => (string) $request,
                        'status' => $status,
                        'date' => $request->date,
                ];
            }elseif(!is_null($request->ip)){
                $status = $this->verifyStatus($request->status['name']);
                $details =[
                        'external_id' =>$request->apid,
                        'amount' => $request->price,
                        'comission_amount' => $request->payment,
                        'payload' => (string) $request,
                        'status' => $status,
                        'date' => $request->date,
                ];
            }

            return $details;
        }catch(\Exception $ex){
            return ResponseClass::rollback($ex);
        }
    }
    public function store(StorePartnerSellsRequest $request)
    {
        DB::beginTransaction();
        try{
             $details = $this->vefifyPayload($request);
             $product = $this->partnerSellsRepositoryInterface->store($details);

             DB::commit();
             return ResponseClass::sendResponse(new PartnerSellsResource($product),'Payload Save',201);

        }catch(\Exception $ex){
            return ResponseClass::rollback($ex);
        }
    }
}
