@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav class="navbar navbar-toggleable-md navBAR-light bg-faded">
                    <a href="{{route('income.index')}}">
                        <button type="button" class="btn btn-success">Добавить Income</button>
                    </a>
                    <a href="{{route('outgo.index')}}">
                        <button type="button" class="btn btn-danger">Добавить Outgo</button>
                    </a>
                </nav>

                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th style="color: #0E0EFF">Type</th>
                                <th style="color: #0E9A00">Category</th>
                                <th style="color: #0e9a00">Date</th>
                                <th style="color: #0E9A00">Sum</th>
                                <th style="color: #0E9A00">Total</th>
                                <th style="color: #0E9A00">Comment</th>
                                <th style="color: #0E9A00">User</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($histories as $history)
                                @php /**@var \App\Models\BlogCategory $item */ @endphp
                                <tr>
                                    <td>{{$history->type->name}}</td>
                                    <td>{{$history->category->name}}</td>
                                    <td>{{$history->created_at}}</td>
                                    <td>{{number_format("$history->sum",2,"."," ")}}</td>
                                    <td>{{number_format("$history->total",2,"."," ")}}</td>
                                    <td>{{$history->comment}}</td>
                                    <td>{{$history->user->name}}</td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
        @if($histories->total() > $histories->count(7))
            <br>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            {{$histories->links()}}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
