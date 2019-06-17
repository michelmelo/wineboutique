@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('store-new-wine') }}" class="row padding-row add-new-wine" enctype="multipart/form-data">
        @csrf
        <h1 class="headline-2">ADD A NEW WINE</h1>
        
        <div class="shadow-box row new-wine-photos">
            <h2>PHOTOS</h2>
            <div class="col-lg-4 col-sm-12">
                <p>Main picture *</p>
                <p class="error-message" id="main-img-err" style="display: none;">You must specify a main image.</p>
                <label><input name="photo" style="display: none; cursor: pointer;" type="file" id="picture"><img src="{{asset('img/primary-photo.jpg')}}" id="imagePreview"></label>
            </div>
        </div>
        <div class="shadow-box row new-wine-photos">
            <div id="photos" class="dropzone">
                <div class="fallback">
                    <p>Click into box to add more.</p>
                </div>
            </div>
            <a href="#" class="add-more-images red-button button" style="visibility: hidden; max-height: 34px; margin: auto 20px;">Add More</a>
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
                        <select id="when_was_it_made" name="when_was_it_made" required>
                        <option value="" disabled selected hidden>When was it made?</option>
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
                        <select name="unit_id" id="unit_id" required>
                            <option value="" disabled selected>Choose a unit</option>
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
        <div id="inputs" style="display: none;"></div>
        <div class="col-lg-12 col-sm-12" style="padding: 0;">
            <button type="submit" id="submit" class="red-button button float-right">SAVE AND CONTINUE</button>
        </div>
    </form>
</div>
@endsection
