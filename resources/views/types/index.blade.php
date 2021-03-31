@extends('layouts.app')

@section('template_title')
    Types
@endsection

@section('content')
    <div class="accordion" id="accordionExample">
        @foreach($types as $type)
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                data-target="#collapse{{$type->id}}"
                                aria-expanded="false" aria-controls="collapse{{$type->id}}">
                            < {{ $type->id }} > {{ $type->name }}
                        </button>
                    </h2>
                </div>

                <div id="collapse{{$type->id}}" class="collapse" aria-labelledby="headingOne"
                     data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="kt-form kt-form--label-right" id="type{{$type->id}}">
                            <input type="hidden" value="{{$type->id}}" name="id">
                            <div class="form-group">
                                <label for="group_id{{$type->id}}">Group</label>
                                <select class="form-control" id="group_id{{$type->id}}" name="group_id{{$type->id}}">
                                    <option value="1" {{ ($type->group_id == 1 ? 'selected="selected"' : '')  }}>
                                        PARTICIPANTS
                                    </option>
                                    <option value="2" {{ ($type->group_id == 2 ? 'selected="selected"' : '')  }}>PRESSE
                                        -
                                        SPONSORS
                                    </option>
                                    <option value="2" {{ ($type->group_id == 3 ? 'selected="selected"' : '')  }}>
                                        ORGANISATION
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="restoration{{$type->id}}">Restauration</label>
                                <select class="form-control" id="restoration{{$type->id}}" name="restoration{{$type->id}}">
                                    <option value="">N/A</option>
                                    @foreach($restorations as $res)
                                        <option value="{{$res->id}}" {{ ($type->restoration == $res->id ? 'selected="selected"' : '')  }}>
                                            {{$res->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="hotel{{$type->id}}">Hotel</label>
                                <select class="form-control" id="hotel{{$type->id}}" name="hotel{{$type->id}}"
                                        onchange="changeHotel(this,{{$type->id}})">
                                    <option value="">N/A</option>
                                    @foreach($hotels as $hotel)
                                        <option value="{{$hotel->id}}" {{ ($type->hotel_id == $hotel->id ? 'selected="selected"' : '')  }}>
                                            {{$hotel->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            @foreach($hotels as $hotel)
                                <div class="form-group room-category room-category{{$hotel->id}}" {!!  ( $type->hotel_id =! null && $hotel->id == $type->hotel_id ? '' : 'style="display: none;"' ) !!}>
                                    <label for="room_category{{$type->id}}">Room Category : {{$hotel->name}}</label>
                                    <select class="form-control" id="room_category{{$type->id}}"
                                            name="room_category{{$type->id}}hotel{{$hotel->id}}">
                                        <option value="">N/A</option>
                                        @foreach($hotel->room_categories as $rc)
                                            <option value="{{$rc->id}}" {{ ($type->room_category_id == $rc->id ? 'selected="selected"' : '')  }}>
                                                {{$rc->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach


                            <div class="form-group">
                                <label for="room_type{{$type->id}}">Room Type</label>
                                <select class="form-control" id="room_type{{$type->id}}" name="room_type{{$type->id}}">
                                    <option value="">N/A</option>
                                    <option value="1" {{ ($type->room_type == 1 ? 'selected="selected"' : '')  }}>Single
                                    </option>
                                    <option value="2" {{ ($type->room_type == 2 ? 'selected="selected"' : '')  }}>Double
                                    </option>
                                </select>
                            </div>
                            <button type="button" class="btn btn-primary" onclick="submitUpdate(this,{{$type->id}})">
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('footer_scripts')
    <script>

        function changeHotel(event, id) {
            console.log('here')
            $('#type' + id + ' .room-category').hide()
            if(event.value)
                $('#type' + id + ' .room-category' + event.value).show()
        }

        function submitUpdate(event, id) {
            var $from = $('#type' + id)
            var data = {
                "_token": $('#csrf-token')[0].content,  //pass the CSRF_TOKEN(),
                id: id,
                group_id: $('#type' + id + " [name='group_id" + id + "']").val(),
                restoration: $('#type' + id + " [name='restoration" + id + "']").val(),
                room_type: $('#type' + id + " [name='room_type" + id + "']").val(),
                hotel_id: $('#type' + id + " [name='hotel" + id + "']").val(),
            };

            if (data.hotel_id) {
                data.room_category_id = $('#type' + id + " [name='room_category" + id + "hotel" + data.hotel_id + "']").val()
            }

            console.log(data)

            $.ajax({
                type: "POST",
                url: '/types/update',
                data: data,
                success: function () {
                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: 'Mis à jour avec succés',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            });

        };
    </script>
@endsection
