@props(['status' => 'pending'])

@php
    $colors = [
        'pending' => ['bg' => 'warning', 'icon' => 'clock', 'text' => 'Menunggu'],
        'diterima' => ['bg' => 'success', 'icon' => 'check-circle', 'text' => 'Diterima'],
        'ditolak' => ['bg' => 'danger', 'icon' => 'times-circle', 'text' => 'Ditolak']
    ];
    
    $config = $colors[$status] ?? $colors['pending'];
@endphp

<span class="badge bg-{{ $config['bg'] }} px-3 py-2 rounded-pill">
    <i class="fas fa-{{ $config['icon'] }} me-1"></i>
    {{ $config['text'] }}
</span>