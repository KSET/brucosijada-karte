@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Users') }}</div>

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
                    <label>Name:</label>
                    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search by Name...">
                    <hr>
                    <table class="table" id="editable">
                    <thead>
                        <tr>
                        <!-- <th scope="col">#ID</th> -->
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Privilege</th>
                        <th scope="col">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                      <tr>
                          <!-- <td scope="col">{{$user->id}}</td> -->
                          <td scope="col">{{$user->name}}</td> 
                          <td scope="col">{{$user->email}}</td> 
                          <td>{{ $user->role }}</td>
                          <td scope="col">
                            <a class="oneUser btn btn-xs btn-dark" data-id="{{ $user->id }}">1</a>
                            <a class="twoUser btn btn-xs btn-dark" data-id="{{ $user->id }}">2</a>
                            <a class="threeUser btn btn-xs btn-dark" data-id="{{ $user->id }}">3</a>
                            <a class="deleteUser btn btn-xs btn-warning" data-id="{{ $user->id }}"><i class="fas fa-trash"></i></a>
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

function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("editable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
} 

$.fn.editable.defaults.mode = 'inline';

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
    }
});

$(".deleteUser").click(function(){
	        var id = $(this).data("id");
	        var token = '{{ csrf_token() }}';
	        $.ajax(
	        {
	            method:'POST',
	            url: "/delete/user/"+id,
	            data: {_token: token},
	            success: function(data)
	            {
	                toastr.success('Successfully!','Delete');
                    window.location.reload();
	            }
	        });
	    });

        $(".oneUser").click(function(){
	        var id = $(this).data("id");
	        var token = '{{ csrf_token() }}';
	        $.ajax(
	        {
	            method:'POST',
	            url: "/one/user/"+id,
	            data: {_token: token},
	            success: function(data)
	            {
	                toastr.success('Successfully!','Made Admin');
                    window.location.reload();
	            }
	        });
	    });
        $(".twoUser").click(function(){
	        var id = $(this).data("id");
	        var token = '{{ csrf_token() }}';
	        $.ajax(
	        {
	            method:'POST',
	            url: "/two/user/"+id,
	            data: {_token: token},
	            success: function(data)
	            {
	                toastr.success('Successfully!','Made Gate');
                    window.location.reload();
	            }
	        });
	    });
        $(".threeUser").click(function(){
	        var id = $(this).data("id");
	        var token = '{{ csrf_token() }}';
	        $.ajax(
	        {
	            method:'POST',
	            url: "/three/user/"+id,
	            data: {_token: token},
	            success: function(data)
	            {
	                toastr.success('Successfully!','Made Sale');
                    window.location.reload();
	            }
	        });
	    });

</script>
@endsection
