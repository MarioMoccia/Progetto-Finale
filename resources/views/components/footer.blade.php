<footer class="site-footer text-center py-4">
  <p>&copy; Presto.it 2026</p>
  <div class="footer-links d-flex justify-content-center align-items-center gap-3">
    <a href="{{ route('about') }}">{{ __('ui.aboutUs') }}</a>
    <span class="d-flex gap-2">
      <a href="#" class="fs-5" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
      <a href="#" class="fs-5" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
    </span>
    @auth
      @if (! Auth::user()->is_revisor)
        <a href="{{ route('work-with-us') }}">{{ __('ui.workWithUs') }}</a>
      @endif
    @endauth
  </div>
</footer>
