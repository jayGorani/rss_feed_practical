<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
    echo $header;
?>
    <div class="main-container">
        <div class="import-card">
            <div class="card-header-custom">
                <i class="bi bi-cloud-download"></i>
                <h2>Import RSS Feed</h2>
            </div>
            <div class="card-body-custom">
                <form id="importForm" action="<?php echo base_url('rss_feeds/import_feed_data'); ?>" method="post">
                    <div class="mb-4">
                        <label for="rssUrl" class="form-label">
                            <i class="bi bi-link-45deg"></i> RSS Feed URL
                        </label>
                        <input
                            type="url"
                            class="form-control"
                            id="rssUrl"
                            placeholder="https://xyz.com/feed"
                            required
                            name="feed_url"
                        >
                    </div>

                    <div class="mb-4">
                        <label for="sortMode" class="form-label">
                            <i class="bi bi-sort-down"></i> Sort Mode
                        </label>
                        <select class="form-select" id="sortMode" name="sorting_order">
                            <option value="asc" selected>ASC (Oldest → Newest)</option>
                            <option value="desc">DESC (Newest → Oldest)</option>
                        </select>
                    </div>

                    <div class="button-group">
                        <button type="submit" class="btn btn-custom btn-import">
                            <span><i class="bi bi-download"></i> Import Feed</span>
                        </button>
                        <button type="button" class="btn btn-custom btn-view" onclick="window.location.href='<?php echo base_url('rss_feeds/feed_list'); ?>'">
                            <span><i class="bi bi-eye"></i> View Posts</span>
                        </button>
                    </div>
                </form>

                <div class="info-box">
                    <h5><i class="bi bi-info-circle"></i> How It Works</h5>
                    <p>
                        This tool will fetch RSS items, calculate character count (including emoji),
                        assign priorities based on sort order, and store them in the database for scheduling.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<?php echo $footer; ?>