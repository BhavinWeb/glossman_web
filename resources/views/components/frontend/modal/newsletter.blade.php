<div class="modal fade show d-none" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
  >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div id="myModall" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-two">
        <div class="modal-two__wrapper">
            <div class="modal-image ">
                <img src="{{ asset('frontend') }}/image/modal/newsleter-1.png" alt="newsleter" class="mw-100">
            </div>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Subscribe to our newsletter</h5>
                    <p class="modal-text">Subscribe to the clicon eCommerce newsletter to receive timely updates
                        &
                        discount from your favorite products.</p>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email Address">
                            <div class="icon">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M2.5 7.5V15.625C2.5 15.7908 2.56585 15.9497 2.68306 16.0669C2.80027 16.1842 2.95924 16.25 3.125 16.25H16.875C17.0408 16.25 17.1997 16.1842 17.3169 16.0669C17.4342 15.9497 17.5 15.7908 17.5 15.625V7.5L10 2.5L2.5 7.5Z"
                                        stroke="var(--bs-primary-500)" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M8.63281 11.875L2.69531 16.0703" stroke="var(--bs-primary-500)" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M17.3047 16.0703L11.3672 11.875" stroke="var(--bs-primary-500)" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M17.5 7.5L11.3672 11.875H8.63281L2.5 7.5" stroke="var(--bs-primary-500)"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 ">Subscribe <svg width="21" height="20"
                                viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.625 10H17.375" stroke="" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path d="M11.75 4.375L17.375 10L11.75 15.625" stroke="" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </button>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Don’t show the popup again</label>
                        </div>
                    </form>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18.75 5.25L5.25 18.75" stroke="white" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M18.75 18.75L5.25 5.25" stroke="white" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>
        </div>
    </div>
</div>
