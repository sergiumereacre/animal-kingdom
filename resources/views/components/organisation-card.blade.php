{{-- Receives an organisation variable --}}
@props(['organisation'])

<x-card>
  <div class="flex">
    <div>
      <h3>
        <a href="/organisations/{{$organisation->id}}">{{$organisation->title}}</a>
      </h3>
      <div>{{$organisation->organisation_name}}</div>
      <div>Owner (Little database pulling here)</div>
      <div>{{$organisation->address}}</div>
      <div>{{$organisation->email}}</div>
      <div>{{$organisation->contact_number}}</div>
    </div>
  </div>
</x-card>