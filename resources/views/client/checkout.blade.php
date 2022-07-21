@section('title', 'Checkout')

<x-client.master-layout>

    <!-- PAGE TITLE
    ================================================== -->
    <header class="py-8 py-md-10" style="background-image: none;">
        <div class="container text-center py-xl-2">
            <h1 class="display-4 fw-semi-bold mb-0">Checkout</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-scroll justify-content-center">
                    <li class="breadcrumb-item">
                        <a class="text-gray-800" href="#">
                            Home
                        </a>
                    </li>
                    <li class="breadcrumb-item text-gray-800 active" aria-current="page">
                        Checkout
                    </li>
                </ol>
            </nav>
        </div>
    </header>


    <!-- SHOP CHECKOUT
    ================================================== -->
    <div class="container pb-6 pb-xl-10">
        <div class="col2-set" id="customer_details">
            <div class="col-12">
                <div class="woocommerce-billing-fields">
                    <div id="accordionCurriculum">
                        <x-client.checkout-accordion-holder>
                            <x-slot:accordion-title>
                                Client Details
                            </x-slot:accordion-title>

                            <x-slot:column>
                                <x-client.checkout-accordion-column>
                                    <x-slot:column-name>
                                        Name
                                    </x-slot:column-name>

                                    <x-slot:column-data>
                                        {{ $client->name }}
                                    </x-slot:column-data>
                                </x-client.checkout-accordion-column>

                                <x-client.checkout-accordion-column class="bg-gray-100">
                                    <x-slot:column-name>
                                        Email
                                    </x-slot:column-name>

                                    <x-slot:column-data>
                                        {{ $client->email }}
                                    </x-slot:column-data>
                                </x-client.checkout-accordion-column>

                                <x-client.checkout-accordion-column>
                                    <x-slot:column-name>
                                        Phone Number
                                    </x-slot:column-name>

                                    <x-slot:column-data>
                                        {{ $client->phone_number }}
                                    </x-slot:column-data>
                                </x-client.checkout-accordion-column>
                            </x-slot:column>
                        </x-client.checkout-accordion-holder>

                        <x-client.checkout-accordion-holder>
                            <x-slot:accordion-title>
                                Appointment Details
                            </x-slot:accordion-title>

                            <x-slot:column>
                                <x-client.checkout-accordion-column class="bg-gray-100">
                                    <x-slot:column-name>
                                        Skill Title
                                    </x-slot:column-name>

                                    <x-slot:column-data>
                                        {{ $appointment->skill->title }}
                                    </x-slot:column-data>
                                </x-client.checkout-accordion-column>

                                <x-client.checkout-accordion-column>
                                    <x-slot:column-name>
                                        Appointment Title
                                    </x-slot:column-name>

                                    <x-slot:column-data>
                                        {{ $appointment->title }}
                                    </x-slot:column-data>
                                </x-client.checkout-accordion-column>

                                <x-client.checkout-accordion-column class="bg-gray-100">
                                    <x-slot:column-name>
                                        Duration
                                    </x-slot:column-name>

                                    <x-slot:column-data>
                                        {{ $appointment->duration }} days
                                    </x-slot:column-data>
                                </x-client.checkout-accordion-column>

                                <x-client.checkout-accordion-column>
                                    <x-slot:column-name>
                                        Start Data
                                    </x-slot:column-name>

                                    <x-slot:column-data>
                                        {{ $appointment->from }}
                                    </x-slot:column-data>
                                </x-client.checkout-accordion-column>

                                <x-client.checkout-accordion-column class="bg-gray-100">
                                    <x-slot:column-name>
                                        End Date
                                    </x-slot:column-name>

                                    <x-slot:column-data>
                                        {{ $appointment->to }}
                                    </x-slot:column-data>
                                </x-client.checkout-accordion-column>

                                <x-client.checkout-accordion-column>
                                    <x-slot:column-name>
                                        Hours ( 24-Hour Format)
                                    </x-slot:column-name>

                                    <x-slot:column-data>
                                        {{ $appointment->start }} - {{ $appointment->end }}
                                    </x-slot:column-data>
                                </x-client.checkout-accordion-column>
                            </x-slot:column>
                        </x-client.checkout-accordion-holder>

                        <x-client.checkout-accordion-holder>
                            <x-slot:accordion-title>
                                Additional Information
                            </x-slot:accordion-title>

                            <x-slot:column>
                                <x-client.checkout-accordion-column>
                                    <x-slot:column-name>
                                        Client's Profession
                                    </x-slot:column-name>

                                    <x-slot:column-data>
                                        {{ $client->profession ?? 'Not provided' }}
                                    </x-slot:column-data>
                                </x-client.checkout-accordion-column>

                                <x-client.checkout-accordion-column>
                                    <x-slot:column-name>
                                        Client's Address
                                    </x-slot:column-name>

                                    <x-slot:column-data>
                                        {{ $client->address ?? 'Not Provided' }}
                                    </x-slot:column-data>
                                </x-client.checkout-accordion-column>
                            </x-slot:column>
                        </x-client.checkout-accordion-holder>
                    </div>
                </div>
            </div>

        </div>

        <livewire:client.process-checkout :client="$client" :appointment="$appointment"/>
    </div>
</x-client.master-layout>
