@extends('base')

@section('library-css')
    <!-- Select2 JS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Tempus Dominus Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.9.4/dist/css/tempus-dominus.min.css"
        crossorigin="anonymous">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('walks.index') }}">
                    <button class="btn btn-sm mt-1" style="float:left;">
                        <i class="fa-solid fa-2x fa-circle-left"></i>
                    </button>
                </a>
                <h1>
                    @if (isset($id))
                        Edit
                    @else
                        Add
                    @endif
                    Walk
                </h1>
            </div>
        </div>
        <form action="{{ isset($id) ? route('walks.update', ['walk' => $id]) : route('walks.store') }}" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <label for="owners" class="form-label">Owner Name</label>
                    <div class="input-group">
                        <select class="search-select col-md-6" name="owner">
                            @foreach ($listOwners as $owner)
                                <option value="{{ $owner->id }}">{{ $owner->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <label for="dog" class="form-label">Dog Name</label>
                    <div class="input-group">
                        <select class="search-select col-md-6" name="dog">
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-sm-6">
                    <label for="datetimepickerInput" class="form-label">Start at</label>
                    <div class="input-group log-event" id="datetimepicker" data-td-target-input="nearest"
                        data-td-target-toggle="nearest">
                        <input id="datetimepickerInput" type="text" class="form-control"
                            data-td-target="#datetimepicker">
                        <span class="input-group-text" data-td-target="#datetimepicker" data-td-toggle="datetimepicker">
                            <i class="fas fa-calendar"></i>
                        </span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="datetimepicker1Input" class="form-label">Finish at</label>
                    <div class="input-group log-event" id="datetimepicker1" data-td-target-input="nearest"
                        data-td-target-toggle="nearest">
                        <input id="datetimepicker1Input" type="text" class="form-control"
                            data-td-target="#datetimepicker1">
                        <span class="input-group-text" data-td-target="#datetimepicker1" data-td-toggle="datetimepicker">
                            <i class="fas fa-calendar"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <button type="submit" class="btn btn-sm btn-primary">
                        <span class="fa fa-save"></span> Save
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('library-js')
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Moment JS, used by Bootstrap DateTimePicker, for formatting date and time -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script> --}}

    <!-- Popperjs -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.7.16/dist/js/tempus-dominus.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.7.16/dist/js/jQuery-provider.js"></script>

    <!-- Custom JS for this page -->
    <script type="text/javascript">
        function initDateTimePicker() {
            $('#datetimepicker').tempusDominus({
                //put your config here
            });
            $('#datetimepicker1').tempusDominus({
                //put your config here
            });
        }

        function loadDogData() {
            var id = $('select[name="owner"]').val();
            var url = '{{ url('') }}/dogs/owner/' + id;
            $.ajax({
                url: url,
                success: function(result) {
                    console.log(result);
                    var dogNameHtml = "";
                    if (result.data.length > 0) {
                        for (var i = 0; i < result.data.length; i++) {
                            console.log(result.data[i]);
                            dogNameHtml += "<option value='" + result.data[i].id + "'>";
                            dogNameHtml += result.data[i].name;
                            dogNameHtml += "</option>";
                        }
                    }
                    $("select[name=dog]").html(dogNameHtml);
                    $("select[name=dog]").select2({
                        placeholder: 'Select an option'
                    });
                }
            });
        }

        $(document).ready(function() {
            $('.search-select').select2({
                placeholder: 'Select an option'
            });

            // Init DateTimePicker
            initDateTimePicker();

            // Init for the first time
            loadDogData();

            // For when owner name selected is changed
            $('select[name="owner"]').change(function() {
                loadDogData();
            });
        });
    </script>
@endsection
