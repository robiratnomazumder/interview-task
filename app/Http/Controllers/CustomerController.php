<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Jobs\CustomerCsvProcess;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmShipped;
use App\Jobs\MailSendJob;

class CustomerController extends Controller
{
    public function index()
    {
        $data['lists'] = Customer::paginate(2000);
        $data['total_count'] = DB::select('CALL total_customer_count')[0]->total_count;
        $data['male_customer_count'] = DB::select('CALL total_male_customer_count')[0]->total_male_count;
        $data['female_customer_count'] = DB::select('CALL total_female_customer_count')[0]->total_female_count;

        return view('customer.index', $data);
    }

    public function import(Request $request)
    {
        if($request->has('import_csv')){
//            $csv    = file($request->import_csv);
//            $chunks = array_chunk($csv,1000);
//            $header = [];
//            $batch  = Bus::batch([])->dispatch();
//
//            foreach ($chunks as $key => $chunk) {
//                $data = array_map('str_getcsv', $chunk);
//                if($key == 0){
//                    $header = $data[0];
//                    unset($data[0]);
//                }
//                $batch->add(new CustomerCsvProcess($data, $header));
//            }


            dispatch(new MailSendJob());

            //return $batch;
        }
        return back();
    }





    public function store(Request $request)
    {
        //
    }

    public function show()
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
//        Mail::send(['text'=>'mailBody'],$mail,function($message) use ($request) {
//            $message->to('admin@akaarit.com')->subject('Successful CSV Upload Confirmation');
//            $message->from('task@akaarit.com','Mail');
//        });
    }
}
