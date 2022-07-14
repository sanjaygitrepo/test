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

<body>
  <div class="container">
     @if (session('status'))
     <div class="alert alert-success">
       {{ session('status') }}
     </div>
     @endif
     <form method="post" action="{{route('addData')}}">
       @csrf
       <h2>Employee Details</h2><br>
       <div class="form-group">
         <label>Id</label>
         <input type="number" required name="e_id" class="form-control" placeholder="Enter Employee_Id">
       </div>
       <div class="form-group">
         <label>Name</label>
         <input type="text" required name="e_name" class="form-control" placeholder="Enter Your Name">
       </div>
       <div class="form-group">
         <label>Email address</label>
         <input type="email" required name="e_email" class="form-control" placeholder="Enter Your Email">
       </div>
     <div class="form-group">
       <label>Manager's Email address</label>
       <input type="email" required name="manager_email" class="form-control" placeholder="Enter Your Email">
     </div>       
       <div class="form-group">
         <h2>Task Details</h2><br>
         <div class="form-group">
           <label>Monday</label>
           <input type="text" required name="t_mon" class="form-control" placeholder="Task done by Monday">
         </div>
   
         <div class="form-group">
           <label>Tuesday</label>
           <input type="text" required name="t_tue" class="form-control" placeholder="Task done by Tuesday">
         </div>
   
         <div class="form-group">
           <label>Wednesday</label>
           <input type="text" required name="t_wed" class="form-control" placeholder="Task done by Wednesday">
         </div>
   
         <div class="form-group">
           <label>Thursday</label>
           <input type="text" required name="t_thu" class="form-control" placeholder="Task done by Thursday">
         </div>
   
         <div class="form-group">
           <label>Friday</label>
           <input type="text" required name="t_fri" class="form-control" placeholder="Task done by Friday">
         </div>
       </div>
       <div class="form-group"></div>
       <button type="submit" class="btn btn-primary">Submit</button>
     </form>
   </div>
</body>
</html> 