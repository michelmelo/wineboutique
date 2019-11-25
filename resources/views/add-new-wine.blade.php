

@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('store-new-wine') }}" class="row padding-row add-new-wine" enctype="multipart/form-data">
        @csrf
        <h1 class="headline-2" id="top">ADD A NEW WINE</h1>

        <div class="shadow-box row new-wine-photos">
            <h2 >PHOTOS <i class="fas fa-info-circle popup-info-trigers" ></i></h2>
              <span class="popup-info d-none">Please select the photos of your wine bottle that you are adding. The Main Picture is the photo that will be showcased throughout our platform.</span>

            <div class="col-lg-4 col-sm-12 mb-3 flex-center ">
                <p class="w-100">Front bottle image *</p>
                <p class="error-message" id="main-img-err" style="display: none;">You must specify a main image.</p>
                <label >
                    <input type="file" name="photo" id="picture" style="display: none; cursor: pointer;" required>
                    <img src="{{asset('img/primary-photo.jpg')}}" id="imagePreview" data-default="{{asset('img/primary-photo.jpg')}}">
                </label>
                  <div class="w-100">
                    <input type="submit" id="crop-picture" value="Crop" style="display:none; width: 200px;" class="red-button button mb-2">
                    <input type="submit" id="cancel-crop-picture" value="Cancel crop" style="display:none; width: 200px;" class="red-button button ">
                 </div>
                <input type="hidden" name="cropx" id="cropx" value="226">
                <input type="hidden" name="cropy" id="cropy" value="250">
                <input type="hidden" name="cropwidth" id="cropwidth" value="0">
                <input type="hidden" name="cropheight" id="cropheight" value="0">
            </div>
            <div class="col-lg-8 col-sm-12 pr-lg-0 flex-center">
                <p class="w-100">Other pictures</p>
                <label class="flex-center">
                    <input type="file" id="other_image" style="display: none; cursor: pointer;" >
                    <img src="{{asset('img/every-angle.jpg')}}" id="otherImagePreview" data-default="{{asset('img/every-angle.jpg')}}">
                     <div class="w-100">
                        <input type="submit" id="crop-other-picture" value="Crop" style="display:none; width: 200px;" class="red-button button my-2">
                        <input type="submit" id="cancel-crop-other-picture" value="Cancel crop" style="display:none; width: 200px;" class="red-button button ">
                    </div>
                    <div class="other_images_preview"></div>
                </label>
            </div>
        </div>

        <div class="shadow-box row details">
            <h2>DETAILS <i class="fas fa-info-circle popup-info-trigers" ></i></h2>
            <span class="popup-info d-none">Here you are required to provide as much detail as possible in regards to your wine. Make it sound delicious and great! </span>
            <div>
                <div class="row form-inputs">
                    <div class="col-lg-4 col-sm-12">
                        <p>Wine Name *</p>
                    </div>

                    <div class="col-lg-8 col-sm-12">
                        <input type="text" name="name" id="name" placeholder="Wine Name" required>
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
                        <input type="text" id="who_made_it" name="who_made_it" placeholder="Wine Maker" required>
                        @if($errors->has('who_made_it'))
                            <span class="help-block">
                                <strong>{{ $errors->first('who_made_it') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-lg-4 col-sm-12">
                        <select id="when_was_it_made" name="when_was_it_made" required>
                        <option value="" disabled selected hidden>Year Vintage</option>
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
                        <select name="varietal" id="varietal" required>
                            <option value="" disabled selected>Varietal</option>
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

                    <div class="col-lg-4 col-sm-12">
                        <p>Wine Region *</p>
                    </div>

                    <div class="col-lg-8 col-sm-12">
                        <select name="wine_region" id="wine_region">
                            <option value="" disabled selected>Wine Region</option>
                            @foreach($wine_regions as $wine_region)
                                <option value="{{$wine_region->id}}">{{ $wine_region->name }}</option>
                            @endforeach
                        </select>

                        @if($errors->has('wine_region'))
                            <span class="help-block">
                                <strong>{{ $errors->first('wine_region') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-lg-4 col-sm-12">
                        <p>Quantity of Bottles *</p>
                    </div>


                    <div class="col-lg-3 col-sm-12">
                        <input type="number" name="quantity" id="quantity" placeholder="Quantity of Bottles" min="1" required>
                        @if($errors->has('quantity'))
                            <span class="help-block">
                                <strong>{{ $errors->first('quantity') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-lg-1 col-sm-12 align-self-center">
                        <span>Capacity</span>
                    </div>

                    <div class="col-lg-3 col-sm-12">
                        <input type="number" name="capacity" id="capacity" placeholder="Capacity" min="0" required>
                        @if($errors->has('capacity'))
                            <span class="help-block">
                                <strong>{{ $errors->first('capacity') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-lg-1 col-sm-12 align-self-center">
                        <span>ML</span>
                    </div>

                    <input type="hidden" name="unit_id" value="3">

{{--                    <div class="col-lg-2 col-sm-12">--}}
{{--                        <select name="unit_id" id="unit_id" required>--}}
{{--                            <option value="" disabled selected>Choose a unit</option>--}}
{{--                            @foreach($capacity_units as $capacity_unit) --}}
{{--                                <option value="{{$capacity_unit->id}}">{{$capacity_unit->name}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                        @if($errors->has('capacity_unit'))--}}
{{--                            <span class="help-block">--}}
{{--                                <strong>{{ $errors->first('capacity_unit') }}</strong>--}}
{{--                            </span>--}}
{{--                        @endif--}}
{{--                    </div>--}}

                    <div class="col-lg-4 col-sm-12">
                        <p>Description *</p>
                    </div>
                    <div class="col-lg-8 col-sm-12">
                        <textarea id="description" type="text" name="description" placeholder="Add text" required></textarea>
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
                        <span style="display: block;font-size: 14px; color: #afafaf">What words might someone use to search for your wine?</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="shadow-box row pricing">
            <h2>PRICING <i class="fas fa-info-circle popup-info-trigers" ></i></h2>
            <span class="popup-info d-none">Please set the pricing of your wine bottle.</span>

            <div class="col-lg-3 col-sm-12"></div>
            <div class="col-lg-6 col-sm-12">
                <div>
                    <div class="row form-inputs">
                        <div class="col-lg-4 col-sm-12">
                            <p>Price *</p>
                        </div>
                        <div class="col-lg-8 col-sm-12">
                            <input type="number" min="5" max="999999.99" name="price" class="usd-input no-sliders" step="0.01" required>
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
        <div id="inputs" style="display: none;"></div>
        <div class="col-lg-4 col-lg-push-8 col-sm-12" style="padding: 0;">
            <a href="#top"><p id="crop-error" style="float: right; color: red; display: none;">Please crop the image</p></a>
            <button type="submit" id="submit" class="red-button button float-right">SAVE AND CONTINUE</button>
        </div>
    </form>
</div>
@endsection
