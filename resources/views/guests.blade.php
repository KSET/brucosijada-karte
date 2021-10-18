@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Brucoši') }}</div>

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
                     <form method="POST" role="form" action="{{route('add_guest')}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Dodaj na popis:</label>
                        <input type="text" name="name" id="name" placeholder="Ime">
                        <input type="text" name="surname" id="name" placeholder="Prezime">
                        <select name="tag" id="tag" >
                            @foreach($tags as $tag)
                            <option value="{{$tag->name}}">{{$tag->name}}</option>
                            @endforeach
                        </select>
                        <button type='submit' class="btn btn-primary">Predaj</button>
                    </div>
                    </form>
                    @endif
                     <hr>
                    <label>JMBAG:</label>
                    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Pretraži po JMBAG-u...">
                    <hr>
                    <table class="table" id="editable">
                    <thead>
                        <tr>
                        <!-- <th scope="col">#ID</th> -->
                        <th scope="col">Ime</th>
                        <th scope="col">Prezime</th>
                        <!-- <th scope="col">Email</th> -->
                        <th scope="col">JMBAG</th>
                        <!-- <th scope="col">Phone</th> -->
                        <!-- <th scope="col">Tag</th> -->
                        <th scope="col">Karta</th>
                        </tr>
                    </thead>
                    <tbody>

                      @foreach ($guests as $guest)
                      <tr>
                        <!-- <td scope="col">{{$guest->id}}</td> -->
                        <!-- <td scope="col">{{$guest->name}}</td>  -->
                        <td><a href="" class="update" data-name="name" data-type="text" data-pk="{{ $guest->id }}" data-title="Enter name">{{ $guest->name }}</a></td>
                        <!-- <td scope="col">{{$guest->surname}}</td> -->
                        <td><a href="" class="update" data-name="surname" data-type="text" data-pk="{{ $guest->id }}" data-title="Enter surname">{{ $guest->surname }}</a></td>
                        <!-- <td scope="col">{{$guest->email}}</td> -->
                        <!-- <td scope="col">{{$guest->jmbag}}</td> -->
                        <td><a href="" class="update" data-name="jmbag" data-type="text" data-pk="{{ $guest->id }}" data-title="Enter JMBAG">{{ $guest->jmbag }}</a></td>
                        <!-- <td scope="col">{{$guest->phone}}</td> -->
                        <!-- <td scope="col">{{$guest->tag}}</td> -->
                        <!-- <td><a href="" class="update" data-name="tag" data-type="text" data-pk="{{ $guest->id }}" data-title="Pick Tag">{{$guest->tag}}</a></td> -->
                        <!-- <td scope="col"><a class="deleteProduct btn btn-xs btn-danger" data-id="{{ $guest->id }}"><i class="fas fa-trash"></i></a></td> -->
                        <!-- <td><a href="" class="update" data-name="bought" data-type="number" data-pk="{{ $guest->id }}" data-title="Enter bought">{{ $guest->bought }}</a></td> -->
                        <td>
                            @if($guest->bought==0)
                            <a class="buyTicket btn btn-xs btn-danger" data-id="{{ $guest->id }}"><i class="fas fa-times"></i></a>
                            @else
                            <a class="deleteTicket btn btn-xs btn-success" data-id="{{ $guest->id }}"><i class="fas fa-check"></i></a>
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
<script type="text/javascript" defer>

function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("editable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
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
    },
    type: 'POST'
});

$( document ).ready(function() {
    $('.update')
        .attr('contenteditable', true)
        .keypress(function(event) {
            if (event.key !== 'Enter') {
                return;
            }

            var $el = $(this);
            var data = {
                pk: $el.attr('data-pk'),
                name: $el.attr('data-name'),
                value: $el.text(),
            };

            event.preventDefault();

            $.ajax({
                type: "POST",
                url: "{{ route('update_guest') }}",
                data: data,
            });
        })
    ;
});

$(".deleteProduct").click(function(){
	    	$(this).parents('tr').hide();
	        var id = $(this).data("id");
	        var token = '{{ csrf_token() }}';
	        $.ajax(
	        {
	            method:'POST',
	            url: "/delete/guest/"+id,
	            data: {_token: token},
	            success: function(data)
	            {
	                toastr.success('Successfully!','Delete');
                    window.location.reload();
	            }
	        });
	    });

$(".buyTicket").click(function(){
	        var id = $(this).data("id");
	        var token = '{{ csrf_token() }}';
	        $.ajax(
	        {
	            method:'POST',
	            url: "/buy/ticket/"+id,
	            data: {_token: token},
	            success: function(data)
	            {
	                toastr.success('Successfully!','Bought');
                    window.location.reload();
	            }
	        });
	    });

$(".deleteTicket").click(function(){
	        var id = $(this).data("id");
	        var token = '{{ csrf_token() }}';
	        $.ajax(
	        {
	            method:'POST',
	            url: "/delete/ticket/"+id,
	            data: {_token: token},
	            success: function(data)
	            {
	                toastr.success('Successfully!','Sold');
                    window.location.reload();
	            }
	        });
	    });


</script>
@endsection
