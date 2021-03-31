<div class="content__step content__step--transfert">
              <div class="inscription">
                  <h1 class="inscription__title title__primary">
                      {{__('front.'.$lang.'.transfer')}}
                  </h1>
    
                      <h2 class="title__secondary">{{__('front.'.$lang.'.arriveflight')}}</h2>
                      <div class="form__group required">

                        <input
                          class="form__input datepicker"
                          type="text"
                          alt="{{__('front.'.$lang.'.arrivaldate')}}"
                          id="dateArrivee"
                          placeholder="{{__('front.'.$lang.'.arrivaldateff')}} "
                          name="transfer_arrival_date"
                          value="{{!empty($participant->transfer_arrival_date) ? $participant->transfer_arrival_date : ''}}"
                        />
                        <label class="form__label" for="dateArrivee"
                          >{{__('front.'.$lang.'.arrivaldate')}}</label
                        >
                      </div> 
                      <div class="form__group required">

                        <input
                          class="form__input timepicker"
                          type="text"
                          
                          alt="{{__('front.'.$lang.'.arrivingtime')}}"
                          name="transfer_arrival_time"
                          id="heureArrivee"
                          placeholder="{{__('front.'.$lang.'.arrivingtime')}} (hh:mm)"
                          value="{{!empty($participant->transfer_arrival_time) ? $participant->transfer_arrival_time : ''}}"

                        />
                        <label class="form__label" for="heureArrivee"
                          >{{__('front.'.$lang.'.arrivingtime')}}</label
                        >
                      </div>

                      <div class="form__group required">
                          <input
                            class="form__input"
                            type="text"
                            alt="{{__('front.'.$lang.'.flightnumber')}}"
                            placeholder="{{__('front.'.$lang.'.flightnumber')}}"
                            id="numvol"
                            name="arrival_flight_number"
                            value="{{!empty($participant->arrival_flight_number) ? $participant->arrival_flight_number : ''}}"
                          />
                          <label class="form__label" for="numvol"
                            >{{__('front.'.$lang.'.flightnumber')}}</label
                          >
                        </div>
                        <div class="form__group required">
                            <input
                              class="form__input"
                              type="text"
                              alt="{{__('front.'.$lang.'.aeriennecompagny')}}"
                              placeholder="{{__('front.'.$lang.'.aeriennecompagny')}}"
                              id="compArienne"
                              name="arrival_airline_company"
                              value="{{!empty($participant->arrival_airline_company) ? $participant->arrival_airline_company : ''}}"
                            />
                            <label class="form__label" for="compArienne"
                              >{{__('front.'.$lang.'.aeriennecompagny')}}</label
                            >
                          </div>
                    <div class="form__group required">
                      <input
                        class="form__input"
                        type="text"
                        alt="{{__('front.'.$lang.'.aeroportprev')}}"
                        placeholder="{{__('front.'.$lang.'.aeroportprev')}}"
                        id="aeroPort_prov"
                        name="arrival_airport"
                        value="{{$participant->arrival_airport}}"
                      />
                      <label class="form__label" for="aeroPort_prov"
                        >{{__('front.'.$lang.'.aeroportprev')}}</label
                      >
                    </div>
    
                    <div class="form__group form__group--selector required">
                      <select name="arrival_recovery_point" class="form__selector">
                        <option value="none" disabled selected
                          >{{__('front.'.$lang.'.airportofarrival')}}</option
                        >
                          @foreach(config('meDays.airports') as $item)
                              @if($item['id']!=4)
                              <option value="{{$item['id']}}" {{$item['id'] == $participant->arrival_recovery_point ? 'selected="selected"' : '' }}>{{ $item['name'] }}</option>
                              @endif
                          @endforeach
                      </select>
                    </div>
                    <h2 class="title__secondary">{{__('front.'.$lang.'.voldepart')}}</h2> 
                    <div class="form__group required">

                      <input
                        class="form__input datepicker"
                        type="text"
                        alt="{{__('front.'.$lang.'.arrivaldate')}}"
                        
                        id="dateDepart_transfert"
                        placeholder="{{__('front.'.$lang.'.arrivaldatef')}} "
                        name="transfer_departure_date"
                        value="{{!empty($participant->transfer_departure_date) ? $participant->transfer_departure_date : ''}}"
                      />
                      <label class="form__label" for="dateDepart_transfert"
                        >{{__('front.'.$lang.'.arrivaldate')}}</label
                      >
                    </div> 
                    <div class="form__group required">

                      <input
                        class="form__input timepicker"
                        type="text"
                        
                        alt="{{__('front.'.$lang.'.departuretime')}}"
                        name="transfer_departure_time"
                        id="heureDepart_transfert"
                        placeholder="{{__('front.'.$lang.'.departuretime')}} (hh:mm)"
                        value="{{!empty($participant->transfer_departure_time) ? $participant->transfer_departure_time : ''}}"
                        
                      />
                      <label class="form__label" for="heureDepart_transfert"
                        >{{__('front.'.$lang.'.departuretime')}}</label
                      >
                    </div>
                    <div class="form__group required">
                        <input
                          class="form__input"
                          type="text"
                          alt="{{__('front.'.$lang.'.flightnumber')}}"
                          placeholder="{{__('front.'.$lang.'.flightnumber')}}"
                          id="numvol"
                          name="departure_flight_number"
                          value="{{!empty($participant->departure_flight_number) ? $participant->departure_flight_number : ''}}"
                        />
                        <label class="form__label" for="numvol"
                          >{{__('front.'.$lang.'.flightnumber')}}</label
                        >
                      </div>
                      <div class="form__group required">
                          <input
                            class="form__input"
                            type="text"
                            alt="{{__('front.'.$lang.'.aeriennecompagny')}}"
                            placeholder="{{__('front.'.$lang.'.aeriennecompagny')}}"
                            id="compArienne"
                            name="departure_airline_company"
                            value="{{!empty($participant->departure_airline_company) ? $participant->departure_airline_company : ''}}"
                          />
                          <label class="form__label" for="compArienne"
                            >{{__('front.'.$lang.'.aeriennecompagny')}}</label
                          >
                        </div>
                    <div class="form__group form__group--selector required">
                      <select name="departure_deposit_point" class="form__selector">
                          <option value="none" disabled selected>{{__('front.'.$lang.'.departaerport')}}</option>
                          @foreach(config('meDays.airports') as $item)
                            @if($item['id']!=4)
                              <option value="{{$item['id']}}" {{$item['id'] == $participant->departure_deposit_point ? 'selected="selected"' : '' }}>{{ $item['name'] }}</option>
                            @endif
                          @endforeach
                        </select>
                      </div>
                     <div class="form__group required">
                       <input
                       class="form__input"
                       type="text"
                       alt="{{__('front.'.$lang.'.aeroportdes')}}"
                       placeholder="{{__('front.'.$lang.'.aeroportdes')}}"
                       name="departure_airport"
                       value="{{$participant->departure_airport}}"
                       id="aeroPort_dest"
                       />
                       <label class="form__label" for="aeroPort_dest"
                       >{{__('front.'.$lang.'.aeroportdes')}}</label
                       >
                      </div>
                      <div
                        class="form__group  form__group--right-content "
                      >
                        <button class="btn btn--left-arrow btn--secondary goback">
                          <span>
                            {{__('front.'.$lang.'.previous')}}
                          </span>
                        </button>
                        @if($participant->has_hebergement == 2)
                          <button data-pstep="content__step--transfert" class="btn btn--right-arrow btn--primary dgotosejour">
                            <span>
                              {{__('front.'.$lang.'.next')}}
                            </span>
                          </button>
                        @else
                          @if($participant->type_id == 2 || $participant->type_id == 3 && $lang == 'fr')
                          <button data-pstep="content__step--transfert" class="btn btn--right-arrow btn--primary dgotoformation">
                            <span>
                              {{__('front.'.$lang.'.next')}}
                            </span>
                          </button>
                          @else
                          <input data-pstep="content__step--transfert" type="submit" class="btn btn--right-arrow btn--primary dsubmit" value="{{__('front.'.$lang.'.next')}}" />
                          @endif
                        @endif
                      </div>
                  <p class="inscription__tip">* {{__('front.'.$lang.'.requiredfields')}}</p>
                </div>
             
                <div class="info">
                  <div class="info__content">
                    <div class="info__tips">
                      <h2 class="title__secondary">{{__('front.'.$lang.'.transfer')}}</h2>
                      <div class="info__desp">
                        {{__('front.'.$lang.'.transferdesc')}}
                       
                      </div>
                    </div>
                    <div class="info__contact">
                      <h2 class="title__secondary">{{__('front.'.$lang.'.amadeuxonstitut')}}</h2>
                      <p class="info__desp">
                        {{__('front.'.$lang.'.contactusforinfo')}}
    
                        @if(empty($type_id))
                          <a href="mailto:inscriptions@amadeusonline.org" target="_blank" class="info__link">inscriptions@amadeusonline.org</a>
                        @elseif($type_id == 2 || $type_id == 3)
                          <a href="mailto:premium@amadeusonline.org" target="_blank" class="info__link">premium@amadeusonline.org</a>
                        @elseif($type_id == 2 && $type_id == 3)
                          <a href="mailto:medays2019@amadeusonline.org" target="_blank" class="info__link">medays2019@amadeusonline.org</a>
                        @elseif($type_id == 4)
                        <a href="medays2019@amadeusonline.org" target="_blank" class="info__link">medays2019@amadeusonline.org</a>
                        @endif
                        <a href="http://www.medays.org" class="info__link">www.medays.org</a>
                      </p>
                    </div>
                  </div>
                </div>

          </div>