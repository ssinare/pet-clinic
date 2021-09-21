<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$pet->species}} - {{$pet->name}}</title>
<style>

	        @font-face {
	            font-family: 'Roboto Slab';
	            src: url({{asset('fonts/RobotoSlab-Regular.ttf')}});
	            font-weight: normal;
	        }
	        @font-face {
	            font-family: 'Roboto Slab';
	            src: url({{asset('fonts/RobotoSlab-Bold.ttf')}});
	            font-weight: bold;
	        }
	        body {
	            font-family: 'Roboto Slab';
	        }
	        div {
	            margin: 7px;
	            padding: 7px;
	        }
	        .master {
	            font-size: 18px;
	        }
	        .about {
	            font-size: 11px;
	            color: gray;
	        }
	        .color {
	            margin: 12px;
	            font-size: 25px;
	            text-transform: uppercase;
	        }

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