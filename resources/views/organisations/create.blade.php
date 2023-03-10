<x-app-layout>
    This page will show the form for creating organisations

    <form method="POST" action="/organisations" enctype="multipart/form-data">
        {{-- This tag makes it so that not anyone can just send a form pointed towards this URL --}}
        @csrf
        <div>
            <label for="organisation_name">Organisation Name</label>
            <input type="text" name="organisation_name" placeholder="" value="{{old('organisation_name')}}">
        </div>

        {{-- Catching errors and displaying them --}}
        @error('organisation_name')
            <p>{{$message}}</p>
        @enderror     
        
        <div>
            <label for="picture">
              Company Logo
            </label>
            <input type="file" name="picture" />
        </div>

        @error('picture')
            <p>{{$message}}</p>
        @enderror

        <div>
            <label for="address">Organisation Address</label>
            <input type="text" name="address" placeholder="" value="{{old('address')}}">
        </div>

        @error('address')
            <p>{{$message}}</p>
        @enderror     
          
        <div>
            <label for="email">Organisation Email</label>
            <input type="email" name="email" placeholder="" value="{{old('email')}}">
        </div>

        @error('email')
            <p>{{$message}}</p>
        @enderror    
        
        <div>
            <label for="contact_number">Organisation Number</label>
            <input type="text" name="contact_number" placeholder="" value="{{old('contact_number')}}">
        </div>

        @error('contact_number')
            <p>{{$message}}</p>
        @enderror     

        <div>
            <label for="description">Organisation Description</label>
            <textarea name="description" id="description" rows="10" placeholder="Organisation Description...">{{old('description')}}</textarea>
        </div>

        @error('description')
            <p>{{$message}}</p>
        @enderror

        <div>
            <button>
                Create Organisation
            </button>

            {{-- Possibly go straight to the created organisation page? --}}
            <a href="/dashboard">Go Back</a>
        </div>
    </form>

</x-app-layout>
