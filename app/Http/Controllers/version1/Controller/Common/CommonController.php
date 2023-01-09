<?php

namespace App\Http\Controllers\version1\Controller\Common;

use App\Http\Controllers\Controller;
use App\Http\Controllers\version1\Services\Common\CommonService;
use App\Http\Controllers\version1\Services\HRM\Masters\HrmDepartmentService;
use App\Models\SmsType;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use DB;
use Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use File;
class CommonController extends Controller
{
    protected $service;
    public function __construct(CommonService $service)
    {
        $this->service = $service;
    }
    public function convertXlToPdf()
    {

        $models = SmsType::get();

        $entities = collect($models)->map(function ($model) {

            $file = public_path('/assets/pdffile/' . $model->filename);
            // if (file_exists(public_path('/assets/pdffile/' . $model->filename))) {
            //     dd('yes');
            // }else{
            //     dd('no');
            // }
            $orgfiles = File::files($file);
            dd($orgfiles);
            return Excel::create('itsolutionstuff_example', function($excel) use ($model) {
                $excel->sheet('mySheet', function($sheet) use ($model)
                {
                    $file = public_path('/assets/pdffile/' . $model->filename);
                    $sheet->loadView($file);
                });
               })->download("pdf");
            });
           dd("well");
        //     return Excel::create('Poptin_conversions_data_', function ($excel) use ($model) {
        //         $excel->sheet('mySheet', function ($sheet) use ($model) {
        //             $file = public_path('/assets/pdffile/' . $model->filename);
        //             $sheet->fromArray($file);
        //         });
        //     })->download('pdf');
        // });

        // $entities = collect($models)->map(function ($model) {
        //     $status = "No";
        //     if (file_exists(public_path('/assets/pdffile/' . $model->filename))) {
        //         $file = public_path('/assets/pdffile/' . $model->filename);
        //         $newfile = explode('.', $model->filename)[0];
        //         Excel::create('name', function ($excel) {

        //             foreach ($categories as $value) {
        //                  $excel->sheet($value['name'], function($sheet) {
        //                  ...
        //                  });
        //             }
        //        })->download('pdf');

        //         // $excel_object = Excel::import($file);
        //         // dd(public_path('/assets/newpdffile/' .$newfile.'pdf'));
        //         // $excel_object->export(public_path('/assets/newpdffile/' .$newfile.'pdf'));
        //         // $status = "Yes";
        //     }
        //     $data = ['file' => $model->filename, 'status' => $status];
        //     return $data;
        // });
        dd($entities);
    }
}
