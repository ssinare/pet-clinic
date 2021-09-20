<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$pet->species}} - {{$pet->name}}</title>
<style>
div {
    margin: 20px;
}
</style>
</head>
<body>
<div style="font-size:35px; ">{{$pet->species}} - {{$pet->name}}</div>
<div style="font-size:22px; ">Doctor: </i> {{$pet->petByDoctor->name}} {{$pet->petByDoctor->surname}}</div>
<div style="font-size:18px ">Birth date: {{$pet->birth_date}}</div>
<div style="font-size:14px "> {!!$pet->history!!}</div>
</body>
</html>