<footer class="footer py-4  ">
  <div class="container-fluid">
    <div class="row align-items-center justify-content-lg-between">
      <div class="col-lg-12">
        <!-- <ul class="nav nav-footer justify-content-center justify-content-lg-end">
        <li class="nav-item">
            <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">About Us</a>
          </li> <li class="nav-item">
            <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">Services</a>
          </li> <li class="nav-item">
            <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">Contact</a>
          </li>
          <li class="nav-item">
            <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">About</a>
          </li>
        </ul> -->
      </div>
    </div>
  </div>
</footer>
</div>
</main>
<script src="./assets/js/jquery-3.7.0.min.js"></script>
<script src="./assets/js/core/bootstrap.bundle.min.js" ></script>
<script src="./assets/js/perfect-scrollbar.min.js" ></script>
<script src="./assets/js/smooth-scrollbar.min.js" ></script>


<!-- Sweet Alert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="./assets/js/custom.js"></script>

<!-- Alertify ja -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<script>

  <?php if(isset($_SESSION['message'])) { ?>
  alertify.set('notifier','position', 'top-right');
  alertify.success('<?= $_SESSION['message']; ?>');
  <?php 
   unset($_SESSION['message']);
   } 
  ?>

</script>
</body>
</html>