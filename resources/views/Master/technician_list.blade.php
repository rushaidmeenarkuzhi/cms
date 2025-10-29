@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>

        <div class="col-md-10">
            <div class="card" style="margin-left:30px;">
                <div class="card-header">
                    <div class="d-flex">
                        <h6>Technician Complaint List</h6>
                        
                    </div>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered table-striped table-sm" style="font-size: 12px;">
                                    <thead>
                                        <tr>
                                            <th>Si.No</th>
                                            <th>Ticket ID</th>
                                            <th>Assinged To</th>
                                            <th>Complaint</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $data )
                                        <tr>
                                            <td align="center" style="width: 20px">{{ ++$i }}</td>
                                            <td align="center" style="width: 20px">{{ $data->ticket_id }}</td>
                                            <td align="center" style="width: 20px">Admin</td>
                                            <td align="center" style="width: 20px">{{ $data->subject }}</td>
                                            <td align="center" style="width: 20px">{{ \Carbon\Carbon::parse($data->updated_at)->format('d/m/Y') }}</td>
                                            <div class="btn-group title-quick-actions">
                                               <td width="100px">
                                                <a href="javascript:void(0);" 
                                                class="openModal" 
                                                data-ticket="{{ $data->ticket_id }}"
                                                data-status="{{ $data->status }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" 
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" 
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                                        class="feather feather-edit text-primary">
                                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                    </svg>
                                                </a>
                                            </td>
                                            </div>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
      <form id="editForm" method="POST" action="{{ route('technician_list.update') }}">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Update Complaint</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

                <div class="modal-body">
                <input type="hidden" name="ticket_id" id="ticket_id">

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                    <option value="resolved">Resolved</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="remarks" class="form-label">Remarks</label>
                    <input type="text" name="remarks" id="remarks" class="form-control" placeholder="Enter remarks...">
                </div>
                </div>

                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
            </div>
        </div>
        </div>
</div>
@include('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editModal = new bootstrap.Modal(document.getElementById('editModal'));

        document.querySelectorAll('.openModal').forEach(button => {
            button.addEventListener('click', function () {
                const ticketId = this.dataset.ticket;
                const status = this.dataset.status;

                document.getElementById('ticket_id').value = ticketId;
                document.getElementById('status').value = status;

                editModal.show();
            });
        });
    });
</script>

@endsection