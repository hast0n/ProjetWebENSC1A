<div class="main-content">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card explore-card">
                <div class="card-body d-flex">

                    {{ $slot }}

                    <d class="main-section">
                        {{ $main }}
                    </d>

                    <d class="side-section">
                        {{ $side }}
                    </d>

                </div>
            </div>
        </div>
    </div>
</div>
