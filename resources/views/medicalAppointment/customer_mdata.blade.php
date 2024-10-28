@extends('layouts.main.master')

@section('content')

<main role="main" class="main-content">
  <div class="container-fluid">
    <div class="row justify-content-center p-4">
      <div class="col-12">

        <div class="card shadow mb-4 p-2 pl-3">
          <div class="card-header">
            <h3><strong class="card-title">Add Customer Medical Data</strong></h3>
          </div>
          <div class="card-body">
            <form action="{{ route('saveCustomerMData',$id) }}" method="POST" enctype="multipart/form-data">
              @csrf

              @foreach($quizzes as $quiz)
              <div class="form-group row mt-4">
                <label class="col-sm-3 col-form-label" style="color:black;">
                  {{ $quiz->quiz }}
                </label>
                <div class="col-sm-8">
                  <input type="text" class="form-control"
                    name="answers[{{ $quiz->id }}]"
                    value="{{ old('answers.' . $quiz->id, $customerAnswers[$quiz->id] ?? '') }}"
                    placeholder="Enter your answer">
                </div>
              </div>
              @endforeach


              <div class="form-group row">
                <div class="col-sm-10 mt-5">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </div>
            </form>
          </div>
        </div>

        @if (session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger">
          {{ session('error') }}
        </div>
        @endif

      </div>
    </div>
  </div>
</main>

<script>
  function updateImageLabel(input) {
    let fileName = input.files[0].name;
    input.nextElementSibling.innerText = fileName;
  }
</script>

@endsection