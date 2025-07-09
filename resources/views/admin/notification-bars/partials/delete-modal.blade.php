<div class="modal fade" id="deleteNotificationBarModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white">Delete Notification Bar</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross text-white"></em>
                </a>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the notification bar <strong
                        id="delete-notification-title"></strong>?</p>
                <p class="text-danger"><strong>This action cannot be undone and will also delete all associated column
                        data and images.</strong></p>

                <form action="" method="POST" id="deleteNotificationBarForm">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
            <div class="modal-footer bg-light">
                <div class="d-flex justify-content-between w-100">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger submit-btn" id="confirmDeleteNotificationBtn">
                        <span class="spinner d-none">
                            <em class="spinner-border spinner-border-sm"></em>&nbsp;
                        </span>
                        <span class="btn-text">Delete</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle delete button clicks
        document.addEventListener('click', function(e) {
            if (e.target.closest('.delete-notification-button')) {
                const btn = e.target.closest('.delete-notification-button');
                const id = btn.getAttribute('data-id');
                const name = btn.getAttribute('data-name');
                const deleteUrl = btn.getAttribute('data-delete-url');

                document.getElementById('delete-notification-title').textContent = name;
                document.getElementById('deleteNotificationBarForm').action = deleteUrl;
            }
        });

        // Handle confirm delete
        document.getElementById('confirmDeleteNotificationBtn').addEventListener('click', function() {
            const btn = this;
            btn.disabled = true;
            btn.querySelector('.spinner').classList.remove('d-none');
            btn.querySelector('.btn-text').textContent = 'Deleting...';

            document.getElementById('deleteNotificationBarForm').submit();
        });
    });
</script>
