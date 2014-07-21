@if ($errors->any())
<div class="error-box">
    <h2>The following errors occurred:</h2>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif