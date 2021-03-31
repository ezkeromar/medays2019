<div class="content__step content__step--pec">
            <div class="inscription">
              <h1 class="inscription__title title__primary">
                {{__('front.'.$lang.'.flightticket')}}
              </h1>
                
                  <h2 class="title__secondary">{{__('front.'.$lang.'.arriveflight')}}</h2>
                  
                 
                <div class="form__group required">

                  <input
                    class="form__input datepicker"
                    type="text"
                    alt="{{__('front.'.$lang.'.arrivaldate')}}"
                    name="desired_arrival_date"
                    id="dateArrivee"
                    placeholder="{{__('front.'.$lang.'.dateformat')}}"
                    value="{{!empty($participant->desired_arrival_date) ? $participant->desired_arrival_date : ''}}"

                  />
                  <label class="form__label" for="dateArrivee"
                    >{{__('front.'.$lang.'.arrivaldate')}}</label
                  >
                </div>

                <div class="form__group form__group--selector required">
                  <select name="desired_arrival_hour" class="form__selector">
                    <option value="none" disabled {{(empty($participant->desired_arrival_hour)) ? 'selected' : ''}}>{{__('front.'.$lang.'.wantedhour')}}</option>
                    <option value="1" {{($participant->desired_arrival_hour == 1) ? 'selected' : ''}}>{{__('front.'.$lang.'.morning')}}</option>
                    <option value="2" {{($participant->desired_arrival_hour == 2) ? 'selected' : ''}}>{{__('front.'.$lang.'.afterlunch')}}</option>
                    <option value="3" {{($participant->desired_arrival_hour == 3) ? 'selected' : ''}}>{{__('front.'.$lang.'.night')}}</option>
                  </select>
                </div>

                
                <div class="form__group required">

                  <input
                    class="form__input"
                    type="text"
                    alt="Aéroport de provenance"
                    placeholder="{{__('front.'.$lang.'.aeroportprev')}}"
                    name="pec_departure_airport"
                    value="{{$participant->pec_departure_airport}}"
                    id="aeroPort_prov"
                  />
                  <label class="form__label" for="aeroPort_prov"
                    >{{__('front.'.$lang.'.aeroportprev')}}</label
                  >
                </div>

              <!--  <div class="form__group form__group--selector required">
                  <select name="pec_arrival_airport" class="form__selector">
                    <option value="none" disabled selected>Aéroport d'arrivée</option>
                    @foreach(config('meDays.airports') as $item)
                      <option value="{{$item['id']}}" {{$item['id'] == $participant->pec_arrival_airport ? 'selected="selected"' : '' }}>{{ $item['name'] }}</option>
                    @endforeach
                  </select>
                </div> -->
                <hr style="margin-bottom: 15px;">
                <h2 class="title__secondary">{{__('front.'.$lang.'.voldepart')}}</h2> 
                 <div class="form__group required">

                  <input
                    class="form__input datepicker"
                    type="text"
                    alt="{{__('front.'.$lang.'.departuredate')}}"
                    name="desired_departure_date"
                    id="dateDepart"
                    placeholder="{{__('front.'.$lang.'.dateformat')}}"
                    value="{{!empty($participant->desired_departure_date) ? $participant->desired_departure_date : ''}}"

                  />
                  <label class="form__label" for="dateDepart"
                    >{{__('front.'.$lang.'.departuredate')}}</label
                  >
                </div>

                <div class="form__group form__group--selector required">
                  <select name="desired_departure_hour" class="form__selector">
                    <option value="none" disabled {{(empty($participant->desired_departure_hour)) ? 'selected' : ''}}>{{__('front.'.$lang.'.wantedhour')}}</option>
                    <option value="1" {{($participant->desired_departure_hour == 1) ? 'selected' : ''}}>{{__('front.'.$lang.'.morning')}}</option>
                    <option value="2" {{($participant->desired_departure_hour == 2) ? 'selected' : ''}}>{{__('front.'.$lang.'.afterlunch')}}</option>
                    <option value="3" {{($participant->desired_departure_hour == 3) ? 'selected' : ''}}>{{__('front.'.$lang.'.night')}}</option>
                  </select>
                </div>
               <!-- <div class="form__group form__group--selector required">
                  <select name="pec_departure_airport" class="form__selector">
                      <option value="none" disabled selected>Aéroport de départ</option>
                    @foreach(config('meDays.airports') as $item)
                      <option value="{{$item['id']}}" {{$item['id'] == $participant->departure_airport ? 'selected="selected"' : '' }}>{{ $item['name'] }}</option>
                    @endforeach
                    </select>
                  </div> -->
                 <div class="form__group required">
                   <input
                   class="form__input"
                   type="text"
                   alt="{{__('front.'.$lang.'.aeroportdes')}}"
                   placeholder="{{__('front.'.$lang.'.aeroportdes')}}"
                   name="pec_arrival_airport"
                   value="{{$participant->pec_arrival_airport}}"
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
                      <button data-pstep="content__step--pec" class="btn btn--right-arrow btn--primary dgotosejour">
                        <span>
                          {{__('front.'.$lang.'.next')}}
                        </span>
                      </button>
                    @else
                      @if($participant->type_id == 2 || $participant->type_id == 3 && $lang == 'fr')
                        <button data-pstep="content__step--pec" class="btn btn--right-arrow btn--primary dgotoformation">
                          <span>
                            {{__('front.'.$lang.'.next')}}
                          </span>
                        </button>
                      @else
                        <input data-pstep="content__step--pec" type="submit" class="btn btn--right-arrow btn--primary dsubmit" value="{{__('front.'.$lang.'.next')}}" />
                      @endif
                    @endif
                  </div>
              <p class="inscription__tip">* {{__('front.'.$lang.'.requiredfields')}}</p>
            </div>
         
            <div class="info">
              <div class="info__content">
                <div class="info__tips">
                  <h2 class="title__secondary">{{__('front.'.$lang.'.flightticket')}}</h2>
                  <div class="info__desp">
                    {{__('front.'.$lang.'.flightticketdesc')}}
                    <p>
                      {{__('front.'.$lang.'.aeroportcasa')}}
                    </p>
                    <p>
                      {{__('front.'.$lang.'.aeroportrabat')}}
                    </p>
                    <p>
                      {{__('front.'.$lang.'.aeroporttanger')}}
                    </p>
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