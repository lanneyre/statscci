@extends('layout.template')
@section('main')
    <form action="{{ url('/import') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <table class="class">
                <tr>
                    <td width="40%"><label for="select_file">Select file</label></td>
                    <td width="30%"><input type="file" name="select_file" id="select_file"></td>
                    <td width="30%"><input type="submit" name="upload" value="Upload" class="btn btn-primary"></td>
                </tr>
            </table>
        </div>
    </form>
@endsection
