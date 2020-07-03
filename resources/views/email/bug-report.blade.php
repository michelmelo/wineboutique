<h1>BUG REPORT</h1>
<div>
    <h2>Issue reported by: {{ $user->firstName }}{{ isset($user->lastName) ? ' ' . $user->lastName : '' }} (<a href="mailto:{{$user->email}}">{{$user->email}}</a>)</h2>
    <h3>REPORT TEXT:</h3>
    <div>
        <i>{{ $text }}</i>
    </div>
</div>