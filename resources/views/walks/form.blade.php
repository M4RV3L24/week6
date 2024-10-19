@extends('base')

@section('library-css')
<!-- Select2 JS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- Bootstrap DateTimePicker -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
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
                    @if(isset($id))
                        Edit
                    @else
                        Add
                    @endif
                    Walk
                </h1>
            </div>
        </div>
        <form action="{{ (isset($id)) ? route('walks.update', ['walk' => $id]) : route('walks.store') }}" method="POST">
            <div class="row">
                <label for="owners">Owner Name</label>
            </div>
            <div class="col-md-6">
                <select class="search-select col-md-6" name="owner">
                    @foreach ($listOwners as $owner)
                        <option value="{{ $owner->id }}">{{ $owner->name }}</option>                            
                    @endforeach
                </select>
            </div>
            <div class="row mt-2">
                <label for="dog">Dog Name</label>
            </div>
            <div class="col-md-6 =">
                <select class="search-select col-md-6" name="dog">
                </select>
            </div>
            <div class="row mt-2">
                <label for="datetime">Select Date & Time</label>
            </div>
            <input class="form-control" type="text" id="datetime" placeholder="hh:mm:ss am/pm" />
            <span class="glyphicon glyphicon-remove clear-button" id="clear-datetime">
           </span>
        </form>
    </div>
@endsection

@section('library-js')
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Moment JS, used by Bootstrap DateTimePicker, for formatting date and time -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<!-- Bootstrap DateTimePicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

<!-- Custom JS for this page -->
<script type="text/javascript">
    function initDateTimePicker() {
        $('#datetime').datetimepicker({
            format: 'yyyy-mm-d'
        });

        $('#clear-datetime').click(function() {
            $('#datetime').val('');
        });
    }

    function loadDogData() {
        var id = $('select[name="owner"]').val();
        var url = '{{ url('') }}/dogs/owner/' + id;
        $.ajax({
            url: url, 
            success: function(result){
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
        $('select[name="owner"]').change(function(){
            loadDogData();
        });
    });
</script>
@endsection