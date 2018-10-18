@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Folders and files in tree structure.</h3></div>

                <div class="card-body">
                    
                      <div class="response"></div>
                      
                      <form action="" method="POST" name="file_tree_form" id="file_tree_form">@csrf
                        <div class="form-group">
                          <label for="email">File Path:</label> Example(F:\testdata)
                          <input type="text" class="form-control" id="file_path" placeholder="Enter file path" name="file_path">
                          <div class="error"></div>
                        </div>
                     
                        <button type="submit" class="btn btn-primary submit-button">Submit</button>
                        <button type="button" style="display:none;" class="btn btn-primary process-button"><i class="fa fa-spinner fa-spin" ></i> Pocessing...</button>
                      
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
