@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Ulaz') }}</div>

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
                    <label>Prezime:</label>
                    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Pretraži po Prezimenu...">
                    <hr>
                    <table class="table" id="editable">
                    <thead>
                        <tr>
                        <!-- <th scope="col">#ID</th> -->
                        <th scope="col">Ime</th>
                        <th scope="col">Prezime</th>
                        <!-- <th scope="col">Email</th> -->
                        <th scope="col">Tag</th>
                        <!-- <th scope="col">Phone</th> -->
                        <!-- <th scope="col">Tag</th> -->
                        <th scope="col">Ulaznica</th>
                        <th scope="col">Ulaz</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                      @foreach ($guests as $guest)
                      <tr>
                        <!-- <td scope="col">{{$guest->id}}</td> -->
                        <!-- <td scope="col">{{$guest->name}}</td>  -->
                        <td>{{ $guest->name }}</td>
                        <!-- <td scope="col">{{$guest->surname}}</td> -->
                        <td>{{ $guest->surname }}</td>                       
                        <!-- <td scope="col">{{$guest->email}}</td> -->
                        <!-- <td scope="col">{{$guest->jmbag}}</td> -->
                        <td>{{ $guest->tag }}</td>
                        <td>
                        @if($guest->bought==0)
                        <i class="fas fa-times"></i>
                        @else
                        <i class="fas fa-check"></i>
                        @endif</td>
                        <!-- <td scope="col">{{$guest->phone}}</td> -->
                        <!-- <td scope="col">{{$guest->tag}}</td> -->
                        <!-- <td><a href="" class="update" data-name="tag" data-type="text" data-pk="{{ $guest->id }}" data-title="Pick Tag">{{$guest->tag}}</a></td> -->
                        <!-- <td scope="col"><a class="deleteProduct btn btn-xs btn-danger" data-id="{{ $guest->id }}"><i class="fas fa-trash"></i></a></td> -->
                        <!-- <td><a href="" class="update" data-name="bought" data-type="number" data-pk="{{ $guest->id }}" data-title="Enter bought">{{ $guest->bought }}</a></td> -->
                        <td>
                            @if($guest->entered==0)
                            <a class="enterGuest btn btn-xs btn-danger" data-id="{{ $guest->id }}"><i class="fas fa-times"></i></a>
                            @else
                            <a class="kickGuest btn btn-xs btn-success" data-id="{{ $guest->id }}"><i class="fas fa-check"></i></a>
                            @endif
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
    td = tr[i].getElementsByTagName("td")[1];
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

$(".enterGuest").click(function(){
	        var id = $(this).data("id");
	        var token = '{{ csrf_token() }}';
	        $.ajax(
	        {
	            method:'POST',
	            url: "/enter/guest/"+id,
	            data: {_token: token},
	            success: function(data)
	            {
	                toastr.success('Successfully!','Entered');
                    window.location.reload();
	            }
	        });
	    });

$(".kickGuest").click(function(){
	        var id = $(this).data("id");
	        var token = '{{ csrf_token() }}';
	        $.ajax(
	        {
	            method:'POST',
	            url: "/kick/guest/"+id,
	            data: {_token: token},
	            success: function(data)
	            {
	                toastr.success('Successfully!','Kicked');
                    window.location.reload();
	            }
	        });
	    });

</script>
@endsection
