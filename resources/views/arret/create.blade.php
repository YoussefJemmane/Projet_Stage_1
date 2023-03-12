@extends('dashboard')
@section('content')

    <div class="py-12 selection:bg-red-500">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <section>
                        <form method="post" action="{{ route('arret.store') }}" class="mt-6 space-y-6">
                            @csrf

                            <div>
                                <x-input-label for="code" :value="__('Code arret')" />
                                <x-text-input id="code" name="code" type="text" class="mt-1 block w-full"
                                    :value="old('code')" required autofocus autocomplete="code" />
                                <x-input-error class="mt-2" :messages="$errors->get('code')" />
                            </div>
                            <div class="flex justify-around">

                                <div class="w-full pr-3">
                                    <x-input-label for="heure_debut_arret" :value="__('Heure Debut d\'Arret')" />
                                    <x-text-input id="heure_debut_arret" name="heure_debut_arret" type="time"
                                        class="mt-1 block w-full" min="1" max="3" :value="old('heure_debut_arret')" required
                                        autofocus autocomplete="heure_debut_arret" />
                                    <x-input-error class="mt-2" :messages="$errors->get('heure_debut_arret')" />
                                </div>
                                <div class="w-full">
                                    <x-input-label for="heure_fin_arret" :value="__('Heure fin d\'Arret')" />
                                    <x-text-input id="heure_fin_arret" name="heure_fin_arret" type="time"
                                        class="mt-1 block w-full" min="1" max="3" :value="old('heure_fin_arret')" required
                                        autofocus autocomplete="heure_fin_arret" />
                                    <x-input-error class="mt-2" :messages="$errors->get('heure_fin_arret')" />
                                </div>
                            </div>
                            <div class="flex justify-around">
                                <div class="w-full pr-3">
                                    <x-input-label for="navire" :value="__('Navire')" />
                                    <select name="navire_id" id="navire"
                                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-red-400 dark:focus:border-red-500 focus:ring-red-400 dark:focus:ring-red-500 rounded-md shadow-sm mt-2 w-full">
                                        @foreach ($navires as $navire)
                                            <option value="{{ $navire->id }}">{{ $navire->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="w-full ">
                                    <x-input-label for="Engin" :value="__('Engin')" />
                                    <select name="engin_id" id="engin"
                                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-red-400 dark:focus:border-red-500 focus:ring-red-400 dark:focus:ring-red-500 rounded-md shadow-sm mt-2 w-full">

                                    </select>
                                </div>
                            </div>



                            <div class="flex justify-end">
                                <x-primary-button>
                                    {{ __('Save') }}
                                </x-primary-button>
                            </div>

                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#navire').on('click', function() {
                var navireID = $(this).val();
                if (navireID) {
                    $.ajax({
                        url: '/getEngin/' + navireID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}",

                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#engin').empty();
                                $('#engin').append('<option hidden>Choose Engin</option>');
                                $.each(data, function(key, engin) {
                                    $('select[name="engin_id"]').append(
                                        '<option value="' + engin.id + '">' + engin.code + '</option>');
                                });
                            } else {
                                $('#engin').empty();
                            }
                        }
                    });
                } else {
                    $('#engin').empty();
                }
            });
        });
    </script>
@endsection
@section('title', 'Create Arret')
