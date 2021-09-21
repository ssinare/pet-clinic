@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Doctor edit</div>
               <div class="card-body">
                    <div class="list-block">
                    <form action="{{route('doctor.update', $doctor)}}" method="post">                        
                        <div class="form-group" style="margin: 10px; font-style: italic">
                            <label>   Name: </label>
                            <input type="text" name="doctor_name" value="{{old('doctor_name', $doctor->name)}}" class="form-control">
                            <small class="form-text text-muted">   Edit doctor's name</small>
                        </div>
                        <div class="form-group" style="margin: 10px; font-style: italic">
                            <label>   Surname: </label>
                            <input type="text" name="doctor_surname" value="{{old('doctor_surname', $doctor->surname)}}" class="form-control">
                            <small class="form-text text-muted">   Edit doctor's surname</small>
                        </div>
                        <div class="form-group" style="margin: 10px; font-style: italic">
                            <label>  Category: </label>
                            <input type="text" name="doctor_category" value="{{old('doctor_category', $doctor->category)}}" class="form-control">
                            <small class="form-text text-muted">   Edit doctor's category</small>
                        </div>
                        <div class="form-group" style="margin: 10px">                         
                            <button class="btn btn-light" type="submit" >Update Doctor</button>                            
                        </div> 
                            @csrf                       
                    </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection

@section('title') Doctor edit @endsection