

    <header class="hero">
        <div class="container">
            <h1 class="display-4 font-bolder">Empresas Coronado</h1>
            <p class="lead">Partes para todas las marcas y modelos</p>
        </div>
    </header>

    <div class="search-card mb-5">
    <h2 class="font-bolder mb-2">Busqueda de piezas</h2>
    <p class="lead">Busca piezas en nuestro amplio inventario.</p>
    <form class="row g-3 mb-4"  method="get" action="<?php echo base_url('pages/search'); ?>">
        <div class="col-md-2">
            <select class="form-select" id="brand-select" name="brand" aria-label="Seleccionar Marca">
                <option value="">Marca</option>
                <?php foreach($brands as $brand): ?>
                    <option value="<?php echo $brand['id']; ?>"><?php echo $brand['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-2">
            <select class="form-select" id="model-select" name="model" aria-label="Seleccionar Modelo" disabled>
                <option value="">Modelo</option>
            </select>
        </div>
        <div class="col-md-2">
            <select class="form-select" name="year" aria-label="Seleccionar Año">
                <option value="">Año</option>
                <?php 
                $current_year = date('Y');
                for($i = $current_year; $i >= 1950; $i--): 
                ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control" id="search-input" name="search" placeholder="Buscar Parte">
            <div id="search-results" class="position-absolute w-100 bg-white shadow-sm" style="display:none; z-index: 1000;"></div>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-dark w-100">Buscar</button>
        </div>
        <a style="text-decoration:none;" href="<?php echo base_url("catalogo") ?>">Busqueda Avanzada ></a>
    </form>
</div>
    
    <section id="about" class="py-5 text-center mt-5">
        <div class="container margin-mobile">
            <h2 class="mt-5 font-bolder">Encuentra las Mejores Autopartes al Mejor Precio</h2>
            <p class="lead">En Empresas Coronado, ofrecemos una amplia selección de autopartes para todas las marcas y modelos.
                 Nuestro yonque cuenta con piezas originales a precios accesibles, garantizando calidad y rendimiento para tu vehículo.
                Aquí encontrarás lo que buscas con la mejor atención y servicio.</p>
            <div class="row mt-5">
                <div class="col-md-8">
                    <div class="card shadow p-3 bg-dark text-white mb-5">
                        <h3 style="font-weight:800">¿Por qué elegirnos?</h3>

                        <h5>Calidad Y Disponibilidad</h5>
                        <p>
                        Nuestro inventario en línea te permite encontrar autopartes fácilmente, 
                        con disponibilidad garantizada y acceso 24/7 desde cualquier dispositivo. ¡Compra rápido y sin complicaciones!
                        </p>
                        <br><br/>
                        <a href="<?php echo base_url("catalogo") ?>" class="btn btn-primary btn-lg mb-3">Ver Catalogo</a>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <img src="<?php echo base_url("assets/images/pickup-01.png") ?>" alt="">
                </div>
            </div>
        </div>
    </section>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const brandSelect = document.getElementById('brand-select');
    const modelSelect = document.getElementById('model-select');
    const searchInput = document.getElementById('search-input');
    const searchResults = document.getElementById('search-results');
    let searchTimeout;

    // Handle brand selection
    brandSelect.addEventListener('change', async function() {
        const brandId = this.value;
        modelSelect.disabled = true;
        modelSelect.innerHTML = '<option value="">Modelo</option>';

        if(brandId) {
            try {
                const response = await fetch('<?php echo base_url("pages/get_models"); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `brand_id=${brandId}`
                });
                
                if (!response.ok) throw new Error('Network response was not ok');
                
                const models = await response.json();
                
                models.forEach(model => {
                    const option = document.createElement('option');
                    option.value = model.id;
                    option.textContent = model.name;
                    modelSelect.appendChild(option);
                });
                
                modelSelect.disabled = false;
            } catch (error) {
                console.error('Error:', error);
            }
        }
    });

    // Predictive search
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        const term = this.value;
        
        if(term.length >= 3) {
            searchTimeout = setTimeout(async function() {
                try {
                    const response = await fetch('<?php echo base_url("pages/search_products"); ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `term=${encodeURIComponent(term)}`
                    });
                    
                    if (!response.ok) throw new Error('Network response was not ok');
                    
                    const products = await response.json();
                    
                    if(products.length > 0) {
                        searchResults.innerHTML = products.map(product => `
                            <div class="p-2 search-item border-bottom" role="button" 
                                 onclick="selectProduct('${product.product_name}')">
                                ${product.product_name} - ${product.part_number}
                            </div>
                        `).join('');
                        searchResults.style.display = 'block';
                    } else {
                        searchResults.innerHTML = '<div class="p-2">No se encontraron resultados</div>';
                        searchResults.style.display = 'block';
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            }, 300);
        } else {
            searchResults.style.display = 'none';
        }
    });

    // Hide search results when clicking outside
    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
            searchResults.style.display = 'none';
        }
    });

    // Function to select a product from search results
    window.selectProduct = function(productName) {
        searchInput.value = productName;
        searchResults.style.display = 'none';
    };
});
</script>

<style>
.search-item:hover {
    background-color: #f8f9fa;
    cursor: pointer;
}

#search-results {
    max-height: 300px;
    overflow-y: auto;
    border: 1px solid #ddd;
    border-top: none;
    border-radius: 0 0 4px 4px;
}
</style>