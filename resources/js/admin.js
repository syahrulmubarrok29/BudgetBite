/**
 * Resep Syaben - Admin Dashboard JavaScript
 * Mengelola CRUD untuk Recipes, Categories, dan Ingredients
 */

class AdminDashboard {
    constructor() {
        this.apiBaseUrl = '/api/admin';
        this.currentSection = 'recipes';
        this.currentEditId = null;
        this.isEditMode = false;
        this.ingredientsCache = [];
        this.categoriesCache = [];
        
        this.init();
    }

    init() {
        this.initElements();
        this.initEventListeners();
        this.loadInitialData();
    }

    initElements() {
        // Navigation
        this.navItems = document.querySelectorAll('.nav-item');
        this.sections = document.querySelectorAll('.data-section');
        this.pageTitle = document.getElementById('pageTitle');
        this.addNewBtn = document.getElementById('addNewBtn');

        // Modal
        this.modalOverlay = document.getElementById('modalOverlay');
        this.modalTitle = document.getElementById('modalTitle');
        this.modalForm = document.getElementById('modalForm');
        this.formFields = document.getElementById('formFields');
        this.closeModal = document.getElementById('closeModal');
        this.cancelBtn = document.getElementById('cancelBtn');

        // Delete Modal
        this.deleteModal = document.getElementById('deleteModal');
        this.deleteMessage = document.getElementById('deleteMessage');
        this.cancelDelete = document.getElementById('cancelDelete');
        this.confirmDelete = document.getElementById('confirmDelete');

        // Tables
        this.recipesTableBody = document.getElementById('recipesTableBody');
        this.categoriesTableBody = document.getElementById('categoriesTableBody');
        this.ingredientsTableBody = document.getElementById('ingredientsTableBody');
    }

    initEventListeners() {
        // Navigation
        this.navItems.forEach(item => {
            item.addEventListener('click', (e) => {
                e.preventDefault();
                const section = item.dataset.section;
                this.switchSection(section);
            });
        });

        // Add New Button
        this.addNewBtn.addEventListener('click', () => this.openAddModal());

        // Modal
        this.closeModal.addEventListener('click', () => this.closeModalFunc());
        this.cancelBtn.addEventListener('click', () => this.closeModalFunc());
        this.modalOverlay.addEventListener('click', (e) => {
            if (e.target === this.modalOverlay) this.closeModalFunc();
        });

        // Delete Modal
        this.cancelDelete.addEventListener('click', () => this.closeDeleteModal());
        this.deleteModal.addEventListener('click', (e) => {
            if (e.target === this.deleteModal) this.closeDeleteModal();
        });

        // Form Submit
        this.modalForm.addEventListener('submit', (e) => {
            e.preventDefault();
            this.handleFormSubmit();
        });
    }

    async loadInitialData() {
        await Promise.all([
            this.loadRecipes(),
            this.loadCategories(),
            this.loadIngredients()
        ]);
    }

    switchSection(section) {
        this.currentSection = section;
        
        // Update nav active
        this.navItems.forEach(item => {
            item.classList.toggle('active', item.dataset.section === section);
        });

        // Update section visibility
        this.sections.forEach(sec => {
            sec.classList.toggle('active', sec.id === `${section}Section`);
        });

        // Update page title and button
        const titles = {
            recipes: 'Kelola Resep',
            categories: 'Kelola Kategori',
            ingredients: 'Kelola Bahan Baku'
        };
        this.pageTitle.textContent = titles[section];
    }

    // =====================
    // API Methods
    // =====================

    async loadRecipes() {
        try {
            const response = await fetch(`${this.apiBaseUrl}/recipes`);
            const result = await response.json();
            if (result.success) {
                this.renderRecipesTable(result.data);
            }
        } catch (error) {
            console.error('Error loading recipes:', error);
        }
    }

    async loadCategories() {
        try {
            const response = await fetch(`${this.apiBaseUrl}/categories`);
            const result = await response.json();
            if (result.success) {
                this.categoriesCache = result.data;
                this.renderCategoriesTable(result.data);
            }
        } catch (error) {
            console.error('Error loading categories:', error);
        }
    }

    async loadIngredients() {
        try {
            const response = await fetch(`${this.apiBaseUrl}/ingredients`);
            const result = await response.json();
            if (result.success) {
                this.ingredientsCache = result.data;
                this.renderIngredientsTable(result.data);
            }
        } catch (error) {
            console.error('Error loading ingredients:', error);
        }
    }

    // =====================
    // Render Methods
    // =====================

    formatRupiah(amount) {
        return 'Rp ' + (parseFloat(amount) || 0).toLocaleString('id-ID');
    }

    renderRecipesTable(recipes) {
        if (recipes.length === 0) {
            this.recipesTableBody.innerHTML = '<tr><td colspan="6" class="loading">Belum ada data resep</td></tr>';
            return;
        }

        this.recipesTableBody.innerHTML = recipes.map((recipe, index) => `
            <tr>
                <td>${index + 1}</td>
                <td>
                    ${recipe.image_url 
                        ? `<img src="${recipe.image_url}" alt="${recipe.title}" class="table-image">`
                        : `<div class="table-image-placeholder">🍽️</div>`
                    }
                </td>
                <td>${recipe.title}</td>
                <td>${recipe.category?.name || '-'}</td>
                <td>${this.formatRupiah(recipe.total_price)}</td>
                <td>
                    <button class="btn-action btn-edit" onclick="admin.editRecipe(${recipe.id})">Edit</button>
                    <button class="btn-action btn-delete" onclick="admin.deleteRecipe(${recipe.id})">Hapus</button>
                </td>
            </tr>
        `).join('');
    }

    renderCategoriesTable(categories) {
        if (categories.length === 0) {
            this.categoriesTableBody.innerHTML = '<tr><td colspan="5" class="loading">Belum ada data kategori</td></tr>';
            return;
        }

        this.categoriesTableBody.innerHTML = categories.map((category, index) => `
            <tr>
                <td>${index + 1}</td>
                <td>${category.name}</td>
                <td>${category.description || '-'}</td>
                <td>${category.recipes_count || 0}</td>
                <td>
                    <button class="btn-action btn-edit" onclick="admin.editCategory(${category.id})">Edit</button>
                    <button class="btn-action btn-delete" onclick="admin.deleteCategory(${category.id})">Hapus</button>
                </td>
            </tr>
        `).join('');
    }

    renderIngredientsTable(ingredients) {
        if (ingredients.length === 0) {
            this.ingredientsTableBody.innerHTML = '<tr><td colspan="5" class="loading">Belum ada data bahan</td></tr>';
            return;
        }

        this.ingredientsTableBody.innerHTML = ingredients.map((ingredient, index) => `
            <tr>
                <td>${index + 1}</td>
                <td>${ingredient.name}</td>
                <td>${ingredient.unit}</td>
                <td>${this.formatRupiah(ingredient.price_per_unit)}</td>
                <td>
                    <button class="btn-action btn-edit" onclick="admin.editIngredient(${ingredient.id})">Edit</button>
                    <button class="btn-action btn-delete" onclick="admin.deleteIngredient(${ingredient.id})">Hapus</button>
                </td>
            </tr>
        `).join('');
    }

    // =====================
    // Modal Methods
    // =====================

    openAddModal() {
        this.isEditMode = false;
        this.currentEditId = null;
        
        switch (this.currentSection) {
            case 'recipes':
                this.modalTitle.textContent = 'Tambah Resep Baru';
                this.renderRecipeForm();
                break;
            case 'categories':
                this.modalTitle.textContent = 'Tambah Kategori';
                this.renderCategoryForm();
                break;
            case 'ingredients':
                this.modalTitle.textContent = 'Tambah Bahan Baku';
                this.renderIngredientForm();
                break;
        }
        
        this.modalOverlay.classList.remove('hidden');
    }

    openEditModal(data) {
        this.isEditMode = true;
        
        switch (this.currentSection) {
            case 'recipes':
                this.modalTitle.textContent = 'Edit Resep';
                this.renderRecipeForm(data);
                break;
            case 'categories':
                this.modalTitle.textContent = 'Edit Kategori';
                this.renderCategoryForm(data);
                break;
            case 'ingredients':
                this.modalTitle.textContent = 'Edit Bahan Baku';
                this.renderIngredientForm(data);
                break;
        }
        
        this.modalOverlay.classList.remove('hidden');
    }

    closeModalFunc() {
        this.modalOverlay.classList.add('hidden');
        this.modalForm.reset();
    }

    // =====================
    // Form Renderers
    // =====================

    renderCategoryForm(data = null) {
        this.formFields.innerHTML = `
            <div class="form-group">
                <label for="name">Nama Kategori</label>
                <input type="text" id="name" name="name" value="${data?.name || ''}" required>
            </div>
            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea id="description" name="description">${data?.description || ''}</textarea>
            </div>
        `;
    }

    renderIngredientForm(data = null) {
        this.formFields.innerHTML = `
            <div class="form-group">
                <label for="name">Nama Bahan</label>
                <input type="text" id="name" name="name" value="${data?.name || ''}" required>
            </div>
            <div class="form-group">
                <label for="unit">Satuan (kg, gram, pcs, dll)</label>
                <input type="text" id="unit" name="unit" value="${data?.unit || ''}" required>
            </div>
            <div class="form-group">
                <label for="price_per_unit">Harga per Satuan (Rp)</label>
                <input type="number" id="price_per_unit" name="price_per_unit" value="${data?.price_per_unit || ''}" min="0" step="100" required>
            </div>
        `;
    }

    renderRecipeForm(data = null) {
        const categoryOptions = this.categoriesCache.map(cat => 
            `<option value="${cat.id}" ${data?.category_id === cat.id ? 'selected' : ''}>${cat.name}</option>`
        ).join('');

        const ingredientOptions = this.ingredientsCache.map(ing => 
            `<option value="${ing.id}" data-price="${ing.price_per_unit}" data-unit="${ing.unit}">${ing.name} (${ing.unit}) - ${this.formatRupiah(ing.price_per_unit)}</option>`
        ).join('');

        // Render existing ingredients if editing
        let ingredientsHtml = '';
        if (data && data.ingredients) {
            data.ingredients.forEach((ing, index) => {
                ingredientsHtml += this.createIngredientRow(ing.id, ing.name, ing.pivot.quantity, ing.pivot.total_price_for_this_recipe, ing.unit);
            });
        }

        this.formFields.innerHTML = `
            <div class="form-group">
                <label for="title">Judul Resep</label>
                <input type="text" id="title" name="title" value="${data?.title || ''}" required>
            </div>
            <div class="form-group">
                <label for="category_id">Kategori</label>
                <select id="category_id" name="category_id" required>
                    <option value="">Pilih Kategori</option>
                    ${categoryOptions}
                </select>
            </div>
            <div class="form-group">
                <label for="instructions">Instruksi / Cara Memasak</label>
                <textarea id="instructions" name="instructions" required>${data?.instructions || ''}</textarea>
            </div>
            <div class="form-group">
                <label for="image_url">URL Gambar (Opsional)</label>
                <input type="url" id="image_url" name="image_url" value="${data?.image_url || ''}" placeholder="https://...">
            </div>
            <div class="form-group">
                <label>Bahan-bahan</label>
                <div id="ingredientsContainer">
                    ${ingredientsHtml || '<p style="color: var(--gray); margin-bottom: 10px;">Belum ada bahan ditambahkan</p>'}
                </div>
                <button type="button" class="btn-add-ingredient" onclick="admin.addIngredientRow()">+ Tambah Bahan</button>
            </div>
        `;

        // Store ingredient options for dynamic adding
        this.ingredientOptionsHtml = ingredientOptions;
    }

    createIngredientRow(ingredientId = '', quantity = '', totalPrice = '', unit = '') {
        const options = this.ingredientsCache.map(ing => 
            `<option value="${ing.id}" data-price="${ing.price_per_unit}" data-unit="${ing.unit}" ${ingredientId == ing.id ? 'selected' : ''}>${ing.name} (${ing.unit}) - ${this.formatRupiah(ing.price_per_unit)}</option>`
        ).join('');

        return `
            <div class="ingredient-row">
                <select class="ingredient-select" onchange="admin.updateIngredientPrice(this)">
                    <option value="">Pilih Bahan</option>
                    ${options}
                </select>
                <input type="number" class="ingredient-quantity" placeholder="Jumlah" value="${quantity}" min="0.01" step="0.01" onchange="admin.calculateIngredientPrice(this)">
                <div class="ingredient-price">${totalPrice ? this.formatRupiah(totalPrice) : 'Rp 0'}</div>
                <button type="button" class="btn-remove-ingredient" onclick="admin.removeIngredientRow(this)">×</button>
            </div>
        `;
    }

    addIngredientRow() {
        const container = document.getElementById('ingredientsContainer');
        const emptyMsg = container.querySelector('p');
        if (emptyMsg) emptyMsg.remove();

        const row = document.createElement('div');
        row.innerHTML = this.createIngredientRow();
        container.appendChild(row.firstElementChild);
    }

    removeIngredientRow(btn) {
        const row = btn.closest('.ingredient-row');
        row.remove();
    }

    updateIngredientPrice(select) {
        const row = select.closest('.ingredient-row');
        const priceInput = row.querySelector('.ingredient-quantity');
        priceInput.dispatchEvent(new Event('change'));
    }

    calculateIngredientPrice(input) {
        const row = input.closest('.ingredient-row');
        const select = row.querySelector('.ingredient-select');
        const priceDiv = row.querySelector('.ingredient-price');
        
        const selectedOption = select.options[select.selectedIndex];
        const pricePerUnit = parseFloat(selectedOption.dataset.price) || 0;
        const quantity = parseFloat(input.value) || 0;
        
        const totalPrice = pricePerUnit * quantity;
        priceDiv.textContent = this.formatRupiah(totalPrice);
    }

    // =====================
    // Form Submit Handler
    // =====================

    async handleFormSubmit() {
        const formData = new FormData(this.modalForm);
        const data = Object.fromEntries(formData.entries());

        let endpoint = '';
        let method = 'POST';

        switch (this.currentSection) {
            case 'recipes':
                endpoint = `${this.apiBaseUrl}/recipes`;
                if (this.isEditMode) {
                    endpoint += `/${this.currentEditId}`;
                    method = 'PUT';
                }
                
                // Collect ingredients
                const ingredientRows = document.querySelectorAll('.ingredient-row');
                const ingredients = [];
                ingredientRows.forEach(row => {
                    const select = row.querySelector('.ingredient-select');
                    const quantity = row.querySelector('.ingredient-quantity');
                    if (select.value && quantity.value) {
                        ingredients.push({
                            ingredient_id: parseInt(select.value),
                            quantity: parseFloat(quantity.value)
                        });
                    }
                });
                data.ingredients = ingredients;
                break;

            case 'categories':
                endpoint = `${this.apiBaseUrl}/categories`;
                if (this.isEditMode) {
                    endpoint += `/${this.currentEditId}`;
                    method = 'PUT';
                }
                break;

            case 'ingredients':
                endpoint = `${this.apiBaseUrl}/ingredients`;
                if (this.isEditMode) {
                    endpoint += `/${this.currentEditId}`;
                    method = 'PUT';
                }
                data.price_per_unit = parseFloat(data.price_per_unit);
                break;
        }

        try {
            const response = await fetch(endpoint, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (result.success) {
                alert(result.message);
                this.closeModalFunc();
                this.refreshCurrentSection();
            } else {
                alert(result.message || 'Terjadi kesalahan');
            }
        } catch (error) {
            console.error('Error submitting form:', error);
            alert('Terjadi kesalahan saat menyimpan data');
        }
    }

    // =====================
    // Edit Methods
    // =====================

    async editRecipe(id) {
        try {
            const response = await fetch(`${this.apiBaseUrl}/recipes/${id}`);
            const result = await response.json();
            if (result.success) {
                this.currentEditId = id;
                this.openEditModal(result.data);
            }
        } catch (error) {
            console.error('Error loading recipe:', error);
        }
    }

    async editCategory(id) {
        try {
            const response = await fetch(`${this.apiBaseUrl}/categories/${id}`);
            const result = await response.json();
            if (result.success) {
                this.currentEditId = id;
                this.openEditModal(result.data);
            }
        } catch (error) {
            console.error('Error loading category:', error);
        }
    }

    async editIngredient(id) {
        try {
            const response = await fetch(`${this.apiBaseUrl}/ingredients/${id}`);
            const result = await response.json();
            if (result.success) {
                this.currentEditId = id;
                this.openEditModal(result.data);
            }
        } catch (error) {
            console.error('Error loading ingredient:', error);
        }
    }

    // =====================
    // Delete Methods
    // =====================

    deleteRecipe(id) {
        this.currentEditId = id;
        this.deleteMessage.textContent = 'Apakah Anda yakin ingin menghapus resep ini?';
        this.deleteModal.classList.remove('hidden');
        this.confirmDelete.onclick = () => this.executeDelete('recipes');
    }

    deleteCategory(id) {
        this.currentEditId = id;
        this.deleteMessage.textContent = 'Apakah Anda yakin ingin menghapus kategori ini?';
        this.deleteModal.classList.remove('hidden');
        this.confirmDelete.onclick = () => this.executeDelete('categories');
    }

    deleteIngredient(id) {
        this.currentEditId = id;
        this.deleteMessage.textContent = 'Apakah Anda yakin ingin menghapus bahan ini?';
        this.deleteModal.classList.remove('hidden');
        this.confirmDelete.onclick = () => this.executeDelete('ingredients');
    }

    closeDeleteModal() {
        this.deleteModal.classList.add('hidden');
    }

    async executeDelete(type) {
        try {
            const response = await fetch(`${this.apiBaseUrl}/${type}/${this.currentEditId}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json'
                }
            });

            const result = await response.json();

            if (result.success) {
                alert(result.message);
                this.closeDeleteModal();
                this.refreshCurrentSection();
            } else {
                alert(result.message || 'Gagal menghapus data');
            }
        } catch (error) {
            console.error('Error deleting:', error);
            alert('Terjadi kesalahan saat menghapus data');
        }
    }

    // =====================
    // Refresh Methods
    // =====================

    refreshCurrentSection() {
        switch (this.currentSection) {
            case 'recipes':
                this.loadRecipes();
                break;
            case 'categories':
                this.loadCategories();
                break;
            case 'ingredients':
                this.loadIngredients();
                break;
        }
    }
}

// Initialize
let admin;
document.addEventListener('DOMContentLoaded', () => {
    admin = new AdminDashboard();
});