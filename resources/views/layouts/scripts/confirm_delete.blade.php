<script>
    function confirmDelete(event, itemId) {
        if (!confirm('Are you sure you want to delete this product?')) {
            event.preventDefault();
        }
    }
</script>
