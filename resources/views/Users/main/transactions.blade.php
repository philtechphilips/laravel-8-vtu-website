@extends('Users.includes.header')
@section("dash_title")
Top Up
@endsection
@section("title")
LuPay Top Up Transactions
@endsection
@section('content')
<div class="content-body">
  <div class="container-fluid">
  <div class="col-12">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">All Transactions</h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example3" class="display table table-striped" style="min-width: 845px">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Tx ID</th>
                            <th>Time</th>
                            <th>Amount</th>
                            <th>Balance</th>
                            <th>Prev. Balance</th>
                            <th>Product</th>
                            <th>Description</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $count = 1;
                        @endphp
                        @foreach ($all_tranactions as $trans)
                        @php
                            if( $trans->product == "Wallet Funding"){
                                $class = "text text-success";
                            }else{
                                $class = "text text-danger";
                            }
                        @endphp
                        <tr>  
                            <td>
                                @php
                                    echo $count++;
                                @endphp
                            </td>
                            <td class="@php echo $class;  @endphp">{{ $trans->tx_id }}</td>
                            <td class="@php echo $class;  @endphp">{{ $trans->time }}</td>
                            <td class="@php echo $class;  @endphp">&#8358; {{ $trans->amount}}</td>
                            <td class="@php echo $class;  @endphp">&#8358; {{ $trans->balance }}</td>
                            <td class="@php echo $class;  @endphp">&#8358; {{ $trans->prev_bal }}</td>
                            <td class="@php echo $class;  @endphp">{{ $trans->product }}</td>
                            <td class="@php echo $class;  @endphp">{{ $trans->description }}</td>
                            <td>
                                @if ($trans->status == 1)
                                    <button class="btn btn-success">SUCESSFUL</button>
                                @else
                                    <button class="btn btn-danger">FAILED</button>
                                @endif
                            </td>
                        </tr>
                        
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div></div></div>
@endsection


@section('script')
<script src={{  asset("vendor/global/global.min.js") }}></script>

<!-- Datatable -->
<script src={{  asset("vendor/datatables/js/jquery.dataTables.min.js") }}></script>
<script src={{  asset("js/plugins-init/datatables.init.js") }}></script>


@endsection