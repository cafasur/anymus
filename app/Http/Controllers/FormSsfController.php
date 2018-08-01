<?php

namespace App\Http\Controllers;

use App\CategoryReport;
use App\Periodicity;
use App\ShippingPeriod;
use App\TypeSignature;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormSsfController extends Controller
{

    public function index(){

        $categoryReports = CategoryReport::all();
        $periodicities = Periodicity::all();
        $signaturesType = TypeSignature::all();
        $shippingPeriods = ShippingPeriod::all();
        $user = User::findOrFail(auth()->user()->getAuthIdentifier());

        return view('apps.formSsf',[
            'user' => $user,
            'categoryReports' => $categoryReports,
            'periodicities' => $periodicities,
            'signaturesType' => $signaturesType,
            'shippingPeriods' => $shippingPeriods
        ]);

    }

    public function getReports(Request $request){
        $this->validate($request, [
            'id' => 'required|numeric|exists:category_reports'
        ]);
        $reports = DB::connection('cafasur')->select(
        'select * from xml2080 where informacion=:id and vercir=0020', ['id' => $request->input('id')]
        );

        return response()->json($reports);
    }

    public function print(Request $request){
        $pdf = PDF::loadView('informs/informSsf');
        return response()->file($pdf->download('prueba.pdf'));
    }
}
