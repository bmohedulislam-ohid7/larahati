<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <h1 class="text-danger pt-3 px-5">To<span class="text-dark">honey</span></h1>
    <table  class="pt-3 px-5">
    <tbody>
        <tr>
        <th scope="col">Order Id</th>
        <td>: {{ $data->id }}</td>
        </tr>
        <tr>
        <th scope="col">Name</th>
        <td>: {{ $data->customer_name }}</td>
        </tr>
        <tr>
        <th scope="col">Phone Number</th>
        <td colspan="2">: {{ $data->customer_phone_number }}</td>
        </tr>
        <tr>
        <th scope="col">Order Date Time</th>
        <td colspan="2">: {{ $data->created_at }}</td>
        </tr>
    </tbody>
</table>

<table class="table pt-5 px-5">
    <thead class="table table-info">
        <tr>
            <th>SL No</th>
            <th>Product Name</th>
            <th>Product Quantity</th>
            <th>Unit Price</th>
            <th>Product Price</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order_details as $order_detail)
             <tr>
        <th scope="row">{{ $loop->index +1 }}</th>
        <td>{{ $order_detail->relationtoproducttable->product_name }}</td>
        <td>{{ $order_detail->quantity }}</td>
        <td>{{ $order_detail->relationtoproducttable->product_price }}</td>
        <td>{{ $order_detail->relationtoproducttable->product_price * $order_detail->quantity}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
