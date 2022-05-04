@extends('layouts.app')

@section('content')
    <div class="h-screen w-full flex flex-col bg-sky-300 items-center justify-center">
        <div class="bg-white flex flex-col items-center py-4" style="height: 90%; width: 90%">
            <div class="text-xl font-bold">Client Registration</div>

            {{-- <select id="region"></select> ito na yung fields na kailangan for API ng address. Need nalang ng styling
            <select id="province"></select>
            <select id="city"></select>
            <select id="barangay"></select> --}}
        </div>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js"></script>
    <script src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations-v1.0.0.js"></script>
    <script type="text/javascript">
        var my_handlers = {

            fill_provinces: function() {

                var region_code = $(this).val();
                $('#province').ph_locations('fetch_list', [{
                    "region_code": region_code
                }]);

            },

            fill_cities: function() {

                var province_code = $(this).val();
                $('#city').ph_locations('fetch_list', [{
                    "province_code": province_code
                }]);
            },


            fill_barangays: function() {

                var city_code = $(this).val();
                $('#barangay').ph_locations('fetch_list', [{
                    "city_code": city_code
                }]);
            }
        };

        $(function() {
            $('#region').on('change', my_handlers.fill_provinces);
            $('#province').on('change', my_handlers.fill_cities);
            $('#city').on('change', my_handlers.fill_barangays);

            $('#region').ph_locations({
                'location_type': 'regions'
            });
            $('#province').ph_locations({
                'location_type': 'provinces'
            });
            $('#city').ph_locations({
                'location_type': 'cities'
            });
            $('#barangay').ph_locations({
                'location_type': 'barangays'
            });

            $('#region').ph_locations('fetch_list');
        });
    </script>
@endsection
