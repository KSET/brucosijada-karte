@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Privileges') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (Session::has('message'))
                    <div class="alert alert-info">{{ Session::get('message') }}</div>
                    @endif
                    @csrf
                     @if (Auth::user()->role == 1)
                     <form method="POST" role="form" action="{{route('add_privilege')}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Dodaj na popis:</label>
                        <input type="text" name="name" id="name" placeholder="Ime">
                        <button type='submit' class="btn btn-primary">Predaj</button>
                    </div>
                    </form>
                    @endif
                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Count</th>
                        <th scope="col">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($privileges as $privilege)
                      <tr>
                          <td scope="col">{{$privilege->id}}</td>
                          <td>{{ $privilege->name }}</td>
                          <td scope="col">{{$counter[$privilege->id]}}</td> 
                          <td scope="col">
                            <a class="deletePrivilege btn btn-xs btn-warning" data-id="{{ $tag->id }}"><i class="fas fa-trash"></i></a>
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
@endsection
<script type="text/javascript">
$.fn.editable.defaults.mode = 'inline';

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
    }
});

$('.update').editable({
    url: "{{ route('update_privilege') }}",
    type: 'text',
    pk: 1,
    name: 'name',
    title: 'Enter name'
});


$(".deletePrivilege").click(function(){
	        var id = $(this).data("id");
	        var token = '{{ csrf_token() }}';
	        $.ajax(
	        {
	            method:'POST',
	            url: "/delete/privilege/"+id,
	            data: {_token: token},
	            success: function(data)
	            {
	                toastr.success('Successfully!','Delete');
                    window.location.reload();
	            }
	        });
	    });

</script>