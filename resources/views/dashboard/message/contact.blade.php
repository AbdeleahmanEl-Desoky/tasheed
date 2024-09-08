@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.messages')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('site.messages')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.home') <small>{{ $messages->total() }}</small></h3>

                    <form action="{{ route('dashboard.message') }}" method="get">

                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                            </div>
                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                    @if ($messages->count() > 0)

                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('site.name')</th>
                                <td>@lang('site.email')</td>
                                <td>@lang('site.phone')</td>
                                <td>@lang('site.country')</td>
                                <td>@lang('site.company_name')</td>
                                <td>@lang('site.interested_in')</td>
                                <th>@lang('site.message')</th>
                                <th>@lang('site.actions')</th> <!-- Added for actions -->
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($messages as $index=>$message)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $message->name }}</td>
                                    <td>{{ $message->email }}</td>
                                    <td>{{ $message->phone }}</td>
                                    <td>{{ $message->country }}</td>
                                    <td>{{ $message->company_name }}</td>
                                    <td>{{ $message->interested_in }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($message->message, 50) }}</td>
                                    <td>
                                        <button class="btn btn-info btn-sm show-message" data-toggle="modal" data-target="#messageModal"
                                        data-name="{{ $message->name }}"
                                        data-email="{{ $message->email }}"
                                        data-phone="{{ $message->phone }}"
                                        data-country="{{ $message->country }}"
                                        data-company="{{ $message->company_name }}"
                                        data-interested="{{ $message->interested_in }}"
                                        data-message="{{ $message->message }}">
                                    @lang('site.view')
                                </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table><!-- end of table -->

                        {{ $messages->appends(request()->query())->links() }}

                    @else

                        <h2>@lang('site.no_data_found')</h2>

                    @endif

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

        <!-- Modal -->
        <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="messageModalLabel">@lang('site.message_details')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><strong>@lang('site.name'):</strong> <span id="modalName">{{ $message->name }}</span></p>
                        <p><strong>@lang('site.email'):</strong> <span id="modalEmail">{{ $message->email }}</span></p>
                        <p><strong>@lang('site.phone'):</strong> <span id="modalPhone">{{ $message->phone }}</span></p>
                        <p><strong>@lang('site.country'):</strong> <span id="modalCountry">{{ $message->country }}</span></p>
                        <p><strong>@lang('site.company_name'):</strong> <span id="modalCompany">{{ $message->company_name }}</span></p>
                        <p><strong>@lang('site.interested_in'):</strong> <span id="modalInterested">{{ $message->interested_in }}</span></p>
                        <p><strong>@lang('site.message'):</strong> {{ $message->message }}</p>
                        <p id="modalMessage"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('site.close')</button>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- end of content wrapper -->

@endsection

@section('scripts')
    <script>
$(document).ready(function () {
    $('.show-message').on('click', function () {
        // Get data attributes
        const name = $(this).data('name');
        const email = $(this).data('email');
        const phone = $(this).data('phone');
        const country = $(this).data('country');
        const company = $(this).data('company');
        const interested = $(this).data('interested');
        const message = $(this).data('message');

        // Debugging: Log to the console to check if values are retrieved
        console.log({ name, email, phone, country, company, interested, message });

        // Set modal data
        $('#modalName').text(name || ''); // Use a fallback value if null
        $('#modalEmail').text(email || '');
        $('#modalPhone').text(phone || '');
        $('#modalCountry').text(country || '');
        $('#modalCompany').text(company || '');
        $('#modalInterested').text(interested || '');
        $('#modalMessage').text(message || '');
    });
});

    </script>
@endsection
