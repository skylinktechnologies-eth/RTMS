<!DOCTYPE html>
<html lang="en">
    @include('Frames.head')
  <body>
    <div class="container-scroller">
     
      <!-- partial:partials/_navbar.html -->
      @include('Frames.navbar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        @include('Frames.sidebar')
        <!-- partial -->
        <div class="main-panel">
        
          <div class="content-wrapper">
           
            @yield('content')

          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          @include('Frames.footer')
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('Frames.script')
  </body>
</html>