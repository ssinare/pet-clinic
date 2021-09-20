@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Owner edit</div>
               <div class="card-body">
                    <div class="list-block">
                    <form action="{{route('owner.update', $owner)}}" method="post">                        
                        <div class="form-group" style="margin: 10px; font-style: italic">
                            <label>   Name: </label>
                            <input type="text" name="owner_name" value="{{old('owner_name', $owner->name)}}" class="form-control">
                            <small class="form-text text-muted">   Edit owner's name</small>
                        </div>
                        <div class="form-group" style="margin: 10px; font-style: italic">
                            <label>   Surname: </label>
                            <input type="text" name="owner_surname" value="{{old('owner_surname', $owner->surname)}}" class="form-control">
                            <small class="form-text text-muted">   Edit owner's surname</small>
                        </div>
                        <div class="form-group" style="margin: 10px; font-style: italic">
                            <label>  Category: </label>
                            <textarea type="text" name="owner_contacts"  class="form-control">{{old('owner_contacts')}}</textarea>
                            <small class="form-text text-muted">   Edit owner's contacts</small>
                        </div>
                        <div class="form-group" style="margin: 10px">                         
                            <button class="btn btn-light" type="submit" >Update Owner</button>                            
                        </div> 
                            @csrf                       
                    </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection

@section('title') Owner edit @endsection