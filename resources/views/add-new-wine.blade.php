@extends('layouts.app')

@section('content')
<div class="container">
    <!-- @php
        var_dump($errors);
    @endphp -->
    <form method="POST" action="{{ route('store-new-wine') }}" class="row padding-row add-new-wine" enctype="multipart/form-data">
        @csrf
        <h1 class="headline-2">ADD A NEW WINE</h1>
        
        <div class="shadow-box row new-wine-photos">
            <h2>PHOTOS</h2>
            <div class="col-lg-2 col-4">
                <label><input name="photo" style="display: none; cursor: pointer;" type="file" id="picture"><img src="{{asset('img/primary-photo.jpg')}}" id="imagePreview"></label>
            </div>
            <div id="photos" class="dropzone">
                <div class="fallback">
                </div>
            </div>
        </div>
      

        <div class="shadow-box row details">
            <h2>DETAILS</h2>
            
            <div>
                <div class="row form-inputs">
                    <div class="col-lg-4 col-sm-12">
                        <p>Wine title *</p>
                    </div>

                    <div class="col-lg-8 col-sm-12">
                        <input type="text" name="name" id="name" placeholder="Title name" required>
                        @if($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>


                    <div class="col-lg-4 col-sm-12">
                        <p>About this wine *</p>
                    </div>

                    <div class="col-lg-4 col-sm-12">
                        <input type="text" id="who_made_it" name="who_made_it" placeholder="Who made it?" required>
                        @if($errors->has('who_made_it'))
                            <span class="help-block">
                                <strong>{{ $errors->first('who_made_it') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-lg-4 col-sm-12">
                        <select id="when_was_it_made" name="when_was_it_made">
                        <option disabled selected hidden>When was it made?</option>
                        <?php $now = date('Y'); ?>
                            @for ($i = $now; $i >= 1900; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        @if($errors->has('when_was_it_made'))
                            <span class="help-block">
                                <strong>{{ $errors->first('when_was_it_made') }}</strong>
                            </span>
                        @endif                  
                    </div>

                    <div class="col-lg-4 col-sm-12">
                        <p>Category *</p>
                    </div>

                    <div class="col-lg-8 col-sm-12">
                        <select name="varietal" id="varietal">
                            <option value="" disabled selected hidden>Varietal</option>
                            @foreach($varietals as $varietal) 
                                <option value="{{$varietal->id}}">{{$varietal->name}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('varietal'))
                            <span class="help-block">
                                <strong>{{ $errors->first('varietal') }}</strong>
                            </span>
                        @endif
                    </div>

                    <!-- <div class="col-lg-4 col-sm-12">
                        <select>
                            <option>Type of wine</option>
                            <option>Type of wine 1</option>
                            <option>Type of wine 2</option>
                        </select>
                    </div> -->

                    <div class="col-lg-4 col-sm-12">
                        <p>Capacity *</p>
                    </div>

                    <div class="col-lg-4 col-sm-12">
                        <input type="number" min="1" name="capacity" id="capacity" placeholder="Enter a number" required>
                        @if($errors->has('capacity'))
                            <span class="help-block">
                                <strong>{{ $errors->first('capacity') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-lg-4 col-sm-12">
                        <select name="unit_id" id="unit_id">
                            <option disabled selected hidden>Choose a unit</option>
                            @foreach($capacity_units as $capacity_unit) 
                                <option value="{{$capacity_unit->id}}">{{$capacity_unit->name}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('capacity_unit'))
                            <span class="help-block">
                                <strong>{{ $errors->first('capacity_unit') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-lg-4 col-sm-12">
                        <p>Description *</p>
                    </div>
                    <div class="col-lg-8 col-sm-12">
                        <textarea id="description" type="text" name="description" placeholder="Add text"></textarea>
                        @if($errors->has('description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-lg-4 col-sm-12">
                        <p>Tags <span>Optional</span></p>
                    </div>
                    <div class="col-lg-8 col-sm-12">
                        <input data-role="tagsinput" type="text" name="tags" placeholder="Tag1, tag2, tag3, etc.">
                        @if($errors->has('tags'))
                            <span class="help-block">
                                <strong>{{ $errors->first('tags') }}</strong>
                            </span>
                        @endif
                        <span style="font-size: 14px; color: #afafaf">What words might someone use to search for your wine?</span>
                    </div>
                </div>
            </div>
        </div>


        <div class="shadow-box row pricing">
            <h2>PRICING</h2>

            <div class="col-lg-3 col-sm-12"></div>
            <div class="col-lg-6 col-sm-12">
                <div>
                    <div class="row form-inputs">
                        <div class="col-lg-4 col-sm-12">
                            <p>Price *</p>
                        </div>
                        <div class="col-lg-8 col-sm-12">
                            <input type="number" min="1" max="999999.99" name="price" class="usd-input no-sliders" step="0.01" required>
                            <div class="usd">USD</div>
                        </div>
                        @if($errors->has('price'))
                            <span class="help-block">
                                <strong>{{ $errors->first('price') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-12"></div>
        </div>


        <div class="shadow-box row">
            <h2>SHIPPING</h2>

            <div>
                <div class="row form-inputs shipping-item-wrapper">
                    <div class="col-lg-4 col-sm-12">
                        <p>Shipping origin *</p>
                    </div>
                    <input type="hidden" name="location" value="unknown">
                    <div class="col-lg-8 col-sm-12">
                        <select id="location" name="shipping[0][location]" class="location" required>
                            <option disabled selected hidden>Select location</option>
                            @foreach($regions as $region)
                                <option value="{{$region->id}}">{{$region->name}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('region'))
                            <span class="help-block">
                                <strong>{{ $errors->first('region') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-lg-4 col-sm-12">
                        <p>Processing time *</p>
                    </div>

                    <div class="col-lg-2 col-sm-12">
                        <input type="number" min="0" name="shipping[0][from]" placeholder="From" class="from" required>
                    </div>

                    <div class="col-lg-2 col-sm-12">
                        <input type="number" min="0" name="shipping[0][to]" placeholder="To" class="to" required>
                    </div>

                    <div class="col-lg-2 col-sm-12 radio-check">
                        <label class="label-container">Business days
                            <input type="radio" checked="checked" name="shipping[0][day_week]" class="day_week" value="day">
                            <span class="checkmark"></span>
                        </label>
                    </div>

                    <div class="col-lg-2 col-sm-12 radio-check">
                        <label class="label-container">Weeks
                            <input type="radio" name="shipping[0][day_week]" class="day_week" value="week">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    
                    <div class="col-lg-4 col-sm-12">
                        <p>Fixed shipping costs *</p>
                    </div>

                    <div class="col-lg-3 col-sm-12">
                        <select name="shipping[0][destination]" class="destination">
                            <option disabled selected hidden>Add a destination</option>
                            @foreach($regions as $region)
                                <option value="{{$region->id}}">{{$region->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-2 col-sm-12 show_hide">
                        <input type="number" min="0"  name="shipping[0][price]" class="usd-input price" placeholder="One item"  >
                        <div class="usd">USD</div>
                        @if($errors->has('one-item'))
                            <span class="help-block">
                                <strong>{{ $errors->first('one-item') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-lg-3 col-sm-12 show_hide">
                        <input type="number" min="0"  name="shipping[0][additional]" class="usd-input additional" placeholder="Each additional" >
                        <div class="usd" >USD</div>
                        @if($errors->has('each-additional'))
                            <span class="help-block">
                                <strong>{{ $errors->first('each-additional') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-lg-4 col-sm-12">
                        <p></p>
                    </div>
                    
                    <div class="col-lg-8 col-sm-12">
                        <input type="checkbox" name="shipping[0][free]" id="shipping_check_0" class="css-checkbox shipping-check"/>
                        <label for="shipping_check_0" class="css-label lite-red-check">Free shipping</label>
                    </div>
                </div>
                <div id="field_wrapper" class=""></div>
            </div>
        </div>
        <div id="inputs" style="display: none;"></div>
        <div class="col-lg-12 col-sm-12" style="padding: 0;">
            <button type="button" class="red-button button float-left" id="add_button">ADD SHIPPING</button>
            <button type="submit" id="submit" class="red-button button float-right">SAVE AND CONTINUE</button>
        </div>
    </form>
</div>
<div id="shipping-template" style="display: none;">
    <div class="shipping-item row form-inputs shipping-item-wrapper">
        <div class="col-lg-4 col-sm-12">
            <p>
                <a href="#" class="remove_button">Remove</a>
            </p>
        </div>

        <div class="col-lg-8 col-sm-12">
            <select name="shipping[][location]" class="location">
                <option disabled selected hidden>Select location</option>
                @foreach($regions as $region)
                    <option value="{{$region->id}}">{{$region->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-lg-4 col-sm-12">
            <p></p>
        </div>

        <div class="col-lg-2 col-sm-12">
            <input type="number" min="0" name="shipping[][from]"  placeholder="From" class="from">
        </div>

        <div class="col-lg-2 col-sm-12">
            <input type="number" min="0" name="shipping[][to]"  placeholder="To" class="to">
        </div>

        <div class="col-lg-2 col-sm-12 radio-check">
            <label class="label-container">Business days
                <input type="radio" checked="checked" name="shipping[][day_week]" class="day_week" value="day">
                <span class="checkmark"></span>
            </label>
        </div>

        <div class="col-lg-2 col-sm-12 radio-check">
            <label class="label-container">Weeks
                <input type="radio" name="shipping[][day_week]" class="day_week" value="week">
                <span class="checkmark"></span>
            </label>
        </div>

        <div class="col-lg-4 col-sm-12">
            <p></p>
        </div>

        <div class="col-lg-3 col-sm-12">
            <select  name="shipping[][destination]" class="destination">
                <option disabled selected hidden>Add a destination</option>
                @foreach($regions as $region)
                    <option value="{{$region->id}}">{{$region->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-lg-2 col-sm-12 show_hide">
            <input type="number" min="0" max="999999.99" name="shipping[][price]" class="usd-input price" placeholder="One item" >
            <div class="usd">USD</div>
        </div>

        <div class="col-lg-3 col-sm-12 show_hide">
            <input type="number" min="0" max="999999.99" name="shipping[][additional]" class="usd-input additional" placeholder="Each additional" >
            <div class="usd" >USD</div>
        </div>
        <div class="col-lg-4 col-sm-12">
            <p></p>
        </div>
        <div class="col-lg-8 col-sm-12">
            <input type="checkbox" name="shipping[][free]" id="shipping_check_0" class="css-checkbox shipping-check"/>
            <label for="shipping_check_0" class="css-label lite-red-check">Free shipping</label>
        </div>

        <!-- <button type="button" class="red-button button " id="remove_button">DELETE</button> -->
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        var maxField = 10; 
        var $addButton = $('#add_button'); 
        var wrapper = $('#field_wrapper'); 
        var fieldHTML = '<div><select><option>Add a destination</option></select><a href="#" class="remove_button">Remove</a>'; 
        
        //Once add button is clicked
        $addButton.click(function() {
            var count = $(".shipping-item").length;
            if(count < maxField){ 
                $(wrapper).append($("#shipping-template").html()); 
            }

            $("#field_wrapper .shipping-item").each(function(index, shippingItem) {
                var shippingIndex = index + 1;

                $(shippingItem).find("[name^='shipping']").each(function(inputIndex, shippingInput) {
                    var $shippingInput = $(shippingInput);
                    var name = $shippingInput.attr("name");

                    name = name.replace(/shipping\[\d{0,}]/, "shipping["+shippingIndex+"]");

                    $shippingInput.attr('name', name);
                });

                $(shippingItem).find("[id^='shipping_check_']").attr('id', 'shipping_check_'+shippingIndex);
                $(shippingItem).find("[for^='shipping_check_']").attr('for', 'shipping_check_'+shippingIndex);
            });
        });
        
        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).closest(".shipping-item-wrapper").remove();          
        });

        $(document).on('change', '.shipping-check', function(e) {
            $(e.target).closest(".shipping-item-wrapper").find('.show_hide').css(
                e.target.checked ? {
                    opacity: 0,
                    visibility: "hidden"
                } : {
                    opacity: 1,
                    visibility: "visible"
                }
            );
        });

        // $(".shipping-check").click(function () {
        //     console.log(this);
        //     // $(".show_hide").css({
        //     //     opacity: 0,
        //     //     visibility: "hidden"
        //     // });
        // });

    });
</script>
@endsection
