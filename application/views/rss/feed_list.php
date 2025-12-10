<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

    echo $header;
?>

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --danger-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        body {
            background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background: var(--primary-gradient) !important;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
        }

        .nav-link {
            color: rgba(255,255,255,0.9) !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: white !important;
            transform: translateY(-2px);
        }

        .main-container {
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .page-header {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            animation: fadeInDown 0.6s ease;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            animation: fadeIn 0.6s ease;
            margin-top: 20px !important;
        }

        .empty-state i {
            font-size: 5rem;
            color: #667eea;
            margin-bottom: 1.5rem;
            opacity: 0.5;
        }
        .empty-state h3 {
            color: #495057;
            margin-bottom: 1rem;
        }
        .empty-state p {
            color: #7f8c8d;
            font-size: 1.1rem;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .page-header h1 {
            margin: 0;
            font-weight: 700;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .btn-custom {
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary-custom {
            background: var(--primary-gradient);
            color: white;
        }

        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .btn-success-custom {
            background: linear-gradient(135deg, #0cebeb 0%, #20e3b2 100%);
            color: white;
        }

        .btn-success-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(12, 235, 235, 0.3);
        }

        .info-text {
            background: linear-gradient(135deg, #fff5e6 0%, #ffe0b2 100%);
            border-left: 4px solid #ff9800;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            animation: slideInLeft 0.6s ease;
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .info-text i {
            color: #f57c00;
            font-size: 1.2rem;
        }

        .posts-table-container {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            animation: fadeInUp 0.6s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .table-responsive {
            border-radius: 12px;
            overflow: hidden;
        }

        .table {
            margin: 0;
        }

        .table thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .table thead th {
            border: none;
            padding: 1.25rem;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.875rem;
            letter-spacing: 0.5px;
        }

        .table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid #f0f0f0;
        }

        .table tbody tr:hover {
            background: #f8f9ff;
            transform: scale(1.01);
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .table tbody td {
            padding: 1.25rem;
            vertical-align: middle;
        }

        .priority-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            font-weight: 700;
            font-size: 1.1rem;
            background: var(--primary-gradient);
            color: white;
            box-shadow: 0 4px 10px rgba(102, 126, 234, 0.3);
        }

        .post-title {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        .post-date {
            color: #7f8c8d;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .char-count {
            display: inline-block;
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            color: #1565c0;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.875rem;
        }

        .platform-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .platform-tag {
            padding: 0.4rem 0.9rem;
            border-radius: 20px;
            font-size: 0.813rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .platform-facebook { background: #e3f2fd; color: #1877f2; }
        .platform-linkedin { background: #e1f5fe; color: #0077b5; }
        .platform-tiktok { background: #fce4ec; color: #ff0050; }
        .platform-instagram { background: #f3e5f5; color: #e4405f; }
        .platform-threads { background: #f1f8e9; color: #101010; }

        .action-btn {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
            font-size: 0.875rem;
        }

        .btn-edit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-delete {
            background: var(--danger-gradient);
            color: white;
        }

        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(245, 87, 108, 0.4);
        }

        .pagination-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 2rem;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .pagination-container .pagination {
            margin: 0;
            gap: 0.5rem;
        }

        .pagination .page-item .page-link {
            border: none;
            background: white;
            color: #667eea;
            font-weight: 600;
            padding: 0.75rem 1.25rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .pagination .page-item .page-link:hover {
            background: var(--primary-gradient);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        .pagination .page-item.active .page-link {
            background: var(--primary-gradient);
            color: white;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .pagination .page-item.disabled .page-link {
            background: #f0f0f0;
            color: #999;
            cursor: not-allowed;
        }

        .modal-content {
            border-radius: 20px;
            border: none;
            overflow: hidden;
        }

        .modal-header {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 1.5rem 2rem;
        }

        .modal-header h5 {
            font-weight: 700;
        }

        .modal-body {
            padding: 2rem;
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.75rem;
        }

        .form-control {
            border-radius: 12px;
            border: 2px solid #e0e0e0;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.15);
        }

        .form-check {
            padding: 0.75rem;
            margin-bottom: 0.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .form-check:hover {
            background: #f8f9ff;
        }

        .form-check-input {
            width: 1.5rem;
            height: 1.5rem;
            border: 2px solid #667eea;
        }

        .form-check-input:checked {
            background-color: #667eea;
            border-color: #667eea;
        }

        .form-check-label {
            font-weight: 500;
            margin-left: 0.5rem;
        }

        .alert-custom {
            border-radius: 12px;
            border: none;
            padding: 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .alert-danger {
            background: #ffebee;
            color: #c62828;
        }

        @media (max-width: 768px) {
            .page-header {
                text-align: center;
            }

            .table thead {
                display: none;
            }

            .table tbody tr {
                display: block;
                margin-bottom: 1rem;
                border-radius: 12px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            }

            .table tbody td {
                display: block;
                text-align: right;
                padding: 0.75rem;
                border: none;
            }

            .table tbody td::before {
                content: attr(data-label);
                float: left;
                font-weight: 600;
                color: #667eea;
            }
        }
    </style>

    <div class="main-container">
        <div class="page-header">
            <h1><i class="bi bi-file-earmark-text"></i> Posts Management</h1>
            <div>
                <button class="btn btn-custom btn-primary-custom" onclick="window.location.href='<?php echo base_url('rss_feeds'); ?>'">
                    <i class="bi bi-cloud-download"></i> Import New RSS
                </button>
                <button class="btn btn-custom btn-success-custom" onclick="window.location.href='<?php echo base_url('rss_feeds/dashboard'); ?>'">
                    <i class="bi bi-grid-3x3-gap"></i> Social Dashboard
                </button>
            </div>
        </div>

        <div class="info-text">
            <i class="bi bi-info-circle-fill"></i>
            <strong>Tip:</strong> Drag and drop rows to change priority. Top row becomes priority 1, next row priority 2, etc.
        </div>

        <div class="posts-table-container">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Priority</th>
                            <th>Title</th>
                            <th>Char Count</th>
                            <th>Social Platforms</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody id="postsBody"></tbody>

                </table>
            </div>

            <div class="empty-state" id="emptyState" style="display: none;">
                <i class="bi bi-inbox"></i>
                <h3>No Posts Found</h3>
                <p>No posts found for the be display.</p>
            </div>

            <div class="pagination-container">
                <nav id="paginationLinks"></nav>
            </div>

        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-pencil-square"></i> Edit Post Platforms</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <input type="hidden" id="edit_post_id" name="post_id" value="">
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <label class="form-label">Title</label>
                                <textarea class="form-control" rows="2" id="edit_title" name="title"></textarea>
                            </div>
                        </div>


                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-share"></i> Social Platforms</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" name="socaial_platform[]" type="checkbox" id="facebook" data-platform-id="1" value="1">
                                        <label class="form-check-label" for="facebook">
                                            <i class="bi bi-facebook"></i> Facebook
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" name="socaial_platform[]" type="checkbox" id="linkedin" data-platform-id="2" value="2">
                                        <label class="form-check-label" for="linkedin">
                                            <i class="bi bi-linkedin"></i> LinkedIn
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" name="socaial_platform[]"type="checkbox" id="tiktok" data-platform-id="3" value="3">
                                        <label class="form-check-label" for="tiktok">
                                            <i class="bi bi-tiktok"></i> TikTok
                                        </label>
                                    </div>

                                </div>
                                <div class="col-md-6">

                                    <div class="form-check">
                                        <input class="form-check-input" name="socaial_platform[]" type="checkbox" id="instagram" data-platform-id="4" value="4">
                                        <label class="form-check-label" for="instagram">
                                            <i class="bi bi-instagram"></i> Instagram
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" name="socaial_platform[]" type="checkbox" id="threads" data-platform-id="5" value="5">
                                        <label class="form-check-label" for="threads">
                                            <i class="bi bi-threads"></i> Threads
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" name="socaial_platform[]" type="checkbox" id="bluesky" data-platform-id="6" value="6">
                                        <label class="form-check-label" for="bluesky">
                                            <i class="bi bi-cloud"></i> Bluesky
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" name="socaial_platform[]" type="checkbox" id="x" checked data-platform-id="7" value="7">
                                        <label class="form-check-label" for="x">
                                            <i class="bi bi-twitter-x"></i> X
                                        </label>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="alert alert-custom alert-danger content_error" style="display: none";>
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <span id="maxlenghcontenterror"></span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Cancel
                    </button>
                    <button type="button" class="btn btn-custom btn-primary-custom" id="saveChangesBtn">
                        <i class="bi bi-check-circle"></i> Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <script>
        // Delete functionality
        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', function() {
                if(confirm('Are you sure you want to delete this post?')) {
                    this.closest('tr').remove();
                }
            });
        });

        // Pagination functionality
        document.querySelectorAll('.pagination .page-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                if (!this.parentElement.classList.contains('disabled') &&
                    !this.parentElement.classList.contains('active')) {

                    // Remove active class from all
                    document.querySelectorAll('.pagination .page-item').forEach(item => {
                        item.classList.remove('active');
                    });

                    // Add active to clicked item (if it's a number)
                    if (!isNaN(this.textContent.trim())) {
                        this.parentElement.classList.add('active');
                    }
                }
            });
        });


        let draggedElement = null;

        const rows = document.querySelectorAll('#postsTableBody tr');
        rows.forEach(row => {
            row.setAttribute('draggable', true);

            row.addEventListener('dragstart', function() {
                draggedElement = this;
                this.style.opacity = '0.5';
            });

            row.addEventListener('dragend', function() {
                this.style.opacity = '1';
            });

            row.addEventListener('dragover', function(e) {
                e.preventDefault();
            });

            row.addEventListener('drop', function(e) {
                e.preventDefault();
                if (draggedElement !== this) {
                    const tbody = document.getElementById('postsTableBody');
                    const allRows = [...tbody.querySelectorAll('tr')];
                    const draggedIndex = allRows.indexOf(draggedElement);
                    const targetIndex = allRows.indexOf(this);

                    if (draggedIndex < targetIndex) {
                        this.after(draggedElement);
                    } else {
                        this.before(draggedElement);
                    }

                    updatePriorities();
                }
            });
        });

        function updatePriorities() {
            const rows = document.querySelectorAll('#postsTableBody tr');
            rows.forEach((row, index) => {
                const badge = row.querySelector('.priority-badge');
                badge.textContent = index + 1;
            });
        }

        function loadFeeds(page = 1) {
            $.post("<?= base_url('rss_feeds/rss_ajax_list') ?>", {page: page}, function(res) {
                if (!res.status) {
                    $("#emptyState").show();
                    $("#postsContainer").html("");
                    $("#paginationLinks").html("");
                    return;
                }
                $("#emptyState").hide();

                let html = "";

                res.posts.forEach(post => {

                    let platformTags = '';
                    if(post.tagged_platform && typeof post.tagged_platform === 'string' && post.tagged_platform.trim() !== '') {
                        const keys = post.tagged_platform.split(',').map(k => k.trim()).filter(k => k);
                        keys.forEach(k => {
                            if(res.templates[k]) {
                                platformTags += res.templates[k];
                            }
                        });
                    }

                    html += `
                        <tr data-id="${post.id}">
                            <td data-label="Priority">
                                <span class="priority-badge">${post.priority}</span>
                            </td>
                            <td data-label="Title">
                                <div class="post-title">${post.title}</div>
                                <div class="post-date">
                                    <i class="bi bi-calendar-event"></i> ${post.pub_date}
                                </div>
                            </td>
                            <td data-label="Char Count">
                                <span class="char-count">${post.char_count} chars</span>
                            </td>
                            <td data-label="Social Platforms">
                                <div class="platform-tags">
                                    ${platformTags}
                                </div>
                            </td>
                            <td data-label="Actions">
                                <button class="action-btn btn-edit me-2 mb-2 editBtn" data-id="${post.id}">
                                    <i class="bi bi-pencil"></i> Edit
                                </button>
                                <button class="action-btn btn-delete deleteBtn mb-2" data-id="${post.id}">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                    `;
                });

                $("#postsBody").html(html);
                $("#paginationLinks").html(res.pagination);

                enableDragAndDrop();
            }, "json");
        }

        function enableDragAndDrop() {
            let draggedRow = null;

            $("#postsBody tr").attr("draggable", true);

            $("#postsBody tr").on("dragstart", function() {
                draggedRow = this;
                $(this).css("opacity", "0.5");
            });

            $("#postsBody tr").on("dragend", function() {
                $(this).css("opacity", "1");
            });

            $("#postsBody tr").on("dragover", function(e) {
                e.preventDefault();
            });

            $("#postsBody tr").on("drop", function(e) {
                e.preventDefault();
                if (draggedRow !== this) {
                    if ($(draggedRow).index() < $(this).index()) {
                        $(this).after(draggedRow);
                    } else {
                        $(this).before(draggedRow);
                    }
                }
                updatePriorities();
            });
        }

        function updatePriorities() {
            let newOrder = [];

            $("#postsBody tr").each(function(index) {
                $(this).find(".priority-badge").text(index + 1);
                newOrder.push({
                    id: $(this).data("id"),
                    priority: index + 1
                });
            });


            $.ajax({
                url: "<?= base_url('rss_feeds/update_priority_order') ?>",
                method: "POST",
                data: {order: JSON.stringify(newOrder)},
                success: function () {
                    console.log("Priority Saved");
                }
            });
        }

        loadFeeds(1);

        $(document).on("click", ".ajax-page", function (e) {
            e.preventDefault();
            let page = $(this).data("page");
            loadFeeds(page);
        });

        $(document).on("click", ".deleteBtn", function () {
            let id = $(this).data("id");
            if(confirm('Are you sure you want to delete this post?')) {
                $.post("<?= base_url('rss_feeds/delete/') ?>" + id, function (res) {
                    loadFeeds(1);
                });
            }
        });

        $(document).on("click", ".editBtn", function () {
            let id = $(this).data("id");
            $('#editForm .form-check-input').prop('checked', false);
            $.get("<?= base_url('rss_feeds/get/') ?>" + id, function (res) {
                res = JSON.parse(res);
                const post = res.data;
                $("#edit_post_id").val(post.id);
                $("#edit_title").val(post.title);
                if(post.tagged_platform && typeof post.tagged_platform === 'string' && post.tagged_platform.trim() !== '') {
                    post.tagged_platform.split(',').forEach(id => {
                        id = id.trim();
                        $('#editForm .form-check-input[data-platform-id="' + id + '"]').prop('checked', true);
                    });
                }
                $(".content_error").hide();
                $("#editModal").modal('show');
            });
        });


        $("#saveChangesBtn").click(function (e) {

            e.preventDefault();
            let max_twitter_limit = 280;

            const istwitterChecked = $('#editForm .form-check-input[data-platform-id="7"]').is(':checked');
            const text = $("#edit_title").val().trim();
            const length = text.length;

            $("#maxlenghcontenterror").empty();

            if (istwitterChecked && length > max_twitter_limit) {
                $("#maxlenghcontenterror").text(`This post has ${length} characters, which exceeds the ${max_twitter_limit} character limit for Twitter.`);
                $(".content_error").show();
                return false;
            }

            $.post("<?= base_url('rss_feeds/update') ?>",
                $("#editForm").serialize(),
                function (res) {
                    $("#editModal").modal('hide');
                    loadFeeds(1);
                },
            "json");
        });


    </script>

<?php echo $footer; ?>