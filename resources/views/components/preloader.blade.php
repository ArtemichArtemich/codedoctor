<div
    id="preloader"
    class="fixed inset-0 bg-background flex items-center justify-center transition-opacity duration-500"
    style="z-index: 100;"
>
    <div class="flex flex-col items-center">

        <div class="relative w-24 h-24 mb-6">

            <div class="absolute inset-0 border-4 border-accent/20 rounded-full"></div>

            <div
                class="absolute inset-0 border-4 border-transparent border-t-accent rounded-full animate-spin"
                style="animation-duration: 1s;"
            ></div>

            <div class="absolute inset-0 flex items-center justify-center">

                <img
                    src="/images/favicon.webp"
                    alt="Code Doctor"
                    width="64"
                    height="64"
                    class="w-16 h-16 object-contain"
                >

            </div>

        </div>

        <div class="text-center">

            <div class="text-xl font-bold">
                Code Doctor
            </div>

            <div class="text-text-secondary text-sm mt-2">
                Разработка и развитие сайтов
            </div>

        </div>

    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const preloader = document.getElementById('preloader');

    function hidePreloader() {

        if (!preloader || preloader.style.display === 'none') {
            return;
        }

        preloader.style.opacity = '0';

        setTimeout(function () {
            preloader.style.display = 'none';
            document.body.classList.add('loaded');
        }, 500);
    }


    if (document.readyState === 'complete') {
        hidePreloader();
    } else {
        window.addEventListener('load', hidePreloader, { once: true });
    }


    // Страховка, если событие load по какой-то причине не произошло
    setTimeout(hidePreloader, 3000);

});
</script>