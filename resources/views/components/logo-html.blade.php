<div class="app-brand justify-content-center">
    <a href="/" class="app-brand-link gap-2">
        <span class="app-brand-logo demo">
            @if (!empty($settingGeneral->site_logo))
                <img width="40px" src="{{ asset('img_logo/' . $settingGeneral->site_logo)}}" alt="icon" />
                @else
                <img width="40px" src="" alt="icon" />
            @endif
        </span>
        <span class="app-brand-text demo text-body fw-bolder">
            {{ $settingGeneral->site_title }}
        </span>
    </a>
</div>