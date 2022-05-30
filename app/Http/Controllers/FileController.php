<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class FileController extends Controller
{
    public function index()
    {
        return view('customer.file');
    }

    public function readCSV($csvFile, $array)
    {
        $file_handle = fopen($csvFile, 'r');
        while (!feof($file_handle)) {
            $line_of_text[] = fgetcsv($file_handle, 0, $array['delimiter']);
        }
        fclose($file_handle);
        return $line_of_text;
    }

    public function store(Request $request)
    {
        if($request->has('upload')){
            $file = $request->file('upload');
            $real_path = $file->getRealPath();
            $datas = $this->readCSV($real_path, array('delimiter' => ','));
            foreach ($datas as $key => $data){
                $path = public_path('File/'.$data[1].'.pdf');
                $isExists = file_exists($path);
                if ($isExists) {
                    File::move(public_path('File/'.$data[1].'.pdf'), public_path($data[0].'/'.$data[1].'.pdf'));
                    //header('content-type:application/pdf');
                    //echo file_get_contents($path);
                }
                else continue;
            }
            return back()->with('success','PDF File Moved Successfully!');
        }
        return back()->with('error','Error !');
    }

    public function show($id)
    {

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
        //
    }
}
