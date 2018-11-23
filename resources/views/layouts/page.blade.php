@section('title', $view_data->_head['title'])
@section('description', $view_data->_head['description'])
@section('logo', $view_data->_head['logo'])
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
@include('layouts.head', ['page_type'=>$page_type??'frame'])
@include('layouts.page_body', ['page_type'=>$page_type??'frame'])
</html>
