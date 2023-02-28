<footer class="bg-black py-5 text-white">
    <div class="flex flex-col md:flex-row justify-between px-4 md:px-8 lg:px-16 pb-8">
        <a href="/">
            <img src="{{ asset('img/logo-white.png') }}" alt="logo-white" class="w-2/4 md:w-4/5">
        </a>
        @foreach($footerLinks as $footerLink)
            <div class="pt-4 md:pt-0">
                <h5 class="text-lg">{{ $footerLink->title }}</h5>
                <ul>
                    @foreach($footerLink->childPages as $childLink)
                        <li>
                            <a class="text-sm font-light font-secondary hover:text-blue-400"
                               href="{{ route('page', $childLink->slug) }}">
                                {{ $childLink->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
        {{--<div class="pt-4 md:pt-0">
            <h5 class="text-lg">Top Services</h5>
            <ul>
                <li><a class="text-sm font-light font-secondary hover:text-blue-400" href="#">Home Mover Services</a>
                </li>
                <li><a class="text-sm font-light font-secondary hover:text-blue-400" href="#">Goods Transport
                        Services</a></li>
                <li><a class="text-sm font-light font-secondary hover:text-blue-400" href="#">Home Mover Services</a>
                </li>
                <li><a class="text-sm font-light font-secondary hover:text-blue-400" href="#">Schedule Bookings</a></li>
                <li><a class="text-sm font-light font-secondary hover:text-blue-400" href="#">Multiple Drop Off
                        Locations</a></li>
            </ul>
        </div>--}}
        <div class="pt-4 md:pt-0">
            <h5 class="text-lg">Head Office</h5>
            <ul>
                <li class="font-light font-secondary text-sm">Suit #603, 6th Floor, Trade tower,</li>
                <li class="font-light font-secondary text-sm">Abdullah Haroon Road,</li>
                <li class="font-light font-secondary text-sm">Karachi, Pakistan.</li>
                <li class="font-light font-secondary text-sm">021-32212301</li>
            </ul>
        </div>
    </div>
    <hr>
    <div class="px-6 py-3 pt-5 flex flex-col md:flex-row items-center justify-between">
        <div class="flex items-center space-x-4 my-3 md:my-0">
            &copy; 2020 Daala Pvt. Ltd.
        </div>
        <div class="flex items-center space-x-4 mb-3 md:mb-0">
            Design & Developed By <a href="https://www.facebook.com/OfficialEFFECTSTECH/"
                                     class="hover:text-blue-400 ml-1" target="_blank">Effects Tech</a>
        </div>
        <div class="flex items-center space-x-4 text-white">
            <ul class="flex items-center space-x-8">
                <li>
                    <a href="#" class="hover:text-blue-500">
                        <i data-feather="twitter"></i>
                    </a>
                </li>
                <li>
                    <a href="#" class="hover:text-blue-500">
                        <i data-feather="facebook"></i>
                    </a>
                </li>
                <li>
                    <a href="#" class="hover:text-blue-500">
                        <i data-feather="linkedin"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</footer>
