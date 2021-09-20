@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">New Pet</div>
               <div class="card-body">
                <div class="list-block">
                    <form action="{{route('pet.store')}}" method="post">                      
                        <div class="form-group" style="margin: 10px; font-style: italic">
                            <label>   Name: </label>
                            <input type="text" name="pet_name" class="form-control" value="{{old('pet_name')}}">
                            <small class="form-text text-muted">   Enter pet name</small>
                        </div>
                        <div class="form-group" style="margin: 10px; font-style: italic">
                            <label>   Species: </label>
                            <input type="text" name="pet_species" class="form-control" value="{{old('pet_species')}}">
                            <small class="form-text text-muted">   Enter pet species</small>
                        </div>
                        <div class="form-group" style="margin: 10px; font-style: italic">
                            <label>   Birth date: </label>
                            <input type="text" name="pet_birth_date" class="form-control" value="{{old('pet_birth_date')}}">
                            <small class="form-text text-muted">   Enter pet birth date</small>
                        </div>
                        <div class="form-group" style="margin: 10px; font-style: italic">
                            <label>   Document: </label>
                            <input type="text" name="pet_document" class="form-control" value="{{old('pet_document')}}">
                            <small class="form-text text-muted">   Enter pet document</small>
                        </div>
                        <div class="form-group" style="margin: 10px; font-style: italic">
                            <label>   History: </label>
                            <textarea type="text" name="pet_history"  class="form-control">{{old('pet_history')}}</textarea>                                
                        </div>
                        <div class="form-group" style="margin: 10px; font-style: italic">
                            <label>   Doctor: </label>
                            <select type="text" name="doctor_id" class="form-control">
                                @foreach ($doctors as $doctor)
                                    <option value="{{$doctor->id}}"@if(old('doctor_id') == $doctor->id)  selected @endif>{{$doctor->name}} {{$doctor->surname}}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">   Select doctor from the list</small>                                
                        </div>
                         <label>   Owner: </label>
                            <select type="text" name="owner_id" class="form-control">
                                @foreach ($owners as $owner)
                                    <option value="{{$owner->id}}"@if(old('owner_id') == $owner->id)  selected @endif>{{$owner->name}} {{$owner->surname}}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">   Select owner from the list</small>                                
                                                   
                        <div class="form-group" style="margin: 10px">                         
                            <button class="btn btn-light" type="submit" >Add</button>                            
                        </div> 
                        @csrf                       
                    </form>
                </div>
               </div>
           </div>
       </div>
   </div>
</div>



@endsection

@section('title') New Pet @endsection
