<div class="content__step content__step--sejour">
              <div class="inscription">
                  <h1 class="inscription__title title__primary">
                      {{__('front.'.$lang.'.yourhotel')}}
                  </h1>
    

                      <p class="info__desp">
                        {{__('front.'.$lang.'.hoteltopdesc')}}
                      </p>
                      <div class="form__group required">

                        <input
                          class="form__input datepicker"
                          type="text"
                          alt="{{__('front.'.$lang.'.arrivaldate')}}"
                          id="dateArrivee"
                          name="arrival_date"
                          placeholder="{{__('front.'.$lang.'.arrivaldate')}} ({{__('front.'.$lang.'.dateformat')}}) "
                          value="{{!empty($participant->arrival_date) ? $participant->arrival_date : ''}}"
                        />
                        <label class="form__label" for="dateArrivee"
                          >{{__('front.'.$lang.'.arrivaldate')}}</label
                        >
                      </div> 
                      <div class="form__group required">

                        <input
                          class="form__input datepicker"
                          type="text"
                          alt="{{__('front.'.$lang.'.departuredate')}}"
                          name='departure_date'
                          id="dateDepart"
                          placeholder="{{__('front.'.$lang.'.departuredate')}} ({{__('front.'.$lang.'.dateformat')}})"
                          value="{{!empty($participant->departure_date) ? $participant->departure_date : ''}}"
                        />
                        <label class="form__label" for="dateDepart"
                          >{{__('front.'.$lang.'.departuredate')}}</label
                        >
                      </div>

                      <p class="info__desp" style="font-size: 13px;">
                        * {{__('front.'.$lang.'.hotelinfodesc')}}
                        <br/>
                        {{__('front.'.$lang.'.hotelinfodescone')}}
                        <br/>
                        {{__('front.'.$lang.'.hotelinfodesctow')}}
                      </p>
                     
                      <div
                        class="form__group  form__group--right-content "
                      >
                        <button class="btn btn--left-arrow btn--secondary goback">
                          <span>
                            {{__('front.'.$lang.'.previous')}}
                          </span>
                        </button>
                        @if($participant->type_id == 2 || $participant->type_id == 3 && $lang == 'fr')
                          <button data-pstep="content__step--sejour" class="btn btn--right-arrow btn--primary dgotoformation">
                            <span>
                              {{__('front.'.$lang.'.next')}}
                            </span>
                          </button>
                        @else
                          <input data-pstep="content__step--sejour" type="submit" class="btn btn--right-arrow btn--primary dsubmit" value="{{__('front.'.$lang.'.next')}}" />
                        @endif
                        </div>
                  <p class="inscription__tip">* {{__('front.'.$lang.'.requiredfields')}}</p>
                </div>
             
                <div class="info">
                  <div class="info__content">
                    <div class="info__tips">
                      <h2 class="title__secondary">{{__('front.'.$lang.'.yourhotel')}}</h2>
                      <div class="info__desp">
                          {{__('front.'.$lang.'.hoteldesc')}}
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