<footer class="site-footer">
  <p>&copy; Presto.it 2026</p>
  <div class="footer-links">
    <a href="/privacy">{{ __('ui.aboutUs') }}</a>
    <a href="/cookie">{{ __('ui.contacts') }}</a>
    @auth
      @if (! Auth::user()->is_revisor)
        <a href="{{ route('work-with-us') }}">{{ __('ui.workWithUs') }}</a>
      @endif
    @endauth
  </div>
</footer>
