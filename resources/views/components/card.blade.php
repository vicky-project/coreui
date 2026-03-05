@props(['title' => '', 'footer' => ''])

<div class="card shadow-sm border-0 mb-4">
  @if($title)
  <div class="card-header bg-white fw-bold">
    {{ $title }}
  </div>
  @endif
  <div class="card-body">
    {{ $slot }}
  </div>
  @if($footer)
  <div class="card-footer bg-light border-0">
    {{ $footer }}
  </div>
  @endif
</div>