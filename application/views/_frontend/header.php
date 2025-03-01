<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Empresas Coronado</title>
    <?php if(isset($product)): ?>
    <!-- Open Graph Tags for Social Sharing -->
    <meta property="og:title" content="<?php echo $product['product_name']; ?>" />
    <meta property="og:description" content="<?php echo $product['part_number']; ?> para <?php echo $product['car_brand']; ?> <?php echo $product['car_model']; ?>" />
    <meta property="og:type" content="product" />
    <meta property="og:url" content="<?php echo current_url(); ?>" />
    <?php if(!empty($product['product_image'])): ?>
    <meta property="og:image" content="<?php echo base_url('uploads/products/' . $product['product_image']); ?>" />
    <?php else: ?>
    <meta property="og:image" content="<?php echo base_url('assets/images/no-image.png'); ?>" />
    <?php endif; ?>
    <meta property="og:site_name" content="Empresas Coronado" />
    <?php endif; ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

    