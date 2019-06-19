@extends('layouts.app')

@section('content')
<div class="container margin-row">
    <cart user-address="{{json_encode($user_address)}}"></cart>
</div>
@endsection