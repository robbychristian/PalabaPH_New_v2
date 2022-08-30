@extends('layouts.app')

@section('content')
    <div class="flex flex-col h-screen">
        <div class="grid grid-cols-1 gap-5 h-full w-full py-3 md:grid-cols-2 bg-sky-300">
            <div class="flex flex-col col-span-1 w-full h-full lg:mx-10">
                <div class="text-3xl text-orange-700 uppercase font-bold px-3 xl:text-5xl">the best partner of the laundry
                    shops
                </div>
                <div class="text-2xl text-white font-bold px-3 mt-3 xl:text-3xl">Elevate and Innovate</div>
                <div class="text-xl text-white uppercase font-bold px-3 xl:text-2xl">be one of us</div>
                <div class="text-md text-white font-light px-3 mt-3 xl:text-xl">Managing your laundry shop will not be a
                    problem. Palaba PH provides management capabilities for the whole laundry operations. Palaba PH is also
                    a platform that connects customers and laundry shops closer together. Customers can see your laundry
                    shop services, products, pricing and machine availability, It even comes with notifications and
                    monitoring for customers and laundry owners. What are you waiting for? Elevate your laundry services
                    with Palaba PH.</div>
                <br>
                <button class="btn btn-warning w-50 text-white">Download PalabaPH Android App</button>
            </div>
            <div class="flex col-span-1 justify-center items-center h-full lg:mx-10">
                <img src="https://palabaph.com/images/PalabaPH-Icon.png" class="h-[40vh] w-[40vh] xl:h-[55vh] xl:w-[55vh]" />
            </div>
        </div>
        <div class="flex flex-col h-full w-full bg-white">
            <div class="text-3xl text-orange-700 uppercase font-bold px-3 xl:text-5xl py-3 text-center">Our Features</div>
            <div class="grid grid-cols-1 w-full h-full my-2 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                <div class="flex flex-col col-span-1 w-full h-full justify-center items-center">
                    <img src="{{ asset('images/welcome/tab-store 1.png') }}"
                        class="h-[6vh] w-[6vh] lg:h-[10vh] lg:w-[10vh]" />
                    <div class="text-xl text-black font-bold lg:text-2xl">Store Module</div>
                    <div class="text-md text-gray-600 font-light text-center px-24 lg:text-lg lg:px-16">Customize and update
                        from time to time your laundry shop details</div>
                </div>
                <div class="flex flex-col col-span-1 w-full h-full justify-center items-center">
                    <img src="{{ asset('images/welcome/laundry 1.png') }}"
                        class="h-[6vh] w-[6vh] lg:h-[10vh] lg:w-[10vh]" />
                    <div class="text-xl text-black font-bold lg:text-2xl">Services Module</div>
                    <div class="text-md text-gray-600 font-light text-center px-24 lg:text-lg lg:px-16">Include all of your
                        laundry shop's services and products
                    </div>
                </div>
                <div class="flex flex-col col-span-1 w-full h-full justify-center items-center">
                    <img src="{{ asset('images/welcome/tab-inventory 1.png') }}"
                        class="h-[6vh] w-[6vh] lg:h-[10vh] lg:w-[10vh]" />
                    <div class="text-xl text-black font-bold lg:text-2xl">Inventory Module</div>
                    <div class="text-md text-gray-600 font-light text-center px-24 lg:text-lg lg:px-16">Keep track on your
                        laundry shop's inventory of stocks</div>
                </div>
                <div class="flex flex-col col-span-1 w-full h-full justify-center items-center">
                    <img src="{{ asset('images/welcome/tab-store 2.png') }}"
                        class="h-[6vh] w-[6vh] lg:h-[10vh] lg:w-[10vh]" />
                    <div class="text-xl text-black font-bold lg:text-2xl">Order Module</div>
                    <div class="text-md text-gray-600 font-light text-center px-24 lg:text-lg lg:px-16">Manage your customer
                        orders, queueing and payments with ease</div>
                </div>
                <div class="flex flex-col col-span-1 w-full h-full justify-center items-center">
                    <img src="{{ asset('images/welcome/laundry 2.png') }}"
                        class="h-[6vh] w-[6vh] lg:h-[10vh] lg:w-[10vh]" />
                    <div class="text-xl text-black font-bold lg:text-2xl">Sales Module</div>
                    <div class="text-md text-gray-600 font-light text-center px-24 lg:text-lg lg:px-16">Record and monitor
                        your laundry shop's overall sales records</div>
                </div>
                <div class="flex flex-col col-span-1 w-full h-full justify-center items-center">
                    <img src="{{ asset('images/welcome/tab-inventory 2.png') }}"
                        class="h-[6vh] w-[6vh] lg:h-[10vh] lg:w-[10vh]" />
                    <div class="text-xl text-black font-bold lg:text-2xl">Statistics Module</div>
                    <div class="text-md text-gray-600 font-light text-center px-24 lg:text-lg lg:px-16">Generate statistical
                        graphs and reports about your laundry shop</div>
                </div>
                <div class="flex flex-col col-span-1 w-full h-full justify-center items-center">
                    <img src="{{ asset('images/welcome/tab-store 3.png') }}"
                        class="h-[6vh] w-[6vh] lg:h-[10vh] lg:w-[10vh]" />
                    <div class="text-xl text-black font-bold lg:text-2xl">Machine Module</div>
                    <div class="text-md text-gray-600 font-light text-center px-24 lg:text-lg lg:px-16">Let your customer
                        monitor your laundry shop's machine availability</div>
                </div>
                <div class="flex flex-col col-span-1 w-full h-full justify-center items-center">
                    <img src="{{ asset('images/welcome/laundry 3.png') }}"
                        class="h-[6vh] w-[6vh] lg:h-[10vh] lg:w-[10vh]" />
                    <div class="text-xl text-black font-bold lg:text-2xl">Complaints Module</div>
                    <div class="text-md text-gray-600 font-light text-center px-24 lg:text-lg lg:px-16">Keep in touch with
                        your customers by getting their feedback and reports</div>
                </div>

            </div>
        </div>
    </div>
@endsection
