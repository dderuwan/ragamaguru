@extends('layouts.main.master')

@section('title', 'Ragama Guru - Supplier Report')

@section('content')
<main role="main" class="main-content">
    <div class="container">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <h2>Supplier Report</h2>
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
                                            <th style="color: black;">#</th>
                                            <th style="color: black;">Supplier code</th>
                                            <th style="color: black;">Name</th>
                                            <th style="color: black;">Contact No.</th>
                                            <th style="color: black;">Address</th>
                                            <th style="color: black;">Registered Time</th>
                                            <th class="text-center" style="color: black;">Action</th>  
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($suppliers as $index=>$supplier)
                                        <tr>
                                            <td>{{$index+1}}</td>
                                            <td>{{$supplier->supplier_code}}</td>     
                                            <td>{{$supplier->name}}</td>
                                            <td>{{$supplier->contact}}</td>
                                            <td>{{$supplier->address}}</td>
                                            <td>{{$supplier->registered_time}}</td>
                                            <td>
                                                 <!-- Delete Button -->
                                                 <button class="btn btn-danger" onclick="confirmDelete({{ $supplier->id }})"><i class="fe fe-trash fe-16"></i></button>
                                                <form id="delete-form-{{ $supplier->id }}" action="{{ route('supplierdestroy', $supplier->id) }}" method="POST" style="display:none;">
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
                            return idx !== 6;
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
                                <h2 style="margin-top: 10px; font-size: 24px; font-weight: bold; text-align: center;">Supplier Report</h2>
                            </div>
                        `);

                        $(win.document.body).find('table').find('th:eq(6), td:eq(6)').hide();

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
