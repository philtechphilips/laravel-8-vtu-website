@extends('Users.includes.header')
@section("dash_title")
Data
@endsection
@section("title")
LuPay Buy Data
@endsection
@section("content")
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <!-- START widgets box-->
        <div class="row justify-content-center">
            <div class="col-md-8 col-md-offset-3">
                <div class="col-md-12">
                                        </div>
                <div class="card card-default" style="padding: 20px;">
                <div class="card-heading">
                    <a href="{{ url("user/service") }}"><i class="fa fa-arrow-circle-left fa-2x"></i></a>
                    <div class="text-center w-100">
                        <img id="service-img" class="img-thumbnail img-circle img-responsive thumb48" src="" width="70" alt="Logo">
                    </div>
                </div>
                <div class="card-body">
                   <div class="col-md-12">
                    <form>
                        @csrf
                        {{-- <h6 class="text text-danger" style="font-size: 16px; font-weight: bold;">Select Network</h6> --}}
                    <div class="row">
                            <div class="form-group my-3">
                                <h6 class="text text-primary" style="font-size: 16px; font-weight: bold;">Select Network</h6>
                                <select id="network" style="font-size: 14px;" class="form-control">
                                    <option selected disabled>--- SELECT NETWORK ---</option>
                                    <option value="MTN">--- MTN ---</option>
                                    <option value="AIRTEL">--- AIRTEL ---</option>
                                    <option value="9MOBILE">--- 9MOBILE ---</option>
                                    <option value="GLO">--- GLO ---</option>
                                </select>
                            </div>
                            
                            <div class="form-group my-3">
                                <h6 class="text text-primary" style="font-size: 16px; font-weight: bold;">Select Plan</h6>
                                <select id="check" style="font-size: 14px;" class="form-control">
                                    <option selected disabled>--- SELECT DATA PLAN ---</option>
                                </select>
                            </div>
                                <div class="form-group my-3">
                                    <h6 class="text text-primary" style="font-size: 16px; font-weight: bold;">Enter Phone Number</h6>
                                    <input type="phone" id="phone" style="font-size: 16px;" placeholder="Enter Phone Number" class="form-control">
                                </div>
                                <div class="form-group my-3">
                                    <label class="text text-primary" style="font-size: 16px; font-weight: bold;">Ported Number</label>
                                    <input type="checkbox">
                                </div>
                                <div class="form-group my-3">
                                    <input type="submit" id="submit" style="font-size: 16px;" class="btn btn-primary form-control" value="BUY NOW">
                                </div>
                            </div>
                    </div>
                    </form>
                   </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>
</div>
@endsection


@section("script")
<script src={{ asset("frontend/js/jquery.js") }}></script>
<script>
    $(document).ready(function(){
        // e.preventDefault();
  $("#network").change(function(){
    var network = $("#network").val();
    // alert(network);
    if(network == "MTN"){
        $("#service-img").attr("src", "{{ asset('images/mtn.jpg') }}");
        // alert(network);
    }else if(network == "AIRTEL"){
        $("#service-img").attr("src", "{{ asset('images/airtel.png') }}");
    }else if(network == "GLO"){
        $("#service-img").attr("src", "{{ asset('images/glo.jpg') }}");
    }else if(network == "9MOBILE"){
        $("#service-img").attr("src", "{{ asset('images/9mobile.png') }}");
    }

    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

    // $.ajax({
    //             method: "POST",
    //             url: "/add-to-cart",
    //             data:{
    //                 'network': network,
    //             },
    //             success: function (response){
    //                 alert(response);
    //             }
    //         });

    $("#check").load('/user/data/network',{
                  network:network
                });



  });
});
</script>
<script>
    $(document).ready(function () {
        $('#submit').click(function (e) {
            e.preventDefault();
           let network = $("#network").val();
           let check = $("#check").val();
           let phone = $("#phone").val();
          
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "POST",
                url: "/buy-data",
                data:{
                    'network': network,
                    'check': check,
                    'phone': phone,
                },
                success: function (response){
                    if(response == "Data Purchase is Sucessfull!"){
                        Swal.fire({
                                title: 'Data Purchase',
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
                    else if(response == "Insufficient Funds"){
                        Swal.fire({
                                title: 'OOPS?',
                                text: "Insufficient Funds",
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
            })
        });
    });
</script>

@endsection