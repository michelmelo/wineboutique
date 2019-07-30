@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{url('/store-edited-wine').'/'.$wine->slug}}" class="row padding-row add-new-wine" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <h1 class="headline-2">EDIT WINE</h1>
        
        <div class="shadow-box row new-wine-photos">
            <h2>PHOTOS</h2>
            <div class="col-lg-2 col-4">
                <label><input name="photo" style="display: none; cursor: pointer;" type="file" id="picture"><img src="{{ $wine->photo === null ? asset('img/primary-photo.jpg') : $wine->photo }}" id="imagePreview"></label>
                <div class="help-message">
                    {{ $wine->photo === null ? '' : '(click to change)' }}
                </div>
            </div>

            <div class="col-lg-8 col-sm-12 crop-holder" style="display: none">
                <canvas id="cropCanvas" width="450" height="450">
                    Your browser does not support canvas.
                </canvas>

                <input type="button" id="crop-it" class="crop-options" value="Crop" />
            </div>
        </div>
        <div class="shadow-box row new-wine-photos">
            <div id="photos" class="dropzone">
            </div>
            <a href="#" class="add-more-images red-button button" style="visibility: hidden; max-height: 34px; margin: auto 20px;">Add More</a>
            <script>
                var preloadedImages = {!! $preloadedImages->toJson() !!};
            </script>
        </div>

        <div class="shadow-box row details">
            <h2>DETAILS</h2>
            <div>
                <div class="row form-inputs">
                    <div class="col-lg-4 col-sm-12">
                        <p>Wine title *</p>
                    </div>
                    <input type="hidden" name="id" value="{{ old('id') ? old('id') : $wine->id }}" />

                    <div class="col-lg-8 col-sm-12">
                        <input type="text" name="name" id="name" placeholder="Title name" value="{{ old('name') ? old('name') : $wine->name }}" required>
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
                        <input type="text" id="who_made_it" name="who_made_it" placeholder="Who made it?" value="{{ old('who_made_it') ? old('who_made_it') : $wine->who_made_it }}" required>
                        @if($errors->has('who_made_it'))
                            <span class="help-block">
                                <strong>{{ $errors->first('who_made_it') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-lg-4 col-sm-12">
                        @php
                            $when_was_it_made = old('when_was_it_made', $wine->when_was_it_made);
                        @endphp
                        <select id="when_was_it_made" name="when_was_it_made">
                            <option hidden>When was it made?</option>
                            <?php $now = date('Y'); ?>
                                @for ($i = $now; $i >= 1900; $i--)
                                    <option value="{{ $i }}" {{$i==$when_was_it_made?"selected":""}}>{{ $i }}</option>
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
                        @php
                            $varietal_id = old('varietal', $wine->varietal_id);
                        @endphp
                        <select name="varietal" id="varietal">
                            @foreach($varietals as $varietal) 
                                <option value="{{$varietal->id}}" {{$varietal->id==$varietal_id?"selected":""}}>{{ $varietal->name }}</option>
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
                            @foreach($wine_regions as $wine_region)
                                <option value="{{$wine_region->id}}" {{$wine_region->id==$wine->wine_region_id ? "selected" : ""}}>{{ $wine_region->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-4 col-sm-12">
                        <p>Capacity *</p>
                    </div>

                    <div class="col-lg-4 col-sm-12">
                        <input type="number" min="0" name="capacity" id="capacity" placeholder="Enter a number" value="{{ old('capacity') ? old('capacity') : $wine->capacity }}" required>
                        @if($errors->has('capacity'))
                            <span class="help-block">
                                <strong>{{ $errors->first('capacity') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-lg-4 col-sm-12">
                        @php
                            $unit_id = old('unit_id', $wine->unit_id);
                        @endphp
                        <select name="unit_id" id="unit_id">
                            <option hidden>Choose a unit</option>
                            @foreach($capacity_units as $capacity_unit) 
                                <option value="{{$capacity_unit->id}}" {{$capacity_unit->id==$unit_id?"selected":""}}>{{$capacity_unit->name}}</option>
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
                        <textarea id="description" type="text" name="description" placeholder="Add text" required >{{ old('description') ? old('description') : $wine->description }} </textarea>
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
                        <input data-role="tagsinput" id="tags" type="text" name="tags" placeholder="Tag1, tag2, tag3, etc." value="{{ $wine->tags->pluck('name')->implode(',') }}">
                       
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
                            <input type="number" min="1" max="999999.99" step="0.01" name="price" class="usd-input" value="{{ old('price') ? old('price') : $wine->price }}" required>
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
