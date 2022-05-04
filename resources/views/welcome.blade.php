@extends('layouts.app')

@section('content')
    <div class="flex flex-col h-screen w-screen">
        <div class="grid grid-cols-1 gap-5 h-full w-full py-3 md:grid-cols-2 bg-sky-300">
            <div class="flex flex-col col-span-1 w-full h-full lg:mx-10">
                <div class="text-3xl text-orange-700 uppercase font-bold px-3 xl:text-5xl">the best partner of the laundry
                    shops
                </div>
                <div class="text-2xl text-white font-bold px-3 mt-3 xl:text-3xl">Elevate and Innovate</div>
                <div class="text-xl text-white uppercase font-bold px-3 xl:text-2xl">be one of us</div>
                <div class="text-md text-white font-light px-3 mt-3 xl:text-xl">Lorem ipsum dolor sit amet, consectetur
                    adipiscing
                    elit.
                    Phasellus id erat in quam maximus semper. Sed rutrum fermentum quam, vitae maximus lectus malesuada et.
                    Ut
                    facilisis fringilla justo vitae ultricies. Mauris a sapien ut mi hendrerit pharetra a vitae elit. Etiam
                    at
                    velit efficitur, rhoncus nisi vel, porta arcu. Ut et ante et urna molestie rhoncus. Sed dignissim nec
                    lorem
                    in pellentesque. Pellentesque erat ante, condimentum eu erat ac, tempor venenatis tellus. Praesent
                    ornare
                    ipsum at nibh aliquam, et pulvinar tortor lobortis.</div>
            </div>
            <div class="flex col-span-1 justify-center items-center h-full lg:mx-10">
                <img src="https://github.com/robbychristian/PalabaPH/blob/master/public/images/PalabaPH-Icon.png?raw=true"
                    class="h-[40vh] w-[40vh] xl:h-[55vh] xl:w-[55vh]" />
            </div>
        </div>
        <div class="flex flex-col h-1/2 w-full bg-white">
            <div class="text-3xl text-orange-700 uppercase font-bold px-3 xl:text-5xl py-3 text-center">Our Features</div>
            <div class="grid grid-cols-1 w-full h-full my-2 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                <div class="flex flex-col col-span-1 w-full h-full justify-center items-center">
                    <img src="{{ asset('images/welcome/tab-store 1.png') }}"
                        class="h-[6vh] w-[6vh] lg:h-[10vh] lg:w-[10vh]" />
                    <div class="text-xl text-black font-bold lg:text-2xl">Store Module</div>
                    <div class="text-md text-gray-600 font-light text-center px-24 lg:text-lg lg:px-16">Lorem Ipsum
                        Dolorfsfsffsa
                        sit amet constetur adpiusinc
                        elit fermentum</div>
                </div>
                <div class="flex flex-col col-span-1 w-full h-full justify-center items-center">
                    <img src="{{ asset('images/welcome/laundry 1.png') }}"
                        class="h-[6vh] w-[6vh] lg:h-[10vh] lg:w-[10vh]" />
                    <div class="text-xl text-black font-bold lg:text-2xl">Services Module</div>
                    <div class="text-md text-gray-600 font-light text-center px-24 lg:text-lg lg:px-16">Lorem Ipsum
                        Dolorfsfsffsa
                        sit amet constetur adpiusinc
                        elit fermentum</div>
                </div>
                <div class="flex flex-col col-span-1 w-full h-full justify-center items-center">
                    <img src="{{ asset('images/welcome/tab-inventory 1.png') }}"
                        class="h-[6vh] w-[6vh] lg:h-[10vh] lg:w-[10vh]" />
                    <div class="text-xl text-black font-bold lg:text-2xl">Inventory Module</div>
                    <div class="text-md text-gray-600 font-light text-center px-24 lg:text-lg lg:px-16">Lorem Ipsum
                        Dolorfsfsffsa
                        sit amet constetur adpiusinc
                        elit fermentum</div>
                </div>
                <div class="flex flex-col col-span-1 w-full h-full justify-center items-center">
                    <img src="{{ asset('images/welcome/tab-store 2.png') }}"
                        class="h-[6vh] w-[6vh] lg:h-[10vh] lg:w-[10vh]" />
                    <div class="text-xl text-black font-bold lg:text-2xl">Order Module</div>
                    <div class="text-md text-gray-600 font-light text-center px-24 lg:text-lg lg:px-16">Lorem Ipsum
                        Dolorfsfsffsa
                        sit amet constetur adpiusinc
                        elit fermentum</div>
                </div>
                <div class="flex flex-col col-span-1 w-full h-full justify-center items-center">
                    <img src="{{ asset('images/welcome/laundry 2.png') }}"
                        class="h-[6vh] w-[6vh] lg:h-[10vh] lg:w-[10vh]" />
                    <div class="text-xl text-black font-bold lg:text-2xl">Sales Module</div>
                    <div class="text-md text-gray-600 font-light text-center px-24 lg:text-lg lg:px-16">Lorem Ipsum
                        Dolorfsfsffsa
                        sit amet constetur adpiusinc
                        elit fermentum</div>
                </div>
                <div class="flex flex-col col-span-1 w-full h-full justify-center items-center">
                    <img src="{{ asset('images/welcome/tab-inventory 2.png') }}"
                        class="h-[6vh] w-[6vh] lg:h-[10vh] lg:w-[10vh]" />
                    <div class="text-xl text-black font-bold lg:text-2xl">Statistics Module</div>
                    <div class="text-md text-gray-600 font-light text-center px-24 lg:text-lg lg:px-16">Lorem Ipsum
                        Dolorfsfsffsa
                        sit amet constetur adpiusinc
                        elit fermentum</div>
                </div>
                <div class="flex flex-col col-span-1 w-full h-full justify-center items-center">
                    <img src="{{ asset('images/welcome/tab-store 3.png') }}"
                        class="h-[6vh] w-[6vh] lg:h-[10vh] lg:w-[10vh]" />
                    <div class="text-xl text-black font-bold lg:text-2xl">Machine Module</div>
                    <div class="text-md text-gray-600 font-light text-center px-24 lg:text-lg lg:px-16">Lorem Ipsum
                        Dolorfsfsffsa
                        sit amet constetur adpiusinc
                        elit fermentum</div>
                </div>
                <div class="flex flex-col col-span-1 w-full h-full justify-center items-center">
                    <img src="{{ asset('images/welcome/laundry 3.png') }}"
                        class="h-[6vh] w-[6vh] lg:h-[10vh] lg:w-[10vh]" />
                    <div class="text-xl text-black font-bold lg:text-2xl">Complaints Module</div>
                    <div class="text-md text-gray-600 font-light text-center px-24 lg:text-lg lg:px-16">Lorem Ipsum
                        Dolorfsfsffsa
                        sit amet constetur adpiusinc
                        elit fermentum</div>
                </div>

            </div>
        </div>
    </div>
@endsection
