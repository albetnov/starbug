 <!-- Footer -->
 <footer class="content-footer footer bg-footer-theme">
     <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
         <div class="mb-2 mb-md-0">
             ©
             <script>
                 document.write(new Date().getFullYear());
             </script>
             {{ $appName }} using
             StarBug by
             <a href="https://github.com/albetnov" target="_blank" class="footer-link fw-bolder">Albet Novendo</a>
         </div>
         <div>
             <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>

             <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" target="_blank"
                 class="footer-link me-4">Support</a>
         </div>
     </div>
 </footer>
 <!-- / Footer -->

 <div class="content-backdrop fade"></div>
 </div>
 <!-- Content wrapper -->
 </div>
 <!-- / Layout page -->
 </div>

 <!-- Overlay -->
 <div class="layout-overlay layout-menu-toggle"></div>
 </div>
 <!-- / Layout wrapper -->

 <!-- Core JS -->
 <!-- build:js assets/vendor/js/core.js -->
 <script src="{{ asset('assets/admin') }}/vendor/libs/jquery/jquery.js"></script>
 <script src="{{ asset('assets/admin') }}/vendor/libs/popper/popper.js"></script>
 <script src="{{ asset('assets/admin') }}/vendor/js/bootstrap.js"></script>
 <script src="{{ asset('assets/admin') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

 <script src="{{ asset('assets/admin') }}/vendor/js/menu.js"></script>
 <!-- endbuild -->


 <!-- Main JS -->
 <script src="{{ asset('assets/admin') }}/js/main.js"></script>

 <!-- Page JS -->

 <!-- Place this tag in your head or just before your close body tag. -->
 <script async defer src="https://buttons.github.io/buttons.js"></script>

 <!-- Vendor JS -->
 <script src="{{ asset('assets/vendor/toastify-js/src/toastify.js') }}"></script>
 <script>
     @if (session('toast'))
         Toastify({
         close: true,
         text: "{{ session('message') }}",
         stopOnFocus: true,
         duration: 3000,
         style: {
         @if (session('toast') == 'success')
             background: "linear-gradient(to right, #00b09b, #96c93d)"
         @elseif(session('toast') == 'error')
             background: "linear-gradient(to right, #fc1e43, #ed0028)"
         @else
             background: "linear-gradient(ro right, #75cdff, #00a1fc)"
         @endif
         }
         }).showToast();
     @endif
 </script>
 @stack('scripts')
 </body>

 </html>
