@extends('layouts.app')
@section('content')
    @if (session()->has('alert'))
        <div class="modal" id="success-modal-preview" data-modal="1">
            <div class="modal__content">
                <div class="p-5 text-center"> <i data-feather="check-circle" class="w-16 h-16 text-theme-9 mx-auto mt-3"></i>
                    <div class="text-3xl mt-5">Berhasil!</div>
                    <div class="text-gray-600 mt-2">{{ session('alert') }}</div>
                </div>
                <div class="px-5 pb-8 text-center"> <button type="button" data-dismiss="modal"
                        class="button w-24 bg-theme-1 text-white">Ok</button> </div>
            </div>
        </div>
    @endif
    <div class="grid grid-cols-12 gap-6">
        <!-- BEGIN: Profile Menu -->
        <div class="col-span-12">
            <!-- BEGIN: Display Information -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-gray-200">
                    <h2 class="font-medium text-base mr-auto">
                        Informasi
                    </h2>
                </div>
                <div class="p-5">
                    <form action="/user" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-12 gap-5">
                            <div class="col-span-12 xl:col-span-4">
                                <div class="border border-gray-200 rounded-md p-5">
                                    <div class="w-40 h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                        @if (Auth::user()->foto == 'user.png')
                                            <img class="rounded-md" alt="{{ Auth::user()->name }}"
                                                src="{{ asset('assets/dist/images/') . '/' . Auth::user()->foto }}"
                                                id="imagePreview">
                                        @else
                                            <img class="rounded-md" alt="{{ Auth::user()->name }}"
                                                src="{{ asset('storage') . '/' . Auth::user()->foto }}" id="imagePreview">
                                        @endif
                                    </div>
                                    <div class="w-40 mx-auto cursor-pointer relative mt-5">
                                        <button type="button"
                                            class="button w-full bg-theme-7 text-white cursor-pointer">Upload Foto</button>
                                        <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0"
                                            id="imageInput" name="foto">
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-8">
                                <div>
                                    <label>Username</label>
                                    <input type="text" class="input w-full border bg-gray-100 mt-2"
                                        value="{{ Auth::user()->username }}" readonly>
                                </div>
                                <div>
                                    <label>Nama</label>
                                    <input type="text" class="input w-full border bg-gray-100 mt-2"
                                        value="{{ Auth::user()->name }}" name="name">
                                </div>
                                <div class="mt-3">
                                    <div>
                                        <label>Email</label>
                                        <input type="text" class="input w-full border bg-gray-100 mt-2"
                                            value="{{ Auth::user()->email }}" name="email">
                                    </div>
                                </div>
                                <button type="submit" class="button w-20 bg-theme-1 text-white mt-3">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END: Display Information -->
            <!-- BEGIN: Personal Information -->
            <div class="intro-y box lg:mt-5">
                <div class="flex items-center p-5 border-b border-gray-200">
                    <h2 class="font-medium text-base mr-auto">
                        Rubah Password
                    </h2>
                </div>
                <div class="p-5">
                    <form action="/rubahPassword" method="POST">
                        @csrf
                        <div class="grid grid-cols-12 gap-5">
                            <div class="col-span-12">
                                <div>
                                    <label>Passoword Lama</label>
                                    <input type="password"
                                        class="input w-full border bg-gray-100 mt-2 @error('password_lama') error @enderror()"
                                        name="password_lama">
                                    @error('password_lama')
                                        <label id="name-error" class="error" for="name">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-span-12">
                                <div class="mt-3">
                                    <div>
                                        <label>Konfirmasi Passoword Baru</label>
                                        <input type="password"
                                            class="input w-full border bg-gray-100 mt-2 @error('password_konfirmasi') error @enderror()"
                                            name="password_konfirmasi">
                                        @error('password_konfirmasi')
                                            <label id="name-error" class="error" for="name">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-12">
                                <div class="mt-3">
                                    <label>Passoword Baru</label>
                                    <input type="password"
                                        class="input w-full border bg-gray-100 mt-2 @error('password_baru') error @enderror()"
                                        name="password_baru">
                                    @error('password_baru')
                                        <label id="name-error" class="error" for="name">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- <div class="flex justify-start mt-4">
                          
                        </div> --}}
                        <button type="submit" class="button w-20 bg-theme-1 text-white ml-auto mt-5">Simpan</button>
                    </form>
                </div>
            </div>
            <!-- END: Personal Information -->
        </div>
         <!-- END: Profile Menu -->
    </div>
    @endsection
    @push('myscript')
        <script>
            document.getElementById('imageInput').addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imagePreview = document.getElementById('imagePreview');
                        imagePreview.src = e.target.result;
                        imagePreview.style.display = 'block';
                    };

                    reader.readAsDataURL(file);
                }
            });
        </script>
    @endpush
