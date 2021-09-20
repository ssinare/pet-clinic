@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Doctors List</div>
               <div class="card-body">
                    <div class="mb-3">{{$doctors->links()}}</div>
                   <ul class="list-group">
                    @foreach ($doctors as $doctor)
                     <li class="list-group-item">
                        <div class="list-block">
                            <div class="list-block_content">
                                <span>{{$doctor->name}} {{$doctor->surname}} {{$doctor->category}}</span>
                                @if ($doctor->doctorPets->count()) 
                                <small>Works with {{$doctor->doctorPets->count()}} pets</small>
                                @else 
                                <small>Currently has no pets </small>
                                @endif                                
                            </div>
                            <div class="list-block_button">
                                <a href="{{route('doctor.edit',[$doctor])}}" class="btn btn-light">Edit</a>                             
                                <form method="POST" action="{{route('doctor.destroy', $doctor)}}">
                                    <button type="submit" class="btn btn-secondary" >Delete</button>
                                @csrf
                                </form>
                            </div>
                        </div>
                    </li>
                    @endforeach 
                    </ul> 
                    <div class="m-2">{{$doctors->links()}}</div>   
               </div>
           </div>
       </div>
   </div>
</div>
@endsection


@section('title') Doctors List @endsection