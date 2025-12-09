<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
    echo $header;
?>

   <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        }
        body {
            background: linear-gradient(135deg, #e0c3fc 0%, #8ec5fc 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar {
            background: var(--primary-gradient) !important;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
            transition: transform 0.3s ease;
        }
        .navbar-brand:hover {
            transform: scale(1.05);
        }
        .nav-link {
            color: rgba(255,255,255,0.9) !important;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
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
        .dashboard-header {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1.5rem;
            animation: fadeInDown 0.6s ease;
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
        .dashboard-header h1 {
            margin: 0;
            font-weight: 700;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .filter-section {
            background: white;
            border-radius: 20px;
            padding: 1.5rem 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
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
        .filter-section label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .form-select {
            border-radius: 12px;
            border: 2px solid #e0e0e0;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            font-weight: 500;
            background-color: #f8f9fa;
        }
        .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.15);
            transform: translateY(-2px);
            background-color: white;
        }
        .filter-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0.5rem 1.25rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.95rem;
            animation: bounceIn 0.6s ease;
        }
        @keyframes bounceIn {
            0% {
                opacity: 0;
                transform: scale(0.3);
            }
            50% {
                opacity: 1;
                transform: scale(1.05);
            }
            70% {
                transform: scale(0.9);
            }
            100% {
                transform: scale(1);
            }
        }
        .btn-back {
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            border: none;
            background: var(--success-gradient);
            color: white;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-back:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(17, 153, 142, 0.3);
        }
        .posts-container {
            display: grid;
            gap: 1.5rem;
        }
        .post-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: all 0.4s ease;
            animation: fadeInUp 0.6s ease;
            position: relative;
            overflow: hidden;
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
        .post-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: var(--primary-gradient);
        }
        .post-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }
        .post-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .priority-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            font-weight: 700;
            font-size: 1.25rem;
            background: var(--primary-gradient);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }
        .post-date {
            color: #7f8c8d;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: #f8f9fa;
            padding: 0.5rem 1rem;
            border-radius: 20px;
        }
        .post-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 1rem;
            line-height: 1.5;
        }
        .post-excerpt {
            color: #546e7a;
            line-height: 1.7;
            margin-bottom: 1.5rem;
        }
        .post-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            padding-top: 1.5rem;
            border-top: 2px solid #f0f0f0;
        }
        .platform-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        .platform-tag {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.813rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }
        .platform-tag:hover {
            transform: scale(1.05);
        }
        .platform-facebook {
            background: linear-gradient(135deg, #4267B2 0%, #3b5998 100%);
            color: white;
        }
        .platform-linkedin {
            background: linear-gradient(135deg, #0077b5 0%, #006396 100%);
            color: white;
        }
        .platform-tiktok {
            background: linear-gradient(135deg, #ff0050 0%, #d00042 100%);
            color: white;
        }
        .platform-instagram {
            background: linear-gradient(135deg, #f58529 0%, #e4405f 100%);
            color: white;
        }
        .platform-threads {
            background: linear-gradient(135deg, #000000 0%, #333333 100%);
            color: white;
        }
        .char-count {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0.5rem 1.25rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.875rem;
        }
        .action-buttons {
            display: flex;
            gap: 0.75rem;
        }
        .action-btn {
            padding: 0.6rem 1.25rem;
            border-radius: 10px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
            font-size: 0.875rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-manage {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .btn-manage:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }
        .pagination-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 2.5rem;
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
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            animation: fadeIn 0.6s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
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
        @media (max-width: 768px) {
            .dashboard-header {
                text-align: center;
            }
            .post-header {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            .post-footer {
                flex-direction: column;
            }
            .action-buttons {
                width: 100%;
                flex-direction: column;
            }
            .action-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    <div class="main-container">
        <div class="dashboard-header">
            <h1>
                <i class="bi bi-grid-3x3-gap"></i>
                Social Media Dashboard
            </h1>
            <button class="btn-back" onclick="window.location.href='<?php echo base_url('rss_feeds'); ?>'">
                <i class="bi bi-cloud-download"></i> Import New RSS
            </button>
        </div>

        <div class="filter-section">
            <div class="row align-items-end">
                <div class="col-md-6">
                    <label for="platformFilter">
                        <i class="bi bi-filter"></i> Filter by Social Platform
                    </label>
                    <select class="form-select" id="platformFilter" onchange="filterPosts()">
                        <option value="0">All Platforms</option>
                        <?php foreach($available_platforms as $platform) { ?>
                            <option value="<?php echo $platform['platform_id']; ?>">
                                <?php echo htmlspecialchars($platform['platfrom_name']); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-6 mt-3 mt-md-0">
                    <span class="filter-badge" id="filterBadge">
                        <i class="bi bi-info-circle"></i>
                        Showing posts for: All Platforms
                    </span>
                </div>
            </div>
        </div>

        <div class="posts-container" id="postsContainer"></div>

        <div class="pagination-container">
            <nav id="paginationLinks"></nav>
        </div>

        <div class="empty-state" id="emptyState" style="display: none;">
            <i class="bi bi-inbox"></i>
            <h3>No Posts Found</h3>
            <p>No posts found for the selected platform filter.</p>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>

        function filterPosts() {
            $("#filterBadge").text("");
            let selected_platform_text = $('#platformFilter option:selected').text();
            $("#filterBadge").html("<i class='bi bi-info-circle'></i> Showing posts for: " + selected_platform_text);
            loadFeeds(1);
        }

        document.querySelectorAll('.pagination .page-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                if (!this.parentElement.classList.contains('disabled') &&
                    !this.parentElement.classList.contains('active')) {
                    document.querySelectorAll('.pagination .page-item').forEach(item => {
                        item.classList.remove('active');
                    });
                    if (!isNaN(this.textContent.trim())) {
                        this.parentElement.classList.add('active');
                    }
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
            });
        });

        let currentPage = 1;

        function loadFeeds(page = 1) {

            let selected_platform = $('#platformFilter').val();
            $.post("<?= base_url('rss_feeds/rss_dashboard_ajax_list') ?>", {page: page,'platform' : selected_platform}, function(res) {

                if (!res.status) return;
                const templates = res.templates;
                let html = "";
                const posts = res.data;

                posts.forEach(p => {
                    const platforms = (p.tagged_platform || "")
                            .split(',')
                            .map(x => x.trim())
                            .filter(x => x !== "");

                    const platformHTML = platforms
                        .map(id => templates[id] ? templates[id] : "")
                        .join("");

                    html += `
                        <div class="post-card">
                            <div class="post-header">
                                <span class="priority-badge">#${p.priority}</span>
                                <div class="post-date">
                                    <i class="bi bi-calendar-event"></i>
                                    ${p.pub_date}
                                </div>
                            </div>

                            <h2 class="post-title">${p.title}</h2>

                            <p class="post-excerpt">
                                ${p.content.substring(0, 120)}...
                            </p>

                            <div class="post-footer">
                                <div class="platform-tags">${platformHTML}
                                </div>
                                <div>
                                    <span class="char-count">
                                        <i class="bi bi-file-text"></i> ${p.char_count} chars
                                    </span>
                                </div>
                            </div>
                        </div>
                    `;
                });

                $("#postsContainer").html(html);
                $("#paginationLinks").html(res.pagination);

                const totalPages = Math.ceil(res.total / res.limit);

                $("#currentPage").text(`Page ${res.page} of ${totalPages}`);

                $("#prevPage").prop("disabled", res.page <= 1);
                $("#nextPage").prop("disabled", res.page >= totalPages);

                currentPage = res.page;
            }, "json");
        }

        loadFeeds(1);

        $(document).on("click", ".ajax-page", function (e) {
            e.preventDefault();
            let page = $(this).data("page");
            loadFeeds(page);
        });

    </script>

<?php echo $footer; ?>

