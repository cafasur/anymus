<?php

namespace App\Http\Controllers;

use App\AbsenteeismControl;
use App\absenteeismType;
use App\CategoryReport;
use App\Periodicity;
use App\ShippingPeriod;
use App\TypeSignature;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FormalitiesController extends Controller
{
    public function index(){
        $absenteeismControl = AbsenteeismControl::where('user_id', '=', auth()->user()->getAuthIdentifier())->get();
        return view('apps.formalities.index',[
            'absenteeismControl' => $absenteeismControl
        ]);
    }

    public function form_ssf(){

        $categoryReports = CategoryReport::all();
        $periodicities = Periodicity::all();
        $signaturesType = TypeSignature::all();
        $shippingPeriods = ShippingPeriod::all();
        $user = User::findOrFail(auth()->user()->getAuthIdentifier());

        return view('apps.formalities.formSsf',[
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
        $pdf = PDF::loadView('reports/informSsf');
        return response()->file($pdf->download('prueba.pdf'));
    }

    public function form_absenteeism() {
        $user = User::findOrFail(auth()->user()->getAuthIdentifier());
        $user->load('document_types');
        $absenteeismTypes = absenteeismType::all();
        return view('apps.formalities.formAbsenteeism',[
            'user' => $user,
            'absenteeismTypes' => $absenteeismTypes
        ]);
    }

    public function store_form_absenteeism(Request $request, User $user){
        $this->validate($request, [
            'absenteeismType' => 'required|numeric|exists:absenteeism_types,id',
            'datePermission' => 'required|date|after_or_equal:today',
            'departureTime' => 'required',
            'detailPermission' => 'required|string|max:191'
        ]);

        $absenteeismControl = new AbsenteeismControl();
        $absenteeismControl->user_id = $user->id;
        $absenteeismControl->absenteeism_type_id = $request->input('absenteeismType');
        $absenteeismControl->date_permission = $request->input('datePermission');
        $absenteeismControl->departure_time = $request->input('departureTime');
        $absenteeismControl->detail_permission = $request->input('detailPermission');
        $absenteeismControl->status_id = 1;

        try{
            $absenteeismControl->saveOrFail();
            return redirect()->route('formalities.form_absenteeism')->with([
                'status' => 'success',
                'message' => 'Los datos se guardaron con exito <a target="_blank" class="alert-link" href="'.route('formalities.print_form_absenteeism', $absenteeismControl->id).'"><i class="fa fa-print fa-fw"></i> Imprimir Formato <i class="fa fa-external-link-alt fa-fw"></i></a>'
            ]);
        }catch (\Exception $e){
            Log::error($e);
            return redirect()->route('formalities.form_absenteeism')->with([
                'status' => 'danger',
                'message' => 'Error al intentar crear el permiso'
            ]);
        }
    }

    public function show_form_absenteeism(AbsenteeismControl $absenteeismControl){
        return view('apps.formalities.showFormAbsenteeism',[
            'absenteeismControl' => $absenteeismControl
        ]);
    }

    public function print_form_absenteeism(AbsenteeismControl $absenteeismControl){

        if($absenteeismControl->status_id == 2)
        {
            return redirect()->route('formalities.index')->with([
                'status' => 'danger',
                'message' => 'Error - El permiso esta anulado'
            ]);
        }

        $pdf = PDF::loadView('reports.FormatAbsenteeism',[
            'absenteeismControl' => $absenteeismControl
        ]);
        $pdf->setPaper('letter', 'portrait');
        return $pdf->stream('formato_de_ausentismo_#_'.$absenteeismControl->id.'.pdf');

    }

    public function destroy_form_absenteeism(Request $request, AbsenteeismControl $absenteeismControl){
        $this->validate($request, [
           'nota' => 'required|string|max:191'
        ]);

        if($absenteeismControl->status_id == 2)
        {
            return redirect()->route('formalities.index')->with([
                'status' => 'danger',
                'message' => 'Error - El permiso ya fue anulado'
            ]);
        }

        $absenteeismControl->status_id = 2;
        $absenteeismControl->note = $request->input('nota');

        try{
            $absenteeismControl->saveOrFail();
            return response()->json([
                'message' => 'Acción realizada correctamente'
            ], 200);
        }catch (\Exception $e){
            Log::error($e);
            return response()->json([
                'message' => 'Error al intentar realizar la acción'
            ], 500);
        }
    }

    public function approve_form_absenteeism(AbsenteeismControl $absenteeismControl)
    {
        if($absenteeismControl->status_id == 2)
        {
            return redirect()->route('formalities.index')->with([
                'status' => 'danger',
                'message' => 'Error - El permiso esta anulado'
            ]);
        }

        $absenteeismControl->status_id = 3;

        try{
            $absenteeismControl->saveOrFail();
            return response()->json([
                'message' => 'El permiso fue aprobado'
            ], 200);
        }catch (\Exception $e){
            Log::error($e);
            return response()->json([
                'message' => 'Error al intentar aprobar el permiso'
            ], 500);
        }
    }

    public function check_arrival_form_absenteeism(Request $request, AbsenteeismControl $absenteeismControl)
    {
        $this->validate($request, [
            'time' => 'required|date_format:H:i',
            'date' => 'required|date||after_or_equal:'.$absenteeismControl->date_permission,
        ]);

        $absenteeismControl->arrival_date = $request->input('date');
        $absenteeismControl->arrival_time = $request->input('time');
        $absenteeismControl->status_id = 4;

        try{
            $absenteeismControl->saveOrFail();
            return response()->json([
                'message' => 'Se marco la hora de llegada y se finalizo el permiso'
            ], 200);
        }catch (\Exception $e){
            return response()->json([
                'message' => 'Error al intentar guardar los cambios'
            ], 500);
        }

    }

    public function permission_management(){
        $absenteeismControl = AbsenteeismControl::all();
        $absenteeismControlNotCheck = $absenteeismControl->filter(function ($item){
            return $item->status_id == 1;
        });
        $absenteeismControlNotArrivalTime = $absenteeismControl->filter(function ($item){
            return $item->status_id == 3;
        });
        return view('apps.formalities.permission_management',[
            'absenteeismControl' => $absenteeismControl,
            'absenteeismControlNotCheck' => $absenteeismControlNotCheck,
            'absenteeismControlNotArrivalTime' => $absenteeismControlNotArrivalTime
        ]);
    }
}
