<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParentModel;
use App\Models\Request as MilkRequest;
use Illuminate\Support\Facades\Auth;
use App\Model\Doctor;
use App\Models\Milk;
use App\Models\Allocation;
use Carbon\Carbon;

class RequestController extends Controller
{
    public function create()
    {
        $parents = ParentModel::all();

        return view('doctor.doctor_milk-request-form', compact('parents'));
    }

    public function viewRequestDoctor()
    {
        $requests = MilkRequest::with(['parent', 'doctor'])->latest()->get();
        return view('doctor.doctor_milk-request', compact('requests'));
    }

    public function viewRequestNurse()
    {
        // Milk Requests
        $requests = MilkRequest::with(['parent', 'doctor'])
                    ->latest()
                    ->get();

        // Only NON-EXPIRED milk
        $milks = Milk::whereDate('milk_expiryDate', '>=', Carbon::today())
                    ->get();

        return view('nurse.nurse_milk-request-list', compact('requests', 'milks'));
    }

    public function store(Request $request)
    {
        $doctor = \App\Models\Doctor::where('dr_ID', auth()->id())->first();

        $request->validate([
            'pr_ID'             => 'required',
            'weight'            => 'required|numeric',
            'entered_volume'    => 'required|numeric',
            'feeding_date'      => 'required|date',
            'start_time'        => 'required',
            'feeds_per_day'     => 'required|integer',
            'interval_hours'    => 'required|integer',
        ]);

        MilkRequest::create([
            'dr_ID'              => $doctor->dr_ID, // doctor logged in
            'pr_ID'              => $request->pr_ID,
            'current_weight'     => $request->weight,
            'recommended_volume' => $request->entered_volume,
            'feeding_start_date' => $request->feeding_date,
            'feeding_start_time' => $request->start_time,
            'feeding_perday'     => $request->feeds_per_day,
            'feeding_interval'   => $request->interval_hours,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Milk Request submitted successfully!'
        ]);
    }
    
    public function allocateMilk(Request $request)
    {
        $request->validate([
            'request_id'      => 'required|exists:request,request_ID',
            'selected_milk'   => 'required|array',
            'allocation_times'=> 'required|array',
            'total_volume'    => 'required',
            'storage_location'=> 'required'
        ]);

        foreach ($request->selected_milk as $milk) {

            Allocation::create([
                'request_ID'             => $request->request_id,
                'milk_ID'                => $milk['id'],
                'total_selected_milk'    => $request->total_volume,
                'storage_location'       => $request->storage_location,
                'allocation_milk_date_time' => json_encode([
                    'milk_id' => $milk['id'],
                    'datetime' => $request->allocation_times[$milk['id']] ?? null
                ])
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function delete($id)
    {
        $req = MilkRequest::findOrFail($id);
        $req->delete();

        return response()->json([
            'success' => true,
            'message' => 'Milk request deleted successfully.'
        ]);
    }

    public function setInfantWeightNurse()
    {
        $parents = ParentModel::all();

        return view('nurse.nurse_set-infant-weight', compact('parents'));
    }

    public function updateInfantWeightNurse(Request $request)
    {
        $request->validate([
            'pr_ID' => 'required|exists:parent,pr_ID',
            'pr_BabyCurrentWeight' => 'required|numeric|min:0',
        ]);

        $parent = ParentModel::findOrFail($request->pr_ID);
        $parent->pr_BabyCurrentWeight = $request->pr_BabyCurrentWeight;
        $parent->save();

        return response()->json(['success' => true, 'message' => 'Weight updated!']);
    }

}