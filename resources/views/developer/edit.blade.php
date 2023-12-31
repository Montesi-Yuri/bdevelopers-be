@extends('layouts.app')

@section('main-content')
    <main class="bg-zinc-50 dark:bg-zinc-900 w-full h-full overflow-y-auto text-[--text] dark:text-[--dark-text]">
        <div class="container mx-auto my-5 px-4">
            <div class="mb-8 flex flex-col items-center">
                <h3 class="text-4xl font-bold text-center">{{ $developer->user->name }}</h3>
            </div>
            
            @if ($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('developer.update', ['developer' => $developer->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Name --}}
                <div class="form-row">
                    <label class ="form-label" for="name"><span class ="text-red-500">*</span> Nome Cognome</label>
                    <input type="text" name="name" id="name" class="form-input peer" placeholder=" " required value="{{ old('name', $developer->user->name) }}"/>
                </div>

                {{-- Email --}}
                <div class="form-row">
                    <label class ="form-label" for="email"><span class ="text-red-500">*</span> Email</label>
                    <input type="email" name="email" id="email" class="form-input peer" placeholder=" " required value="{{ old('email', $developer->user->email) }}"/>
                </div>

                {{-- Profile Picture --}}
                <h4 class="mb-2 font-medium text-sm">Immagine profilo</h4>
                <div class="form-row bg-gray-200 dark:bg-gray-800 rounded-md p-4">
                    @if ($developer->profile_picture)
                        <div class="my-8 flex justify-center">
                            <img class="rounded-lg w-32 object-cover" src="{{ $developer->full_img_src }}" class="w-50" alt="{{ $developer->user->name }}">
                        </div>
                        <div class="form-check">
                            <input class="checkbox my-5" type="checkbox" name="remove_profile_picture" id="remove_profile_picture" value="remove">
                            <label class="checkbox-label" for="remove_profile_picture">
                                Rimuovi immagine profilo
                            </label>
                        </div>
                    @endif
                    <label class="form-label" for="profile_picture">Seleziona immagine profilo</label>
                    <input type="file" name="profile_picture" id="profile_picture" class="form-input peer"/>
                    
                </div>

                {{-- Experience Year --}}
                <div class="form-row">
                    <label class ="form-label" for="experience_year" >Anni di Esperienza</label>
                    <input type="number" name="experience_year" id="experience_year" class="form-input peer" placeholder=" " value="{{ old('experience_year', $developer->experience_year) }}"/>
                </div>
                
                {{-- Profile Description --}}
                <div class="form-row">
                    <label class ="form-label" for="profile_description"><span class ="text-red-500">*</span> Descrizione Profilo</label>
                    <textarea required id="profile_description" name="profile_description" class="form-input peer" rows="4" cols="50">{{ old('profile_description', $developer->profile_description) }}</textarea>
                </div>

                {{-- Address --}}
                <div class="form-row">
                    <label class ="form-label" for="address" >Indirizzo</label>
                    <input type="text" name="address" id="address" class="form-input peer" placeholder=" " value="{{ old('address', $developer->address) }}"/>
                </div>

                {{-- Phone Number --}}
                <div class="form-row">
                    <label class = "form-label" for="phone_number" >Numero di Telefono</label>
                    <input type="text" name="phone_number" id="phone_number" class="form-input peer" placeholder=" " value="{{ old('phone_number', $developer->phone_number) }}"/>
                </div>

                {{-- Work Fields --}}
                <h4 class="mb-2 font-medium text-sm"><span class ="text-red-500">*</span>Work Fields</h4>
                <div class="form-row bg-gray-200 dark:bg-gray-800 rounded-md py-6 px-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                        @foreach ($work_fields as $i => $work_field)
                            <div class="flex items-center mb-4">
                                <input name="work_fields[]" id="work_field{{ $i }}" type="checkbox" value="{{ $work_field->id }}" class="checkbox"
                                    @if ($errors->any())
                                        @if ( in_array( $work_field->id, old('work_fields', []) ) )
                                            checked
                                        @endif
                                    @elseif ( $developer->work_fields->contains($work_field) )
                                        checked
                                    @endif
                                >
                                <label for="work_field{{ $i }}" class="checkbox-label">{{ $work_field->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-center mt-5">
                    <button type="submit" class="btn-primary">Modifica</button>
                </div>
            </form>
        </div>
    </main>
@endsection