<picture>
    <!-- Untuk Layar Kerapatan Tinggi (Retina/4K) -->
    <source srcset="{{ asset('images/logo_sdn_gedong_12.png') }}" media="(min-resolution: 2dppx)">
    <!-- Untuk Layar Standar -->
    <img src="{{ asset('images/logo_sdn_gedong_12.png') }}" alt="Logo Sekolah" {{ $attributes }}>
</picture>
