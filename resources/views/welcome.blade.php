<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>Laravel CRUD</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
body {
    color: #566787;
    background: #f5f5f5;
    font-family: 'Varela Round', sans-serif;
    font-size: 13px;
}
.table-responsive {
    margin: 30px 0;
}
.table-wrapper {
    background: #fff;
    padding: 20px 25px;
    border-radius: 3px;
    min-width: 1000px;
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
}
.table-title {        
    padding-bottom: 15px;
    background: #435d7d;
    color: #fff;
    padding: 16px 30px;
    min-width: 100%;
    margin: -20px -25px 10px;
    border-radius: 3px 3px 0 0;
}
.table-title h2 {
    margin: 5px 0 0;
    font-size: 24px;
}
.table-title .btn-group {
    float: right;
}
.table-title .btn {
    color: #fff;
    float: right;
    font-size: 13px;
    border: none;
    min-width: 50px;
    border-radius: 2px;
    border: none;
    outline: none !important;
    margin-left: 10px;
}
.table-title .btn i {
    float: left;
    font-size: 21px;
    margin-right: 5px;
}
.table-title .btn span {
    float: left;
    margin-top: 2px;
}
table.table tr th, table.table tr td {
    border-color: #e9e9e9;
    padding: 12px 15px;
    vertical-align: middle;
}
table.table tr th:first-child {
    width: 60px;
}
table.table tr th:last-child {
    width: 100px;
}
table.table-striped tbody tr:nth-of-type(odd) {
    background-color: #fcfcfc;
}
table.table-striped.table-hover tbody tr:hover {
    background: #f5f5f5;
}
table.table th i {
    font-size: 13px;
    margin: 0 5px;
    cursor: pointer;
}   
table.table td:last-child i {
    opacity: 0.9;
    font-size: 22px;
    margin: 0 5px;
}
table.table td a {
    font-weight: bold;
    color: #566787;
    display: inline-block;
    text-decoration: none;
    outline: none !important;
}
table.table td a:hover {
    color: #2196F3;
}
table.table td a.edit {
    color: #FFC107;
}
table.table td a.delete {
    color: #F44336;
}
table.table td a.restore {
    color: blue;
}
table.table td i {
    font-size: 19px;
}
table.table .avatar {
    border-radius: 50%;
    vertical-align: middle;
    margin-right: 10px;
}

.hint-text {
    float: left;
    margin-top: 10px;
    font-size: 13px;
}    
/* Custom checkbox */
.custom-checkbox {
    position: relative;
}
.custom-checkbox input[type="checkbox"] {    
    opacity: 0;
    position: absolute;
    margin: 5px 0 0 3px;
    z-index: 9;
}
.custom-checkbox label:before{
    width: 18px;
    height: 18px;
}

/* Modal styles */
.modal .modal-dialog {
    max-width: 400px;
}
.modal .modal-header, .modal .modal-body, .modal .modal-footer {
    padding: 20px 30px;
}
.modal .modal-content {
    border-radius: 3px;
    font-size: 14px;
}
.modal .modal-footer {
    background: #ecf0f1;
    border-radius: 0 0 3px 3px;
}
.modal .modal-title {
    display: inline-block;
}
.modal .form-control {
    border-radius: 2px;
    box-shadow: none;
    border-color: #dddddd;
}
.modal textarea.form-control {
    resize: vertical;
}
.modal .btn {
    border-radius: 2px;
    min-width: 100px;
}   
.modal form label {
    font-weight: normal;
}   
</style>
<script>
$(document).ready(function(){
    // Activate tooltip
    $('[data-toggle="tooltip"]').tooltip();
    
});
</script>
</head>
<body>
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">               
                    <div class="col-sm-6">
                        <h2>Manage <b>Employees</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Employee</span></a>                      
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $employee)
                    <tr>
                        <td>{{$employee->name}}</td>
                        <td>{{$employee->email}}</td>
                        <td>{{$employee->address}}</td>
                        <td>{{$employee->phone}}</td>
                        <td>
                            @if($employee->deleted_at)
                            <a href="{{url('employees/restore/'.$employee->id)}}" class="restore"><i class="material-icons" data-toggle="tooltip" title="Restore">&#xE872;</i></a>  
                            @else
                            <a href="javascript:void(0)" class="edit" onclick="getEmp({{$employee->id}})" ><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <a href="javascript:void(0)" onclick="deleteEmp({{$employee->id}})" class="delete" ><i class="material-icons" data-toggle="tooltip"  title="Delete">&#xE872;</i></a>
                            @endif                          
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
                    {{$employees->links()}}
        </div>
    </div>        
</div>
<!-- Edit Modal HTML -->
<div id="addEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{route('employees.store')}}" autocomplete="off">
                @csrf
                <div class="modal-header">                      
                    <h4 class="modal-title">Add Employee</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">                    
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" required>
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif                        
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" autocomplete="off">
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif                        
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" autocomplete="off">
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif                        
                    </div>                    
                    <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" name="address" required></textarea>
                        @if ($errors->has('address'))
                            <span class="text-danger">{{ $errors->first('address') }}</span>
                        @endif                        
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone" required>
                        @if ($errors->has('phone'))
                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                        @endif                        
                    </div>                  
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-success" value="Add">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit Modal HTML -->
<div id="editEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" id="EditEmployeeForm"  autocomplete="off">
                @csrf
                @method('PATCH')
                <div class="modal-header">                      
                    <h4 class="modal-title">Edit Employee</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">                    
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required>
                        @error('name')<span class="text-danger">{{$message}}</span>@enderror                           
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                        @error('email')<span class="text-danger">{{$message}}</span>@enderror                           

                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" name="address" required></textarea>
                        @error('address')<span class="text-danger">{{$message}}</span>@enderror                           

                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control" required>
                        @error('phone')<span class="text-danger">{{$message}}</span>@enderror                           

                    </div>                  
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-info" value="Update">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Delete Modal HTML -->
<div id="deleteEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">                      
                    <h4 class="modal-title">Delete Employee</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">                    
                    <p>Are you sure you want to delete these Records?</p>
                    <p class="text-warning"><small>This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="hidden" id="emp_id" value="">
                    <input type="button" class="btn btn-danger" onclick="dltEmployee()" value="Delete">
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    function deleteEmp(emp_id)
    {
        $('#emp_id').val(emp_id);
        $('#deleteEmployeeModal').modal('show');
    }

    function dltEmployee()
    {
        var emp_id=$('#emp_id').val();
        var token = $("meta[name='csrf-token']").attr("content");
        $.ajax({
           type:'DELETE',
           url:"{{ url('employees') }}"+"/"+emp_id,
            data: {
                "_token": token,
            },
            success: function (response){
                location.reload();
            }
        });        
    }


    function getEmp(emp_id)
    {

        let url = '{{route('employees.edit', ':queryId')}}';
        url = url.replace(':queryId', emp_id);
        $.ajax({
           type:'GET',
           url:url,
            success: function (response){
                $('#EditEmployeeForm [name="name"]').val(response.name);
                $('#EditEmployeeForm [name="email"]').val(response.email);
                $('#EditEmployeeForm [name="address"]').val(response.address);
                $('#EditEmployeeForm [name="phone"]').val(response.phone);

                let url = '{{route('employees.update', ':queryId')}}';
                url = url.replace(':queryId', response.id);
                $('#EditEmployeeForm').attr('action',url);
                $('#editEmployeeModal').modal('show');
            }
        });        
    }
        
</script>
</body>
</html>