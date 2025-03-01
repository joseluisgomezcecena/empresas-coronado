<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   

     <!-- Primary Meta Tags -->
     <title><?php echo isset($title) ? $title . ' | Empresas Coronado' : 'Empresas Coronado - Refacciones para Automóviles'; ?></title>
    <meta name="title" content="<?php echo isset($title) ? $title . ' | Empresas Coronado' : 'Empresas Coronado - Refacciones para Automóviles'; ?>">
    <meta name="description" content="<?php echo isset($product) ? $product['product_name'] . ' para ' . $product['car_brand'] . ' ' . $product['car_model'] : 'Encuentra las mejores refacciones para tu automóvil. Gran variedad de marcas y modelos. Servicio de calidad y precios competitivos.'; ?>">
    <meta name="author" content="Empresas Coronado">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo current_url(); ?>">


    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url('assets/favicon/apple-touch-icon.png'); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('assets/favicon/favicon-32x32.png'); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('assets/favicon/favicon-16x16.png'); ?>">
    <link rel="manifest" href="<?php echo base_url('assets/favicon/site.webmanifest'); ?>">
    


    <!-- Open Graph / Facebook -->
    <?php if(isset($product)): ?>
    <meta property="og:type" content="product">
    <meta property="og:title" content="<?php echo $product['product_name']; ?> | Empresas Coronado">
    <meta property="og:description" content="<?php echo $product['part_number']; ?> para <?php echo $product['brand_name']; ?> <?php echo $product['car_model']; ?>. Disponible en stock.">
    <meta property="og:url" content="<?php echo current_url(); ?>">
    <?php if(!empty($product['product_image'])): ?>
    <meta property="og:image" content="<?php echo base_url('uploads/products/' . $product['product_image']); ?>">
    <meta property="og:image:alt" content="<?php echo $product['product_name']; ?>">
    <?php else: ?>
    <meta property="og:image" content="<?php echo base_url('assets/images/no-image.png'); ?>">
    <meta property="og:image:alt" content="Imagen no disponible">
    <?php endif; ?>
    <?php else: ?>
    <meta property="og:type" content="website">
    <meta property="og:title" content="Empresas Coronado - Refacciones para Automóviles">
    <meta property="og:description" content="Encuentra las mejores refacciones para tu automóvil. Gran variedad de marcas y modelos. Servicio de calidad y precios competitivos.">
    <meta property="og:url" content="<?php echo current_url(); ?>">
    <meta property="og:image" content="<?php echo base_url('assets/images/og-default.jpg'); ?>">
    <meta property="og:image:alt" content="Empresas Coronado">
    <?php endif; ?>
    <meta property="og:site_name" content="Empresas Coronado">
    <meta property="og:locale" content="es_MX">
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo isset($product) ? $product['product_name'] . ' | Empresas Coronado' : 'Empresas Coronado - Refacciones para Automóviles'; ?>">
    <meta name="twitter:description" content="<?php echo isset($product) ? $product['part_number'] . ' para ' . $product['brand_name'] . ' ' . $product['car_model'] : 'Encuentra las mejores refacciones para tu automóvil. Gran variedad de marcas y modelos.'; ?>">
    <?php if(isset($product) && !empty($product['product_image'])): ?>
    <meta name="twitter:image" content="<?php echo base_url('uploads/products/' . $product['product_image']); ?>">
    <?php else: ?>
    <meta name="twitter:image" content="<?php echo base_url('assets/images/og-default.jpg'); ?>">
    <?php endif; ?>
    
    <!-- Structured Data / JSON-LD -->
    <?php if(isset($product)): ?>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org/",
        "@type": "Product",
        "name": "<?php echo $product['product_name']; ?>",
        "image": "<?php echo !empty($product['product_image']) ? base_url('uploads/products/' . $product['product_image']) : base_url('assets/images/no-image.png'); ?>",
        "description": "<?php echo $product['part_number']; ?> para <?php echo $product['brand_name']; ?> <?php echo $product['car_model']; ?>",
        "sku": "<?php echo $product['part_number']; ?>",
        "brand": {
            "@type": "Brand",
            "name": "<?php echo $product['brand_name']; ?>"
        },
        "offers": {
            "@type": "Offer",
            "url": "<?php echo current_url(); ?>",
            "priceCurrency": "MXN",
            "price": "<?php echo $product['sale_price']; ?>",
            "availability": "<?php echo ($product['current_stock'] > 0) ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock'; ?>",
            "seller": {
                "@type": "Organization",
                "name": "Empresas Coronado"
            }
        }
    }
    </script>
    <?php else: ?>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org/",
        "@type": "Organization",
        "name": "Empresas Coronado",
        "url": "<?php echo base_url(); ?>",
        "logo": "<?php echo base_url('assets/images/logo.png'); ?>",
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+52123456789",
            "contactType": "customer service"
        }
    }
    </script>
    <?php endif; ?>
    



    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- Preconnect to external domains -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">

    <style>
        .hero {
            background: url('<?php echo base_url() ?>assets/images/car1.jpg') center/cover no-repeat;
            height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            flex-direction: column;
            position: relative;
        }

        .search-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: absolute;
            width: 80%;
            left: 50%;
            transform: translateX(-50%);
            top: 70vh;
            z-index: 10;
        }

        .font-bolder {
            font-weight: 700 !important;
        }

        .btn{
            border-radius:.25rem!important;
            font-weight: 700 !important;
        }

        /* on mobile */
        @media (max-width: 768px) {
            .hero {
                height: 80vh;
            }

            .search-card {
                top: 65vh;
            }

            .margin-mobile {
                margin-top: 250px;
            }
        }

        .navbar-toggler{
            border: none;
        }

        a{
            text-decoration: none !important;
        }

        .bg-black{
            background-color: #000 !important;
        }

    </style>
</head>
<body>

    