<div class="content__step content__step--step2"> 
            <div class="inscription">
              <h1 class="inscription__title title__primary">
                {{__('front.'.$lang.'.inscriptionrequest')}}
              </h1>
                <div class="form__group form__group--selector required">
                  <select name="country" class="form__selector">
                    <option value="none" disabled {{(empty($participant->country)) ? 'selected' : ''}}>{{__('front.'.$lang.'.countryofresidence')}}</option>
                    @foreach($countries as  $country)
                      @if(!empty($country))
                        <option {{(!empty($participant->country) && $participant->country == $country->code2) ? 'selected="selected"' : ''}} value="{{$country->code2}}">
                          {!!   $lang =='fr' ? $country->name_fr : $country->name_en !!}
                        </option>
                      @endif
                    @endforeach
                  </select>
                </div>
                <div class="form__group required">
                  <input
                    class="form__input"
                    type="text"
                    alt="city"
                    name="city"
                    value='{{(!empty($participant->city)) ? $participant->city : ""}}'
                    placeholder="{{__('front.'.$lang.'.city')}}"
                    id="city"
                  />
                  <label class="form__label" for="city">{{__('front.'.$lang.'.city')}}</label>
                </div>
                <div class="form__group required">
                  <input
                    class="form__input"
                    type="text"
                    alt="Email"
                    value='{{(!empty($participant->email)) ? $participant->email : ""}}'
                    name="email"
                    placeholder="{{__('front.'.$lang.'.email')}}"
                    id="email"
                  />
                  <label class="form__label" for="email">{{__('front.'.$lang.'.email')}}</label>
                </div>
                <div class="form__group required">
                  <input
                    class="form__input"
                    type="text"
                    name="pro_phone"
                    value='{{(!empty($participant->pro_phone)) ? $participant->pro_phone : ""}}'
                    alt="{{__('front.'.$lang.'.professionalphone')}}"
                    placeholder="{{__('front.'.$lang.'.professionalphone')}}"
                    id="teleprof"
                  />
                  <label class="form__label" for="teleprof"
                    >{{__('front.'.$lang.'.professionalphone')}}</label
                  >
                </div>
                <div class="form__group required">
                  <input
                    class="form__input"
                    type="text"
                    name="mobile_phone"
                    value='{{(!empty($participant->mobile_phone)) ? $participant->mobile_phone : ""}}'
                    alt="{{__('front.'.$lang.'.mobilephone')}}"
                    placeholder="{{__('front.'.$lang.'.mobilephone')}}"
                    id="telemob"
                  />
                  <label class="form__label" for="telemob"
                    >{{__('front.'.$lang.'.mobilephone')}}</label
                  >
                </div>
                <div class="form__group">
                  <span class="form__simple-label"
                    >{{__('front.'.$lang.'.ID')}} <span class="form__etoile">*</span></span
                  >

                  <div class="form__radio-group">
                    <input
                      class="form__radio-input"
                      type="radio"
                      name="identity_type"
                      {{(!empty($participant->identity_type) && $participant->identity_type == 1) ? 'checked' : ''}}
                      value="1"
                      id="cin"
                    />
                    <label class="form__radio-label" for="cin">
                      <span class="form__radio-button"></span>
                      {{__('front.'.$lang.'.cin')}}</label
                    >
                  </div>

                  <div class="form__radio-group">
                    <input
                      class="form__radio-input"
                      type="radio"
                      name="identity_type"
                      {{(!empty($participant->identity_type) && $participant->identity_type == 2) ? 'checked' : ''}}
                      value="2"
                      id="pass"
                    />
                    <label class="form__radio-label" for="pass">
                      <span class="form__radio-button"></span>
                      {{__('front.'.$lang.'.passport')}}</label
                    >
                  </div>
                </div>

                <div class="form__group required">
                  <input
                  class="form__input"
                    type="text"
                    name="num_identity"
                    value='{{(!empty($participant->num_identity)) ? $participant->num_identity : ""}}'
                    alt="nbrId"
                    placeholder="{{__('front.'.$lang.'.idnumber')}}"
                    id="nbrId"
                  />
                  <label class="form__label" for="nbrId"
                    >{{__('front.'.$lang.'.idnumber')}}</label
                  >
                </div>
                @if(app('request')->input('type') == 7)
                <div class="form__group required">
                  <!-- ce input juste pour la présentation, le style-->
                  <p id="filelabelinput" class="form__input form__input--upload">{{__('front.'.$lang.'.presscard')}} (PDF / JPG / JPEG / PNG) | max 6 mo</p>
                  <input
                    class="form__input form__input--upload"
                    id="filelabelinputf"
                    type="file"
                    alt="cp"
                    placeholder="Carte de presse (PDF / JPG / JPEG / PNG) max 6 mo"
                    name='presscarte'
                    style="display: none;"
                  />
                  <!-- Utiliser ce input pour récupérer le fichier , le style
                  <input
                    class="form__input form__input--file"
                    type="file"
                    alt="cartePresse"
                    placeholder="Carte de presse (PDF / JPG / JPEG / PNG) max 6 mo"
                    id="cartePresse"
                    required
                  /> -->
                </div>
                @endif
                <div class="form__group form__group--right-content">
                  <button class="btn btn--left-arrow btn--secondary goback">
                    {{__('front.'.$lang.'.previous')}}
                  </button>
                  @if(!empty($participant) && $participant->has_pec == 2 || !empty($participant) && $participant->has_transfert == 2 || !empty($participant) && $participant->has_hebergement == 2)
                    @if($participant->has_pec == 2)
                      <button class="btn btn--right-arrow btn--primary gotopec">
                        {{__('front.'.$lang.'.next')}}
                      </button>
                    @elseif($participant->has_transfert == 2)
                      <button class="btn btn--right-arrow btn--primary gototransfer">
                        {{__('front.'.$lang.'.next')}}
                      </button>
                    @else
                      <button class="btn btn--right-arrow btn--primary gotosejour">
                        {{__('front.'.$lang.'.next')}}
                      </button>
                    @endif
                  @else
                  @if(!empty($type_id) && $type_id == 2 || !empty($type_id) && $type_id == 3 || app('request')->input('type') != 7 && app('request')->input('type') != 1)
                  @if($lang == 'fr')
                    <button class="btn btn--right-arrow btn--primary gotoformation">
                      {{__('front.'.$lang.'.next')}}
                    </button>
                  @else
                    <input type="submit" class="btn btn--right-arrow btn--primary" value="{{__('front.'.$lang.'.next')}}" />
                  @endif
                  @else
                    <button class="btn btn--right-arrow btn--primary gostepthree">
                      {{__('front.'.$lang.'.next')}}
                    </button>
                  @endif
                  @endif
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