<img src="{{ $src }}" alt="{{ $alt }}"
    @if ($width) width="{{ $width }}" @endif
    @if ($height) height="{{ $height }}" @endif loading="{{ $loading }}" decoding="async"
    @if ($fetchpriority !== 'auto') fetchpriority="{{ $fetchpriority }}" @endif class="{{ $class }}">
