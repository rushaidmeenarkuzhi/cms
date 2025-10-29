<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\User;

use Alert;
use Illuminate\Http\Request;
use Auth;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $i = 0;
        $complaint = Complaint::where('deleted_at', null)->get();
        return view('Master.complaints', ['complaint' => $complaint, 'i' => $i]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Master.create_complaints');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd(4567);
        $this->validate($request, [
            'ticket_id' => 'required',
            'subject' => 'required',
            'description' => 'required',
            
        ]);

        $userId = Auth::user()->id;
        $complaint = complaint::where('description', $request->description)->orWhere('ticket_id', $request->ticket_id)->first();
        if ($complaint) {
            return redirect()->back()->with('error', 'This Complaint Alredy Exist!');
        }
        
        $complaint = new Complaint([
            'ticket_id' => $request->get('ticket_id'),
            'user_id' => $userId,
            'subject' => $request->get('subject'),
            'description' => $request->get('description'),
            'status' => $request->get('status'),
        ]);
        $complaint->save();
        return redirect()->route('complaints.index')->with('success', 'Complaint Registered successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $complaint = Complaint::where('id', $id)->first();
        return view('Master.create_complaints', compact('complaint'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'ticket_id' => 'required',
            'subject' => 'required',
            'description' => 'required',
        ]);

        $userId = Auth::user()->id;


        $existingComplaint = Complaint::where(function ($query) use ($request) {
            $query->where('description', $request->description)
                ->orWhere('ticket_id', $request->ticket_id);
        })
            ->where('id', '!=', $id)
            ->first();

        if ($existingComplaint) {
            return redirect()->back()->with('error', 'This Complaint already exists!');
        }

        $complaint = Complaint::findOrFail($id);
        $complaint->ticket_id = $request->ticket_id;
        $complaint->user_id = $userId;
        $complaint->subject = $request->subject;
        $complaint->description = $request->description;
        $complaint->status = $request->status;
        $complaint->save();

        return redirect()->route('complaints.index')->with('success', 'Complaint updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd(12);
        $complaint = Complaint::find($id);
       $result = $complaint->delete();
       
         if ($result) {
          return redirect()->route('complaints.index')->with('success', 'Complaint Deleted successfully!');

        }
        
    }

    public function showassign($ticket_id)
    {
           $complaint = Complaint::where('ticket_id', $ticket_id)->first();
            $technicians = User::where('user_type', 3)->get();

            return view('Master.assigned_to_technician', compact('complaint', 'technicians'));
    }


        public function assignTechnician(Request $request,$ticket_id)
        {

        $complaint = Complaint::where('ticket_id', $ticket_id)->firstOrFail();
        $complaint->update([
            'technician_id' => $request->technician_id,
             'status' => 'assigned',
        ]);

            return redirect()->route('home')->with('success', 'Technician assigned successfully!');

        }
}
