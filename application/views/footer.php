</div>

<script>

    function showMsg(type, message) {
        if (type === "error") type = "danger";
        let alertHtml = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        $('#flash-messages').append(alertHtml);
        setTimeout(function () {
            $('#flash-messages .alert').first().alert('close');
        }, 5000);
    }

</script>

<footer class="text-center mt-5 mb-3">
    <small>© <?php echo date('Y'); ?> RSS Manager — All rights reserved.</small>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
