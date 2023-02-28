<x-app title="Home">
    <x-slot name="styles">
        <style>
            .bg-img {
                /* Background image */
                background-image: url('{{ asset('img/coming-soon.jpg') }}');
                /* Full-screen */
                height: 700px;
                /* Center the background image */
                background-position: center;
                /* Scale and zoom in the image */
                background-size: cover;
                /* Add position: relative to enable absolutely positioned elements inside the image (place text) */
                position: relative;
                /* Add a white text color to all elements inside the .bgimg container */
                color: white;
                /* Add a font */
                font-size: 50px;
            }
            .middle {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                text-align: center;
            }
        </style>
    </x-slot>
    <div id="content">
        <div class="bg-img">
            <div class="middle">
                <h1>Coming Soon</h1>
            </div>
        </div>
    </div>
</x-app>
