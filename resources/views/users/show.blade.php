<head>
	<meta charset="UTF-8">        
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
</head>
<body>
  <div id="containerexample" class="m-5 mt-5" style="margin-top:10px">
    <h2>Manage Users</h2>
    @if($msg=Session::get('message'))
    <div class="alert alert-success">{{ $msg }}</div>
    @endif
	<table id="myTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
          </tr>
        </thead>
        <tbody id="users">
        </tbody>
    </table>
  </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
    <script>

    </script>
    <script>
      $(document).ready(function(){        
        $.ajax({
          url:'/getusers',
          method:'get',
          success:function(data){
            var data=JSON.parse(data);
            $('#users').html('');            
            data.forEach(function(item){
             var row=$('<tr><td>' + item.name + '</td><td>' + item.email + '</td>'+'</tr>');             
             $('#users').append(row);
            });
            $('#myTable').DataTable({});
            // console.log(JSON.parse(data));                        
          }
        });
      });
    </script>
</body>
</html>