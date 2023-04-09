@extends('backend.layout')
@section('title','User')
@section('main')

<div class="pagetitle">
      <h1>Users</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <div class="row">

<!-- Left side columns -->
<div class="col-12">
  <div class="row">

    <!-- Sales Card -->
    <div class="col-xxl-4 col-md-6">
      <div class="card info-card sales-card">

        

        <div class="card-body">
        <div class="row">
            <div class="col-8">
                <h4 class="card-title">Total Users</h4>
                <div class="d-flex align-items-center">
                    <div class="ps-3">
                        <h5>{{$countuser}}</h5>
                
                    </div>
                </div>
            </div>
            <div class="col-4 d-flex align-items-center justify-content-center mt-2 ">
            <i class="fa-solid fa-users fa-3x"></i>
            </div>
        </div>  
        

          
        </div>

      </div>
    </div><!-- End Sales Card -->

    <!-- Revenue Card -->
    <div class="col-xxl-4 col-md-6">
      <div class="card info-card revenue-card">

        

        <div class="card-body">
        <div class="row">
            <div class="col-8">
                <h4 class="card-title">Total Premium Users</h4>
                <div class="d-flex align-items-center">
                    <div class="ps-3">
                        <h5>{{$premiumuser}}</h5>
                
                    </div>
                </div>
            </div>
            <div class="col-4 d-flex align-items-center justify-content-center mt-2 ">
            <i class="fa-solid fa-crown fa-3x"></i>
            </div>
        </div>
        </div>

      </div>
    </div><!-- End Revenue Card -->

    <!-- Customers Card -->
    <div class="col-xxl-4 col-xl-12">

      <div class="card info-card customers-card">

        

        <div class="card-body">
        <div class="row">
            <div class="col-8">
                <h4 class="card-title">Pending Users</h4>
                <div class="d-flex align-items-center">
                    <div class="ps-3">
                        <h5>{{$countuser}} (Dummy Data)</h5>
                    </div>
                </div>
            </div>
            <div class="col-4 d-flex align-items-center justify-content-center mt-2 ">
            <i class="fa-solid fa-users fa-3x"></i>
            </div>
        </div>

        </div>
      </div>

    </div><!-- End Customers Card -->


    <!-- Recent Sales -->
    <div class="col-12">
      <div class="card recent-sales overflow-auto">

        

        <div class="card-body">
          <h5 class="card-title">Users List</h5>

          <table class="table table-borderless datatable">
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col" class="text-center">Role</th>
                <th scope="col" class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach($data as $key => $data )
			<tr>
				<td>{{ $key+1 }}</td>
				<td> {{ $data->id }}</td>
				<td>{{ $data->name }}</td>
				<td>{{ $data->email }}</td>
        <td class="text-center"><span class="badge @if($data->role === 'admin') bg-success @elseif($data->role === 'free_user') bg-primary @elseif($data->role === 'content_manager') bg-warning @else bg-danger @endif">{{ $data->role }}</span></td>
				<td class="d-flex justify-content-center">
          <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <form action="{{ route('user.delete',$data->id)}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <li class="text-center"><a class="dropdown-item text-success" href="{{ route('user.edit',$data->id) }}"><b>Edit role</b></a></li>
                  <li class="d-flex justify-content-center"><button type="submit" class="btn btncolor text-danger"><b>Delete</b></button></li>
                </form>
              </ul>
          </div>
        </td> 
			</tr>
			@endforeach
            </tbody>
          </table>

        </div>

      </div>
    </div><!-- End Recent Sales -->

    

</div>

@endsection