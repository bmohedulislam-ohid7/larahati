@extends('layouts.starlight')
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb">
        <span class="breadcrumb-item active">Dashboard</span>
    </nav>
@endsection

@section('dashboard')
active
@endsection
@section('title')
Dashboard
@endsection
@section('content')
<h1>Role: {{ Auth::user()->role }}</h1>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
          @if (Auth::user()->role == 1)
                <div class="card">
                <div class="alert alert-success">
                    Total Users:{{$users->count()}}
                </div>
                <div class="card-header">Hello Admin</div>

                <div class="card-body">
                    <div>
                        <canvas id="myChart"></canvas>
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">SL No</th>
                            <th scope="col">Name</th>
                            <th scope="col">email</th>
                            <th scope="col">Acount Created Time</th>
                            </tr>
                        </thead>
                        @foreach ($users as $user)
                             <tbody>
                                <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->created_at->diffForHumans()}}</td>
                                </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
          @else
            @include('customerdashbord')
          @endif
        </div>
    </div>
</div>
@endsection
@section('footer_scripts')
<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['COD', 'Credit Cart'],
      datasets: [{
        label: 'Payment Status',
        data: [{{ $cashondelivery }}, {{ $creditcard }}],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
@endsection
