@section('title', 'Settings')

<x-admin.master-layout>
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Settings</h1>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title">General Settings</h3>
            </div>
            <div class="block-content p-2">
                <form action="{{ route('settings.storeGeneralSettings') }}" method="POST">
                    @csrf
                    <div class="col-12">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="site_name">Site Name</label>
                                <input type="text" class="form-control" id="site_name" name="site_name"
                                       value="{{ setting('site_name') ?? 'N/A' }}">
                                @error('site_name')
                                <div class="alert alert-error">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="contact_email">Contact Email</label>
                                <input type="email" class="form-control" id="contact_email" name="contact_email"
                                       value="{{ setting('contact_email') ?? 'N/A' }}">
                                @error('contact_email')
                                <div class="alert alert-error">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="contact_phone_number">Contact Phone Number</label>
                                <input type="text" class="form-control" id="contact_phone_number"
                                       name="contact_phone_number"
                                       value="{{ setting('site_name') ?? 'Eg. +255700000000' }}">
                                @error('contact_phone_number')
                                <div class="alert alert-error">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="facebook_social_media_link">Facebook Social Media Link</label>
                                <input type="text" class="form-control" id="facebook_social_media_link"
                                       name="facebook_social_media_link"
                                       value="{{ setting('facebook_social_media_link') ?? 'N/A' }}">
                                @error('facebook_social_media_link')
                                <div class="alert alert-error">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="twitter_social_media_link">Twitter Social Media Link</label>
                                <input type="text" class="form-control" id="twitter_social_media_link"
                                       name="twitter_social_media_link"
                                       value="{{ setting('twitter_social_media_link') ?? 'N/A' }}">
                                @error('twitter_social_media_link')
                                <div class="alert alert-error">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="instagram_social_media_link">Instagram Social Media Link</label>
                                <input type="text" class="form-control" id="instagram_social_media_link"
                                       name="instagram_social_media_link"
                                       value="{{ setting('instagram_social_media_link') ?? 'N/A' }}">
                                @error('instagram_social_media_link')
                                <div class="alert alert-error">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-12">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address"
                                       value="{{ setting('address') ?? 'N/A' }}">
                                @error('address')
                                <div class="alert alert-error">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title">Beem Settings</h3>
            </div>
            <div class="block-content p-2">
                <form action="{{ route('settings.storeBeemSettings') }}" method="POST">
                    @csrf
                    <div class="col-12">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="beem_api_key">Beem Api Key</label>
                                <input type="text" class="form-control" id="beem_api_key" name="beem_api_key"
                                       value="{{ setting('beem_api_key') ?? 'N/A' }}">
                                @error('beem_api_key')
                                <div class="alert alert-error">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="beem_sender_name">Beem Sender Name</label>
                                <input type="text" class="form-control" id="beem_sender_name"
                                       name="beem_sender_name" value="{{ setting('beem_sender_name') ?? 'N/A' }}">
                                @error('beem_sender_name')
                                <div class="alert alert-error">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="beem_secret_key">Beem Secret Key</label>
                                <textarea type="email" class="form-control" id="beem_secret_key" name="beem_secret_key"
                                          rows="3">{{ setting('beem_secret_key') ?? 'N/A' }}</textarea>
                                @error('beem_secret_key')
                                <div class="alert alert-error">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="block block-rounded block-bordered">
            <div class="block-header block-header-default">
                <h3 class="block-title">Other Settings</h3>
            </div>
            <div class="block-content p-2">
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="google_calendar_credentials">Google Calendar Credentials</label>
                                    <input type="file" id="google_calendar_credentials"
                                           name="google_calendar_credentials">
                                @error('google_calendar_credentials')
                                <div class="alert alert-error">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin.master-layout>
