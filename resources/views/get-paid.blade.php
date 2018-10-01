@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row padding-row add-new-wine">

        <div class="shadow-box row">
            <h2>HOW YOU’LL GET PAID</h2>
            <form>
                <div class="row form-inputs">
                    <div class="col-lg-4 col-sm-12">
                        <p>Bank location *</p>
                    </div>
                    <div class="col-lg-8 col-sm-12">
                        <select>
                            <option>Select country</option>
                            <option>country 1</option>
                            <option>country 2</option>
                            <option>country 3</option>
                            <option>country 4</option>
                        </select>
                        <span>Your deposit will be in <b>$USD</b></span>
                    </div>

                    <div class="col-lg-4 col-sm-12">
                        <p>Full name on account*</p>
                    </div>
                    <div class="col-lg-8 col-sm-12">
                        <input type="text" name="account name" placeholder="Full name">
                    </div>

                    <div class="col-lg-4 col-sm-12">
                        <p>Account type *</p>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <select>
                            <option>Checking</option>
                            <option>Checking 1</option>
                            <option>Checking 2</option>
                        </select>
                    </div>

                    <div class="col-lg-4 col-sm-12">
                        <p>Routing number *</p>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <input type="text" name="enter number" placeholder="Enter a number">
                    </div>

                    <div class="col-lg-4 col-sm-12">
                        <p>Account number *</p>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <input type="text" name="enter number 2" placeholder="Enter a number">
                    </div>
                </div>
            </form>
        </div>


        <div class="shadow-box row">
            <h2>INFORMATION ABOUT YOU</h2>
            <form>
                <div class="row form-inputs">
                    <div class="col-lg-4 col-sm-12">
                        <p>Country of residence *</p>
                    </div>
                    <div class="col-lg-8 col-sm-12">
                        <select>
                            <option>Select a location</option>
                            <option>location 1</option>
                            <option>location 2</option>
                            <option>location 3</option>
                            <option>location 4</option>
                        </select>
                    </div>

                    <div class="col-lg-4 col-sm-12">
                        <p>Your name *</p>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <input type="text" name="firs name" placeholder="First name">
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <input type="text" name="last name" placeholder="Last name">
                    </div>

                    <div class="col-lg-4 col-sm-12">
                        <p>Your date of birth *</p>
                    </div>
                    <div class="col-lg-3 col-sm-12">
                        <select>
                            <option>Month</option>
                            <option>month 1</option>
                            <option>month 2</option>
                            <option>month 3</option>
                            <option>month 4</option>
                        </select>
                    </div>
                    <div class="col-lg-2 col-sm-12">
                        <select>
                            <option>Day</option>
                            <option>day 1</option>
                            <option>day 2</option>
                            <option>day 3</option>
                            <option>day 4</option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-sm-12">
                        <select>
                            <option>Year</option>
                            <option>2018</option>
                            <option>2017</option>
                            <option>2016</option>
                            <option>2015</option>
                        </select>
                    </div>

                    <div class="col-lg-4 col-sm-12">
                        <p>Last 4 of social security number *</p>
                    </div>
                    <div class="col-lg-1 col-sm-12">
                        <span style="line-height: 48px;">XXX-XX-</span>
                    </div>
                    <div class="col-lg-2 col-sm-12">
                        <input type="text" name="social number">
                    </div>

                </div>
            </form>
        </div>


        <div class="shadow-box row">
            <h2>HOME ADDRESS</h2>
            <form>
                <div class="row form-inputs">
                    <div class="col-lg-4 col-sm-12">
                        <p>Number and street name *</p>
                    </div>
                    <div class="col-lg-2 col-sm-12">
                        <input type="text" name="number" placeholder="Number">
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <input type="text" name="street name" placeholder="Street Name">
                    </div>

                    <div class="col-lg-4 col-sm-12">
                        <p>Apt / Suite / Other <span>Optional</span></p>
                    </div>
                    <div class="col-lg-8 col-sm-12">
                        <input type="text" name="apt" placeholder="Apt/Suite/Other">
                    </div>
                    

                    <div class="col-lg-4 col-sm-12">
                        <p>Zip code and City *</p>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <input type="text" name="zip" placeholder="Zip code">
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <input type="text" name="city" placeholder="City">
                    </div>


                    <div class="col-lg-4 col-sm-12">
                        <p>State *</p>
                    </div>
                    <div class="col-lg-8 col-sm-12">
                        <select>
                            <option>Select State</option>
                            <option>State 1</option>
                            <option>State 2</option>
                            <option>State 3</option>
                            <option>State 4</option>
                        </select>
                    </div>
                    

                    <div class="col-lg-4 col-sm-12">
                        <p>Phone number *</p>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <input type="text" name="phone" placeholder="Phone number">
                    </div>
                </div>
            </form>
        </div>

        
        <div class="col-lg-12 col-sm-12" style="padding: 0;">
            <a href="#" class="red-button button float-right">NEXT STEP</a>
        </div>
    </div>
</div>
@endsection