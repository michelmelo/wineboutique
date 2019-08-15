@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row padding-row startup">
            <div class="col-md-12 col-sm-12">
                <form method="post" action="/sub-merchant-setup">
                    @csrf

                    <div class="shadow-box row">
                        <div class="col-xs-12">
                            <h2>SUB MERCHANT SETUP</h2>

                            @foreach($fields as $field)
                                @if($field->FieldType == "checkbox" or $field->FieldType == "text" or $field->FieldType == "tel"
                                or $field->FieldType == "number" or $field->FieldType == "email" or $field->FieldType == "url"
                                or $field->FieldType == "password")
                                <div class="row">
                                    <div class="col-lg-6 col-lg-push-3 col-sm-12 enter-name">
                                        <label for="{{ $field->UserDefinedId }}">{{ $field->ShortName }}</label>
                                        <input type="{{$field->FieldType}}" name="{{ $field->UserDefinedId }}" id="{{ $field->UserDefinedId }}" placeholder="{{ $field->PlaceholderText }}" required>
                                    </div>
                                </div>
                                @elseif(strpos($field->UserDefinedId,".ownershiptype") !== false)
                                    <div class="row">
                                        <div class="col-lg-6 col-lg-push-3 col-sm-12 enter-name">
                                            <label for="{{ $field->UserDefinedId }}">{{ $field->ShortName }}</label>
                                            <input type="text" name="{{ $field->UserDefinedId }}" id="{{ $field->UserDefinedId }}" placeholder="{{ $field->PlaceholderText }}" required>
                                        </div>
                                    </div>
                                @elseif(strpos($field->UserDefinedId,".dob") !== false)
                                    <div class="row">
                                        <div class="col-lg-6 col-lg-push-3 col-sm-12 enter-name">
                                            <label for="{{ $field->UserDefinedId }}">{{ $field->ShortName }}</label>
                                            <input type="date" name="{{ $field->UserDefinedId }}" id="{{ $field->UserDefinedId }}" placeholder="{{ $field->PlaceholderText }}" required>
                                        </div>
                                    </div>
                                @elseif(strpos($field->UserDefinedId,".mcc") !== false)
                                    <div class="row form-inputs">
                                        <div class="col-lg-6 col-lg-push-3 col-sm-12 enter-name">
                                            <label for="{{ $field->UserDefinedId }}">{{ $field->ShortName }}</label>
                                            <select name="{{ $field->UserDefinedId }}" id="{{ $field->UserDefinedId }}">
                                                @foreach($field->OptionsList as $key => $value)
                                                    <option value="{{$key}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @elseif(strpos($field->UserDefinedId,".address") !== false)
                                    <div class="row">
                                        <div class="col-lg-6 col-lg-push-3 col-sm-12 enter-name">
                                            <label for="{{ $field->UserDefinedId }}">{{ $field->ShortName }} Country</label>
                                            <input type="text" name="{{ $field->UserDefinedId }}[Country]" id="{{ $field->UserDefinedId }}" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-lg-push-3 col-sm-12 enter-name">
                                            <label for="{{ $field->UserDefinedId }}">{{ $field->ShortName }} Address 1</label>
                                            <input type="text" name="{{ $field->UserDefinedId }}[Street1]" id="{{ $field->UserDefinedId }}" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-lg-push-3 col-sm-12 enter-name">
                                            <label for="{{ $field->UserDefinedId }}">{{ $field->ShortName }} Address 2</label>
                                            <input type="text" name="{{ $field->UserDefinedId }}[Street2]" id="{{ $field->UserDefinedId }}" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-lg-push-3 col-sm-12 enter-name">
                                            <label for="{{ $field->UserDefinedId }}">{{ $field->ShortName }} City</label>
                                            <input type="text" name="{{ $field->UserDefinedId }}[City]" id="{{ $field->UserDefinedId }}" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-lg-push-3 col-sm-12 enter-name">
                                            <label for="{{ $field->UserDefinedId }}">{{ $field->ShortName }} State</label>
                                            <input type="text" name="{{ $field->UserDefinedId }}[State]" id="{{ $field->UserDefinedId }}" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-lg-push-3 col-sm-12 enter-name">
                                            <label for="{{ $field->UserDefinedId }}">{{ $field->ShortName }} Zip</label>
                                            <input type="text" name="{{ $field->UserDefinedId }}[Zip]" id="{{ $field->UserDefinedId }}" required>
                                        </div>
                                    </div>
                                @else
                                    <input type="hidden" name="{{ $field->UserDefinedId }}" value="missing_parameter">
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="red-button button float-right">FINISH</button>
                </form>
            </div>
        </div>
    </div>
@endsection