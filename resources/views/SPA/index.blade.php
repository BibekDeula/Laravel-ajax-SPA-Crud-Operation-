 
 <link rel="stylesheet" href="dog/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Csrf Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Bootstrap 4 CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    {{-- Jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>

    {{-- Bootstrap 4 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>

<div id="bbk"></div>
 <!-- Button trigger modal -->

{{-- @hasanyrole('admin') --}}
<button type="button" class="btn btn-primary" id="create">
  Add User
</button>
{{-- @endrole --}}

<br>

<!--EDIT Modal -->
<div class="modal fade" id="editmodal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <input type="hidden"id="editid"name="id">
    <label for="name">Name</label>
    <input type="text" id="editname" name="editname" >

    <label for="address">Address</label>
    <input type="text" id="editaddress" name="editaddress" >

    <label for="trending">Trending</label>
    <select id="edittrending" name="trending">
      <option value=1>Yes</option>
      <option value=0>No</option>
     
    </select>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="reset">Reset</button>
        <button type="button" class="btn btn-primary"id="update">Update</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="createmodal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
    <label for="name">Name</label>
    <input type="text" id="name" name="name" placeholder="Your name..">

    <label for="address">Address</label>
    <input type="text" id="address" name="address" placeholder="Your address..">

    <label for="trending">Trending</label>
    <select id="trending" name="trending">
      <option value=1>Yes</option>
      <option value=0>No</option>
     
    </select>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="reset">Reset</button>
        <button type="button" class="btn btn-primary"id="submit"href="{{route('crud.store')}}">Submit</button>
      </div>
    </div>
  </div>
</div>
<input type="text"id="input"placeholder="search"style="width:150px;height:30px;border-color:black;">
<script>1
  $(document).ready(function(){
    $('#input').on('keyup',function(){
      var value=$(this).val().toLowerCase();
      $('#customers tr').filter(function(){
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
      });
    });
  });
</script>



<table id="customers">
  <tr>
    <th>SN</th>
    <th>Name</th>
    <th>Address</th>
    <th>Trending</th>
    <th>Action</th>
  </tr>
  @foreach($datas as $key=> $data)
  <tr>
    <td>{{$key+ 1}}</td>
    <td>{{$data->name}}</td>
    <td>{{$data->address}}</td>
    <td>{{$data->trending}}</td>
    <td><button type="button"class="btn btn-primary"id="edit"href="{{route('crud.edit',$data->id)}}">Edit</button>
      
    <button type="button"id="delete"class="btn btn-danger"href="{{route('crud.destroy',$data->id)}}">Delete</button></td>
    
  </tr>
@endforeach
</table>
<script>
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  $(document).on('click','#update',function(){
    var id=$('#editid').val();
    var url="{{route('crud.update',':id')}}";
    var url=url.replace(":id",id);
$.ajax({
  type: "POST",
  url: url,
  data:{
                    _token: CSRF_TOKEN,
                     _method: 'PUT',
                    id: $('#editid').val(),
                    name: $('#editname').val(),
                    address: $('#editaddress').val(),
                    trending: $('#edittrending').val(),
                    
  },
  dataType: "JSON",
  success: function (response) {
                        $("#customers").load(location.href + " #customers");
                    $("#editmodal").modal('hide');
                     $('#bbk').addClass('alert alert-success');
                     $('#bbk').html(response.success);
  }
});
  });
</script>




<script>
  $(document).on('click','#reset',function(){
   $('#name').val('');
   $('#address').val('');
   $('#trending').val('');
  });
</script>


{{-- show modal --}}
<script>
$(document).on('click','#create',function(){
    $.ajax({
        type: "GET",
        success: function (response) {
            $('#createmodal').modal('show');
        }
    });
});
</script>
{{-- end show modal --}}

{{-- create modal --}}
<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).on('click','#submit',function(){
    
    var url=$(this).attr('href');
    $.ajax({
        type: "POST",
        url: url,
        cache:false,
        data:{
            _token:CSRF_TOKEN,
            name:$('#name').val(),
            address:$('#address').val(),
            trending:$('#trending').val()
        },
        cache:false,
        success: function (response) {
                     if(response.status == 400){
                        $('#bbk').html("");
                        $('#bbk').addClass('alert alert-danger');
                        $.each(response.errors, function (key, errorvalues) {
                           $('#bbk').append('<li>'+errorvalues+'</li>'); 
 });
                        }else{
             $("#customers").load(location.href + " #customers");
            $('#createmodal').modal('hide');
            $('#createmodal').find('input').val('');

                     $('#bbk').addClass('alert alert-success');
                     $('#bbk').html(response.success);
        }
        }
    });
    });
</script>
{{-- end create modal --}}  

    <script>
        $(document).on('click', '#delete', function() {
            if (confirm("Are you sure?")) {
                var url = $(this).attr('href');
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    method: 'POST',
                    url: url,
                    data: {
                        _token: CSRF_TOKEN,
                        _method: 'DELETE'
                    },  
                    cache:false,
                    success: function(response) {
                        $("#customers").load(location.href + " #customers");
                    }
                });
            }
            return false;
        });
    </script>
    <script>
      $(document).on('click','#edit',function(){
        var link = $(this).attr('href');
        $.ajax({
          type: "GET",
                url : link,
                cache: false,
          success: function (result) {
            $('#editmodal').modal('show');
             $('#editid').val(result.id);
            $('#editname').val(result.name);
            $('#editaddress').val(result.address);
            $('#edittrending').val(result.trending);
          }
        });
      });
    </script>
{{$datas->links() }}