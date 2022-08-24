@extends('Users.includes.header')
@section("dash_title")
Dashboard
@endsection
@section("title")
LuPay Dashboard
@endsection
@section('content')

<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card tryal-gradient">
                                    <div class="card-body tryal row">
                                        <div class="col-xl-7 col-sm-6">
                                            <h2>Need A Website or Mobile App of Your Own?</h2>
                                            <span>Let us be the one to create and manage your website & application.</span>
                                            <a href="javascript:void(0);" class="btn btn-rounded  fs-18 font-w500">Contact Us Now</a>
                                        </div>
                                        <div class="col-xl-5 col-sm-6">
                                            <img src="images/chart.png" alt="" class="sd-shape">
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                            <div>
                                {{-- Extra Content --}}
                            </div>

                        </div>
                        
                    </div>
                    <div class="col-xl-6">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="row">
                                    <div class="col-xl-6 col-sm-6">
                                        <div class="card">
                                            <div class="card-body d-flex px-4 pb-0 justify-content-between">
                                                <div>
                                                    <h4 class="fs-18 font-w600 mb-4 text-nowrap">Total Transactions</h4>
                                                    <div class="d-flex align-items-center">
                                                        <h2 class="fs-32 font-w700 mb-0">68</h2>
                                                        <span class="d-block ms-4">
                                                            <svg width="21" height="11" viewbox="0 0 21 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M1.49217 11C0.590508 11 0.149368 9.9006 0.800944 9.27736L9.80878 0.66117C10.1954 0.29136 10.8046 0.291359 11.1912 0.661169L20.1991 9.27736C20.8506 9.9006 20.4095 11 19.5078 11H1.49217Z" fill="#09BD3C"></path>
                                                            </svg>
                                                            <small class="d-block fs-16 font-w400 text-success">+0,5%</small>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div id="columnChart"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-sm-6">
                                        <div class="card">
                                            <div class="card-body px-4 pb-0">
                                                <h4 class="fs-18 font-w600 mb-5 text-nowrap">Refer and Win</h4>
                                                <div class="" style="margin-top: -20px">
                                                    <input type="text" style="font-size: 18px; font-weight:500px" class="form-control" value="ref?id">
                                                </div>
                                                {{-- <div class="d-flex align-items-end mt-2 pb-3 justify-content-between">
                                                    <span>76 left from target</span>
                                                    <h4 class="mb-0">42</h4>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                    

                                    <div class="col-xl-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-xl-6 col-sm-6">
                                                        <div class=" owl-carousel card-slider">
                                                            <div class="items">
                                                                <h4 class="fs-20 font-w700 mb-4">Buy/Sell Airtime</h4>
                                                                <span class="fs-14 font-w400">You can buy airtime for yourself and loved ones conviniently Airtel, Mtn, Glo, Etisalat </span>
                                                            </div>	
                                                            <div class="items">
                                                                <h4 class="fs-20 font-w700 mb-4">Buy/Sell Data</h4>
                                                                <span class="fs-14 font-w400">All Network Data are Avaliable</span>
                                                            </div>	
                                                            <div class="items">
                                                                <h4 class="fs-20 font-w700 mb-4">Buy/Sell Gift Card</h4>
                                                                <span class="fs-14 font-w400">Coming Soon.... </span>
                                                            </div>
                                                            <div class="items">
                                                                <h4 class="fs-20 font-w700 mb-4">Tv Subscription</h4>
                                                                <span class="fs-14 font-w400">Subscribe Your GoTv, Startimes, DSTV Convinently</span>
                                                            </div>	
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-sm-6">
                                                        <img src= {{ asset("images/Data.jpg") }} style="margin-left: 20px" width="150px">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>




                            
                        </div>
                    </div>
                </div>
            </div>
        </div>


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
        </div>

        </div>
    </div>
</div>


@endsection

@section('script')
<script src={{  asset("vendor/global/global.min.js") }}></script>

<!-- Datatable -->
<script src={{  asset("vendor/datatables/js/jquery.dataTables.min.js") }}></script>
<script src={{  asset("js/plugins-init/datatables.init.js") }}></script>


@endsection