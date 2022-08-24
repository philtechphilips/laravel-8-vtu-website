   <!--**********************************
        Sidebar start
    ***********************************-->
    <div class="dlabnav">
        <div class="dlabnav-scroll">
            <ul class="metismenu" id="menu">
                <li><a class="" href={{ url("/home") }} aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                
                <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-wallet"></i>
                        <span class="nav-text">Services</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href={{ url("user/data") }}>Buy Data Bundle</a></li>
                        <li><a href={{ url("user/airtime") }}>Buy Airtime</a></li>
                        <li><a href={{ url("user/data") }}>TV Decoder</a></li>
                        <li><a href={{ url("user/electricity") }}>Pay Electricity</a></li>
                        <li><a href={{ url("user/data") }}>Convert Excess Arirtime to Cash</a></li>
                        <li><a href={{ url("user/data") }}>Print Recharge</a></li>
                        <li><a href={{ url("user/data") }}>Internet Data(Smile, Spectranet)</a></li>
                        <li><a href={{ url("user/data") }}>Saved Contacts</a></li>
                        <li><a href={{ url("user/all-transaction") }}>View All Transactions</a></li>
                        {{-- <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Email</a>
                            <ul aria-expanded="false">
                                <li><a href="email-compose.html">Compose</a></li>
                                <li><a href="email-inbox.html">Inbox</a></li>
                                <li><a href="email-read.html">Read</a></li>
                            </ul>
                        </li>
                        <li><a href="app-calender.html">Calendar</a></li>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Shop</a>
                            <ul aria-expanded="false">
                                <li><a href="ecom-product-grid.html">Product Grid</a></li>
                                <li><a href="ecom-product-list.html">Product List</a></li>
                                <li><a href="ecom-product-detail.html">Product Details</a></li>
                                <li><a href="ecom-product-order.html">Order</a></li>
                                <li><a href="ecom-checkout.html">Checkout</a></li>
                                <li><a href="ecom-invoice.html">Invoice</a></li>
                                <li><a href="ecom-customers.html">Customers</a></li>
                            </ul>
                        </li> --}}
                    </ul>
                </li>

                <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-wallet"></i>
                        <span class="nav-text">Wallet</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href={{ url("user/topup") }}>Top up</a></li>
                        <li><a href="post-details.html">View All Transactions</a></li>
                        {{-- <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Email</a>
                            <ul aria-expanded="false">
                                <li><a href="email-compose.html">Compose</a></li>
                                <li><a href="email-inbox.html">Inbox</a></li>
                                <li><a href="email-read.html">Read</a></li>
                            </ul>
                        </li>
                        <li><a href="app-calender.html">Calendar</a></li>
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Shop</a>
                            <ul aria-expanded="false">
                                <li><a href="ecom-product-grid.html">Product Grid</a></li>
                                <li><a href="ecom-product-list.html">Product List</a></li>
                                <li><a href="ecom-product-detail.html">Product Details</a></li>
                                <li><a href="ecom-product-order.html">Order</a></li>
                                <li><a href="ecom-checkout.html">Checkout</a></li>
                                <li><a href="ecom-invoice.html">Invoice</a></li>
                                <li><a href="ecom-customers.html">Customers</a></li>
                            </ul>
                        </li> --}}
                    </ul>
                </li>
            </ul>
            {{-- <div class="side-bar-profile">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="side-bar-profile-img">
                        <img src="images/user.jpg" alt="">
                    </div>
                    <div class="profile-info1">
                        <h4 class="fs-18 font-w500">Soeng Souy</h4>
                        <span>example@mail.com</span>
                    </div>
                    <div class="profile-button">
                        <i class="fas fa-caret-down scale5 text-light"></i>
                    </div>
                </div>	
                <div class="d-flex justify-content-between mb-2 progress-info">
                    <span class="fs-12"><i class="fas fa-star text-orange me-2"></i>Task Progress</span>
                    <span class="fs-12">20/45</span>
                </div>
                <div class="progress default-progress">
                    <div class="progress-bar bg-gradientf progress-animated" style="width: 45%; height:10px;" role="progressbar">
                        <span class="sr-only">45% Complete</span>
                    </div>
                </div>
            </div> --}}
            
            <div class="copyright">
                <p><strong>LuPay</strong> © @php
                    echo date("Y");
                @endphp All Rights Reserved</p>
                <p class="fs-12">Made with <span class="heart"></span> by 08028192337</p>
            </div>
        </div>
    </div>
    <!--**********************************
        Sidebar end
    ***********************************-->