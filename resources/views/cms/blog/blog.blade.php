@extends('default')
@section('content')
<style>
    .uper {
    margin-top: 5px;
    }
</style>
<div class="app-content content container-fluid">
<div class="content-wrapper">
<div class="uper">
    @if(session()->get('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}  
    </div>
    <br />
    @endif
    @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <br />
     @endif
    <div class="content-body">
        <!-- Basic Tables start -->
        <div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header cat-heading">
                        <h4 class="card-title">Blogs</h4>
                        <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <div class="form-group">
                                    <button type="button" class="btn btn-outline-warning mb-4" data-toggle="modal" data-target="#addBlog">
                                    Add Blog
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade text-xs-left" id="addBlog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <label class="modal-title text-text-bold-600" id="myModalLabel33">Add Blog</label>
                                                </div>
                                                <form method="post" action="{{ route('blogs.store') }}" id="addBlogs" enctype="multipart/form-data">
                                                    @csrf                                                 
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="issueinput5">Blogs</label>
                                                    
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Heading:</label>
                                                            <input type="text" class="form-control" name="heading" />                                                         
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Image:</label>
                                                            <input type="file" class="form-control" name="image" />                                                         
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Description:</label>
                                                            <textarea name="description" id="editor1"> </textarea>                                                          
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="submit" class="btn btn-outline-success" value="Add">
                                                        <input type="submit" class="btn btn-outline-danger" data-dismiss="modal" value="Close">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body collapse in">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th colspan="2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($blogs as $blog)
                                    <tr>
                                        <td>{{$blog->id}}</td>
                                        <td>{{$blog->heading}}</td>
                                        <td>{{$blog->description}}</td>
                                        <td><img src="{{ asset('uploads/cms/'.$blog->image) }}" height="100px" width="100px">{{$blog->image}}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateBlog_{{$blog->id}}">Edit
                                            </button>
                                            <div class="modal fade text-xs-left" id="updateBlog_{{$blog->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            <label class="modal-title text-text-bold-600" id="myModalLabel33">Update Blog</label>
                                                        </div>
                                                        <form method="post" class="updateBlogs" action="{{ route('blogs.update', $blog->id) }}" enctype="multipart/form-data">
                                                               @csrf   
                                                               @method('PATCH')
                                                           <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="issueinput5">Blogs</label>
                                                            
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="name">Heading:</label>
                                                                    <input type="text" class="form-control" name="heading" value="{{$blog->heading}}"/ >                                                         
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="name">Image:</label>
                                                                    <input type="file" class="form-control" name="image" /> 
                                                                    <input type="hidden" name="olg_image" value="{{$blog->image}}">                                                        
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="name">Description:</label>
                                                                    <textarea id="textarea_{{$blog->id}}" name="description" class="editor2" > {{$blog->description}} </textarea>                                                          
                                                                </div>
                                                             </div>
                                                            <div class="modal-footer">
                                                                <input type="submit" class="btn btn-outline-success" value="Update">
                                                                <input type="submit" class="btn btn-outline-danger" data-dismiss="modal" value="Close">
                                                            </div>
                                                            <script type="text/javascript">
                                                                CKEDITOR.editorConfig = function(config) {
                                                                    config.language = 'es';
                                                                    config.uiColor = '#F7B42C';
                                                                    config.height = 300;
                                                                    config.toolbarCanCollapse = true;
                                                                };
                                                                CKEDITOR.replace("<?php echo 'textarea_'.$blog->id; ?>");
                                                            </script>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteBlog_{{$blog->id}}">
                                            Delete
                                            </button>
                                            <div class="modal fade text-xs-left" id="deleteBlog_{{$blog->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            <label class="modal-title text-text-bold-600" id="myModalLabel33">Delete Blog</label>
                                                        </div>
                                                        <form method="post" action="{{ route('blogs.destroy', $blog->id)}}">
                                                            <div class="modal-body">
                                                                @csrf
                                                                <div class="form-group">
                                                                    @method('DELETE')                                  
                                                                    <label> Do you really want to delete this Blog?</label>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="submit" class="btn btn-outline-warning" value="Delete">
                                                                <input type="submit" class="btn btn-outline-danger" data-dismiss="modal" value="Close">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
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
    </div>
</div>

@endsection