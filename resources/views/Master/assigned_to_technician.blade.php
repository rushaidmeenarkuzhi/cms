@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2"></div>

        <!-- Main Content -->
        <div class="col-md-10">
            <div class="card" style="margin-left:30px;">
                <div class="card-header">
                    <h6>ASSIGNED TO TECHNICIAN</h6>

                </div>
                <div class="card-body">
                    <form id="saveform" action="{{ route('complaint.assign', $complaint->ticket_id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <div class="d-flex">
                                            <label for="ticket_id">Select Technician</label>
                                            <font color="#FF0000" size="">*</font>
                                        </div>

                                    </div>

                                    <div class="col-sm-8">
                                        <select name="technician_id" id="technician_id" class="form-control" required>
                                                            <option value="">-- Choose Technician --</option>
                                                            <option value="technician">Technician</option>
                                            </select>
                                    </div>
                                </div>
                            </div>
 
                        </div>
    
                            </div>
 
                            <div class="">
                                <button type="submit" class="btn btn-sm btn-primary">Assign</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@include('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection