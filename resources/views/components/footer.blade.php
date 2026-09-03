<footer class="site-footer">
  <p>&copy; Presto 2026</p>
  <div class="footer-links">
    <a href="/privacy">Chi Siamo</a>
    <a href="/cookie">Contatti</a>
    @auth
      @if (! Auth::user()->is_revisor)
        <a href="{{ route('work-with-us') }}">Lavora con noi</a>
      @endif
    @endauth
  </div>
</footer>
