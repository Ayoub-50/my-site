<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مشاهدة - سينما</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-primary: #0a0e17;
            --bg-secondary: #141824;
            --bg-card: #1a1f2e;
            --accent-primary: #e50914;
            --accent-secondary: #ff1744;
            --text-primary: #ffffff;
            --text-secondary: #b8bcc8;
            --text-muted: #6c7589;
            --border-color: #2a2f3e;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Cairo', sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-secondary);
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 2rem;
            padding: 0.8rem 1.5rem;
            background: var(--bg-card);
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            background: var(--accent-primary);
            color: white;
            transform: translateX(5px);
        }

        .video-section {
            margin-bottom: 3rem;
        }

        .player-wrapper {
            position: relative;
            width: 100%;
            padding-top: 56.25%;
            background: #000;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.6);
        }

        .player-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        .content-info {
            background: var(--bg-card);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .content-header {
            display: flex;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .content-poster {
            width: 200px;
            border-radius: 10px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.4);
        }

        .content-details {
            flex: 1;
        }

        .content-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .content-meta {
            display: flex;
            gap: 2rem;
            margin-bottom: 1.5rem;
            color: var(--text-secondary);
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .rating {
            color: #ffd700;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .content-description {
            color: var(--text-secondary);
            line-height: 1.8;
            margin-bottom: 2rem;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
        }

        .btn {
            padding: 1rem 2rem;
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 700;
            font-family: 'Cairo', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(229, 9, 20, 0.4);
        }

        .btn-secondary {
            background: var(--bg-secondary);
            color: var(--text-primary);
            border: 1px solid var(--border-color);
        }

        .btn-secondary:hover {
            background: var(--bg-primary);
        }

        .seasons-section {
            background: var(--bg-card);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .seasons-tabs {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .season-tab {
            padding: 0.8rem 1.5rem;
            background: var(--bg-secondary);
            border: 2px solid var(--border-color);
            border-radius: 50px;
            color: var(--text-secondary);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .season-tab.active,
        .season-tab:hover {
            background: var(--accent-primary);
            color: white;
            border-color: var(--accent-primary);
        }

        .episodes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1.5rem;
        }

        .episode-card {
            background: var(--bg-secondary);
            border-radius: 10px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .episode-card:hover {
            transform: translateY(-5px);
            border-color: var(--accent-primary);
            box-shadow: 0 4px 16px rgba(229, 9, 20, 0.3);
        }

        .episode-thumbnail {
            width: 100%;
            aspect-ratio: 16/9;
            object-fit: cover;
            background: var(--bg-primary);
        }

        .episode-info {
            padding: 1rem;
        }

        .episode-number {
            font-size: 0.9rem;
            color: var(--text-muted);
            margin-bottom: 0.3rem;
        }

        .episode-title {
            font-weight: 600;
            font-size: 1rem;
        }

        .sources-section {
            background: var(--bg-card);
            border-radius: 15px;
            padding: 2rem;
        }

        .sources-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 1rem;
        }

        .source-card {
            background: var(--bg-secondary);
            padding: 1.5rem;
            border-radius: 10px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid var(--border-color);
        }

        .source-card:hover {
            background: var(--accent-primary);
            border-color: var(--accent-primary);
            transform: translateY(-3px);
        }

        .source-quality {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .source-name {
            font-size: 0.9rem;
            color: var(--text-secondary);
        }

        .loading {
            text-align: center;
            padding: 3rem;
            color: var(--text-muted);
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 4px solid var(--border-color);
            border-top-color: var(--accent-primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 1rem;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        @media (max-width: 768px) {
            .content-header {
                flex-direction: column;
            }

            .content-poster {
                width: 100%;
                max-width: 300px;
                margin: 0 auto;
            }

            .content-title {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.html" class="back-button">
            ← العودة للرئيسية
        </a>

        <div class="video-section">
            <div class="player-wrapper" id="playerWrapper">
                <div class="loading">
                    <div class="spinner"></div>
                    <p>جاري التحميل...</p>
                </div>
            </div>
        </div>

        <div class="content-info">
            <div class="content-header">
                <img src="" alt="" class="content-poster" id="contentPoster">
                <div class="content-details">
                    <h1 class="content-title" id="contentTitle">جاري التحميل...</h1>
                    <div class="content-meta">
                        <div class="meta-item">
                            <span class="rating">⭐</span>
                            <span id="contentRating">-</span>
                        </div>
                        <div class="meta-item">
                            <span>📅</span>
                            <span id="contentYear">-</span>
                        </div>
                        <div class="meta-item">
                            <span>🎬</span>
                            <span id="contentType">-</span>
                        </div>
                    </div>
                    <p class="content-description" id="contentDescription"></p>
                    <div class="action-buttons">
                        <button class="btn btn-primary" onclick="playVideo()">
                            ▶ تشغيل
                        </button>
                        <button class="btn btn-secondary" onclick="downloadContent()">
                            ⬇ تحميل
                        </button>
                        <button class="btn btn-secondary" onclick="shareContent()">
                            📤 مشاركة
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="seasons-section" id="seasonsSection" style="display: none;">
            <h2 class="section-title">المواسم والحلقات</h2>
            <div class="seasons-tabs" id="seasonsTabs"></div>
            <div class="episodes-grid" id="episodesGrid"></div>
        </div>

        <div class="sources-section" id="sourcesSection" style="display: none;">
            <h2 class="section-title">مصادر المشاهدة</h2>
            <div class="sources-grid" id="sourcesGrid"></div>
        </div>
    </div>

    <script>
        // Get URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const contentId = urlParams.get('id');
        const contentType = urlParams.get('type');
        let currentSeasonId = null;

        // API Base
        const API_BASE = 'api.php';

        // Load content details
        async function loadContentDetails() {
            try {
                const response = await fetch(`${API_BASE}?action=${contentType === 'movie' ? 'movie' : 'series'}_details&id=${contentId}`);
                const data = await response.json();

                if (data) {
                    document.getElementById('contentTitle').textContent = data.title || data.name;
                    document.getElementById('contentRating').textContent = data.rating || 'N/A';
                    document.getElementById('contentYear').textContent = data.year || 'N/A';
                    document.getElementById('contentType').textContent = contentType === 'movie' ? 'فيلم' : 'مسلسل';
                    document.getElementById('contentDescription').textContent = data.description || data.overview || 'لا يوجد وصف متاح';
                    document.getElementById('contentPoster').src = data.image || data.poster || '';

                    if (contentType === 'serie') {
                        await loadSeasons();
                    } else {
                        await loadMovieSources();
                    }
                }
            } catch (error) {
                console.error('Error loading content:', error);
            }
        }

        // Load movie sources
        async function loadMovieSources() {
            try {
                const response = await fetch(`${API_BASE}?action=movie_sources&id=${contentId}`);
                const sources = await response.json();

                if (sources && sources.length > 0) {
                    displaySources(sources);
                    loadPlayer(sources[0].url);
                }
            } catch (error) {
                console.error('Error loading sources:', error);
            }
        }

        // Load series seasons
        async function loadSeasons() {
            try {
                const response = await fetch(`${API_BASE}?action=seasons&id=${contentId}`);
                const seasons = await response.json();

                if (seasons && seasons.length > 0) {
                    document.getElementById('seasonsSection').style.display = 'block';
                    
                    const tabsContainer = document.getElementById('seasonsTabs');
                    tabsContainer.innerHTML = seasons.map((season, index) => `
                        <div class="season-tab ${index === 0 ? 'active' : ''}" onclick="loadEpisodes(${season.id}, this)">
                            الموسم ${season.season_number || (index + 1)}
                        </div>
                    `).join('');

                    if (seasons[0]) {
                        loadEpisodes(seasons[0].id);
                    }
                }
            } catch (error) {
                console.error('Error loading seasons:', error);
            }
        }

        // Load episodes for a season
        async function loadEpisodes(seasonId, tabElement) {
            currentSeasonId = seasonId;

            if (tabElement) {
                document.querySelectorAll('.season-tab').forEach(tab => tab.classList.remove('active'));
                tabElement.classList.add('active');
            }

            try {
                const response = await fetch(`${API_BASE}?action=episodes&season_id=${seasonId}`);
                const episodes = await response.json();

                const grid = document.getElementById('episodesGrid');
                
                if (episodes && episodes.length > 0) {
                    grid.innerHTML = episodes.map(episode => `
                        <div class="episode-card" onclick="loadEpisode(${episode.id})">
                            <img src="${episode.image || ''}" alt="الحلقة ${episode.episode_number}" class="episode-thumbnail" onerror="this.style.display='none'">
                            <div class="episode-info">
                                <div class="episode-number">الحلقة ${episode.episode_number || episode.id}</div>
                                <div class="episode-title">${episode.title || `الحلقة ${episode.episode_number}`}</div>
                            </div>
                        </div>
                    `).join('');
                }
            } catch (error) {
                console.error('Error loading episodes:', error);
            }
        }

        // Load episode
        async function loadEpisode(episodeId) {
            try {
                const response = await fetch(`${API_BASE}?action=episode_sources&id=${episodeId}`);
                const sources = await response.json();

                if (sources && sources.length > 0) {
                    displaySources(sources);
                    loadPlayer(sources[0].url);
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
            } catch (error) {
                console.error('Error loading episode:', error);
            }
        }

        // Display sources
        function displaySources(sources) {
            const sourcesSection = document.getElementById('sourcesSection');
            const sourcesGrid = document.getElementById('sourcesGrid');

            sourcesSection.style.display = 'block';
            
            sourcesGrid.innerHTML = sources.map((source, index) => `
                <div class="source-card" onclick="loadPlayer('${source.url}')">
                    <div class="source-quality">${source.quality || 'HD'}</div>
                    <div class="source-name">سيرفر ${index + 1}</div>
                </div>
            `).join('');
        }

        // Load player
        function loadPlayer(url) {
            const playerWrapper = document.getElementById('playerWrapper');
            
            // Check if it's an embed URL
            if (url.includes('/e/')) {
                playerWrapper.innerHTML = `<iframe src="${url}" allowfullscreen allow="autoplay"></iframe>`;
            } else {
                // Handle direct video URLs
                playerWrapper.innerHTML = `
                    <video controls autoplay style="width: 100%; height: 100%;">
                        <source src="${url}" type="video/mp4">
                        متصفحك لا يدعم تشغيل الفيديو
                    </video>
                `;
            }
        }

        // Action functions
        function playVideo() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function downloadContent() {
            alert('ميزة التحميل قيد التطوير');
        }

        function shareContent() {
            const url = window.location.href;
            if (navigator.share) {
                navigator.share({
                    title: document.getElementById('contentTitle').textContent,
                    url: url
                });
            } else {
                navigator.clipboard.writeText(url);
                alert('تم نسخ الرابط');
            }
        }

        // Initialize
        window.addEventListener('DOMContentLoaded', loadContentDetails);
    </script>
</body>
</html>
