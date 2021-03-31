@extends('registerFront')

@section('content')
    <main class="content">
        <div class="content__container">
            <section class="content__standard">
                <section class="content__step content__step--step0">
                    <div class="init-inscription">
                        <div class="init-inscription__right-side">
                            <p class="info__desp">
                                {{__('front.'.$lang.'.wantyouassite')}}<br><br>

                                {{__('front.'.$lang.'.wantyouregister')}}
                            </p>
                            <button class="btn btn--with-arrow btn--tertiary" id="partbtnc">
                                <a href="/steptow/{{$lang}}?type=1" id="partbtnca">
                                    {{__('front.'.$lang.'.participant')}}
                                </a>
                            </button>
                            <button class="btn btn--with-arrow btn--tertiary" id="pressbtnc">
                                <a href="/steptow/{{$lang}}?type=7" id="pressbtnca">
                                    {{__('front.'.$lang.'.press')}}
                                </a>
                            </button>
                        </div>
                        <div class="init-inscription__separator">
                <span>
                  <span>{{__('front.'.$lang.'.or')}}</span>
                </span>
                        </div>
                        <div class="init-inscription__left-side">
                            <p class="info__desp">
                                {{__('front.'.$lang.'.youhadreceivedacode')}}
                                MEDays2019
                            </p>
                            <form class="form" method="POST" action="/steptow/{{$lang}}">
                                {!! csrf_field() !!}
                                <div class="form__group required">
                                    <input
                                            class="form__input"
                                            type="text"
                                            alt="personalCode"
                                            name="webcode"
                                            placeholder="{{__('front.'.$lang.'.personalcode')}}"
                                            id="personalCode"
                                            required
                                    />
                                    <label class="form__label" for="personalCode"
                                    >{{__('front.'.$lang.'.personalcode')}}</label
                                    >
                                </div>
                                @if(!empty($codenotfound))
                                <p class='inscription__tip'>{{__('front.'.$lang.'.existingcode')}}</p>
                                @endif
                                <div class="form__group form__group--center-content">
                                    <button class="btn btn--with-arrow btn--primary">
                                        {{__('front.'.$lang.'.next')}}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="info__contact">
                        <h2 class="title__secondary">{{__('front.'.$lang.'.amadeuxonstitut')}}</h2>
                        <p class="info__desp">
                            {{__('front.'.$lang.'.contactusforinfo')}}

                            <a href="mailto:inscriptions@amadeusonline.org" target="_blank" class="info__link"
                            >inscriptions@amadeusonline.org</a
                            >
                            <a href="http://www.medays.org" target="_blank" class="info__link">www.medays.org</a>
                        </p>
                    </div>
                </section>
            </section>
        </div>
    </main>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
$(document).ready(function() {
    $("#partbtnc").click(function () {
        window.location = "/steptow/{{$lang}}?type=1"
    })

    $("#pressbtnc").click(function () {
        window.location = "/steptow/{{$lang}}?type=7"
    })

    function GetIEVersion() {
        var sAgent = window.navigator.userAgent;
        var Idx = sAgent.indexOf("MSIE");
        if (Idx > 0) 
            return parseInt(sAgent.substring(Idx+ 5, sAgent.indexOf(".", Idx)));
        else if (!!navigator.userAgent.match(/Trident\/7\./)) 
            return 11;
        else
            return 0; //It is not IE
    }
    if (GetIEVersion() > 0) {
        @if($lang == 'fr')
            window.location = '/incompatiblenavigateur'
        @else
            window.location = '/incompatiblebrowser'
        @endif
    } else{
    }
    })
</script>
@endsection