<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Commerce</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;500&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom, #f1f4f9, #dff1ff);
        }

        h1 {
            text-align: center;
            padding: 20px;
            font-size: 2.5rem;
            background: linear-gradient(to right, #2575fc, #6a11cb);
            color: #fff;
            margin: 0 0 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            width: 300px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: scale(1.1);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.25);
        }

        .card img {
    width: 100%;
    height: 250px; /* Augmenté légèrement */
    object-fit: cover;
}

.card .info h3 {
    margin: 5px 0; /* Réduit l'espace autour du titre */
    font-size: 1.3rem; /* Taille adaptée */
    color: #333;
}

.card .info p {
    margin: 3px 0; /* Réduit l'espace entre les paragraphes */
    font-size: 1rem;
    color: #555;
}

.card .info .price {
    font-size: 1.2rem;
    margin: 10px 0; /* Réduit l'espace avant et après */
}


        .card .info {
            padding: 20px;
        }

        .card .info h3 {
            margin: 0;
            font-size: 1.4rem;
            color: #333;
        }

        .card .info p {
            margin: 5px 0;
            font-size: 1rem;
            color: #555;
        }

        .card .info .price {
            font-size: 1.3rem;
            margin: 15px 0;
        }

        .card .info .price .old-price {
            text-decoration: line-through;
            color: #b2b2b2;
            font-size: 1rem;
        }

        .card .info .price .new-price {
            color: #e74c3c;
            font-weight: bold;
        }

        .card .info .buy-btn {
            margin-top: 15px;
            display: inline-block;
            padding: 12px 25px;
            background: linear-gradient(to right, #2575fc, #6a11cb);
            color: #fff;
            font-weight: bold;
            font-size: 1rem;
            text-decoration: none;
            border-radius: 30px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .card .info .buy-btn i {
            margin-right: 8px;
        }

        .card .info .buy-btn:hover {
            transform: translateY(-5px);
            background: linear-gradient(to right, #1b4f9d, #5d0ba0);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        @media screen and (max-width: 768px) {
            .card {
                width: 90%;
            }

            h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <h1>Nos Produits</h1>
    <div class="container">
        <div class="card">
            <img src="images/font.png" alt="Produit 1">
            <div class="info">
                <h3>Nom : Produit 1</h3>
                <p>Modèle : XYZ123</p>
                <p class="price">
                    <span class="old-price">120 €</span>
                    <span class="new-price">80 €</span>
                </p>
                <a href="#" class="buy-btn">
                    <i class="fas fa-shopping-cart"></i> Acheter
                </a>
            </div>
        </div>

        <div class="card">
            <img src="images/produit2.jpg" alt="Produit 2">
            <div class="info">
                <h3>Nom : Produit 2</h3>
                <p>Modèle : ABC456</p>
                <p class="price">
                    <span class="old-price">180 €</span>
                    <span class="new-price">150 €</span>
                </p>
                <a href="#" class="buy-btn">
                    <i class="fas fa-shopping-cart"></i> Acheter
                </a>
            </div>
        </div>

        <div class="card">
            <img src="images/produit3.jpg" alt="Produit 3">
            <div class="info">
                <h3>Nom : Produit 3</h3>
                <p>Modèle : DEF789</p>
                <p class="price">
                    <span class="old-price">250 €</span>
                    <span class="new-price">200 €</span>
                </p>
                <a href="#" class="buy-btn">
                    <i class="fas fa-shopping-cart"></i> Acheter
                </a>
            </div>
        </div>
    </div>
</body>
</html>
