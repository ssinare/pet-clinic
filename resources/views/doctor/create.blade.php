@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">New Doctor</div>
               <div class="card-body">
                   <div class="list-block">
                    <form action="{{route('doctor.store')}}" method="post">                       
                            <div class="form-group" style="margin: 10px; font-style: italic">
                                <label>   Name: </label>
                                <input type="text" name="doctor_name" class="form-control" value="{{old('doctor_name')}}">
                                <small class="form-text text-muted">   Enter new doctor name</small>
                            </div>
                            <div class="form-group" style="margin: 10px; font-style: italic">
                                <label>   Surname: </label>
                                <input type="text" name="doctor_surname" class="form-control" value="{{old('doctor_surname')}}">
                                <small class="form-text text-muted">   Enter new doctor surname</small>
                            </div>
                            <div class="form-group" style="margin: 10px; font-style: italic">
                                <label>   Category: </label>
                                <input type="text" name="doctor_surname" class="form-control" value="{{old('doctor_category')}}">
                                <small class="form-text text-muted">   Enter new doctor category</small>
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


@section('title') New Doctor @endsection