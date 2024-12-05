@extends('master.master')

@section('content')

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">


          <div class="row mt-6">
            <!-- Navigation -->
            <div class="col-lg-3 col-md-4 col-12 mb-md-0 mb-4">
              <div class="d-flex justify-content-between flex-column nav-align-left mb-2 mb-md-0">
                <ul class="nav nav-pills flex-column">
                  <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#payment">
                      {{-- <i class="ti ti-credit-card me-1_5 ti-sm"></i> --}}
                      <i class="fa-solid fa-clipboard-question me-1_5 ti-sm"></i>
                      <span class="align-middle fw-medium">FAQ</span>
                    </button>
                  </li>
                  {{-- <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#delivery">
                      <i class="ti ti-briefcase me-1_5 ti-sm"></i>
                      <span class="align-middle fw-medium">Delivery</span>
                    </button>
                  </li>
                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#cancellation">
                      <i class="ti ti-rotate-clockwise-2 me-1_5 ti-sm"></i>
                      <span class="align-middle fw-medium">Cancellation & Return</span>
                    </button>
                  </li>
                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#orders">
                      <i class="ti ti-box me-1_5 ti-sm"></i>
                      <span class="align-middle fw-medium">My Orders</span>
                    </button>
                  </li>
                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#product">
                      <i class="ti ti-settings me-1_5 ti-sm"></i>
                      <span class="align-middle fw-medium">Product & Services</span>
                    </button>
                  </li> --}}
                </ul>
                <div class="d-none d-md-block">
                  <div class="mt-4">
                    <img
                      src="../../assets/img/illustrations/girl-sitting-with-laptop.png"
                      class="img-fluid"
                      width="270"
                      alt="FAQ Image" />
                  </div>
                </div>
              </div>
            </div>
            <!-- /Navigation -->

            <!-- FAQ's -->
            <div class="col-lg-9 col-md-8 col-12">
              <div class="tab-content p-0">
                <div class="tab-pane fade show active" id="payment" role="tabpanel">
                  <div class="d-flex mb-4 gap-4">
                    <div class="avatar avatar-md">
                      <div class="avatar-initial bg-label-primary rounded">
                        {{-- <i class="ti ti-credit-card ti-30px"></i> --}}
                      <i class="fa-solid fa-clipboard-question ti-lg"></i>

                      </div>

                    </div>
                    <div>
                      <h5 class="mb-0">
                        <span class="align-middle">FAQ</span>
                      </h5>
                      {{-- <span>Get help with payment</span> --}}
                    </div>
                  </div>
                  <div id="accordionPayment" class="accordion">
                    <div class="card accordion-item active">
                      <h2 class="accordion-header">
                        <button
                          class="accordion-button"
                          type="button"
                          data-bs-toggle="collapse"
                          aria-expanded="true"
                          data-bs-target="#accordionPayment-1"
                          aria-controls="accordionPayment-1">
                          1. How to Integrate with TESS Payments?
                        </button>
                      </h2>

                      <div id="accordionPayment-1" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            Simply sign-up on our Sandbox environment and our automated system will guide you through the Integration process.
                        </div>
                      </div>
                    </div>

                    <div class="card accordion-item">
                      <h2 class="accordion-header">
                        <button
                          class="accordion-button collapsed"
                          type="button"
                          data-bs-toggle="collapse"
                          data-bs-target="#accordionPayment-2"
                          aria-controls="accordionPayment-2">
                          2. Will I need to pay any charges to Integrate with TESS Payments?
                        </button>
                      </h2>
                      <div id="accordionPayment-2" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            Integration with TESS Payments is totally free. There are no one time or yearly fees. Just Integrate with TESS Payments and start earning right away.

                        </div>
                      </div>
                    </div>

                    <div class="card accordion-item">
                      <h2 class="accordion-header">
                        <button
                          class="accordion-button collapsed"
                          type="button"
                          data-bs-toggle="collapse"
                          data-bs-target="#accordionPayment-3"
                          aria-controls="accordionPayment-3">
                          3. What are the methods to integrate with TESS Payments?
                        </button>
                      </h2>
                      <div id="accordionPayment-3" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            Integration techniques incorporate Programming interface (Sample Code provided) and Redirection technique. Plugins Modules are also available for top 5 CMS (Customized Management System) and Shopping baskets
                        </div>
                      </div>
                    </div>

                    <div class="card accordion-item">
                      <h2 class="accordion-header">
                        <button
                          class="accordion-button collapsed"
                          type="button"
                          data-bs-toggle="collapse"
                          data-bs-target="#accordionPayment-4"
                          aria-controls="accordionPayment-4">
                          4. Do I need to utilize each of the three Payment Methods available in TESS Payments?
                        </button>
                      </h2>
                      <div id="accordionPayment-4" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            TESS Payments offers you three Payment Methods, it is Merchant's choice to choose any 1, 2 or ALL of the Payment Methods.
                        </div>
                      </div>
                    </div>

                    <div class="card accordion-item">
                      <h2 class="accordion-header">
                        <button
                          class="accordion-button collapsed"
                          type="button"
                          data-bs-toggle="collapse"
                          data-bs-target="#accordionPayment-5"
                          aria-controls="accordionPayment-5">
                          5. Is there any help guide / understanding manual to assist in Integration?
                        </button>
                      </h2>
                      <div id="accordionPayment-5" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            We have Sandbox environment that is available to guide Merchants for Testing and Integration. Please visit the Sandbox Home Page <a href="https://tesspayments.com/" target="_blank">https://tesspayments.com/</a>
                        </div>
                      </div>
                    </div>

                    <div class="card accordion-item">
                        <h2 class="accordion-header">
                          <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#accordionPayment-6"
                            aria-controls="accordionPayment-6">
                            6. Are there any reconciliation / reversal modules for CMS (Customized Management System)?
                          </button>
                        </h2>
                        <div id="accordionPayment-6" class="accordion-collapse collapse">
                          <div class="accordion-body">
                            We have modules created for 5 CMS and Shopping basket stages, for example, Magento, Woocommerce, Prestashop, Open Cart, Joomla and Os Commerce.
                          </div>
                        </div>
                      </div>


                      <div class="card accordion-item">
                        <h2 class="accordion-header">
                          <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#accordionPayment-7"
                            aria-controls="accordionPayment-7">
                            7. Will somebody from the specialized group help us in coordination?
                          </button>
                        </h2>
                        <div id="accordionPayment-7" class="accordion-collapse collapse">
                          <div class="accordion-body">
                            We have dedicated Merchant Support Team (merchantsupport@tesspayments.com) that is fully equipped with all the technical knowledge to guide you through the Integration process, if required.
                          </div>
                        </div>
                      </div>


                      <div class="card accordion-item">
                        <h2 class="accordion-header">
                          <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#accordionPayment-8"
                            aria-controls="accordionPayment-8">
                            8. Are there any framework requirements that a Merchant should have to utilize TESS Payments?
                          </button>
                        </h2>
                        <div id="accordionPayment-8" class="accordion-collapse collapse">
                          <div class="accordion-body">
                            TESS Payments supports Plug and Play Integration for the Merchants. There are no special requirements to Integrate with TESS Payments.
                          </div>
                        </div>
                      </div>

                      <div class="card accordion-item">
                        <h2 class="accordion-header">
                          <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#accordionPayment-9"
                            aria-controls="accordionPayment-9">
                            9. Would we be able to utilize API’s for credit/debit?
                          </button>
                        </h2>
                        <div id="accordionPayment-9" class="accordion-collapse collapse">
                          <div class="accordion-body">
                            Due to security reasons and to protect Customer’s Credit / Debit Card details, only redirection or plugin methods are allowed for Credit / Debit Card transactions.
                          </div>
                        </div>
                      </div>


                  </div>


                </div>
                <div class="tab-pane fade" id="delivery" role="tabpanel">
                  <div class="d-flex mb-4 gap-4 align-items-center">
                    <div class="avatar avatar-md">
                      <span class="avatar-initial bg-label-primary rounded">
                        <i class="ti ti-briefcase ti-30px"></i>
                      </span>
                    </div>
                    <div>
                      <h5 class="mb-0">
                        <span class="align-middle">Delivery</span>
                      </h5>
                      <span>Lorem ipsum, dolor sit amet.</span>
                    </div>
                  </div>
                  <div id="accordionDelivery" class="accordion">
                    <div class="card accordion-item active">
                      <h2 class="accordion-header">
                        <button
                          class="accordion-button"
                          type="button"
                          data-bs-toggle="collapse"
                          aria-expanded="true"
                          data-bs-target="#accordionDelivery-1"
                          aria-controls="accordionDelivery-1">
                          How would you ship my order?
                        </button>
                      </h2>

                      <div id="accordionDelivery-1" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                          For large products, we deliver your product via a third party logistics company offering
                          you the “room of choice” scheduled delivery service. For small products, we offer free
                          parcel delivery.
                        </div>
                      </div>
                    </div>

                    <div class="card accordion-item">
                      <h2 class="accordion-header">
                        <button
                          class="accordion-button collapsed"
                          type="button"
                          data-bs-toggle="collapse"
                          data-bs-target="#accordionDelivery-2"
                          aria-controls="accordionDelivery-2">
                          What is the delivery cost of my order?
                        </button>
                      </h2>
                      <div id="accordionDelivery-2" class="accordion-collapse collapse">
                        <div class="accordion-body">
                          The cost of scheduled delivery is $69 or $99 per order, depending on the destination
                          postal code. The parcel delivery is free.
                        </div>
                      </div>
                    </div>

                    <div class="card accordion-item">
                      <h2 class="accordion-header">
                        <button
                          class="accordion-button collapsed"
                          type="button"
                          data-bs-toggle="collapse"
                          data-bs-target="#accordionDelivery-4"
                          aria-controls="accordionDelivery-4">
                          What to do if my product arrives damaged?
                        </button>
                      </h2>
                      <div id="accordionDelivery-4" class="accordion-collapse collapse">
                        <div class="accordion-body">
                          We will promptly replace any product that is damaged in transit. Just contact our
                          <a href="javascript:void(0);">support team</a>, to notify us of the situation within 48
                          hours of product arrival.
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="cancellation" role="tabpanel">
                  <div class="d-flex mb-4 gap-4 align-items-center">
                    <div class="avatar avatar-md">
                      <span class="avatar-initial bg-label-primary rounded">
                        <i class="ti ti-rotate-clockwise-2 ti-30px"></i>
                      </span>
                    </div>
                    <div>
                      <h5 class="mb-0"><span class="align-middle">Cancellation & Return</span></h5>
                      <span>Lorem ipsum, dolor sit amet.</span>
                    </div>
                  </div>
                  <div id="accordionCancellation" class="accordion">
                    <div class="card accordion-item active">
                      <h2 class="accordion-header">
                        <button
                          class="accordion-button"
                          type="button"
                          data-bs-toggle="collapse"
                          aria-expanded="true"
                          data-bs-target="#accordionCancellation-1"
                          aria-controls="accordionCancellation-1">
                          Can I cancel my order?
                        </button>
                      </h2>

                      <div id="accordionCancellation-1" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                          <p>
                            Scheduled delivery orders can be cancelled 72 hours prior to your selected delivery date
                            for full refund.
                          </p>
                          <p class="mb-0">
                            Parcel delivery orders cannot be cancelled, however a free return label can be provided
                            upon request.
                          </p>
                        </div>
                      </div>
                    </div>

                    <div class="card accordion-item">
                      <h2 class="accordion-header">
                        <button
                          class="accordion-button collapsed"
                          type="button"
                          data-bs-toggle="collapse"
                          data-bs-target="#accordionCancellation-2"
                          aria-controls="accordionCancellation-2">
                          Can I return my product?
                        </button>
                      </h2>
                      <div id="accordionCancellation-2" class="accordion-collapse collapse">
                        <div class="accordion-body">
                          You can return your product within 15 days of delivery, by contacting our
                          <a href="javascript:void(0);">support team</a>, All merchandise returned must be in the
                          original packaging with all original items.
                        </div>
                      </div>
                    </div>

                    <div class="card accordion-item">
                      <h2 class="accordion-header">
                        <button
                          class="accordion-button collapsed"
                          type="button"
                          data-bs-toggle="collapse"
                          aria-controls="accordionCancellation-3"
                          data-bs-target="#accordionCancellation-3">
                          Where can I view status of return?
                        </button>
                      </h2>
                      <div id="accordionCancellation-3" class="accordion-collapse collapse">
                        <div class="accordion-body">
                          <p>Locate the item from Your <a href="javascript:void(0);">Orders</a></p>
                          <p class="mb-0">Select <span class="fw-medium">Return/Refund</span> status</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="orders" role="tabpanel">
                  <div class="d-flex mb-4 gap-4 align-items-center">
                    <div class="avatar avatar-md">
                      <span class="avatar-initial bg-label-primary rounded">
                        <i class="ti ti-box ti-30px"></i>
                      </span>
                    </div>
                    <div>
                      <h5 class="mb-0">
                        <span class="align-middle">My Orders</span>
                      </h5>
                      <span>Lorem ipsum, dolor sit amet.</span>
                    </div>
                  </div>
                  <div id="accordionOrders" class="accordion">
                    <div class="card accordion-item active">
                      <h2 class="accordion-header">
                        <button
                          class="accordion-button"
                          type="button"
                          data-bs-toggle="collapse"
                          aria-expanded="true"
                          data-bs-target="#accordionOrders-1"
                          aria-controls="accordionOrders-1">
                          Has my order been successful?
                        </button>
                      </h2>

                      <div id="accordionOrders-1" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                          <p>
                            All successful order transactions will receive an order confirmation email once the
                            order has been processed. If you have not received your order confirmation email within
                            24 hours, check your junk email or spam folder.
                          </p>
                          <p class="mb-0">
                            Alternatively, log in to your account to check your order summary. If you do not have a
                            account, you can contact our Customer Care Team on
                            <span class="fw-medium">1-000-000-000</span>.
                          </p>
                        </div>
                      </div>
                    </div>

                    <div class="card accordion-item">
                      <h2 class="accordion-header">
                        <button
                          class="accordion-button collapsed"
                          type="button"
                          data-bs-toggle="collapse"
                          data-bs-target="#accordionOrders-2"
                          aria-controls="accordionOrders-2">
                          My Promotion Code is not working, what can I do?
                        </button>
                      </h2>
                      <div id="accordionOrders-2" class="accordion-collapse collapse">
                        <div class="accordion-body">
                          If you are having issues with a promotion code, please contact us at
                          <span class="fw-medium">1 000 000 000</span> for assistance.
                        </div>
                      </div>
                    </div>

                    <div class="card accordion-item">
                      <h2 class="accordion-header">
                        <button
                          class="accordion-button collapsed"
                          type="button"
                          data-bs-toggle="collapse"
                          data-bs-target="#accordionOrders-3"
                          aria-controls="accordionOrders-3">
                          How do I track my Orders?
                        </button>
                      </h2>
                      <div id="accordionOrders-3" class="accordion-collapse collapse">
                        <div class="accordion-body">
                          <p>
                            If you have an account just sign into your account from
                            <a href="javascript:void(0);">here</a> and select
                            <span class="fw-medium">“My Orders”</span>.
                          </p>
                          <p class="mb-0">
                            If you have a a guest account track your order from
                            <a href="javascript:void(0);">here</a> using the order number and the email address.
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="product" role="tabpanel">
                  <div class="d-flex mb-4 gap-4 align-items-center">
                    <div class="avatar avatar-md">
                      <span class="avatar-initial bg-label-primary rounded">
                        <i class="ti ti-camera ti-30px"></i>
                      </span>
                    </div>
                    <div>
                      <h5 class="mb-0">
                        <span class="align-middle">Product & Services</span>
                      </h5>
                      <span>Lorem ipsum, dolor sit amet.</span>
                    </div>
                  </div>
                  <div id="accordionProduct" class="accordion">
                    <div class="card accordion-item active">
                      <h2 class="accordion-header">
                        <button
                          class="accordion-button"
                          type="button"
                          data-bs-toggle="collapse"
                          aria-expanded="true"
                          data-bs-target="#accordionProduct-1"
                          aria-controls="accordionProduct-1">
                          Will I be notified once my order has shipped?
                        </button>
                      </h2>

                      <div id="accordionProduct-1" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                          Yes, We will send you an email once your order has been shipped. This email will contain
                          tracking and order information.
                        </div>
                      </div>
                    </div>

                    <div class="card accordion-item">
                      <h2 class="accordion-header">
                        <button
                          class="accordion-button collapsed"
                          type="button"
                          data-bs-toggle="collapse"
                          data-bs-target="#accordionProduct-2"
                          aria-controls="accordionProduct-2">
                          Where can I find warranty information?
                        </button>
                      </h2>
                      <div id="accordionProduct-2" class="accordion-collapse collapse">
                        <div class="accordion-body">
                          We are committed to quality products. For information on warranty period and warranty
                          services, visit our Warranty section <a href="javascript:void(0);">here</a>.
                        </div>
                      </div>
                    </div>

                    <div class="card accordion-item">
                      <h2 class="accordion-header">
                        <button
                          class="accordion-button collapsed"
                          type="button"
                          data-bs-toggle="collapse"
                          data-bs-target="#accordionProduct-3"
                          aria-controls="accordionProduct-3">
                          How can I purchase additional warranty coverage?
                        </button>
                      </h2>
                      <div id="accordionProduct-3" class="accordion-collapse collapse">
                        <div class="accordion-body">
                          For the peace of your mind, we offer extended warranty plans that add additional year(s)
                          of protection to the standard manufacturer’s warranty provided by us. To purchase or find
                          out more about the extended warranty program, visit Extended Warranty section
                          <a href="javascript:void(0);">here</a>.
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /FAQ's -->
          </div>

          <!-- Contact -->
          <div class="row my-6">
            <div class="col-12 text-center my-6">
              <div class="badge bg-label-primary">Question?</div>
              <h4 class="my-2">You still have a question?</h4>
              <p class="mb-0">
                If you can't find question in our FAQ, you can contact us. We'll answer you shortly!
              </p>
            </div>
          </div>
          <div class="row justify-content-center gap-sm-0 gap-6">
            <div class="col-sm-6">
              <div class="py-6 rounded bg-faq-section d-flex align-items-center flex-column">
                <div class="avatar avatar-md">
                  <span class="avatar-initial bg-label-primary rounded">
                    <i class="ti ti-phone ti-26px"></i>
                  </span>
                </div>
                <h5 class="mt-4 mb-1"><a class="text-heading" href="tel:+(1)25482568">+(1) 2548 2568</a></h5>
                <p class="mb-0">We are always happy to help</p>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="py-6 rounded bg-faq-section d-flex align-items-center flex-column">
                <div class="avatar avatar-md">
                  <span class="avatar-initial bg-label-primary rounded">
                    <i class="ti ti-mail ti-26px"></i>
                  </span>
                </div>
                <h5 class="mt-4 mb-1"><a class="text-heading" href="mailto:help@help.com">help@help.com</a></h5>
                <p class="mb-0">Best way to get a quick answer</p>
              </div>
            </div>
          </div>
          <!-- /Contact -->
        </div>
        <!-- / Content -->



        <div class="content-backdrop fade"></div>
      </div>

@endsection
