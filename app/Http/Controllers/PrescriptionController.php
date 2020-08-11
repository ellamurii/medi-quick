<?php

namespace App\Http\Controllers;

use App\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{

    public function showAllPrescriptions()
    {
        return response()->json(Prescription::with('prescriber','patient')->get()->makeHidden(['id']));
    }

    public function showOnePrescription($id)
    {
        return response()->json(Prescription::with('prescriber', 'patient')->findOrFail($id)->makeHidden(['id']));
    }

    public function create(Request $request)
    {   
        $prescription = new Prescription($request->all());
        $prescription->qr = 'none';
        $prescription->save();
        $id = $prescription->id;

        $prescriptionAppendQR = Prescription::findOrFail($id);
        $prescriptionAppendQR['qr'] = openssl_encrypt($prescription['id'],"AES-128-ECB",$prescription['prescriber_id']);
        $prescriptionAppendQR->save();

        return response()->json($prescriptionAppendQR, 201);
    }

    public function decryptPrescription(Request $request) {
        
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
