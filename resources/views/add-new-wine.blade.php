@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row padding-row add-new-wine margin-row">
        <h1 class="headline-2">ADD A NEW WINE</h1>

        <div class="shadow-box row new-wine-photos">
            <h2>PHOTOS</h2>
            <div class="col-lg-2 col-4">
                <a href="#"><img src="{{asset('img/primary-photo.jpg')}}"></a>
            </div>
            <div class="col-lg-2 col-4">
                <a href="#"><img src="{{asset('img/every-angle.jpg')}}"></a>
            </div>
            <div class="col-lg-2 col-4">
                <a href="#"><img src="{{asset('img/every-angle.jpg')}}"></a>
            </div>
            <div class="col-lg-2 col-4">
                <a href="#"><img src="{{asset('img/every-angle.jpg')}}"></a>
            </div>
            <div class="col-lg-2 col-4">
                <a href="#"><img src="{{asset('img/every-angle.jpg')}}"></a>
            </div>
            <div class="col-lg-2 col-4">
                <a href="#"><img src="{{asset('img/every-angle.jpg')}}"></a>
            </div>
        </div>

        <div class="shadow-box row details">
            <h2>DETAILS</h2>

            <form>
                <div class="row form-inputs">
                    <div class="col-lg-4 col-sm-12">
                        <p>Wine title *</p>
                    </div>
                    <div class="col-lg-8 col-sm-12">
                        <input type="text" name="title name" placeholder="Title name">
                    </div>


                    <div class="col-lg-4 col-sm-12">
                        <p>About this wine *</p>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <input type="text" name="who-made-it" placeholder="Who made it?">
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <select>
                            <option>When was it made?</option>
                            <option>2018</option>
                            <option>2017</option>
                            <option>2016</option>
                            <option>2015</option>
                        </select>
                    </div>


                    <div class="col-lg-4 col-sm-12">
                        <p>Category *</p>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <select>
                            <option>Varietal</option>
                            <option>Varietal 1</option>
                            <option>Varietal 2</option>
                        </select>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <select>
                            <option>Type of wine</option>
                            <option>Type of wine 1</option>
                            <option>Type of wine 2</option>
                        </select>
                    </div>


                    <div class="col-lg-4 col-sm-12">
                        <p>Capacity *</p>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <input type="text" name="who-made-it" placeholder="Enter a number">
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <select>
                            <option>Choose a unit</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>

                    <div class="col-lg-4 col-sm-12">
                        <p>Description *</p>
                    </div>
                    <div class="col-lg-8 col-sm-12">
                        <textarea placeholder="Add text"></textarea>
                    </div>

                    <div class="col-lg-4 col-sm-12">
                        <p>Tags <span>Optional</span></p>
                    </div>
                    <div class="col-lg-8 col-sm-12">
                        <input type="text" name="tags" placeholder="Tag1, tag2, tag3, etc.">
                        <span style="font-size: 14px; color: #afafaf">What words might someone use to search for your wine?</span>
                    </div>
                </div>
            </form>
        </div>

        <div class="shadow-box row pricing">
            <h2>PRICING</h2>

            <div class="col-lg-3 col-sm-12"></div>
            <div class="col-lg-6 col-sm-12">
                <form>
                    <div class="row form-inputs">
                        <div class="col-lg-4 col-sm-12">
                            <p>Pricee *</p>
                        </div>
                        <div class="col-lg-8 col-sm-12">
                            <input type="text" name="price" class="usd-input">
                            <div class="usd">USD</div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 col-sm-12"></div>
        </div>


        <div class="shadow-box row">
            <h2>SHIPPING</h2>

            <form>
                <div class="row form-inputs">
                    <div class="col-lg-4 col-sm-12">
                        <p>Shipping origin *</p>
                    </div>
                    <div class="col-lg-8 col-sm-12">
                        <select>
                            <option>Select location</option>
                            <option>location 1</option>
                            <option>location 2</option>
                        </select>
                    </div>

                    <div class="col-lg-4 col-sm-12">
                        <p>Processing time *</p>
                    </div>
                    <div class="col-lg-2 col-sm-12">
                        <select>
                            <option>From...</option>
                            <option>1</option>
                            <option>2</option>
                        </select>
                    </div>
                    <div class="col-lg-2 col-sm-12">
                        <select>
                            <option>To...</option>
                            <option>1</option>
                            <option>2</option>
                        </select>
                    </div>
                    <div class="col-lg-2 col-sm-12 radio-check">
                        <label class="label-container">Business days
                            <input type="radio" checked="checked" name="day-week">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="col-lg-2 col-sm-12 radio-check">
                        <label class="label-container">Weeks
                            <input type="radio" name="day-week">
                            <span class="checkmark"></span>
                        </label>
                    </div>

                    <div class="col-lg-4 col-sm-12">
                        <p>Fixed shipping costs *</p>
                    </div>
                    <div class="col-lg-3 col-sm-12">
                        <select>
                            <option>Add a destination</option>
                            <option>destination 1</option>
                            <option>destination 2</option>
                        </select>
                    </div>
                    <div class="col-lg-2 col-sm-12">
                        <input type="text" name="one item" class="usd-input" placeholder="One item">
                        <div class="usd">USD</div>
                    </div>
                    <div class="col-lg-3 col-sm-12">
                        <input type="text" name="each additional" class="usd-input" placeholder="Each additional">
                        <div class="usd">USD</div>
                    </div>

                    <div class="col-lg-4 col-sm-12">
                        <p></p>
                    </div>

                    <div class="col-lg-8 col-sm-12">
                        <input type="checkbox" id="checkbox3" class="css-checkbox" checked="checked"/>
                        <label for="checkbox3" name="checkbox2_lbl" class="css-label lite-red-check">Freee shipping</label>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-12 col-sm-12" style="padding: 0;">
            <a href="#" class="red-button button float-right">SAVE AND CONTINUE</a>
        </div>
    </div>
</div>
@endsection
