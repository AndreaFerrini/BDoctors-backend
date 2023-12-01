@extends ('layouts.app')

@section('content')
  @foreach ($doctors as $doctor)
      <div class="card" style="width: 18rem;">
          <img src=" {{  asset('storage/' . $doctor->photo) }} " class="card-img-top" alt="{{ $doctor->name }}">
          <div class="card-body">
            <h5 class="card-title">{{ $doctor->name }}</h5>
            <a href="{{ route('admin.doctors.edit', ['doctor' => $doctor]) }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('admin.doctors.show', ['doctor' => $doctor]) }}" class="btn btn-primary">Show</a>
          </div>
      </div>
  @endforeach
@endsection
