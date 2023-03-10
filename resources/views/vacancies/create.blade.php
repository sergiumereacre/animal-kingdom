<x-app-layout>
    This page will show the form for creating vacancies

    <form method="POST" action="/vacancies" enctype="multipart/form-data">
        {{-- This tag makes it so that not anyone can just send a form pointed towards this URL --}}
        @csrf
        <div>
            <label for="vacancy_title">Vacancy Title</label>
            <input type="text" name="vacancy_title" placeholder="" value="{{old('vacancy_title')}}">
        </div>

        {{-- Catching errors and displaying them --}}
        @error('vacancy_title')
            <p>{{$message}}</p>
        @enderror       

        <div>
            <label for="category_requirement">Category Requirement</label>
            <select name="category_requirement" id="category_requirement">
                <option value="NULL">None</option>
                <option value="MAMMAL">Mammal</option>
                <option value="REPTILE">Reptile</option>
                <option value="AMPHIBIAN">Amphibian</option>
                <option value="AVIAN">Avian</option>
                <option value="FISH">Fish</option>
            </select>
        </div>

        @error('category_requirement')
            <p>{{$message}}</p>
        @enderror

        <div>
            <input type="checkbox" name="can_fly_requirement" id="can_fly_requirement" value="1">
            <label for="can_fly_requirement">Can Fly Requirement</label>
            </select>
        </div>

        @error('can_fly_requirement')
            <p>{{$message}}</p>
        @enderror

        <div>
            <input type="checkbox" name="can_swim_requirement" id="can_swim_requirement" value="1">
            <label for="can_swim_requirement">Can Swim Requirement</label>
            </select>
        </div>

        @error('can_swim_requirement')
            <p>{{$message}}</p>
        @enderror

        <div>
            <input type="checkbox" name="can_climb_requirement" id="can_climb_requirement" value="1">
            <label for="can_climb_requirement">Can Climb Requirement</label>
            </select>
        </div>

        @error('can_climb_requirement')
            <p>{{$message}}</p>
        @enderror

        <div>
            <label for="eating_style_requirement">Eating Style Requirement</label>
            <select name="eating_style_requirement" id="eating_style_requirement">
                <option value="NULL">None</option>
                <option value="HERBIVORE">Herbivore</option>
                <option value="CARNIVORE">Carnivore</option>
                <option value="OMNIVORE">Omnivore</option>
            </select>
        </div>

        @error('eating_style_requirement')
            <p>{{$message}}</p>
        @enderror

        <div>
            <input type="checkbox" name="produces_toxins_requirement" id="produces_toxins_requirement" value="1">
            <label for="produces_toxins_requirement">Produces Toxins Requirement</label>
            </select>
        </div>

        @error('produces_toxins_requirement')
            <p>{{$message}}</p>
        @enderror

        <div>
            <label for="size_requirement">Size Requirement</label>
            <select name="size_requirement" id="size_requirement">
                <option value="NULL">None</option>
                <option value="SMALL">Small</option>
                <option value="MEDIUM">Medium</option>
                <option value="LARGE">Large</option>
            </select>
        </div>

        @error('size_requirement')
            <p>{{$message}}</p>
        @enderror
        
        <div>
            <label for="speed_requirement">Speed Requirement</label>
            <select name="speed_requirement" id="speed_requirement">
                <option value="NULL">None</option>
                <option value="SLOW">Slow</option>
                <option value="MEDIUM">Medium</option>
                <option value="FAST">Fast</option>
            </select>
        </div>

        @error('speed_requirement')
            <p>{{$message}}</p>
        @enderror

        <div>
            <label for="num_appendages_requirement">Number of Appendages Requirement</label>
            <select name="num_appendages_requirement" id="num_appendages_requirement">
                <option value="NULL">None</option>
                <option value="NONE">No Appendages</option>
                <option value="FEW">Few Appendages, e.g., 4</option>
                <option value="MANY">Many Appendages</option>
            </select>
        </div>

        @error('num_appendages_requirement')
            <p>{{$message}}</p>
        @enderror

        <div>
            <label for="vacancy_description">Vacancy Description</label>
            <textarea name="vacancy_description" id="vacancy_description" rows="10" placeholder="Vacancy Description...">{{old('vacancy_description')}}</textarea>
        </div>

        @error('vacancy_description')
            <p>{{$message}}</p>
        @enderror

        <div>
            <button>
                Create Vacancy
            </button>

            <a href="/dashboard">Go Back</a>
        </div>
            <label for="category_requirement">Category Requirement</label>
            <select name="category_requirement" id="category_requirement">
                <option value="NULL">None</option>
                <option value="MAMMAL">Mammal</option>
                <option value="REPTILE">Reptile</option>
                <option value="AMPHIBIAN">Amphibian</option>
                <option value="AVIAN">Avian</option>
                <option value="FISH">Fish</option>
            </select>
        </div>

        @error('category_requirement')
            <p>{{$message}}</p>
        @enderror

        <div>
            <input type="checkbox" name="can_fly_requirement" id="can_fly_requirement" value="1">
            <label for="can_fly_requirement">Can Fly Requirement</label>
            </select>
        </div>

        @error('can_fly_requirement')
            <p>{{$message}}</p>
        @enderror

        <div>
            <input type="checkbox" name="can_swim_requirement" id="can_swim_requirement" value="1">
            <label for="can_swim_requirement">Can Swim Requirement</label>
            </select>
        </div>

        @error('can_swim_requirement')
            <p>{{$message}}</p>
        @enderror

        <div>
            <input type="checkbox" name="can_climb_requirement" id="can_climb_requirement" value="1">
            <label for="can_climb_requirement">Can Climb Requirement</label>
            </select>
        </div>

        @error('can_climb_requirement')
            <p>{{$message}}</p>
        @enderror

        <div>
            <label for="eating_style_requirement">Eating Style Requirement</label>
            <select name="eating_style_requirement" id="eating_style_requirement">
                <option value="NULL">None</option>
                <option value="HERBIVORE">Herbivore</option>
                <option value="CARNIVORE">Carnivore</option>
                <option value="OMNIVORE">Omnivore</option>
            </select>
        </div>

        @error('eating_style_requirement')
            <p>{{$message}}</p>
        @enderror

        <div>
            <input type="checkbox" name="produces_toxins_requirement" id="produces_toxins_requirement" value="1">
            <label for="produces_toxins_requirement">Produces Toxins Requirement</label>
            </select>
        </div>

        @error('produces_toxins_requirement')
            <p>{{$message}}</p>
        @enderror

        <div>
            <label for="size_requirement">Size Requirement</label>
            <select name="size_requirement" id="size_requirement">
                <option value="NULL">None</option>
                <option value="SMALL">Small</option>
                <option value="MEDIUM">Medium</option>
                <option value="LARGE">Large</option>
            </select>
        </div>

        @error('size_requirement')
            <p>{{$message}}</p>
        @enderror
        
        <div>
            <label for="speed_requirement">Speed Requirement</label>
            <select name="speed_requirement" id="speed_requirement">
                <option value="NULL">None</option>
                <option value="SLOW">Slow</option>
                <option value="MEDIUM">Medium</option>
                <option value="FAST">Fast</option>
            </select>
        </div>

        @error('speed_requirement')
            <p>{{$message}}</p>
        @enderror

        <div>
            <label for="num_appendages_requirement">Number of Appendages Requirement</label>
            <select name="num_appendages_requirement" id="num_appendages_requirement">
                <option value="NULL">None</option>
                <option value="NONE">No Appendages</option>
                <option value="FEW">Few Appendages, e.g., 4</option>
                <option value="MANY">Many Appendages</option>
            </select>
        </div>

        @error('num_appendages_requirement')
            <p>{{$message}}</p>
        @enderror

        <div>
            <label for="vacancy_description">Vacancy Description</label>
            <textarea name="vacancy_description" id="vacancy_description" rows="10" placeholder="Vacancy Description...">{{old('vacancy_description')}}</textarea>
        </div>

        @error('vacancy_description')
            <p>{{$message}}</p>
        @enderror

        <div>
            <button>
                Create Vacancy
            </button>

            <a href="/dashboard">Go Back</a>
        </div>
    </form>


</x-app-layout>
