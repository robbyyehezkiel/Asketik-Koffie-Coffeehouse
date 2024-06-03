<section>
    <div class="cart-section mt-150 mb-150">
        <div class="container">
            <div class="row mt-4">
                <div class="col-lg-12
        ">
                    <div class="checkout-accordion-wrap">
                        <div class="card single-accordion">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse"
                                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Update Password
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="billing-address-form">
                                        <!-- Hidden input for cart items -->
                                        <form method="post" action="{{ route('password.update') }}"
                                            class="mt-6 space-y-6">
                                            @csrf
                                            @method('put')

                                            <div>
                                                <x-input-label for="update_password_current_password"
                                                    :value="__('Current Password')" />
                                                <x-text-input id="update_password_current_password"
                                                    name="current_password" type="password"
                                                    class="input-custom mt-1 block w-full"
                                                    autocomplete="current-password" />
                                                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                                            </div>

                                            <div>
                                                <x-input-label for="update_password_password" :value="__('New Password')" />
                                                <x-text-input id="update_password_password" name="password"
                                                    type="password" class="input-custom mt-1 block w-full"
                                                    autocomplete="new-password" />
                                                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                            </div>

                                            <div>
                                                <x-input-label for="update_password_password_confirmation"
                                                    :value="__('Confirm Password')" />
                                                <x-text-input id="update_password_password_confirmation"
                                                    name="password_confirmation" type="password"
                                                    class="input-custom mt-1 block w-full"
                                                    autocomplete="new-password" />
                                                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                                            </div>

                                            <div class="flex items-center gap-4 mt-4">
                                                <x-primary-button>{{ __('Save') }}</x-primary-button>

                                                @if (session('status') === 'password-updated')
                                                    <p x-data="{ show: true }" x-show="show" x-transition
                                                        x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">
                                                        {{ __('Saved.') }}</p>
                                                @endif
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
