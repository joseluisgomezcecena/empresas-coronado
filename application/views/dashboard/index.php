<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<div class="page-header">
    <h2 class="header-title">Dashboard</h2>
</div>

<!-- Quick Stats Cards -->
<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="avatar avatar-icon avatar-lg avatar-blue">
                        <i class="anticon anticon-shopping"></i>
                    </div>
                    <div class="m-l-15">
                        <h2 class="m-b-0"><?php echo number_format($total_products); ?></h2>
                        <p class="m-b-0 text-muted">Productos Totales</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- Sales Stats Card -->
<div class="col-md-3">
    <div class="card">
        <div class="card-body">
            <div class="media align-items-center">
                <div class="avatar avatar-icon avatar-lg avatar-green">
                    <i class="anticon anticon-shopping-cart"></i>
                </div>
                <div class="m-l-15">
                    <h2 class="m-b-0"><?php echo number_format($total_sales); ?></h2>
                    <p class="m-b-0 text-muted">Ventas Totales</p>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="avatar avatar-icon avatar-lg avatar-gold">
                        <i class="anticon anticon-dollar"></i>
                    </div>
                    <div class="m-l-15">
                        <h2 class="m-b-0">$<?php echo number_format($total_inventory_value, 2); ?></h2>
                        <p class="m-b-0 text-muted">Valor de Inventario</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="avatar avatar-icon avatar-lg avatar-cyan">
                        <i class="anticon anticon-sync"></i>
                    </div>
                    <div class="m-l-15">
                        <h2 class="m-b-0"><?php echo number_format($movements_count); ?></h2>
                        <p class="m-b-0 text-muted">Movimientos Recientes</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Movimientos de Inventario</h4>
            </div>
            <div class="card-body">
                <div id="inventory-movements-chart" style="height: 350px;"></div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Distribución por Categoría</h4>
            </div>
            <div class="card-body">
                <div id="category-distribution-chart" style="height: 350px;"></div>
            </div>
        </div>
    </div>
</div>

<!-- Lists Row -->
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Productos Más Movidos</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Movimientos</th>
                                <th>Stock Actual</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($top_products as $product): ?>
                            <tr>
                                <td><?php echo $product['product_name']; ?></td>
                                <td><?php echo $product['movements']; ?></td>
                                <td><?php echo $product['current_stock']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Últimos Movimientos</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Producto</th>
                                <th>Tipo</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recent_movements as $movement): ?>
                            <tr>
                                <td><?php echo date('d/m/Y', strtotime($movement['created_at'])); ?></td>
                                <td><?php echo $movement['product_name']; ?></td>
                                <td>
                                    <?php if ($movement['movement_type'] === 'entrada'): ?>
                                        <span class="badge badge-success">Entrada</span>
                                    <?php else: ?>
                                        <span class="badge badge-danger">Salida</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo $movement['quantity']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Ventas Últimos 30 Días</h4>
            </div>
            <div class="card-body">
                <div id="sales-chart" style="height: 350px;"></div>
            </div>
        </div>
    </div>


<!-- Monthly Sales Table -->

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Ventas por Mes</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Mes</th>
                                <th>Número de Ventas</th>
                                <th>Artículos Vendidos</th>
                                <th>Monto Total</th>
                                <th>Promedio por Venta</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($monthly_sales as $month): ?>
                            <tr>
                                <td><?php echo $month['month_name']; ?></td>
                                <td><?php echo number_format($month['total_sales']); ?></td>
                                <td><?php echo number_format($month['total_items']); ?></td>
                                <td>$<?php echo number_format($month['total_amount'], 2); ?></td>
                                <td>$<?php echo number_format($month['total_amount'] / $month['total_sales'], 2); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inventory Movements Chart
    const movementsData = <?php echo json_encode($inventory_movements); ?>;
    
    const movementsOptions = {
        series: [{
            name: 'Entradas',
            data: movementsData.map(item => ({
                x: new Date(item.date).getTime(),
                y: parseInt(item.entradas)
            }))
        }, {
            name: 'Salidas',
            data: movementsData.map(item => ({
                x: new Date(item.date).getTime(),
                y: parseInt(item.salidas)
            }))
        }],
        chart: {
            type: 'area',
            height: 350,
            toolbar: {
                show: false
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 2
        },
        colors: ['#52c41a', '#ff4d4f'],
        fill: {
            type: 'gradient',
            gradient: {
                opacityFrom: 0.6,
                opacityTo: 0.1
            }
        },
        legend: {
            position: 'top',
            horizontalAlign: 'right'
        },
        xaxis: {
            type: 'datetime',
            labels: {
                format: 'dd/MM/yy'
            }
        },
        tooltip: {
            x: {
                format: 'dd/MM/yy'
            }
        }
    };

    const movementsChart = new ApexCharts(
        document.querySelector("#inventory-movements-chart"), 
        movementsOptions
    );
    movementsChart.render();

    // Category Distribution Chart
    const categoryData = <?php echo json_encode($category_distribution); ?>;
    
    const categoryOptions = {
        series: categoryData.map(item => parseInt(item.product_count)),
        chart: {
            type: 'donut',
            height: 350
        },
        labels: categoryData.map(item => item.category_name),
        colors: ['#1890ff', '#52c41a', '#faad14', '#f5222d', '#722ed1', '#13c2c2', '#fadb14'],
        legend: {
            position: 'bottom'
        },
        plotOptions: {
            pie: {
                donut: {
                    size: '70%',
                    labels: {
                        show: true,
                        total: {
                            show: true,
                            label: 'Total',
                            formatter: function(w) {
                                return w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                            }
                        }
                    }
                }
            }
        }
    };

    const categoryChart = new ApexCharts(
        document.querySelector("#category-distribution-chart"), 
        categoryOptions
    );
    categoryChart.render();

    // Brand Statistics Chart
    const brandData = <?php echo json_encode($brand_stats); ?>;
    
    const brandOptions = {
        series: [{
            name: 'Productos',
            data: brandData.map(item => parseInt(item.product_count))
        }],
        chart: {
            type: 'bar',
            height: 350
        },
        plotOptions: {
            bar: {
                horizontal: true,
                borderRadius: 4
            }
        },
        colors: ['#1890ff'],
        dataLabels: {
            enabled: false
        },
        xaxis: {
            categories: brandData.map(item => item.brand_name)
        },
        yaxis: {
            labels: {
                style: {
                    colors: ['#777']
                }
            }
        }
    };

    const brandChart = new ApexCharts(
        document.querySelector("#brand-statistics-chart"), 
        brandOptions
    );
    brandChart.render();




    // Sales Chart
const salesData = <?php echo json_encode($sales_chart_data); ?>;

const salesOptions = {
    series: [{
        name: 'Ventas',
        data: salesData.map(item => ({
            x: new Date(item.date).getTime(),
            y: parseInt(item.sales_count)
        }))
    }, {
        name: 'Ingresos',
        data: salesData.map(item => ({
            x: new Date(item.date).getTime(),
            y: parseFloat(item.revenue)
        }))
    }],
    chart: {
        type: 'line',
        height: 350,
        toolbar: {
            show: false
        },
        zoom: {
            enabled: false
        }
    },
    stroke: {
        curve: 'smooth',
        width: [2, 2]
    },
    colors: ['#1890ff', '#52c41a'],
    xaxis: {
        type: 'datetime',
        labels: {
            format: 'dd/MM/yy'
        }
    },
    yaxis: [{
        title: {
            text: 'Número de Ventas'
        },
        min: 0,  // Force y-axis to start at 0
        tickAmount: 4,  // Show more ticks
        forceNiceScale: true  // Force nice rounded numbers
    }, {
        opposite: true,
        title: {
            text: 'Ingresos ($)'
        },
        min: 0,  // Force y-axis to start at 0
        forceNiceScale: true
    }],
    legend: {
        position: 'top'
    },
    tooltip: {
        x: {
            format: 'dd/MM/yy'
        }
    },
    markers: {
        size: 5,  // Make points more visible
        hover: {
            size: 7
        }
    }
};

const salesChart = new ApexCharts(
    document.querySelector("#sales-chart"), 
    salesOptions
);
salesChart.render();





    // Optional: Add responsive behavior
    window.addEventListener('resize', function() {
        movementsChart.updateOptions({
            chart: {
                height: window.innerWidth < 768 ? 250 : 350
            }
        });
        categoryChart.updateOptions({
            chart: {
                height: window.innerWidth < 768 ? 250 : 350
            }
        });
        brandChart.updateOptions({
            chart: {
                height: window.innerWidth < 768 ? 250 : 350
            }
        });
        salesChart.updateOptions({
            chart: {
                height: window.innerWidth < 768 ? 250 : 350
            }
        });
    });
});
</script>