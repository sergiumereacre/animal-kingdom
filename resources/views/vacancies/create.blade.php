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
            <label for="vacancy_description">Vacancy Description</label>
            <input type="text" name="vacancy_description" placeholder="" value="{{old('vacancy_description')}}">
        </div>

        @error('vacancy_description')
            <p>{{$message}}</p>
        @enderror

        <div>
            <label for="category_requirement">Category Requirement</label>
            <select name="category_requirement" id="category_requirement">
                <option value="MAMMAL"></option>
            </select>
        </div>

        @error('category_requirement')
            <p>{{$message}}</p>
        @enderror

    </form>


</x-app-layout>
