@extends('layouts.main.master')

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="page-title">Medical Booking Dates</h2>
                <div class="row my-4">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th>Day</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                            <tr>
                                                <td>{{ $day }}</td>
                                                <td>
                                                    <span class="badge badge-{{ $dates[$day]->status ?? 0 ? 'success' : 'danger' }}">
                                                        {{ $dates[$day]->status ?? 0 ? 'On' : 'Off' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <button class="btn btn-info btn-sm btn-toggle" 
                                                            data-day="{{ $day }}" 
                                                            data-status="{{ $dates[$day]->status ?? 0 }}">
                                                        Change
                                                    </button>
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
</main>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleButtons = document.querySelectorAll('.btn-toggle');

        toggleButtons.forEach(button => {
            button.addEventListener('click', function () {
                const day = this.getAttribute('data-day');
                const button = this;

                fetch("{{ route('medicalDate.toggle') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ day })
                })
                .then(response => response.json())
                .then(data => {
                    const statusBadge = button.closest('tr').querySelector('span.badge');
                    if (data.status) {
                        statusBadge.classList.remove('badge-danger');
                        statusBadge.classList.add('badge-success');
                        statusBadge.textContent = 'On';
                    } else {
                        statusBadge.classList.remove('badge-success');
                        statusBadge.classList.add('badge-danger');
                        statusBadge.textContent = 'Off';
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    });
</script>
@endsection
