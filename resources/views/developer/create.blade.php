@extends('layouts.app')

@section('main-content')
<main class = "w-full h-full overflow-y-auto dark:text-[--dark-text]">
    <div class="container mx-auto my-5 px-4">
        <h3 class="mb-8 text-4xl font-bold text-center">{{ Auth::user()->name }}</h3>
        @if ($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('developer.store') }}" method="post" enctype="multipart/form-data">
            @csrf


            {{-- Experience Year --}}
            <div class="form-row">
                <label class = "form-label" for="experience_year">Anni di Esperienza</label>
                <input type="number" name="experience_year" id="experience_year" class="form-input peer" placeholder=" " value="{{ old('experience_year') }}"/> 
            </div>

            {{-- Profile Picture --}}
            <div class="form-row">
                <label class = "form-label" for="profile_picture" >Profile Picture</label>
                <input type="file" name="profile_picture" id="profile_picture" class="form-input peer"/>
            </div>
            
            {{-- Profile Description --}}
            <div class="form-row">
                <label for="phone_number" class = "form-label" ><span class ="text-red-500">*</span>Descrizione Profilo</label>
                <textarea required id="profile_description" name="profile_description" class="form-input peer" rows="4" cols="50">{{ old('profile_description') }}</textarea>
            </div>

            {{-- Address --}}
            <div class="form-row">
                <label for="address" class = "form-label" >Indirizzo</label>
                <input type="text" name="address" id="address" class="form-input peer" placeholder=" " value="{{ old('address') }}"/>
            </div>

            {{-- Phone Number --}}
            <div class="form-row">
                <label for="phone_number" class = "form-label" >Numero di Telefono</label>
                <input type="text" name="phone_number" id="phone_number" class="form-input peer" placeholder=" " value="{{ old('phone_number') }}"/>
            </div>

            {{-- Work Fields --}}
            <h4 class="mb-2">Work Fields</h4>
            <div class="form-row">
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                    @foreach ($work_fields as $work_field)
                        <div class="flex items-center mb-4">
                            <input name="work_fields[]" id="work_fiels" type="checkbox" value="{{ $work_field->id }}" class="checkbox">
                            <label for="work_fields" class="checkbox-label">{{ $work_field->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            <button type="submit" class="btn-primary w-full">Crea</button>
        </form>
    </div>
</main>
@endsection