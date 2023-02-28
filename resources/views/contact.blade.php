<x-app title="Contact Us">
    <div id="content">
        <h1 class="text-4xl text-center my-8">Contact Us</h1>
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3620.369211496762!2d67.0271031144773!3d24.85123655174864!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb33e76727b1905%3A0x6f10d196e1aea61f!2sTrade%20Tower!5e0!3m2!1sen!2s!4v1606840849279!5m2!1sen!2s"
            width="100%"
            height="450"
            frameborder="0"
            style="border:0;"
            allowfullscreen="false"
            aria-hidden="false"
            tabindex="0"
        ></iframe>
        <div class="mt-12">
            <div class="mt-12">
                @if (session('success'))
                    <div class="px-4 py-3 leading-normal text-green-100 bg-green-600 rounded-lg" role="alert">
                        <ul>
                            <li class="text-center"> {{ session('success') }}</li>
                        </ul>
                    </div>
                @endif
                <div class="my-4 bg-white flex">
                    <div class="flex flex-col justify-center py-12 px-4 sm:px-6 md:flex-row lg:px-20 xl:px-24">
                        <div class="mx-auto w-full max-w-sm">
                            <div>
                                <h2 class="mt-6 text-2xl lg:text-3xl leading-9 font-extrabold text-gray-900">
                                    Send Message To Us
                                </h2>
                            </div>
                            <div class="mt-8">
                                <div class="mt-6">
                                    @if ($errors->any())
                                        <div class="px-4 py-3 leading-normal text-red-100 bg-red-700 rounded-lg"
                                             role="alert">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form action="{{ route('contact') }}" method="post">
                                        @csrf
                                        <div class="mt-4">
                                            <label for="name"
                                                   class="block text-sm font-medium leading-5 text-gray-700">Name
                                            </label>
                                            <div class="mt-1 relative rounded-md shadow-sm">
                                                <input
                                                    id="name"
                                                    name="name"
                                                    value="{{ old('name') }}"
                                                    required
                                                    type="text"
                                                    class="form-input block font-secondary w-full p-2 outline-none sm:text-sm sm:leading-5"
                                                    placeholder="Your Name"
                                                />
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <label for="email"
                                                   class="block text-sm font-medium leading-5 text-gray-700">Email
                                            </label>
                                            <div class="mt-1 relative rounded-md shadow-sm">
                                                <input
                                                    id="email"
                                                    name="email"
                                                    value="{{ old('email') }}"
                                                    required
                                                    type="email"
                                                    class="form-input block font-secondary w-full p-2 outline-none sm:text-sm sm:leading-5"
                                                    placeholder="Your Email"
                                                />
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <label for="contact"
                                                   class="block text-sm font-medium leading-5 text-gray-700">Contact
                                            </label>
                                            <div class="mt-1 relative rounded-md shadow-sm">
                                                <input
                                                    id="contact"
                                                    name="contact"
                                                    value="{{ old('contact') }}"
                                                    type="number"
                                                    required
                                                    class="form-input block font-secondary w-full p-2 outline-none sm:text-sm sm:leading-5"
                                                    placeholder="Your Contact"
                                                />
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <label for="message"
                                                   class="block text-sm font-medium leading-5 text-gray-700">Message
                                            </label>
                                            <div class="mt-1 relative rounded-md shadow-sm">
                                        <textarea
                                            name="message"
                                            id="message"
                                            required
                                            placeholder="Your Message"
                                            class="form-input block font-secondary w-full resize-none outline-none p-2 sm:text-sm sm:leading-5"
                                            rows="5"
                                        >{{ old('message') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="mt-6">
                                    <span class="block w-full rounded-md shadow-sm">
                                        <button type="submit"
                                                class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-400 focus:outline-none focus:border-blue-500 focus:shadow-outline-blue active:bg-blue-400 transition duration-150 ease-in-out">
                                            Submit
                                        </button>
                                    </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between flex-col md:flex-row">
                            <img src="{{ asset('img/app-marketing.png') }}" alt="app-marketing" class="w-1/2">
                            <div>
                                <h2 class="text-lg text-center my-3">Download Your Application</h2>
                                <ul class="flex items-center space-x-8">
                                    <li>
                                        <a href="javascript:;">
                                            <img src="{{ asset('img/play-store.png') }}" alt="play-store">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <img src="{{ asset('img/app-store.png') }}" alt="app-store">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</x-app>
