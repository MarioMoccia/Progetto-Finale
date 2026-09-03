@props(['lang'])

<form action="{{ route('setLocale', $lang) }}" method="POST" class="d-inline">
    @csrf
    <button type="submit" class="btn p-1">
        <img src="{{ asset('vendor/blade-flags/country-'.$lang.'.svg') }}" width="28" height="28" alt="{{ $lang }}">
    </button>
</form>
