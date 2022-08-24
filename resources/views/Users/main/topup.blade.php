@extends('Users.includes.header')
@section("dash_title")
Top Up
@endsection
@section("title")
LuPay Top Up Wallet
@endsection
@section('content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-6">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">
                Your Virtual Account Number
              </h3>
            </div>
            <div class="card-body">
              
             
            </div>
            <!-- /.card -->
          </div>
        </div>


        <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Other Payment Method</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="paymentForm">
                @csrf
                <div class="card-body">
                    <label for="exampleInputEmail" style="font-size: 14px">Amount</label>
                  <div class="form-group input-group">
                    <span class="input-group-text"><a href="javascript:void(0)">&#8358</a></span>
                    <input type="number" name="amount" id="amount" class="form-control" id="exampleInputEmail1" style="font-size: 13px" placeholder="Enter Amount">
                    {{-- <span class="input-group-text"><a href="javascript:void(0)"><i class="flaticon-381-search-2"></i></a></span> --}}
                </div>
                <input type="hidden" id="email-address" value="{{ Auth::user()->email }}">
                <br>
                  <div class="form-group">
                    <label for="exampleInputPassword1" style="font-size: 14px">Select Payment Method</label>
                    <select name="payment" class="form-control">
                        <option value="Paystack" option="selected" style="font-size: 13px !important">-- Pay Online Using ATM Card, USSD... (+1.5%) [From &#8358 100]--</option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" onclick="payWithPaystack(event)" class="btn btn-primary" style="font-size: 13px">Fund Wallet</button>
                </div>
              </form>
            </div>
              <!-- /.card -->
            </div>
          </div>
       
       
       


          <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">All Transactions</h1>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 900px">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Transaction ID</th>
                                    <th>Amount</th>
                                    <th>Date Initiated</th>
                                    {{-- <th>Action</th> --}}
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php
                              $count = 1;
                            @endphp
                          
                            @foreach ($all_funds as $funds)
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{ $funds->trans_id }}</td>
                                <td>{{ $funds->amount }}</td>
                                <td>{{ $funds->init_time }}</td>
                                <td><a class="btn btn-success">{{ $funds->gateway_response }}</a></td>
                                {{-- <td><a class="btn btn-success btn-md">{{ $funds->status }}</a></td> --}}
                        @endforeach
                           
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>





       
        </div>
      </div>
</div>
@endsection

@section('script')
<script src={{  asset("vendor/global/global.min.js") }}></script>
<script src="https://js.paystack.co/v1/inline.js"></script> 
<!-- Datatable -->

<script src={{  asset("vendor/datatables/js/jquery.dataTables.min.js") }}></script>
<script src={{  asset("js/plugins-init/datatables.init.js") }}></script>
<script>
  let paymentForm = document.getElementById('paymentForm');
paymentForm.addEventListener('submit', payWithPaystack, false);
function payWithPaystack(e) {
  e.preventDefault();
  let handler = PaystackPop.setup({
    key: 'pk_test_7c371d93d1d4c27411cad38812b18a3533b6ff63', // Replace with your public key
    email: document.getElementById('email-address').value,
    amount: document.getElementById('amount').value * 100, // the amount value is multiplied by 100 to convert to the lowest currency unit
    currency: 'NGN', // Use GHS for Ghana Cedis or USD for US Dollars
    ref: 'LuPay' + Math.floor((Math.random() * 1000000000) + 1), // Replace with a reference you generated
    callback: function(response) {
      //this happens after the payment is completed successfully
      let reference = response.reference;
      // alert('Payment complete! Reference: ' + reference);
      // Make an AJAX call to your server with the reference to verify the transaction
      
      $.ajax({
        type: "GET",
        url: "{{ URL::to('/user/topup/verify-payment') }}/"+reference,
        success: function (response){
          let responses = response; 
          if(responses == "Inserted Sucessfully"){
            Swal.fire({
                                title: 'Wallet Funding',
                                text: "is Sucessful!",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#795ab6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK!'
                                }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                                })
          }
          else{
            Swal.fire({
                                title: 'OOPS?',
                                text: "Somethhing Went Wrong!",
                                icon: 'warning',
                                showCancelButton: false,
                                confirmButtonColor: '#d33',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK!'
                                }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                                })
          }
        }
      });
    },
    onClose: function() {
      alert('Transaction was not completed, window closed.');
    },
  });
  handler.openIframe();
}
</script>

@endsection