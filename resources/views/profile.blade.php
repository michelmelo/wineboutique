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
                @if(!$user->google_id && !$user->facebook_id)
                    <password-update-form />
                @endif
            </div>
        </div>

    </div>
</div>
@endsection