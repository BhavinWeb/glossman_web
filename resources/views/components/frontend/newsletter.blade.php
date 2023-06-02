<div class="newsletter-section-01 bg-secondary-700">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-10 col-xs-11">
                <div class="newsletter-section-01__wrapper">
                    <div class="section-title-block">
                        <h2 class="title">{{ __('subscribe_to_our_newsletter') }}</h2>
                        <p class="text">
                            {{ __('praesent_fringilla_erat_a_lacinia_egestas_donec_vehicula_tempor_libero_et_cursus_donec_non_quam_urna_quisque_vitae_porta_ipsum') }}
                        </p>
                    </div>
                    <div class="newsletter-form-01">
                        <form action="{{ route('newsletter.subscribe') }}" method="post">
                            @csrf
                            <input required type="email" name="subscribe_email" placeholder="@lang('email_address')"
                                class="text-black form-control @error('subscribe_email') is-invalid @enderror">
                            <div class="button-group">
                                <button class="btn btn-primary" type="submit">
                                    {{ __('subscribe') }}
                                    <x-svg.arrow-long-right width="21" height="20" />
                                </button>
                            </div>
                        </form>
                    </div>
                    @error('subscribe_email')
                        <span class="text-danger" role="alert">{{ __($message) }}</span>
                    @enderror
                </div>
                <div class="newsletter-section-01__sponsor">
                    <div class="logo-slider">
                        <div class="logo-slider__track">
                            @foreach ($partners as $partner)
                                <div class="slide">
                                    <img src="{{ asset($partner->logo) }}" alt="{{ $partner->name }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
