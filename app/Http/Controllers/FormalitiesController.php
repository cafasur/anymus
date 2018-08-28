<?php

namespace App\Http\Controllers;

use App\AbsenteeismControl;
use App\absenteeismType;
use App\CategoryReport;
use App\Periodicity;
use App\Rules\CheckPermissionDate;
use App\ShippingPeriod;
use App\TypeSignature;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
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

    public function permission_management(){
        $users = User::all();
        $absenteeismTypes = absenteeismType::all();
        $absenteeismControl = AbsenteeismControl::all();
        $absenteeismControlNotCheck = $absenteeismControl->filter(function ($item){
            return $item->status_id == 1;
        });
        $absenteeismControlNotArrivalTime = $absenteeismControl->filter(function ($item){
            return $item->status_id == 4;
        });
        return view('apps.formalities.permission_management',[
            'absenteeismControl' => $absenteeismControl,
            'absenteeismControlNotCheck' => $absenteeismControlNotCheck,
            'absenteeismControlNotArrivalTime' => $absenteeismControlNotArrivalTime,
            'absenteeismTypes' => $absenteeismTypes,
            'users' => $users
        ]);
    }

    public function store_form_absenteeism(Request $request, User $user){

        $this->validate($request, [
            'absenteeismType' => 'required|numeric|exists:absenteeism_types,id',
            'datePermission' => ['required','date', new CheckPermissionDate],
            'detailPermission' => 'required|string|max:191'
        ]);

        $absenteeismControl = new AbsenteeismControl();
        $absenteeismControl->user_id = $user->id;
        $absenteeismControl->absenteeism_type_id = $request->input('absenteeismType');
        $absenteeismControl->permission_date = $request->input('datePermission');
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

    public  function store_form_absenteeism2(Request $request)
    {
        $this->validate($request, [
            'user' => 'required|numeric|exists:users,id',
            'absenteeismType' => 'required|numeric|exists:absenteeism_types,id',
            'datePermission' => ['required','date', new CheckPermissionDate],
            'detailPermission' => 'required|string|max:191'
        ]);

        $user = User::find($request->input('user'));
        $absenteeismControl = new AbsenteeismControl();
        $absenteeismControl->user_id = $user->id;
        $absenteeismControl->absenteeism_type_id = $request->input('absenteeismType');
        $absenteeismControl->permission_date = $request->input('datePermission');
        $absenteeismControl->detail_permission = $request->input('detailPermission');
        $absenteeismControl->status_id = 1;

        try{
            $absenteeismControl->saveOrFail();
            return redirect()->route('formalities.permission_management')->with([
                'status' => 'success',
                'message' => 'Los datos se guardaron con exito <a target="_blank" class="alert-link" href="'.route('formalities.print_form_absenteeism', $absenteeismControl->id).'"><i class="fa fa-print fa-fw"></i> Imprimir Formato <i class="fa fa-external-link-alt fa-fw"></i></a>'
            ]);
        }catch (\Exception $e){
            Log::error($e);
            return redirect()->route('formalities.permission_management')->with([
                'status' => 'danger',
                'message' => 'Error al intentar crear el permiso'
            ]);
        }

    }

    public function show_form_absenteeism(AbsenteeismControl $absenteeismControl)
    {
        return view('apps.formalities.showFormAbsenteeism',[
            'absenteeismControl' => $absenteeismControl
        ]);
    }

    public function print_form_absenteeism(AbsenteeismControl $absenteeismControl)
    {
        $pdf = PDF::loadView('reports.FormatAbsenteeism',[
            'absenteeismControl' => $absenteeismControl
        ]);
        $pdf->setPaper('letter', 'portrait');
        return $pdf->stream('formato_de_ausentismo_#_'.$absenteeismControl->id.'.pdf');
    }

    public function cancel_form_absenteeism(Request $request, AbsenteeismControl $absenteeismControl)
    {
        $this->validate($request, [
            'nota' => 'required|string|max:191'
        ]);

        if($absenteeismControl->status_id == 2 or $absenteeismControl->status_id == 3 or $absenteeismControl->status_id == 5){
            return response()->json([
                'message' => 'Error - No se puede anular el permiso'
            ], 500);
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

    public function refuse_form_absenteeism(Request $request, AbsenteeismControl $absenteeismControl)
    {
        $this->validate($request, [
           'nota' => 'required|string|max:191'
        ]);

        if($absenteeismControl->status_id == 2 or $absenteeismControl->status_id == 3 or $absenteeismControl->status_id == 5){
            return response()->json([
                'message' => 'Error - No se puede rechazar el permiso'
            ], 500);
        }

        $absenteeismControl->status_id = 3;
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
        if($absenteeismControl->status_id == 2 or $absenteeismControl->status_id == 3 or $absenteeismControl->status_id == 5){
            return response()->json([
                'message' => 'Error - No se puede aprobar el permiso'
            ], 500);
        }

        $absenteeismControl->status_id = 4;
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
            'date' => ['required','date','after:'.$absenteeismControl->permission_date, new CheckPermissionDate]
        ]);

        if($absenteeismControl->status_id != 4 ){
            return response()->json([
                'message' => 'Error - No se puede finalizar el permiso debe de estar aprobado'
            ], 422);
        }

        $absenteeismControl->arrival_date = $request->input('date');
        $absenteeismControl->status_id = 5;

        $minutesAbsent = $absenteeismControl->permission_date->diffFiltered(CarbonInterval::minutes(),function (Carbon $date){
            $morning = new Carbon($date->toDateString());
            $morning->hour = 7;
            $morning->minute = 1;

            $midday = new Carbon($date->toDateString());
            $midday->hour = 12;
            $midday->minute = 30;

            $afternoon = new Carbon($date->toDateString());
            $afternoon->hour = 14;
            $afternoon->minute = 1;

            $night = new Carbon($date->toDateString());
            $night->hour = 18;

            return (!$date->isWeekend()) and ($date->between($morning, $midday) or $date->between($afternoon, $night));
        }, $absenteeismControl->arrival_date);


        try{
            $absenteeismControl->saveOrFail();

            return response()->json([
                'message' => 'Se marco la hora y fecha de llegada y se finalizo el permiso',
                'hours' => ($minutesAbsent/60),
                'idAbsenteeism' => $absenteeismControl->id,
                'permission_date' => $absenteeismControl->permission_date->toDateTimeString(),
                'arrival_date' => $absenteeismControl->arrival_date->toDateTimeString(),
            ], 200);
        }catch (\Exception $e){
            return response()->json([
                'message' => 'Error al intentar guardar los cambios'
            ], 500);
        }
    }

    public function confirm_hours_absent_form_absenteeism (Request $request, AbsenteeismControl $absenteeismControl){
        $this->validate($request, [
           'hoursAbsent' => 'required|numeric'
        ]);

        $absenteeismControl->hours_absent = $request->input('hoursAbsent');

        try{
            $absenteeismControl->saveOrFail();
            return response()->json([
                'message' => 'Exito - datos guardados correctamente.',
            ], 200);
        }catch (\Exception $e){
            return response()->json([
                'message' => 'Error al intentar guardar los cambios'
            ], 500);
        }
    }
}
