@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tags') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (Session::has('message'))
                    <div class="alert alert-info">{{ Session::get('message') }}</div>
                    @endif
                    @if (Auth::user()->role == 1) 
                    <form method="POST" role="form" action="{{route('add_tag')}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Add new Tag</label>
                        <input type="text" name="name" id="name" placeholder="Name">
                        <button type='submit' class="btn btn-primary">Submit</button>
                    </div>                    
                    </form>
                    @endif
                    @csrf
                    <table class="table">
                    <thead>
                        <tr>
                        <!-- <th scope="col">#ID</th> -->
                        <th scope="col">Name</th>
                        <th scope="col">Count</th>
                        <th scope="col">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($tags as $tag)
                      <tr>
                          <!-- <td scope="col">{{$tag->id}}</td> -->
                          <td><a href="" class="update" data-name="name" data-type="text" data-pk="{{ $tag->id }}" data-title="Enter name">{{ $tag->name }}</a></td>
                          <td scope="col">{{$counter[$tag->name]}}</td> 
                          <td scope="col">
                            <a class="deleteTag btn btn-xs btn-warning" data-id="{{ $tag->id }}"><i class="fas fa-trash"></i></a>
                          </td>
                    </tr>
                    @endforeach
                    </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$.fn.editable.defaults.mode = 'inline';

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
    }
});

$('.update').editable({
    url: "{{ route('update_tag') }}",
    type: 'text',
    pk: 1,
    name: 'name',
    title: 'Enter name'
});


$(".deleteTag").click(function(){
	        var id = $(this).data("id");
	        var token = '{{ csrf_token() }}';
	        $.ajax(
	        {
	            method:'POST',
	            url: "/delete/tag/"+id,
	            data: {_token: token},
	            success: function(data)
	            {
	                toastr.success('Successfully!','Delete');
                    window.location.reload();
	            }
	        });
	    });

</script>
@endsection
