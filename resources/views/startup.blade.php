@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row padding-row startup">
        <div class="col-md-12 col-sm-12">
            <div class="shadow-box row">
                <h2>NAME YOUR WINERY</h2>
                <div class="col-lg-3 col-sm-12"></div>
                <div class="col-lg-6 col-sm-12 enter-name">
                    <form>
                        <input type="text" name="store" placeholder="Enter your winery name">
                        <div class="name-check"><i class="fas fa-check"></i></div>
                    </form>
                </div>
                <div class="col-lg-3 col-sm-12"></div>
            </div>

            <div class="shadow-box row">
                <h2>WINERY PREFERENCES</h2>
                <div class="col-lg-2 col-sm-12"></div>
                <div class="col-lg-8 col-sm-12 winery-preferences">
                    <table>
                        <tr>
                            <td>Winery language *</td>
                            <td>
                                <select class="half-select">
                                    <option>English</option>\
                                    <option>English</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Winery country *</td>
                            <td>
                                <select>
                                    <option>United States</option>\
                                    <option>England</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Winery currecy *</td>
                            <td>
                                <select>
                                    <option>$ United States Dollar</option>\
                                    <option>£ UK Pound</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-2 col-sm-12"></div>
            </div>

            <div class="shadow-box row">
                <h2>INVENTORY UPLOAD</h2>
                <div class="col-lg-12 col-sm-12 inventory">
                    <div class="row">

                        <div class="col-xs-5 vine-box-style-3 style-3-2 add-wine">
                            <a href="#">
                                <div class="image-container">
                                    <img src="{{asset('img/add-wine.jpg')}}">
                                </div>
                            </a>
                        </div>

                        <div class="col-xs-5 vine-box-style-3 style-3-2">
                            <div class="inv-container">
                                <div class="image-container">
                                    <img src="{{asset('img/vine-style-3-img.png')}}">
                                    <div class="delete-copy">
                                        <a href="#"><i class="fas fa-times"></i> <span>DELETE</span></a>
                                        <a href="#"><i class="far fa-copy"></i> <span>COPY</span></a>
                                    </div>
                                </div>
                                <h5>Name Of The Store</h5>
                                <h4>$49.00</h4>
                            </div>
                        </div>

                        <div class="col-xs-5 vine-box-style-3 style-3-2">
                            <div class="inv-container">
                                <div class="image-container">
                                    
                                </div>
                                
                            </div>
                        </div>

                        <div class="col-xs-5 vine-box-style-3 style-3-2">
                            <div class="inv-container">
                                <div class="image-container">
                                    
                                </div>
                                
                            </div>
                        </div>

                        <div class="col-xs-5 vine-box-style-3 style-3-2">
                            <div class="inv-container">
                                <div class="image-container">
                                    
                                </div>
                                
                            </div>
                        </div>

                        <div class="col-xs-5 vine-box-style-3 style-3-2">
                            <div class="inv-container">
                                <div class="image-container">
                                    
                                </div>
                                
                            </div>
                        </div>

                        <div class="col-xs-5 vine-box-style-3 style-3-2">
                            <div class="inv-container">
                                <div class="image-container">
                                    
                                </div>
                                
                            </div>
                        </div>

                        <div class="col-xs-5 vine-box-style-3 style-3-2">
                            <div class="inv-container">
                                <div class="image-container">
                                    
                                </div>
                                
                            </div>
                        </div>

                        <div class="col-xs-5 vine-box-style-3 style-3-2">
                            <div class="inv-container">
                                <div class="image-container">
                                    
                                </div>
                                
                            </div>
                        </div>

                        <div class="col-xs-5 vine-box-style-3 style-3-2">
                            <div class="inv-container">
                                <div class="image-container">
                                    
                                </div>
                                
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <a href="#" class="red-button button float-right">NEXT STEP</a>

        </div>
    </div>

</div>
@endsection