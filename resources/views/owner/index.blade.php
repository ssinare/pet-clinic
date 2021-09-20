@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Owners List</div>
               <div class="card-body">
                    {{-- <div class="mb-3">{{$owners->links()}}</div> --}}
                   <ul class="list-group">
                    @foreach ($owners as $owner)
                     <li class="list-group-item">
                        <div class="list-block">
                            <div class="list-block_content">
                                <span>{{$owner->name}} {{$owner->surname}}</span>
                                {{-- @if ($owner->ownerPets->count()) 
                                <small>Has {{$owner->ownerPets->count()}} pets</small>
                                @else 
                                <small>Pet died, I'm sorry. </small>
                                @endif                                 --}}
                            </div>
                            <div class="list-block_button">
                                <a href="{{route('owner.edit',[$owner])}}" class="btn btn-light">Edit</a>                             
                                <form method="POST" action="{{route('owner.destroy', $owner)}}">
                                    <button type="submit" class="btn btn-secondary" >Delete</button>
                                @csrf
                                </form>
                            </div>
                        </div>
                    </li>
                    @endforeach 
                    </ul> 
                    {{-- <div class="m-2">{{$owners->links()}}</div>    --}}
               </div>
           </div>
       </div>
   </div>
</div>
@endsection


@section('title') Owners List @endsection