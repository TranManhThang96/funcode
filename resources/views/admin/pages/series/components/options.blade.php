<select class="custom-select custom-select-2 mr-sm-2 select-series-option" name="series_id">
    <option value=""></option>
    @if(isset($allSeries))
        @foreach($allSeries as $seriesItem)
            <option
                value="{{$seriesItem['id']}}" {{$seriesSelected == $seriesItem['id'] ? 'selected' : ''}}>{{$seriesItem['name']}}</option>
        @endforeach
    @endif
</select>
