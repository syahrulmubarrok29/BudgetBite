/**
 * Resep Syaben - Search Functionality
 * Menggunakan Fetch API untuk komunikasi dengan backend
 */

class RecipeSearch {
    constructor() {
        this.apiBaseUrl = '/api/recipes';
        this.initElements();
        this.initEventListeners();
    }

    /**
     * Inisialisasi elemen DOM
     */
    initElements() {
        this.form = document.getElementById('searchForm');
        this.budgetInput = document.getElementById('maxBudget');
        this.budgetSlider = document.getElementById('budgetSlider');
        this.budgetDisplay = document.getElementById('budgetDisplay');
        this.categorySelect = document.getElementById('categorySelect');
        this.resultsContainer = document.getElementById('resultsContainer');
        this.loadingIndicator = document.getElementById('loadingIndicator');
        this.noResults = document.getElementById('noResults');
        this.errorMessage = document.getElementById('errorMessage');
    }

    /**
     * Inisialisasi event listeners
     */
    initEventListeners() {
        // Sync slider dengan number input
        this.budgetSlider.addEventListener('input', (e) => {
            this.budgetInput.value = e.target.value;
            this.updateBudgetDisplay(e.target.value);
        });

        this.budgetInput.addEventListener('input', (e) => {
            this.budgetSlider.value = e.target.value;
            this.updateBudgetDisplay(e.target.value);
        });

        // Submit form
        this.form.addEventListener('submit', (e) => {
            e.preventDefault();
            this.searchRecipes();
        });
    }

    /**
     * Update tampilan budget
     */
    updateBudgetDisplay(value) {
        const formatted = this.formatRupiah(parseInt(value) || 0);
        this.budgetDisplay.textContent = formatted;
    }

    /**
     * Format angka ke Rupiah
     */
    formatRupiah(amount) {
        return 'Rp ' + amount.toLocaleString('id-ID');
    }

    /**
     * Main function: Pencarian resep berdasarkan budget
     */
    async searchRecipes() {
        const maxBudget = parseInt(this.budgetInput.value);
        const categoryId = this.categorySelect.value;

        // Validasi input
        if (!maxBudget || maxBudget <= 0) {
            alert('Masukkan budget yang valid!');
            return;
        }

        // Tampilkan loading, sembunyikan hasil sebelumnya
        this.showLoading();
        this.hideResults();
        this.hideError();

        try {
            // Build query parameters
            const params = new URLSearchParams();
            params.append('max_budget', maxBudget);
            if (categoryId) {
                params.append('category_id', categoryId);
            }

            // Fetch data dari backend
            const response = await fetch(`${this.apiBaseUrl}/search?${params.toString()}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const result = await response.json();

            // Tampilkan hasil
            if (result.success && result.data.length > 0) {
                this.renderRecipes(result.data);
            } else {
                this.showNoResults();
            }

        } catch (error) {
            console.error('Error searching recipes:', error);
            this.showError();
        } finally {
            this.hideLoading();
        }
    }

    /**
     * Render recipes ke dalam card UI
     */
    renderRecipes(recipes) {
        this.resultsContainer.innerHTML = '';

        recipes.forEach(recipe => {
            const card = this.createRecipeCard(recipe);
            this.resultsContainer.appendChild(card);
        });

        this.resultsContainer.classList.remove('hidden');
    }

    /**
     * Buat elemen card untuk satu resep
     */
    createRecipeCard(recipe) {
        const card = document.createElement('div');
        card.className = 'recipe-card';

        // Image atau placeholder
        const imageHtml = recipe.image_url 
            ? `<img src="${recipe.image_url}" alt="${recipe.title}" class="recipe-card-image">`
            : `<div class="recipe-card-image-placeholder">🍽️</div>`;

        // List ingredients
        const ingredientsList = recipe.ingredients.map(ing => 
            `<li>• ${ing.name} (${ing.quantity} ${ing.unit}) - ${this.formatRupiah(ing.total_price)}</li>`
        ).join('');

        card.innerHTML = `
            ${imageHtml}
            <div class="recipe-card-body">
                <h3 class="recipe-card-title">${recipe.title}</h3>
                <span class="recipe-card-category">${recipe.category.name}</span>
                <div class="recipe-card-price">
                    <span>💰</span>
                    <span>Total: ${this.formatRupiah(recipe.total_price)}</span>
                </div>
                <div class="recipe-card-ingredients">
                    <h4>Bahan-bahan:</h4>
                    <ul>${ingredientsList}</ul>
                </div>
            </div>
        `;

        return card;
    }

    /**
     * Tampilkan loading indicator
     */
    showLoading() {
        this.loadingIndicator.classList.remove('hidden');
    }

    /**
     * Sembunyikan loading indicator
     */
    hideLoading() {
        this.loadingIndicator.classList.add('hidden');
    }

    /**
     * Tampilkan pesan tidak ada hasil
     */
    showNoResults() {
        this.noResults.classList.remove('hidden');
    }

    /**
     * Sembunyikan hasil
     */
    hideResults() {
        this.resultsContainer.classList.add('hidden');
        this.noResults.classList.add('hidden');
    }

    /**
     * Tampilkan pesan error
     */
    showError() {
        this.errorMessage.classList.remove('hidden');
    }

    /**
     * Sembunyikan pesan error
     */
    hideError() {
        this.errorMessage.classList.add('hidden');
    }
}

// Inisialisasi saat DOM ready
document.addEventListener('DOMContentLoaded', () => {
    window.recipeSearch = new RecipeSearch();
});