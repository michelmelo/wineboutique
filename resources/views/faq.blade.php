@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="heading" id="qwe" style="margin-bottom: 40px; margin-top: 40px">FAQ</h2>
            <div id="accordion" class="accordion" style="margin-bottom: 70px;">

                <div class="card" style="border: 0px;">
                    <div class="card-header" id="headingOne" style="border-bottom: 0px;">
                        <h5 class="mb-0">
                            <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                <span class="accordion-name color-r" style="margin-left: -20px;"><b>Q:</b> HOW IT WORKS?</span>
                                <i class="fas fa-chevron-down color-r"></i>
                                <i class="fas fa-chevron-up color-r"></i>
                            </button>
                        </h5>
                    </div>

                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body px-3">
                            Wineboutiqueus.com connects you to an array of wines and delivers them straight to your door.All you have to do is enter your zip code to ensure your state allows for delivery. We areworking on bringing wines from all 50 states...tag us @wineboutiqueus if you know of a wineryin your area!   
                        </div>
                    </div>
                </div>

                <div class="card" style="border: 0px;">
                    <div class="card-header" id="headingTwo" style="border-bottom: 0px;">
                        <h5 class="mb-0">
                            <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <span class="accordion-name color-r" style="margin-left: -20px;"><b>Q:</b> SHIPPING?</span>
                                <i class="fas fa-chevron-down color-r"></i>
                                <i class="fas fa-chevron-up color-r"></i>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body px-3">
                            We ship wine to most states, though there are still some states that prohibit retailers fromshipping wine in their state. To determine if WineBoutique.com ships to your state, use thedrop-down menu at the top of the page to select your state. This will ensure you see correctinventory and pricing for your area. If we cannot ship to your state, you will see that on the redbar at the top of the page alerting you that your state prohibits delivery of wine from wineries toconsumer.
                        </div>
                    </div>
                </div>

                <div class="card" style="border: 0px;">
                    <div class="card-header" id="headingThree" style="border-bottom: 0px;">
                        <h5 class="mb-0">
                            <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <span class="accordion-name color-r" style="margin-left: -20px;"><b>Q:</b> SHIPPING RATES?</span>
                                <i class="fas fa-chevron-down color-r"></i>
                                <i class="fas fa-chevron-up color-r"></i>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body px-3">
                            Shipping and handling rates will vary based on the number of bottles, and the size and weight ofyour order. Rates will also change as expedited shipping methods are selected. Check out ourpreferred partner www.fedex.com for all details on shipping.
                        </div>
                    </div>
                </div>

                <div class="card" style="border: 0px;">
                    <div class="card-header" id="headingFour" style="border-bottom: 0px;">
                        <h5 class="mb-0">
                            <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                                <span class="accordion-name color-r" style="margin-left: -20px;"><b>Q:</b> ORDER STATUS?</span>
                                <i class="fas fa-chevron-down color-r"></i>
                                <i class="fas fa-chevron-up color-r"></i>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">  
                        <div class="card-body px-3">
                            Click here to Track delivery progress and view order details.
                        </div>
                    </div>
                </div>

                <div class="card" style="border: 0px;">
                    <div class="card-header" id="headingFive" style="border-bottom: 0px;">
                        <h5 class="mb-0">
                            <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseThree">
                                <span class="accordion-name color-r" style="margin-left: -20px;"><b>Q:</b> WHEN WILL MY ORDER SHIP?</span>
                                <i class="fas fa-chevron-down color-r"></i>
                                <i class="fas fa-chevron-up color-r"></i>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                        <div class="card-body px-3">
                            Here’s how it works: you order, we process the order with the winery, the winery ships thewines. Ordering takes only a few seconds, processing can take up to 1 week. You will receivean email notification with tracking info that your shipment has left the building.
                        </div>
                    </div>
                </div>
                <div class="card" style="border: 0px;">
                    <div class="card-header" id="headingSix" style="border-bottom: 0px;">
                        <h5 class="mb-0">
                            <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                <span class="accordion-name color-r" style="margin-left: -20px;"><b>Q:</b> HOW CAN I EDIT MY SHIPPING ADDRESS?</span>
                                <i class="fas fa-chevron-down color-r"></i>
                                <i class="fas fa-chevron-up color-r"></i>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                        <div class="card-body px-3">
                            Once the email shipping notification (confirmation) has been sent out, we can no longer changethe shipping address. You have one week from the time you place an order until it ships tochange the address delivery.
                        </div>
                    </div>
                </div>
                <div class="card" style="border: 0px;">
                    <div class="card-header" id="headingSeven" style="border-bottom: 0px;">
                        <h5 class="mb-0">
                            <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                <span class="accordion-name color-r" style="margin-left: -20px;"><b>Q:</b> RETURNS & EXCHANGES?</span>
                                <i class="fas fa-chevron-down color-r"></i>
                                <i class="fas fa-chevron-up color-r"></i>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion">
                        <div class="card-body px-3">
                            We are sorry you didn’t love the wine. Please reach out to our team at EMAIL ADDRESS HEREwith your order # and the wine you didn’t enjoy and we will notify the winery.
                        </div>
                    </div>
                </div>
                <div class="card" style="border: 0px;">
                    <div class="card-header" id="headingEight" style="border-bottom: 0px;">
                        <h5 class="mb-0">
                            <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                <span class="accordion-name color-r" style="margin-left: -20px;"><b>Q:</b> WHEN WILL MY CREDIT CARD BE CHARGED?</span>
                                <i class="fas fa-chevron-down color-r"></i>
                                <i class="fas fa-chevron-up color-r"></i>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordion">
                        <div class="card-body px-3">
                            Your credit card will be charged as soon as your order is received and processed with thewinery.
                        </div>
                    </div>
                </div>
                <div class="card" style="border: 0px;">
                    <div class="card-header" id="headingNine" style="border-bottom: 0px;">
                        <h5 class="mb-0">
                            <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                <span class="accordion-name color-r" style="margin-left: -20px;"><b>Q:</b> WINE SELLER?</span>
                                <i class="fas fa-chevron-down color-r"></i>
                                <i class="fas fa-chevron-up color-r"></i>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordion">
                        <div class="card-body px-3">
                            Click <a href="{{ url('/register/sell') }}">here</a> to get details how you can sell your wine on wineboutique.com
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--
    <div class="row mb-5">
        <div class="col-12 text-center pb-5">
            <h2 class="mb-5">Have a question that isn't covered?</h2>
            <a href="" class="button red-button">Contact us!</a>
        </div>
    </div>
    -->
</div>
@endsection
