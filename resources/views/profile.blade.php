@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row padding-row">

        @include('layouts.partials._profile_menu')

        <div class="col-md-8 col-sm-12">
            <div>
                <personal-information-form user="{{json_encode($user)}}" />
            </div>

            <div>
                <password-update-form />
            </div>
        </div>

    </div>
</div>
@endsection