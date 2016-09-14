@extends('layouts.app')

@section('content')

<div class="container">

    <row>
        <table class="table" >
            <thead>
                <tr>
                    <th>Place</th>
                    <th>Name</th>
                    <th>Punk's</th>
                    <th>All games</th>
                </tr>
            </thead>
            <tbody>

             <?php $i =0;?>
             @foreach($top_10 as $key=>$tops_10)
                <?php $i++;?>
                <tr>
                   <td>{{ $i }}</td>
                   <td><div>
                        <img src="http://placehold.it/100x100">
                        <a style="display: block; text-align: center;width: 100px;" href="user/{{ $tops_10['id'] }}/show">{{ucfirst( $tops_10['name'])}}</a>
                        </div>
                   </td>
                   <td>{{$key}}</td>
                   <th><a href="user/{{ $tops_10['id'] }}/show">{{$tops_10['all_games']}}</a></td>
                 </tr>
             @endforeach
            </tbody>
        </table>
@endsection