const resultsBody = document.getElementById('results');
const summaryDiv = document.getElementById('summary');
const searchInput = document.getElementById('search');
const addForm = document.getElementById('addForm');
const formError = document.getElementById('formError');

function renderMovies(movies) {
    resultsBody.innerHTML = '';
    movies.forEach(movie => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${escapeHtml(movie.title)}</td>
            <td>${escapeHtml(movie.director)}</td>
            <td>${escapeHtml(String(movie.year))}</td>
            <td>${escapeHtml(movie.genre)}</td>
            <td>${escapeHtml(String(movie.rating))}</td>
        `;
        resultsBody.appendChild(row);
    });

    updateSummary(movies);
}

function updateSummary(movies) {
    if (movies.length === 0) {
        summaryDiv.textContent = 'Фільмів не знайдено';
        return;
    }
    const avg = movies.reduce((sum, m) => sum + parseFloat(m.rating), 0) / movies.length;
    summaryDiv.textContent = `Фільмів: ${movies.length}, середній рейтинг: ${avg.toFixed(2)}`;
}

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

async function loadMovies(query = '') {
    try {
        const response = await fetch('api_list.php?q=' + encodeURIComponent(query));
        if (!response.ok) {
            throw new Error('Помилка сервера');
        }
        const movies = await response.json();
        renderMovies(movies);
    } catch (error) {
        summaryDiv.textContent = 'Не вдалося завантажити список фільмів';
        console.error(error);
    }
}

// Крок 3: завантаження списку при відкритті сторінки
loadMovies();

// Крок 4: живий пошук
searchInput.addEventListener('input', () => {
    loadMovies(searchInput.value);
});

// Крок 6: додавання через AJAX
addForm.addEventListener('submit', async (event) => {
    event.preventDefault();
    formError.textContent = '';

    const payload = {
        title: document.getElementById('title').value,
        director: document.getElementById('director').value,
        year: document.getElementById('year').value,
        genre: document.getElementById('genre').value,
        rating: document.getElementById('rating').value,
    };

    try {
        const response = await fetch('api_add.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload),
        });

        const data = await response.json();

        if (!response.ok) {
            formError.textContent = (data.errors || ['Невідома помилка']).join(', ');
            return;
        }

        addForm.reset();
        loadMovies(searchInput.value);
    } catch (error) {
        formError.textContent = 'Не вдалося з\'єднатися з сервером';
        console.error(error);
    }
});