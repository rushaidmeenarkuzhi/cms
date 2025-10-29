<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class TechnicianController extends Controller
{
    public function index()
    { 
        $i = 0;
        $datas = Complaint::where('status', 'assigned')->get();
        // dd($datas);
        return view('Master.technician_list', ['datas'=> $datas,'i'=>$i]);
    }

   public function update(Request $request)
{
    $request->validate([
        'ticket_id' => 'required|exists:complaints,ticket_id',
        'status' => 'required',
    ]);

    $complaint = Complaint::where('ticket_id', $request->ticket_id)->first();
    // dd($complaint);
    $complaint->update([
        'status' => $request->status,
        'remarks' => $request->remarks,
    ]);

    return redirect()->route('technician_list.index')->with('success', 'Complaint updated successfully!');

}
    
}
