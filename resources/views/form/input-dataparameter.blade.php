<x-layout-form-parameter>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Input Parameter</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container">
                <form action="ruangan/create" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-25">
                            <label for="ruangan">Parameter</label>
                        </div>
                        <div class="col-75">
                            {{--                            <input type="text" name="ruangan" value="{{ old('ruangan') }}">--}}
                            <select name="parameter" id="parameter" >
                                <option value="">Pilih</option>

                                @foreach($parameter as $parameters)
                                    <option value="{{$parameters->id}}">{{$parameters->parameter}}</option>
                                @endforeach

                            </select>

                        </div>
                    </div>
                    @if ($errors->input->has('parameter'))
                        <div class="invalid">{{ $errors->input->first('parameter') }}</div>
                    @endif
                    <div class="row">
                        <input type="submit" name="submit" value="submit">
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
                {{--                table--}}
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Parameter</th>
                        <th scope="col">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($parameter as $parameters)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$parameters->parameter}}</td>
{{--                            <td>--}}
{{--                                <a href="{{route('editparameter', $parameters->id)}}" type="button" class="btn btn-primary" >--}}
{{--                                    Edit--}}
{{--                                </a>--}}
{{--                                <a href="{{route('deleteparameter', $parameters->id)}}" type="button" class="btn btn-danger" >--}}
{{--                                    Delete--}}
{{--                                </a>--}}
{{--                            </td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>


        </div>
    </div>
</x-layout-form-parameter>
