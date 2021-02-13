@extends('master')
@section('content')
<div class="custom-product">


    <div class="col-sm-10">
        <table class="table table-striped">

            <tbody>
                <tr>
                    <td>Amount</td>
                    <td>${{$total}}</td>
                </tr>
                <tr>
                    <td>Tax</td>
                    <td>$ 0</td>
                </tr>
                <tr>
                    <td>Delivery</td>
                    <td>$ 10</td>
                </tr>
                <tr>
                    <td>Total Amount</td>
                    <td>${{$total+10}}</td>
                </tr>


        </table>
        <div>
            <form action="/orderplace" method="post">
                @csrf
                <div class="form-group">

                    <textarea name="address" placeholder="Enter Your Address" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="pwd">Payment Method: </label><br> <br>
                    <input type="radio" value="cash" name="payment"><span>online payment</span><br> <br>
                    <input type="radio" value="cash" name="payment"><span>EMI payment</span><br> <br>
                    <input type="radio" value="cash" name="payment"><span>payment on delivery</span>
                </div>

                <button type="submit" class="btn btn-success">Order Now</button>
            </form>
        </div>
    </div>

</div>
@endsection