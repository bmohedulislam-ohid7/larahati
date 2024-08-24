
<div class="card">
    <div class="card-header">Hello Admin</div>

    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">SL No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone_number</th>
                    <th scope="col">total</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            @foreach ($orders as $order)
            <tbody>
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{ $order->customer_name}}</td>
                    <td>{{$order->customer_phone_number}}</td>
                    <td>{{$order->total}}</td>
                    <td>
                        <a href="{{ route('downloadinvoice',$order->id) }}">
                            <i class="fa fa-download"> Download Invoice </i>
                        </a>
                        <br>
                        <a href="{{ route('givereview',$order->id) }}">
                            <i class="fa fa-star"> Give Review </i>
                        </a>
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
</div>

