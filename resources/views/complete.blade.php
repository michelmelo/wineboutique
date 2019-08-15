@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="headline-2">{{ $response }}</h1>
</div>

<script>
    $(document).ready(function () {
        window.top.location.href = '{{ url("my-orders") }}';
    });
</script>
@endsection
