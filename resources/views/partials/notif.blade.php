@if($errors->any())
<div class="alert alert-danger alert-dismissable" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {!! implode('', $errors->all(':message<br />')) !!}
</div>
@endif
@if (\Session::has('success'))
<div class="alert alert-success alert-dismissable" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {!! \Session::get('success') !!}
</div>
@endif
@if (\Session::has('danger'))
<div class="alert alert-danger alert-dismissable" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {!! \Session::get('danger') !!}
</div>
@endif
@if (\Session::has('warning'))
<div class="alert alert-warning alert-dismissable" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {!! \Session::get('warning') !!}
</div>
@endif
