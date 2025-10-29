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
                    <h6>{{ isset($complaint) ? 'EDIT COMPLAINT' : 'ADD NEW COMPLAINT' }}</h6>

                </div>
                <div class="card-body">
                    <form id="saveform" action="{{ isset($complaint) ? route('complaints.update', $complaint->id) : route('complaints.store') }}" method="POST">
                        @csrf
                        @if(isset($complaint))
                        @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <div class="d-flex">
                                            <label for="ticket_id">Ticket Id</label>
                                            <font color="#FF0000" size="">*</font>
                                        </div>

                                    </div>

                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="ticket_id" name="ticket_id" value="{{ isset($complaint) ? $complaint->ticket_id : '' }}" required>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                 <div class="form-group row">
                                    <div class="col-sm-4">
                                        <div class="d-flex">
                                            <label for="subject">Subject</label>
                                            <font color="#FF0000" size="">*</font>
                                        </div>

                                    </div>

                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="subject" name="subject" value="{{ isset($complaint) ? $complaint->subject : '' }}" >

                                    </div>
                                </div>
                            </div>
                            
                        </div>
                         <div class="row">
                            
                            <div class="col-md-6">
                                 <div class="form-group row">
                                    <div class="col-sm-4">
                                        <div class="d-flex">
                                            <label for="description">Description</label>
                                            <font color="#FF0000" size="">*</font>
                                        </div>

                                    </div>

                                    <div class="col-sm-8">
                                        <textarea class="form-control" name="description" id="description" cols="30" rows="1">{{ isset($complaint) ? $complaint->description  : ''}}</textarea>

                                    </div>
                                </div>
                            </div>
                             <div class="col-md-6">
                                 <div class="form-group row">
                                    <div class="col-sm-4">
                                        <div class="d-flex">
                                            <label for="status">Status</label>
                                        </div>

                                    </div>

                                    <div class="col-sm-8">
                                        <select name="status" id="status" class="form-control">
                                            <option value="pending">Pending</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                         </div>
                         
                               
                            </div>
                           
                            
                            
                            <div class="">
                                <button type="submit" class="btn btn-sm btn-primary">Save</button>
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