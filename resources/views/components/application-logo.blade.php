<picture>
    <!-- Untuk Layar Kerapatan Tinggi (Retina/4K) -->
    <source srcset="{{ asset('images/Logo_Unindra.png') }}" media="(min-resolution: 2dppx)">
    <!-- Untuk Layar Standar -->
    <img src="{{ asset('images/Logo_Unindra.png') }}" alt="Logo Sekolah" {{ $attributes }}>
</picture>
