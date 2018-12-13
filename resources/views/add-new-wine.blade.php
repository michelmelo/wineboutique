@extends('layouts.app')

@section('content')
<div class="container">
    
<<<<<<< HEAD
    <div class="row padding-row add-new-wine margin-row">
=======
    <form method="POST" action="{{ route('add-new-wine.store') }}" class="row padding-row add-new-wine">
        @csrf
>>>>>>> 4b034a54251ce593d33e0a446580910d575e4bbf
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
                        <input type="text" name="name" id="name" placeholder="Title name">
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
                        <input type="text" name="who-made-it" placeholder="Who made it?">
                        @if($errors->has('who-made-it'))
                            <span class="help-block">
                                <strong>{{ $errors->first('who-made-it') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-lg-4 col-sm-12">
                        <select id="year" name="year">
                        <option>When was it made?</option>
                            @for ($i = 2018; $i >= 1900; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        @if($errors->has('year'))
                            <span class="help-block">
                                <strong>{{ $errors->first('year') }}</strong>
                            </span>
                        @endif                  
                    </div>

                    <div class="col-lg-4 col-sm-12">
                        <p>Category *</p>
                    </div>

                    <div class="col-lg-8 col-sm-12">
                        <select name="varietal" id="varietal">
                            <option value="">Varietal</option>
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
                        @if($errors->has('who-made-it'))
                            <span class="help-block">
                                <strong>{{ $errors->first('who-made-it') }}</strong>
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
                            <input type="text" name="price" class="usd-input">
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
                <div class="row form-inputs">
                    <div class="col-lg-4 col-sm-12">
                        <p>Shipping origin *</p>
                    </div>

                    <div class="col-lg-8 col-sm-12">
                        <select name="region" id="region">
                            <option>Select location</option>
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
                        <input type="text" name="from" placeholder="From">
                    </div>
                    @if($errors->has('from'))
                        <span class="help-block">
                            <strong>{{ $errors->first('from') }}</strong>
                        </span>
                    @endif

                    <div class="col-lg-2 col-sm-12">
                        <input type="text" name="to" placeholder="To">
                    </div>
                    @if($errors->has('to'))
                        <span class="help-block">
                            <strong>{{ $errors->first('to') }}</strong>
                        </span>
                    @endif

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
                        <input type="text" name="one-item" class="usd-input" placeholder="One item">
                        <div class="usd">USD</div>
                        @if($errors->has('one-item'))
                            <span class="help-block">
                                <strong>{{ $errors->first('one-item') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-lg-3 col-sm-12">
                        <input type="text" name="each-additional" class="usd-input" placeholder="Each additional">
                        <div class="usd">USD</div>
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
                        <input type="checkbox" id="checkbox3" class="css-checkbox" checked="checked"/>
                        <label for="checkbox3" name="checkbox2_lbl" class="css-label lite-red-check">Free shipping</label>
                        @if($errors->has('checkbox2_lbl'))
                            <span class="help-block">
                                <strong>{{ $errors->first('checkbox2_lbl') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div id="inputs" style="display: none;"></div>
        <div class="col-lg-12 col-sm-12" style="padding: 0;">
            <button type="submit" class="red-button button float-right">SAVE AND CONTINUE</button>
        </div>
    </form>
    @php
   var_dump($errors);
@endphp
</div>
@endsection
