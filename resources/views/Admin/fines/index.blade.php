@extends('layouts.master')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Fines</h2>
            </div>
            <div class="pull-right">
                @can('fine-create')
                <a class="btn btn-success" href="{{ route('fines.create') }}"> Create Fine</a>
                @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Student</th>
            <th>Equipment</th>
            <th>Status</th>
            <th>Amount</th>
            <th width="280px">Action</th>
        </tr>
	    @foreach ($fines as $fine)
	    <tr>
	        <td>{{ ++$i }}</td>
            <td>{{ $fine->student }}</td>
	        <td>{{ $fine->Equipment}}</td>
	        <td>{{ $fine->status }}</td>
	        <td>{{ $fine->Amount}}</td>
	        <td>
                <form action="{{ route('fines.destroy',$fine->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('fines.show',$fine->id) }}">Show</a>
                    @can('fine-edit')
                    <a class="btn btn-primary" href="{{ route('fines.edit',$fine->id) }}">Edit</a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('course-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>


    {!! $fines->links() !!}



@endsection
