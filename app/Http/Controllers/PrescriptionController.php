<?php

namespace App\Http\Controllers;

use App\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{

    public function showAllPrescriptions()
    {
        $res = Prescription::with('prescriber')->get();
        $res->makeHidden(['prescriber_id']);
        return response()->json($res);
    }

    public function showOnePrescription($id)
    {
        $res = Prescription::with('prescriber')->find($id);
        $res->makeHidden(['prescriber_id']);
        return response()->json($res);
    }

    public function create(Request $request)
    {
        $prescription = Prescription::create($request->all());

        return response()->json($prescription, 201);
    }

    public function update($id, Request $request)
    {
        $prescription = Prescription::findOrFail($id);
        $prescription->update($request->all());

        return response()->json($prescription, 200);
    }

    public function delete($id)
    {
        Prescription::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}
