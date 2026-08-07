<section class="py-20 bg-card/30 relative group">
    <div class="container">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">С кем работаю</h2>
        <p class="text-center text-text-secondary mb-12 max-w-2xl mx-auto">
            Реализовал проекты для компаний разных сфер: от премиальных брендов 
            до технологических стартапов
        </p>
        
        <div class="relative overflow-hidden">
            <!-- Карусель -->
            <div class="flex gap-8 py-4 carousel-run">
                @for($i = 0; $i < 3; $i++)
                    @foreach(['artoftea', 'brcno', 'tesseract', 'lat', 'sad'] as $brand)
                        <div class="flex-shrink-0 w-48 h-24 bg-card rounded-2xl border border-white/10 flex items-center justify-center p-4">
                            @include('components.logo.' . $brand)
                        </div>
                    @endforeach
                @endfor
            </div>
        </div>
        
        <!-- Градиентные маски -->
        <div class="absolute left-0 top-1/2 -translate-y-1/2 w-32 h-full bg-gradient-to-r from-background to-transparent pointer-events-none"></div>
        <div class="absolute right-0 top-1/2 -translate-y-1/2 w-32 h-full bg-gradient-to-l from-background to-transparent pointer-events-none"></div>
    </div>
</section>

<style>
@keyframes carousel {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-33.333%);
    }
}

.carousel-run {
    animation: carousel 10s linear infinite;
    width: max-content;
}

/* Пауза при наведении на всю секцию */
.group:hover .carousel-run {
    animation-play-state: paused;
}
</style>