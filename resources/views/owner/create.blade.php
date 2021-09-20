@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">New Owner</div>
               <div class="card-body">
                   <div class="list-block">
                    <form action="{{route('owner.store')}}" method="post">                       
                            <div class="form-group" style="margin: 10px; font-style: italic">
                                <label>   Name: </label>
                                <input type="text" name="owner_name" class="form-control" value="{{old('owner_name')}}">
                                <small class="form-text text-muted">   Enter new owner name</small>
                            </div>
                            <div class="form-group" style="margin: 10px; font-style: italic">
                                <label>   Surname: </label>
                                <input type="text" name="owner_surname" class="form-control" value="{{old('owner_surname')}}">
                                <small class="form-text text-muted">   Enter new owner surname</small>
                            </div>
                            <div class="form-group" style="margin: 10px; font-style: italic">
                                <label>   Contacts: </label>
                            <textarea type="text" name="owner_contacts"  class="form-control">{{old('owner_contacts')}}</textarea>       
                                <small class="form-text text-muted">   Enter new owner contacts</small>
                            </div>
                            <div class="form-group" style="margin: 10px">                         
                                <button class="btn btn-light" type="submit" >Add new</button>                            
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


@section('title') New Owner @endsection