@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">  
                    <div>Species: <b>{{$pet->species}}</b></div>
                    <div><b>Doctor: {{$pet->petByDoctor->name}} {{$pet->petByDoctor->surname}} </b></div> 
                     <div><b>Owner: {{$pet->petByOwner->name}} {{$pet->petByOwner->surname}} </b></div>        
                </div>
               <div class="card-body">
                    <div class="list-block">
                         <div class="pet-container">
                        <div class="pet-container__maker">
                           <div>  Name: <b> {{$pet->name}}  </b></div>  
                           <div> Birth date: <b> {{$pet->birth_date}} </b></div> 
                        </div>
                        </div>
                   </div>
                        <div class="pet-container">
                        <div class="pet-container__notices">
                        {!!$pet->history!!}
                          {{-- //su regexpu tikrinti ar yra script tagas  ir pakeisti i      --}}
                        </div>   
                        </div>
                        <a href="{{route('pet.edit',[$pet])}}" class="btn btn-secondary m-2">Edit</a></a>
                        <a href="{{route('pet.pdf',[$pet])}}" class="btn btn-secondary m-2">PDF</a></a>
                    </div>
            </div>
                
           </div>
       </div>
   </div>
</div>



@endsection

@section('title') {{$pet->species}} @endsection
