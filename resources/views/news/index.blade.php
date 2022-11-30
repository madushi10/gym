@extends('layouts.master')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Lates News</h2>
            </div>
            <div class="pull-right">
                @can('news-create')
                <a class="btn btn-success" href="{{ route('news.create') }}"> Create New News</a>
                @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered container">
        <tr>
            <th>No</th>
            <th>Title</th>
            <th>Description</th>
            <th>Image</th>
            <th width="280px">Action</th>
        </tr>
	    @foreach ($news as $news)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $news->title }}</td>
	        <td>{{ $news->description }}</td>
            <td>{{ $news->image }}</td>
	        <td>
                <form action="{{ route('news.destroy',$news->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('news.show',$news->id) }}">Show</a>
                    @can('news-edit')
                    <a class="btn btn-primary" href="{{ route('news.edit',$news->id) }}">Edit</a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('news-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>


    
    



@endsection