
<div class="content__step content__step--step1">
            <div class="inscription">
              <h1 class="inscription__title title__primary">
              {{__('front.'.$lang.'.inscriptionrequest')}}
              </h1>
                {{ csrf_field() }}
                <div class="form__group">
                  <div class="form__radio-group">
                    <input
                      class="form__radio-input"
                      type="radio"
                      name="civility"
                      value="1"
                      id="small"
                      {{(!empty($participant->civility) && $participant->civility == 1) ? 'checked' : ''}}
                      {{(empty($participant->civility)) ? 'checked' : ''}}
                    />
                    <label class="form__radio-label" for="small">
                      <span class="form__radio-button"></span>
                      {{__('front.'.$lang.'.madame')}}</label
                    >
                  </div>
                  <div class="form__radio-group">
                    <input
                      class="form__radio-input"
                      type="radio"
                      name="civility"
                      value="2"
                      id="large"
                      {{(!empty($participant->civility) && $participant->civility == 2) ? 'checked' : ''}}
                    />
                    <label class="form__radio-label" for="large">
                      <span class="form__radio-button"></span>
                      {{__('front.'.$lang.'.monsieu')}}</label
                    >
                  </div>
                </div>
                <div class="form__group required">
                  <input
                    class="form__input"
                    value="{{(!empty($participant->first_name)) ? $participant->first_name : ''}}"
                    type="text"
                    alt="First name"
                    name="first_name"
                    placeholder="{{__('front.'.$lang.'.firstname')}}"
                    id="firstname"
                  />
                  <label class="form__label" for="firstname">{{__('front.'.$lang.'.firstname')}}</label>
                </div>
                <div class="form__group required">
                  <input
                    class="form__input"
                    value="{{(!empty($participant->last_name)) ? $participant->last_name : ''}}"
                    type="text"
                    alt="Last name"
                    name="last_name"
                    placeholder="{{__('front.'.$lang.'.lastname')}}"
                    id="lastname"
                  />
                  <label class="form__label" for="lastname">{{__('front.'.$lang.'.lastname')}}</label>
                </div>
                <div class="form__group required">
                  <input
                    class="form__input"
                    value="{{(!empty($participant->organization)) ? $participant->organization : ''}}"
                    type="text"
                    alt="Organisme"
                    name="organization"
                    placeholder="{{__('front.'.$lang.'.organism')}}"
                    id="organisme"
                  />
                  <label class="form__label" for="organisme">{{__('front.'.$lang.'.organism')}}</label>
                </div>
                <div class="form__group required">
                  <input
                    class="form__input"
                    value="{{(!empty($participant->function)) ? $participant->function : ''}}"
                    type="text"
                    alt="fonction"
                    name="function"
                    placeholder="{{__('front.'.$lang.'.function')}}"
                    id="fonction"
                  />
                  <label class="form__label" for="fonction">{{__('front.'.$lang.'.function')}}</label>
                </div>
                <div class="form__group form__group--selector required">
                  <select name="nationality" class="form__selector">
                    <option value="none" disabled {{(empty($participant->nationality)) ? 'selected' : ''}}>{{__('front.'.$lang.'.origincountry')}}</option>
                    @foreach($countries as $country)
                        @if(!empty($country))
                        <option {{(!empty($participant->nationality) && $participant->nationality == $country->code2) ? 'selected="selected"' : ''}} value="{{$country->code2}}">
                          {!!   $lang =='fr' ? $country->name_fr : $country->name_en !!}
                        </option>
                        @endif
                    @endforeach
                  </select>
                </div>
                <div class="form__group required">
                  <input 
                    class="form__input" 
                    value="{{(!empty($participant->birthday)) ? $participant->birthday : ''}}" 
                    name="birthday" 
                    type="text" 
                    maxlength="10" 
                    placeholder="{{__('front.'.$lang.'.dateformat')}}" 
                    alt="" 
                    id="birthdate"/>
                  <label class="form__label" for="birthdate"
                    >{{__('front.'.$lang.'.birthday')}}</label
                  >
                </div>
                <input type="hidden" value="{{$lang}}" name="language" />
                <input type="hidden" value="{{ app('request')->input('type') }}" name="type" />
                <div class="form__group form__group--right-content">
                  <button class="btn btn--with-arrow btn--primary gosteptow">
                    {{__('front.'.$lang.'.next')}}
                  </button>
                </div>
              <p class="inscription__tip">* {{__('front.'.$lang.'.requiredfields')}}</p>
            </div>
            <div class="info">
              <div class="info__content">
                <div class="info__tips">
                  <h2 class="title__secondary">{{__('front.'.$lang.'.personalinformations')}}</h2>
                  <div class="info__desp">
                    {{__('front.'.$lang.'.thankstoaddinfovalide')}}
                    {{__('front.'.$lang.'.requestbestcondition')}}
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
                    <a href="http://www.medays.org" target="_blank" class="info__link">www.medays.org</a>
                  </p>
                </div>
              </div>
            </div> 
</div>