<x-app title="Home">
    <div id="content">
        <section id="slider" class="owl-carousel">
            @foreach($sliders as $slider)
                <img src="{{ $slider->getImagePath('image') }}" alt="banner">
            @endforeach
        </section>
        <section id="what_we_are" class="flex flex-row md:grid md:grid-cols-2 lg:grid-cols-3">
            <div id="phone" class="-mb-10 mt-10 mx-auto hidden md:block">
                <img src="{{ asset('img/phone.png') }}" alt="phone">
            </div>
            <div class="content lg:col-span-2 text-white py-5 md:py-0 my-auto">
                <h1 class="text-center md:text-left text-4xl md:text-5xl lg:text-8xl uppercase">
                    What We Are?
                </h1>
                <p class="text-center md:text-justify w-full md:w-11/12 lg:w-4/5 text-xl font-secondary">
                    <span class="font-semibold">Daala</span> is the application for delivering your goods to your
                    desired destination. We are offering you a service in which you just have to book a ride. Then load
                    your packages on our loaders and our driver will drop your luggage to your desired place
                </p>
            </div>
        </section>
        <section id="map" class="md:grid md:grid-cols-2 px-2 md:px-4 lg:px-6 pt-8 bg-gray-100">
            <div class="m-auto w-full md:w-3/4 lg:w-4/5">
                <h2 class="font-secondary text-3xl">UPTO</h2>
                <h1 class="text-6xl text-blue-400">05</h1>
                <h2 class="text-3xl">Drop Off location</h2>
                <p class="font-secondary text-xl">First e-commerce moving platform to offer upto 5 dropoff location -
                    from bikes to vehicles</p>
            </div>
            <img src="{{ asset('img/map.png') }}" alt="map" class="w-full">
        </section>
        <section id="slogan" class="my-8">
            <h1 class="text-2xl md:text-4xl lg:text-6xl text-center">Pakistan’s first logistics service</h1>
            <h3 class="text-xl mdtext-2xl lg:text-3xl font-secondary text-center">to offer services at the cheapest rate
                possible with quality service.</h3>
            <img src="{{ asset('img/karachi-banner.png') }}" alt="karachi" class="w-full">
        </section>
        <section id="choose_us" class="pb-8">
            <h1 class="text-2xl md:text-3xl lg:text-4xl text-center">Reason to choose us</h1>
            <div class="flex flex-col md:flex-row justify-between px-4 md:px-8 lg:px-16 pt-6">
                <div class="w-full md:w-1/2 lg:w-1/3">
                    <h2 class="text-2xl">Safe & Secure</h2>
                    <p class="text-justify font-secondary text-lg">
                        Our daala’s vehicles are registered and go through a thorough background check to ensure your
                        safety. GPs trackers are also instored for your tracking with every move
                    </p>
                </div>
                <div class="w-full pt-5 md:pt-0 md:w-1/2 lg:w-1/3">
                    <h2 class="text-2xl">Competitive & standart prices</h2>
                    <p class="text-justify font-secondary text-lg">
                        Our team at daala are working relentlessly to offer our customers the best prices possible and
                        let the burden only be about the load.
                    </p>
                </div>
            </div>
        </section>
    </div>
    <x-slot name="scripts">
        <script>
            $('.owl-carousel').owlCarousel({
                loop: true,
                autoplay: true,
                margin: 10,
                nav: false,
                dots: false,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 1
                    }
                }
            })
        </script>
    </x-slot>
</x-app>
