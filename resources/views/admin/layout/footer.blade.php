<!-- partial:partials/_footer.html -->
<footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
            Copyright © <span id="currentYear"></span>. All rights reserved.
        </span>
    </div>
</footer>

<script>
    // Update the year dynamically
    document.getElementById('currentYear').textContent = new Date().getFullYear();
</script>