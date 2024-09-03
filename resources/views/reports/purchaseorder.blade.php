@extends('layouts.main.master')

@section('title', 'Ragama Guru - Purchase Order Report')

@section('content')
<main role="main" class="main-content">
    <div class="container">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <h2>Purchase Order Report</h2>
                        </div>
                    </div>
                    <p class="card-text"></p>
                    <div class="row my-4">
                        
                        <!-- Small table -->
                        <div class="col-md-12">
                            <div class="card shadow">
                                <div class="card-body">
                                <table id="mydata" class="table">
                                    <thead>
                                        <tr>
                                            <th>Order-Request-Code</th>
                                            <th>Supplier Code</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th width="200px">Action</th>   
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($orderRequests as $orderRequest)
                                        <tr>
                                            <td>{{ $orderRequest->order_request_code }}</td>
                                            <td>{{ $orderRequest->supplier_code }}</td>
                                            <td>{{ $orderRequest->date }}</td>
                                            <td>{{ $orderRequest->status }}</td>
                                            <td>
                                                <!-- Show Button -->
                                                <a href="{{ route('purchaseordershow', $orderRequest->id) }}" class="btn btn-secondary"><i class="fe fe-eye fe-16"></i></a>

                                                <!-- Delete Button -->
                                                <button class="btn btn-danger" onclick="confirmDelete({{ $orderRequest->id }})"><i class="fe fe-trash fe-16"></i></button>
                                                <form id="delete-form-{{ $orderRequest->id }}" action="{{ route('purchaseorderdestroy', $orderRequest->id) }}" method="POST" style="display:none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
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
    </div>
</main>



<script>
$(document).ready(function() {
    var table = $('#mydata').DataTable({
        dom: 'Bfrtip', // Layout for DataTables with Buttons
        buttons: [
            {
                extend: 'copyHtml5',
                footer: true
            },
            {
                extend: 'excelHtml5',
                footer: true
            },
            {
                extend: 'csvHtml5',
                footer: true
            },
            {
                    extend: 'pdfHtml5',
                    footer: true,
                    customize: function(doc) {
                        doc.content[1].margin = [0, 0, 0, 20];
                    },
                    exportOptions: {
                        columns: function(idx, data, node) {
                            return idx !== 4;
                        }
                    }
                },
                {
                    extend: 'print',
                    footer: true,
                    title: '',
                    customize: function(win) {
                        $(win.document.body)
                            .prepend(`
                            <div style="text-align: center; margin: 0 auto; width: 100%; page-break-after: avoid;">
                                <img src="/images/logos/1723184027.png" style="height: 50px; width: auto; display: block; margin: 0 auto;" />
                                <h2 style="margin-top: 10px; font-size: 24px; font-weight: bold; text-align: center;">Purchase Order Report</h2>
                            </div>
                        `);

                        $(win.document.body).find('table').find('th:eq(4), td:eq(4)').hide();

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
        ],
        
    });

    
});

</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(supplier_code) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + supplier_code).submit();
            }
        })
    }
</script>

@endsection
