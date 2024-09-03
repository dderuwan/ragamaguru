@extends('layouts.main.master')

@section('title', 'Ragama Guru - Stock Report')

@section('content')
<main role="main" class="main-content">
    <div class="container">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <h2>Stock Report</h2>
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
                                            <th style="color: black;">Item code</th>
                                            <th style="color: black;">Name</th>
                                            <th style="color: black;">Stock</th>
                                            <th style="color: black;">Supplier</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($items as $index=>$item)
                                        <tr>
                                            <td>{{$index+1}}</td>
                                            <td>{{$item->item_code}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->quantity}}</td>
                                            <td>{{$item->supplier_code}}</td>                                 
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
                                <h2 style="margin-top: 10px; font-size: 24px; font-weight: bold; text-align: center;">Stock Report</h2>
                            </div>    
                        `);

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }

        ],
        
    });

    
});

</script>


@endsection
