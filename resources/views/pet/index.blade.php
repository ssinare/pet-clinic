@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">
               <h5>Pets List</h5> 
                <form action="{{route('pet.index')}}" method="GET">               
                    <fieldset>
                    <h6>Sort</h6>
                        <div class="list-block">
                            <button type="submit" name="sort" value="species" class="btn btn-light">Species</button>
                            <button type="submit" name="sort" value="birth_date" class="btn btn-light">Birth date</button>
                            <a href="{{route('pet.index')}}" class="btn btn-secondary">Reset</a>
                    
                            <div class="form-check">
                            <input class="form-check-input" type="radio" 
                                name="sort_dir" id="_1" 
                                value="asc" @if('desc' != $sortDirection) checked @endif>
                            <label class="form-check-label" for="_1">
                                ASC
                            </label>                    
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio"
                                name="sort_dir" id="_2"
                                value="desc" @if('desc'== $sortDirection) checked @endif>
                            <label class="form-check-label" for="_2" style="margin-right: 5px">
                                DESC
                            </label>                    
                            </div>
                        </div>                                             
                    </fieldset>
                </form>
                <form action="{{route('pet.index')}}" method="get">
                    <fieldset>
                        <h6 style="padding-top: 10px;">Filter</h6>
                        <div class="list-block">
                            <div>
                            <div class="form-group">
                                <select class="form-control" name="doctor_id">
                                <option value="0" disabled selected>Select Doctor</option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{$doctor->id}}" @if($doctor_id == $doctor->id) selected @endif>{{$doctor->name}} {{$doctor->surname}}</option>
                                @endforeach
                                </select>
                                <small class="form-text text-muted">Select doctor from the list.</small>
                                <button type="submit" class="btn btn-light" name="filter" value="doctor">Filter by doctor</button>
                           
                            </div>

                             <div class="form-group">
                                <select class="form-control" name="owner_id">
                                <option value="0" disabled selected>Select Owner</option>
                                @foreach ($owners as $owner)
                                    <option value="{{$owner->id}}" @if($owner_id == $owner->id) selected @endif>{{$owner->name}} {{$owner->surname}}</option>
                                @endforeach
                                </select>
                                <small class="form-text text-muted">Select owner from the list.</small>
                                <button type="submit" class="btn btn-light" name="filter" value="owner">Filter by owner</button>
                           
                            </div>            
                            </div>                      
                            <div class="block">
                                 <a href="{{route('pet.index')}}" class="btn btn-secondary">Reset</a>
                            </div>
                        </div>
                    </fieldset>
                </form>
                <form action="{{route('pet.index')}}" method="get">
                    <fieldset>
                        <h6 style="padding-top: 10px;">Search</h6>
                        <div class="list-block">
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Search" name="s" value="{{$s}}">
                                <small class="form-text text-muted">Search in our clinic</small>
                            </div>                       
                            <div class="block">
                                <button type="submit" class="btn btn-light" name="search" value="all">Search</button>
                                <a href="{{route('pet.index')}}" class="btn btn-secondary">Reset</a>
                            </div>
                        </div>
                    </fieldset>                    
                </form>             
                <div class="card-body">
                     <div class="mb-3">{{$pets->links()}}</div>
                   <ul class="list-group">
                    @foreach ($pets as $pet)
                    <li class="list-group-item">
                        <div class="list-block">
                            <div class="list-block_content">
                                <span> <i> Species: </i>{{$pet->species}} <b>{{$pet->name}}</b>
                                  <br>  <i> Birth date: </i> {{$pet->birth_date}}</span>
                                <small><i> Doctor: </i> {{$pet->petByDoctor->name}} {{$pet->petByDoctor->surname}}</small>
                                <small><i> Owner: </i> {{$pet->petByOwner->name}} {{$pet->petByOwner->surname}}</small>
                            </div>
                            <div class="list-block_button">
                                <a href="{{route('pet.edit',[$pet])}}" class="btn btn-light">Edit</a>
                                <a href="{{route('pet.show',[$pet])}}" class="btn btn-light">Show</a>
                                <form method="POST" action="{{route('pet.destroy', [$pet])}}">
                                <button maker="submit" class="btn btn-secondary" >Delete</button>
                                @csrf
                                </form>
                            </div>
                        </div>
                    </li>      
                    @endforeach
                   </ul>
                   <div class="m-2">{{$pets->links()}}</div> 
               </div>
           </div>
       </div>
   </div>
</div>
@endsection


@section('title') Pets List @endsection
